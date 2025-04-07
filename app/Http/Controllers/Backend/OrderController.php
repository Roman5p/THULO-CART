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

    public function addPayment(Request $request, $orderId)
    {
        $request->validate([
            'payment_method' => 'required|string|in:cash,credit_card,paypal,stripe', // Add allowed payment methods
            'status' => 'required|string|in:pending,completed,failed',
            'payment_id' => 'nullable|string',
        ]);

        $order = Order::findOrFail($orderId);

        $payment = Payment::create([
            'user_id' => $order->user_id,
            'order_id' => $order->id,
            'payment_method' => $request->payment_method,
            'status' => $request->status,
            'payment_id' => $request->payment_id,
        ]);

        return redirect()->route('admin.orders.show', $order->id)
            ->with('success', 'Payment method added successfully');
    }

    public function show($id)
    {
        $order = Order::with(['user', 'orderItems', 'payment'])->findOrFail($id);
        return view('backend.orders.show', compact('order'));
    }
}
