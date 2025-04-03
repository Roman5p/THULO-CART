<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\product;
use App\Models\ShippingAddress;
use App\Models\Order_Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    // Display the homepage with various product categories and user cart
    public function index()
    {
        // Fetch all carousel items for the homepage slider
        $carousels = Carousel::all();
        // Get all product categories
        $categories = Category::all();
        // Retrieve cart items for the authenticated user
        $carts = Cart::where('user_id', auth()->id())->get();
        // Get featured products (limited to 9)
        $featureProducts = Product::where('is_feature', true)->limit(9)->get();
        // Get best-selling products (limited to 10)
        $sellingProducts = Product::where('is_selling', true)->limit(10)->get();
        // Get popular products (limited to 9)
        $popularProducts = Product::where('is_popular', true)->limit(9)->get();
        // Get new products (limited to 9)
        $newProducts = Product::where('is_new', true)->limit(9)->get();
        // Return the homepage view with all collected data
        return view('Frontend.index', compact('carousels', 'featureProducts', 'sellingProducts', 'popularProducts', 'newProducts', 'categories', 'carts'));
    }

    // Show details of a specific product
    public function productDetails($id)
    {
        // Find product by ID or throw 404 if not found
        $product = Product::findOrFail($id);
        // Get user's cart items
        $carts = Cart::where('user_id', auth()->id())->get();
        // Return product details view with product and cart data
        return view('frontend.product-details', compact('product', 'carts'));
    }

    // Display the About Us page
    public function aboutus()
    {
        // Get user's cart items
        $carts = Cart::where('user_id', auth()->id())->get();
        // Return about us view with cart data
        return view('frontend.aboutus', compact('carts'));
    }


    // Display the Contact page
    public function contact()
    {
        // Get user's cart items
        $carts = Cart::where('user_id', auth()->id())->get();
        // Return contact view with cart data
        return view('frontend.contact', compact('carts'));
    }

    public function profile()
    {
        $user_id = Auth::id();
        $orders = Order::where('user_id', $user_id)->get();
        // Get user's cart items
        $carts = Cart::where('user_id', auth()->id())->get();
        // Return contact view with cart data
        return view('frontend.profile', compact('orders', 'carts'));
    }



    // Show checkout page with shipping information
    public function checkout()
    {
        // Get authenticated user's ID
        $user_id = auth()->id();
        // Fetch user's permanent shipping address if exists
        $shippingInfo = ShippingAddress::where('user_id', $user_id)->where('is_permanent', true)->first();
        // Get user's cart items
        $carts = Cart::where('user_id', auth()->id())->get();
        // Return checkout view with cart and shipping data
        return view('frontend.checkout', compact('carts', 'shippingInfo'));
    }

    // Process checkout and store order information
    public function storeCheckout(Request $request)
    {
        // Get the ID of the currently authenticated user
        $user_id = auth()->id();

        // Retrieve all cart items associated with the authenticated user
        $carts = Cart::where('user_id', $user_id)->get();

        // Create a new order instance for the checkout
        $order = new Order();
        $order->user_id = $user_id;              // Assign the user ID to the order
        $order->status = 'pending';              // Set initial order status as pending
        $order->total_cost = $carts->sum(function ($cart) {
            // Calculate total cost by multiplying each product's price by its quantity
            return $cart->product->price * $cart->quantity;
        });
        $order->total_quantity = $carts->sum('quantity');  // Sum up total quantity of all items
        $order->save();                           // Save the order to the database

        // Iterate through each cart item to create order items
        foreach ($carts as $cart) {
            $orderItem = new Order_Item();        // Create new order item instance
            $orderItem->quantity = $cart->quantity;     // Set quantity from cart
            $orderItem->product_id = $cart->product_id; // Link to the product
            $orderItem->order_id = $order->id;         // Associate with the created order
            $orderItem->save();                  // Save the order item to the database
        }

        $shippingInfo = null;
        // Validate shipping information from request

        $request->validate([
            'address' => 'required|max:250',
            'number' => 'required|numeric',
            'landmark' => 'required',
            'postalcode' => 'required|numeric',
            'street_no' => 'required|numeric',
            'state' => 'required',
            'is_permanent' => 'required|boolean'
        ]);


        // Check if user wants to save this as permanent address
        if ($request->is_permanent) {
            // Get existing permanent shipping address if any
            $shippingInfo = ShippingAddress::where('user_id', $user_id)->where('is_permanent', true)->first();
        }

        // Update existing shipping info if it exists
        if ($shippingInfo) {
            $shippingInfo->address = $request->address;
            $shippingInfo->number = $request->number;
            $shippingInfo->landmark = $request->landmark;
            $shippingInfo->postalcode = $request->postalcode;
            $shippingInfo->street_no = $request->street_no;
            $shippingInfo->state = $request->state;
            $shippingInfo->is_permanent = $request->is_permanent;
            $shippingInfo->save();
        }
        // Create new shipping info if none exists
        else {
            $shippingInfo = new ShippingAddress();
            $shippingInfo->user_id = $user_id;
            $shippingInfo->address = $request->address;
            $shippingInfo->number = $request->number;
            $shippingInfo->landmark = $request->landmark;
            $shippingInfo->postalcode = $request->postalcode;
            $shippingInfo->street_no = $request->street_no;
            $shippingInfo->state = $request->state;
            $shippingInfo->is_permanent = $request->is_permanent;
            $shippingInfo->save();
        }

        // Create additional shipping info tied to this specific order
        $shippingInfo = new ShippingAddress();
        $shippingInfo->address = $request->address;
        $shippingInfo->number = $request->number;
        $shippingInfo->landmark = $request->landmark;
        $shippingInfo->postalcode = $request->postalcode;
        $shippingInfo->street_no = $request->street_no;
        $shippingInfo->state = $request->state;
        $shippingInfo->order_id = $order->id;
        $shippingInfo->user_id = $user_id;
        $shippingInfo->save();



        // Redirect to confirmation page with success message
        // return redirect()->route('getConfirm', $order->id)->with('success', 'Checkout successful');
        return redirect()->route('getConfirm', $order->id);


    }

    // Show order confirmation page
    public function getConfirm($oid)
    {
        // Find order by ID
        $order = Order::find($oid);
        $carts = Cart::where('user_id', auth()->id())->get();

        // Clear user's cart after successful checkout

        foreach ($carts as $cart) {
            $cart->delete();
        }
        // Return confirmation view with order details
        return view('frontend.confirm', compact('order', 'carts'));
    }

    // Show order details page

    public function myorder()
    {
        $user_id = Auth::id();
        $orders = Order::where('user_id', $user_id)->get();
        // Get user's cart items
        $carts = Cart::where('user_id', auth()->id())->get();
        // Return contact view with cart data
        return view('frontend.myorder', compact('orders', 'carts'));
    }

    public function success(request $request)
    {
        // Get user's cart items
        $carts = Cart::where('user_id', auth()->id())->get();
        // Return contact view with cart data
        return view('frontend.success', compact('carts'));
    }

    public function failurePage()
    {
        // Get user's cart items
        $carts = Cart::where('user_id', auth()->id())->get();
        // Return contact view with cart data
        return view('frontend.failure', compact('carts'));
    }




    // Display payment page
    // public function payment()
    // {
    //     // Get user's cart items
    //     $carts = Cart::where('user_id', auth()->id())->get();
    //     // Return payment view with cart data
    //     return view('frontend.payment', compact('carts'));
    // }
}

