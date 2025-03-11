<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\product;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;

class CartController extends Controller
{


    public function getCarts()
    {



        $carts = Cart::where('user_id', auth()->id())->get();

        $discount = 0;
        $cost = 0;
        $total_quantity = 0;
        $total_cost = 0;

        foreach ($carts as $cart) {
            $total_cost = $total_cost + $cart->product->price * $cart->quantity;
            $discount = $discount + $cart->product->discount_amount * $cart->quantity;
            $cost = $cost + $cart->product->actual_amount * $cart->quantity;
        }


        return view('frontend.cart', compact('carts', 'total_cost', 'discount', 'cost', 'total_quantity'));
    }

    public function addtoCart($pid, $quantity = 1)
    {
        $user_id = auth()->id();
        Product::findOrFail($pid);

        $cart = Cart::where('user_id', auth()->id())->where('product_id', $pid)->first();
        if ($cart) {
            $cart->quantity += $quantity;
            $cart->save();
            return redirect()->route('index')->with('success', 'Product quantity updated successfully');
        } else {

            $cart = new Cart();
            $cart->user_id = $user_id;
            $cart->product_id = $pid;
            $cart->quantity = $quantity;
            $cart->save();

            return redirect()->route('index')->with('success', 'Product added to cart successfully');
        }
    }

    public function checkout()
    {
        $carts = Cart::where('user_id', auth()->id())->get();

        $discount = 0;
        $cost = 0;
        $total_quantity = 0;
        $total_cost = 0;

        foreach ($carts as $cart) {
            $total_cost = $total_cost + $cart->product->price * $cart->quantity;
            $discount = $discount + $cart->product->discount_amount * $cart->quantity;
            $cost = $cost + $cart->product->actual_amount * $cart->quantity;
        }

        return view('frontend.checkout', compact('carts', 'total_cost', 'discount', 'cost', 'total_quantity'));
    }

    

    public function delete($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();

        return redirect()->route('getcarts')->with('success', 'Product removed from cart successfully');
    }
}
