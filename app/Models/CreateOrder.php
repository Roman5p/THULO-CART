<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreateOrder extends Model
{
    protected $fillable = [
        'user_id',
        'status',
        'total_cost',
        'total_quantity',
    ];
}
