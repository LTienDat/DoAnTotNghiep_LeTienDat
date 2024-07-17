<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'name',
        'description',
        'content',
        'menu_id',
        'price',
        'price_sale',
        'warehouse_id',
        'active',
        'file',
    ];

    public function menu()
    {
        return $this->hasOne(Menu::class, 'id', 'menu_id')->withDefault(['name' => '']);
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'product_id', 'id');
    }

    // public function productAttribute(){
    //     return $this->hasMany(ProductAttribute::class,'product_id','id');
    // }

    public function warehouse()
    {
        return $this->hasMany(Warehouse::class, 'product_id', 'id');
    }
    public function productImage(){
        return $this->hasMany(ProductImage::class,'product_id', 'id');
    }
    public function reviewProduct(){
        return $this->belongsToMany(Review_Product::class, 'reviewproduct__products', 'reviewProduct_id', 'products_id');
    }
}