<?php

namespace App\Http\Controllers;

use App\Http\Services\ProfileService;
use App\Http\Services\UserService;
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
        $customer = $this->ProfileService->customer();
        return view('profileUser.order',[
            'title'=> 'Danh sách đơn hàng đã đặt',
            'carts'=> $carts,
            'customers' => $customer
        ]);
    }
}
