<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewProduct_Product extends Model
{
    use HasFactory;
    protected $table = 'reviewproduct__products';
    protected $fillable = ["products_id", "reviewProduct_id"];
}
