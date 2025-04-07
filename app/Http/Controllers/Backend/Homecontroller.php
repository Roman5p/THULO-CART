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

        $recentOrders = Order::with(['user', 'payment']) // Add payment relationship
            ->orderBy('created_at', 'desc')
            ->take(5)
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
            ->limit(5)
            ->get();

        return view(
            'backend.index',
            compact('totalUsers', 'totalProducts', 'totalOrders', 'recentOrders', 'mostlyPurchasedProducts')
        );
    }
}
