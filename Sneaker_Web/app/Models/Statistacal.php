<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistacal extends Model
{
    use HasFactory;
    protected $fillable = [
        "orderDate",
        "quantity",
        "sales",
        "profit",
        "total_order",
    ];
}
