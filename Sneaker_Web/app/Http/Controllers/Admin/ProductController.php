<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Services\product\ProductService;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;
    public function __construct(ProductService $productService){
        $this->productService = $productService;
    }

    public function index()
    {
        return view("admin.product.list", [
            'title'=>'Danh sách sản phẩm',
            'products'=>$this->productService->get(),
        
        ]);
    }
    public function search(Request $request){
        $products = $this->productService->searchProduct($request);

        return view("admin.product.list", [
            'title'=>'Danh sách sản phẩm',
            'products'=>$products
        ]);
    }

    public function create()
    {
        return View('admin.product.add', [
            'title'=> 'Thêm sản phẩm',
            'menus'=> $this->productService->getMenu()
        ]);
    }

    public function store(ProductRequest $request ){
        $this->productService->insert($request);
        return redirect()->back();
     }


    public function show(Product $product)
    {
        return view('admin.product.edit',[
            'title'=> 'Chỉnh sửa sản phẩm',
            'product'=> $product,
            'menus'=> $this->productService->getMenu()
        ]);
    }


    public function update(Request $request, Product $product)
    {
        $result = $this->productService->update($request, $product);
        if($result){
            return redirect('admin/product/list');
        }
        return redirect()->back();  
    }


    public function destroy(Request $request)
    {
        $result = $this->productService->delete($request);
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

    public function showare(){
        $warehouse = $this->productService->getware();
        dd($warehouse);
        
        return view("admin.product.attribute.attribute",[
            "title" => 'Bảng size và màu',
            "warehouses"=> $warehouse 
        
        ]);
    }
    
}
