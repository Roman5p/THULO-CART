<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class ShippingAddress extends Model
{
    protected $fillable = [
        'address',
        'number',
        'landmark',
        'postalcode',
        'street_no',
        'state',
        'is_permanent',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


