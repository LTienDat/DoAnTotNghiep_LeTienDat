<?php

namespace App\Http\Controllers;

use App\Http\Services\Product\ProductUserService;
use Illuminate\Http\Request;
use App\Http\Services\product\ProductService;
class DetailProductController extends Controller
{

    protected $productService;
    public function __construct(ProductUserService $productService){
        $this->productService = $productService;
    }
    public function index($id = '', $slug = '', Request $request){
        $product = $this->productService->show($id);
        $productAttributes = $this->productService->showAttribute($id);
        $productImage = $this->productService->showImage($id);
        $review = $this->productService->showReview($id);
        return view('products.detail',[
            'title'=> $product->name,
            'products' => $product,
            'productAttributes'=> $productAttributes,
            'productImages' => $productImage,
            'request' => $request,
            'reviews' =>  $review
        ]);
    }   
}
