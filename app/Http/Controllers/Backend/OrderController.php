<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('created_at','desc')->paginate(10); // Get all orders from database
        return view('backend.orders.index', compact('orders'));
    }
}
