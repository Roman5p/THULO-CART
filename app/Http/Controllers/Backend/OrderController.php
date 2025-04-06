<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('orderItems', 'user')->orderBy('created_at', 'desc')->paginate(10); // Get all orders from database
        return view('backend.orders.index', compact('orders'));
    }

    public function details($id)
    {
        $order = Order::find($id); // Get order by id
        $order->load('orderItems');
        return view('backend.orders.show', compact('order'));
    }

    public function statusReady($id)
    {
        $order = Order::findOrFail($id); // Get order by ID

        // Check current status and update accordingly
        if ($order->status === 'pending') {
            $order->update(['status' => 'shipped']);
            $message = 'Order status updated to shipped';
        } elseif ($order->status === 'shipped') {
            $order->update(['status' => 'delivered']);
            $message = 'Order status updated to delivered';
        } elseif ($order->status === 'failed') {
            $order->update(['status' => 'cancelled']);
            $message = 'Order status updated to cancelled';
        } else {
            // If status is already delivered, cancelled, or something else, do nothing or handle differently
            return redirect()->route('admin.orders.index')
                ->with('info', 'Order status cannot be updated further from ' . $order->status);
        }

        return redirect()->route('admin.orders.index')->with('success', $message);
    }

    public function destroy($id)
    {
        $order = Order::find($id); // Get order by id
        $order->delete(); // Delete order
        return redirect()->route('admin.orders.index')->with('success', 'Order deleted successfully');
    }
}
