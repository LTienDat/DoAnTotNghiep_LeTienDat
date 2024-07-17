<?php

namespace App\Http\Services\Product;

use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductImage;
use App\Models\Review_Product;
use App\Models\WareHouse;

class ProductUserService
{
    const LIMIT = 16;
    public function get($page = null)
    {
        return Product::select('id', 'name', 'price', 'price_sale', 'file')
            ->orderByDesc('id')
            ->when($page != null, function ($query) use ($page) {
                $query->offset($page * self::LIMIT);
            })
            ->limit(self::LIMIT)
            ->get();
    }

    public function show($id)
    {
        $product =  Product::where('id', $id)->where('active', 1)
            ->with('menu')->firstOrFail();
        return (object)$product;
    }
    public function showAttribute($id)
    {
        $product =  WareHouse::where('product_id', $id)->get();
        return (object)$product;
    }

    public function showImage($id){
        return ProductImage::where('product_id', $id)->get();
    }
    public function showReview($id){
        $product = Product::find($id);
        return $product->reviewProduct()->get();
    }

    public function searchProduct($request)
    {
        $key = $request->input('search');

        // Sử dụng paginate trước khi get() để lấy dữ liệu đã phân trang
        return Product::where(function ($query) use ($key) {
            $query->where('name', 'like', '%' . $key . '%')
                ->orWhere('price', $key);
        })->paginate(15); // Phân trang với mỗi trang 15 sản phẩm
    }
}