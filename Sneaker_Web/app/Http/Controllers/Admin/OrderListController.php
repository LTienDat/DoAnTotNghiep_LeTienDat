<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Services\OrderService;
use App\Models\InfoOrder;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class OrderListController extends Controller
{
    protected $orderservice;

    public function __construct(OrderService $orderservice){
        $this->orderservice = $orderservice;
    }
    public function index(){
        return view("admin.carts.customer",[
            'title' => 'Danh sách đơn đặt hàng',
            'customers'=> $this->orderservice->getCustomer(),
        ]);
    }
    
    public function search(Request $request){
        $customers = $this->orderservice->searchOrder($request);
        return view("admin.carts.customer", [
            'title'=>'Danh sách đơn đặt hàng',
            'customers'=>$customers
        ]);
    }


    public function show(Customer $customer, Cart $cart){
        $carts = $customer->carts()->with('product')->get();
        $total = 0;
        foreach($carts as $cart){
            $total += $cart->price;
        }
        return view('admin.carts.detail',[
            'title'=> 'Chi tiết đơn hàng',
            'customers' => $customer,
            'carts' => $carts,
            'total' => $total,
        ]);
    }

    public function updateStatus(Request $request, $i){
        $id = intval($i);
        $option = $request->input('option');
        $customer = Customer::where('id', $id)->update(['status_order' => $option]);
        if($customer){
            return true;
        }else{
            return false;
        }
    }
    public function destroy(Request $request){
        $result = false;
        $id = intval($request->input('id'));
        $order = Cart::where('id', $id)->first();
        $result = $order->delete();
        if($result){
            return response()->json([
                'error'=> false,
                'message'=> 'Xóa thành công sản phẩm'
            ]);
        }
        return response()->json([
            'error'=> true,
            'message'=> 'Xóa thành sản phẩm thất bại'
        ]);
    }
    public function destroyCustomer(Request $request){
        $result = false;
        $customer = Customer::where('id', $request->input('id'))->first();
        $result = $customer->delete();
        if($result){
            return response()->json([
                'error'=> false,
                'message'=> 'Xóa thành công sản phẩm'
            ]);
        }
        return response()->json([
            'error'=> true,
            'message'=> 'Xóa thành sản phẩm thất bại'
        ]);
    }
}
