<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'order_id',
        'product_name',
        'qty',
        'product_price',

    ];
    function order()
    {
        return $this->belongsTo(Order::class);
    }
    function product()
    {
        return $this->belongsTo(Product::class);
    }
}
