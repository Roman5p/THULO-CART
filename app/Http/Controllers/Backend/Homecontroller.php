<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class Homecontroller extends Controller
{
    public function index()
    {

        $totalUsers = User::count();
        $totalProducts = Product::count();
        $totalOrders = Order::count();

        // Fetch recent orders (e.g., last 10 orders)
        $recentOrders = Order::with('user') // Eager load the user relationship
            ->orderBy('created_at', 'desc') // Sort by latest first
            ->take(10) // Limit to 10 recent orders
            ->get();

        $mostlyPurchasedProducts = Product::select(
            'products.id',
            'products.name',
            'products.price',
            DB::raw('COUNT(order_items.id) as total_purchases')
        )
            ->join('order_items', 'products.id', '=', 'order_items.product_id')
            ->groupBy('products.id', 'products.name', 'products.price')
            ->orderBy('total_purchases', 'desc')
            ->limit(5) // Top 5 most purchased products
            ->get();

        return view(
            'backend.index',
            compact('totalUsers', 'totalProducts', 'totalOrders', 'recentOrders', 'mostlyPurchasedProducts')
        );
    }
}
