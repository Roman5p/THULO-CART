<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    protected $fillable = [
        'user_id',
        'order_id',
        'payment_method',
        'payment_status',
        'payment_id',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}
