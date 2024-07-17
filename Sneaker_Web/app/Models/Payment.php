<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        "order",
        "thanh_vien",
        "price",
        "note",
        "vnp_response_code",
        "code_vnpay",
        "code_bank",
        "transactionCode",
        "created_at",
        "updated_at",
    ];
}
