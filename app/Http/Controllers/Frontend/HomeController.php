<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use App\Models\Cart;
use App\Models\Category;
use App\Models\product;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function index()
    {
        $carousels = Carousel::all();
        $categories = Category::all();
        $carts= Cart::where('user_id', auth()->id())->get();
        $featureProducts = Product::where('is_feature', true)->limit(9)->get();
        $sellingProducts = Product::where('is_selling', true)->limit(10)->get();
        $popularProducts = Product::where('is_popular', true)->limit(9)->get();
        $newProducts = Product::where('is_new', true)->limit(9)->get();
        return view('Frontend.index', compact('carousels','featureProducts','sellingProducts','popularProducts','newProducts', 'categories','carts'));
    }

    public function productDetails($id)
    {
        $product = Product::findOrFail($id);
        $carts= Cart::where('user_id', auth()->id())->get();
        return view('frontend.product-details', compact('product','carts'));
    }

    public function aboutus()
    {
        $carts = Cart::where('user_id', auth()->id())->get();
        return view('frontend.aboutus', compact('carts'));
    }
    public function contact()
    {
        $carts = Cart::where('user_id', auth()->id())->get();
        return view('frontend.contact', compact('carts'));
    }
}
