<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'orders';

    protected $fillable = [
        "customer_id",
        "product_id",
        "quantity",
        "color",
        "size",
        "price",

    ];
    public function product(){
    return $this->hasone(Product::class, "id", 'product_id');
    }

    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id','id');
    }

}