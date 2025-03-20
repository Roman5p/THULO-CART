<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Order_Item;

class product extends Model
{
    protected $fillable = [
        'name',
        'price',
        'quantity',
        'discount_amount',
        'actual_amount',
        'description',
        'category_id',
        'image',
        'is_feature',
        'is_selling',
        'is_popular',
        'is_new',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id','id');
    }
    
    public function orderItems()
    {
        return $this->hasMany(Order_Item::class);
    }
}

