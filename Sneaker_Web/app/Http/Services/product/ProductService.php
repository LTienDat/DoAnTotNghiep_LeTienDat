<?php 
namespace App\Http\Services\product;

use App\Models\Menu;
use App\Models\Product;
use App\Models\WareHouse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ProductService {
   public function getMenu(){
        return Menu::where('active',1)->get();
   }

   protected function isValidPrice($request){
    if($request->input("price") != "0" && 
    $request->input("price_sale") != "0" &&
    $request->input('price_sale') >= $request->input('price')){
        Session::flash('error','Giá giảm phải nhỏ hơn giá gốc');
        return false;
    }

    if($request->input("price_sale") != "0" && 
    (int)$request->input("price") == "0"){
        Session::flash('error','Vui lòng nhập giá gốc');
        return false;
    }

    return true;
   }

   public function insert($request){
    $isvalidPrice = $this->isValidPrice($request);
    if($isvalidPrice == false){
        return false;
    }
    try{
        $request->except('_token');
        Product::create($request->all());

        Session::flash('success','Thêm sản phẩm thành công');
    }catch(\Exception $e){
        Session::flash('error','Thêm sản phẩm thât bại');
        \Log::info($e->getMessage());
        return false;
    }
    return true;

    }
    public function get(){
        return Product::with('menu')
        ->orderByDesc('id')->paginate(15);
    }


    public function update($request, $product){
        $isvalidPrice = $this->isValidPrice($request);
        if($isvalidPrice == false){
            return false;
        }

        try{
            $product -> fill($request->input());
            $product -> save();
            Session::flash('success','Cập nhật thành công');
        }catch(\Exception $e){
            Session::flash('error','Cập nhật thất bại');
            \Log::info($e->getMessage());
            return false;
        }
        return true;    

    }

    public function delete($request){
        $product = Product::where('id', $request->input('id'))->first();
        if($product){
            $product->delete();
            return true;
        }
        return false;

    }

    public function getware(){
        return Product::with('warehouse')->get();
    }

    public function searchProduct($request)
    {
        $key = $request->input('query');

        // Sử dụng paginate trước khi get() để lấy dữ liệu đã phân trang
        return Product::where(function ($query) use ($key) {
            $query->where('name', 'like', '%' . $key . '%')
                ->orWhere('id', $key)
                ->orWhere('price', $key);
        })->paginate(15); // Phân trang với mỗi trang 15 sản phẩm
    }

}

