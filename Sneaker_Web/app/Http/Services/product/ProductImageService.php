<?php 
namespace App\Http\Services\Product;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Session;

class ProductImageService{
    public function getAll(){
        return ProductImage::with('product')->get();
    }

    public function getProduct(){
        return Product::get();
    }

    public function insert($request){
        try{
            $request->except('_token');
            ProductImage::create($request->all());
    
            Session::flash('success','Thêm ảnh sản phẩm thành công');
        }catch(\Exception $e){
            Session::flash('error','Thêm ảnh sản phẩm thât bại');
            \Log::info($e->getMessage());
            return false;
        }
        return true;   
    }

    public function getShow($id){
        return ProductImage::with('product')->find($id);
    }

    public function edit($ProductImage,$request){
        try{
            $ProductImage -> fill($request->input());
            $ProductImage -> save();
            Session::flash('success','Cập nhật thành công');
        }catch(\Exception $e){
            Session::flash('error','Cập nhật thất bại');
            \Log::info($e->getMessage());
            return false;
        }
        return true;   
    }

    public function delete($request){
        $supplier = ProductImage::where('id', $request->input('id'))->first();
        if($supplier){
            $supplier->delete();
            return true;
        }
        return false;
     }

     public function searchProductImage($request)
    {
        $key = $request->input('query');

        // Sử dụng paginate trước khi get() để lấy dữ liệu đã phân trang
        return ProductImage::whereHas('product', function ($query) use ($key) {
            $query->where('name', 'like', '%' . $key . '%');
        })
        ->paginate(15); // Phân trang với mỗi trang 15 sản phẩm ảnh
    }
}
?>