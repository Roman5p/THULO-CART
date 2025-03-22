<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('orderItems','user')->orderBy('created_at','desc')->paginate(10); // Get all orders from database
        return view('backend.orders.index', compact('orders'));
    }

    public function details($id)
    {
        $order = Order::find($id); // Get order by id
        $order->load('orderItems');
        return view('backend.orders.show', compact('order'));
    }

    public function destroy($id)
    {
        $order = Order::find($id); // Get order by id
        $order->delete(); // Delete order
        return redirect()->route('admin.orders.index')->with('success', 'Order deleted successfully');
    }
}
