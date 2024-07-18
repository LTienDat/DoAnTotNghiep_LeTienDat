<?php

namespace App\Http\Controllers;

use App\Http\Services\ProfileService;
use App\Http\Services\UserService;
use App\Models\Cart;
use App\Models\Customer;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $ProfileService;
    public function __construct(ProfileService $ProfileService){
        $this->ProfileService = $ProfileService;
    }
    public function showProfile(){
        return view("profileUser/profile",[
            'title' => 'Thông tin cá nhân'
        ]);
    }

    public function store(Request $request){
        $this->ProfileService->updateUser( $request);
        return redirect()->back();
    }

    public function order(){
        $carts = $this->ProfileService->showOrder();
        $customerOrder = $this->ProfileService->customer();
        $customerIdCounts = [];
        foreach ($carts as $value) {
            if (isset($customerIdCounts[$value->customer_id])) {
                $customerIdCounts[$value->customer_id]++;
            } else {
                $customerIdCounts[$value->customer_id] = 1;
            }
        }
        $customerId = [];
        foreach ($carts as $value) {
            if ($customerIdCounts[$value->customer_id] >= 2) {
                $customerId[] = $value->customer_id;
            }
        }
        $customers = Cart::whereIn('customer_id', $customerId)->with('product')->get();
        return view('profileUser.order',[
            'title'=> 'Danh sách đơn hàng đã đặt',
            'carts'=> $carts,
            'customers' => $customerOrder,
            'cus' => $customers,
            'customerIdCounts' => $customerIdCounts
        ]);
    }
}
