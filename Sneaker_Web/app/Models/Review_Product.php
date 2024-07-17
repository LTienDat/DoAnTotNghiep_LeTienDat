<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review_Product extends Model
{
    use HasFactory;
    protected $table = 'reviewproducts';
    protected $fillable = [
        "user_id", "review", "star"
    ];

    public function product(){
        return $this->belongsToMany(Product::class, 'reviewproduct__products', 'reviewProduct_id', 'products_id');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
