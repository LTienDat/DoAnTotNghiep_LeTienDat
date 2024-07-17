<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoOrder extends Model
{
    use HasFactory;
    protected $table = 'infor_order';
    protected $fillable = ["customer_id"];
    
    public function customer(){
        return $this->belongsTo(Customer::class);
    }
    public function order(){
        return $this->hasMany(Cart::class,'inforOder_id','id');
    }  
}
