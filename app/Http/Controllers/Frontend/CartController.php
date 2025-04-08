<?php

namespace App\Http\Controllers\Frontend;  // Defines the namespace for frontend controllers

use App\Http\Controllers\Controller;    // Imports base Controller class
use App\Models\Cart;                    // Imports Cart model
use App\Models\product;                 // Imports Product model (note: 'product' should be 'Product' for convention)
use Illuminate\Http\Request;            // Imports Request class for HTTP handling
use illuminate\Support\Facades\Auth;    // Imports Auth facade for authentication

class CartController extends Controller  // CartController class extending base Controller
{
    /**
     * Retrieves and displays user's cart items
     * @return \Illuminate\View\View
     */
    public function getCarts()
    {
        // Fetch all cart items for the authenticated user
        $carts = Cart::where('user_id', auth()->id())->get();

        // Initialize variables for cart calculations
        $discount = 0;         // Total discount amount
        $cost = 0;            // Total cost after discount
        $total_quantity = 0;  // Total number of items (not currently used)
        $total_cost = 0;      // Total cost before discount

        // Calculate totals by iterating through cart items
        foreach ($carts as $cart) {
            $total_cost += $cart->product->price * $cart->quantity;          // Sum original price × quantity
            $total_quantity += $cart->quantity;                              // Sum quantity of items// Calculate discount and cost
            $discount += $discount + $cart->product->discount_amount * $cart->quantity;    // Sum discount × quantity
            $cost += $cart->product->actual_amount * $cart->quantity;              // Sum final price × quantity
        }

        // Return the cart view with calculated values
        return view('frontend.cart', compact('carts', 'total_cost', 'discount', 'cost', 'total_quantity'));
    }

    /**
     * Adds a product to the user's cart or updates quantity if it exists
     * @param int $pid Product ID
     * @param int $quantity Quantity to add (default: 1)
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addtoCart($pid, $quantity = 1)
    {
        $user_id = auth()->id();  // Get current authenticated user's ID
        Product::findOrFail($pid);  // Verify product exists, throws 404 if not found

        // Check if product already exists in user's cart
        $cart = Cart::where('user_id', auth()->id())->where('product_id', $pid)->first();

        if ($cart) {
            // If item exists, increment quantity
            $cart->quantity += $quantity;
            $cart->save();
            return redirect()->route('index')->with('success', 'Product quantity updated successfully');
        } else {
            // If item doesn't exist, create new cart entry
            $cart = new Cart();
            $cart->user_id = $user_id;
            $cart->product_id = $pid;
            $cart->quantity = $quantity;
            $cart->save();

            return redirect()->route('index')->with('success', 'Product added to cart successfully');
        }
    }

    /**
     * Displays checkout page with cart summary
     * @return \Illuminate\View\View
     */
    public function checkout()
    {
        // Fetch all cart items for authenticated user
        $carts = Cart::where('user_id', auth()->id())->get();

        // Initialize variables for checkout calculations
        $discount = 0;
        $cost = 0;
        $total_quantity = 0;  // Note: Currently unused in calculations
        $total_cost = 0;

        // Calculate totals (same logic as getCarts)
        foreach ($carts as $cart) {
            $total_cost = $total_cost + $cart->product->price * $cart->quantity;
            $discount = $discount + $cart->product->discount_amount * $cart->quantity;
            $cost = $cost + $cart->product->actual_amount * $cart->quantity;
        }

        // Return checkout view with calculated values
        return view('frontend.checkout', compact('carts', 'total_cost', 'discount', 'cost', 'total_quantity'));
    }

    /**
     * Removes a specific item from the cart
     * @param int $id Cart item ID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        // Find cart item or throw 404 if not found
        $cart = Cart::findOrFail($id);
        $cart->delete();  // Remove the item from database

        // Redirect to cart page with success message
        return redirect()->route('getcarts')->with('success', 'Product removed from cart successfully');
    }
}