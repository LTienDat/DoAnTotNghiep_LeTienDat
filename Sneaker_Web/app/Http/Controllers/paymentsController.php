<?php

namespace App\Http\Controllers;

use App\Http\Services\PaymentService;
use App\Models\Cart;
use App\Models\InfoCustomTemporary;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Facades\JWTAuth;

class paymentsController extends Controller
{
    protected $payments;
    public function __construct(PaymentService $payments){
        $this->payments = $payments;
    }
    public function pay(Request $request){

        $infoCustomer = InfoCustomTemporary::first();
        $products = $this->payments->getProduct();
        $carts = Session::get('carts');
        if(!empty($carts)){
            $keycarts = array_keys($carts);
            foreach( $keycarts as $key=>$value ) {
                $keycart[] = $value;
            }
        }else{
            $keycart = [];
        }
        return view('pay', [
            'title'=> 'Danh sách giỏ hàng',
            'products' => $products,
            'carts' => $carts,
            'keycarts' => $keycart,
            "infoCustomer" => $infoCustomer,
            'request' => $request
        ]);
    }

    public function order(Request $request){ 
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:10',
            'address' => 'required|string|max:255',
        ], [
            'name.required' => 'Vui lòng nhập tên của bạn.',
            'email.required' => 'Vui lòng nhập email của bạn.',
            'phone.required' => 'Vui lòng nhập số điện thoại của bạn.',
            'address.required' => 'Vui lòng nhập địa chỉ của bạn.',
        ]);
        if($request->input("payment_VNP") == "1") {
            return $this->payments->VNPay($request);
        }else{
            $this->payments->pay($request);
            return redirect()->back();
        }
    }

//    public function VNPay(Request $request){   
//         $this->payments->VNPay($request);
//    }

public function VNPayReturn(Request $request){
    dd(1);
    $infoPayment = $this->payments->VNPReturn($request);
    return view('paymentVNP', [
        'title' => 'Thông tin giao dịch',
        'infoPayment' => $infoPayment,
        'request' => $request
    ]);
}


}