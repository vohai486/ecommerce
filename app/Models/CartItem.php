<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'qty'
    ];
    function product()
    {
        return $this->belongsTo(Product::class);
    }
    function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}
