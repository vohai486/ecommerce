<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'fullname',
        'email',
        'phone',
        'address',
        'note',
        'user_id',
        'total_money',
        'discount',
        'status'
    ];

    function user()
    {
        return $this->belongsTo(User::class);
    }
    function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
