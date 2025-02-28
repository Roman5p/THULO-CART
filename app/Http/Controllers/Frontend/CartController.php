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
       
        return view('frontend.cart', compact('carts'));

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

    public function delete($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();

        return redirect()->route('getcarts')->with('success', 'Product removed from cart successfully');
    }
}
