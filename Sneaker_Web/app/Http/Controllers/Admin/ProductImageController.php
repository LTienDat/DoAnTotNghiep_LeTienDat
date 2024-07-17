<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Menu\CreateFormRequest;
use App\Http\Services\Product\ProductImageService;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductImageController extends Controller
{
    protected $productImageService;
    public function __construct(ProductImageService $productImageService){
        $this->productImageService = $productImageService;
    }
    public function index(){
        $images = $this->productImageService->getAll();
        
        // dd($images->product);
        return view("admin.productImage.list",[
            "title" => "Ảnh chi tiết sản phẩm",
            "ProductImages"=> $images
        ]);
    }

    
    public function search(Request $request){
        $ProductImages = $this->productImageService->searchProductImage($request);

        return view("admin.productImage.list", [
            'title'=>'Ảnh chi tiết sản phẩm',
            'ProductImages'=>$ProductImages
        ]);
    }

    public function create(){
        $products = $this->productImageService->getProduct();
        return view("admin.productImage.add",[
            "title"=> "Thêm sảnh cho sản phẩm",
            "products" => $products
        ]);
    }

    public function store(Request $request){
        $this->productImageService->insert($request);
        return redirect()->back();
    }

    public function show($id){
        $product = $this->productImageService->getShow($id);
        return view("admin.productImage.edit",[
            "title"=> "Sửa ảnh chi tiết sản phẩm",
            "product"=> $product
        ]);
    }

    public function update(ProductImage $ProductImage, CreateFormRequest $request){
        $this->productImageService->edit($ProductImage,$request);
        return redirect('admin/productImage/list');

    }

    public function destroy(Request $request){
        $result = $this->productImageService->delete($request);
        if($result){
            return response()->json([
                'error'=> false,
                'message'=> 'Xóa thành công ảnh sản phẩm'
            ]);
        }
        return response()->json([
            'error'=> true,
            'message'=> 'Xóa ảnh sản phẩm thất bại'
        ]);
    }
}
