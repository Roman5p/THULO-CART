<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'status',
        'total_cost',
        'total_quantity',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()  // Add this relationship
    {
        return $this->hasMany(Order_Item::class, 'order_id');
    }

    public function shippingAddress()  // Add this relationship
    {
        return $this->hasOne(ShippingAddress::class, 'order_id');
    }
}
