<?php 
namespace App\Http\Services;
use App\Models\Cart;
use App\Models\Customer;

class OrderService{
    public function getCustomer(){
        return Customer::with('carts')->orderByDesc("id")->paginate(10);
    }

    public function searchOrder($request)
    {
        $key = $request->input('query');

        // Sử dụng paginate trước khi get() để lấy dữ liệu đã phân trang
        return Customer::where( function ($query) use ($key) {
            $query->where('name', 'like', '%' . $key . '%')
                ->orWhere('phone', $key)
                ->orWhere('id', $key)
                ->orWhere('email', $key);
        })->paginate(15); // Phân trang với mỗi trang 15 sản phẩm
    }

}