<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'order_id',
        'payment_method',
        'status',
        'payment_id',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}
