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
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Storage;

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

    public function updatePhoto(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'nullable|string|max:255', // Optional name update
            'password' => 'nullable|string|min:8|confirmed', // Optional password update with confirmation
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:4096', // Required photo, matching admin max size
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Update name if provided
        if ($request->filled('name')) {
            $user->name = $request->name;
        }

        // Update password if provided
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        // Handle the file upload
        if ($request->hasFile('profile_photo')) {
            // Delete the old photo if it exists
            if ($user->profile && Storage::disk('public')->exists($user->profile)) {
                Storage::disk('public')->delete($user->profile);
            }

            // Store the new photo in 'users' directory under 'public' disk
            $user->profile = $request->file('profile_photo')->store('users', 'public');
        }

        // Save all changes
        $user->save();

        // Fetch orders and carts
        $orders = Order::where('user_id', auth()->id())->get();
        $carts = Cart::where('user_id', auth()->id())->get();

        // Return to profile view
        return view('frontend.profile', compact('orders', 'carts'))
            ->with('success', 'Profile updated successfully!');
    }



    // Show checkout page with shipping information
    public function checkout()
    {
        $user_id = auth()->id();
        $shippingInfo = ShippingAddress::where('user_id', $user_id)->where('is_permanent', true)->first();
        $carts = Cart::where('user_id', auth()->id())->get();
        return view('frontend.checkout', compact('carts', 'shippingInfo'));
    }

    public function storeCheckout(Request $request)
    {
        $user_id = auth()->id();
        $carts = Cart::where('user_id', $user_id)->get();

        if ($carts->isEmpty()) {
            return redirect()->route('checkout')->with('error', 'Your cart is empty.');
        }

        // Create a new order
        $order = new Order();
        $order->user_id = $user_id;
        $order->status = 'pending'; // Initial status
        $order->total_cost = $carts->sum(function ($cart) {
            return $cart->product->price * $cart->quantity;
        });
        $order->total_quantity = $carts->sum('quantity');
        $order->save();

        // Create order items
        foreach ($carts as $cart) {
            $orderItem = new Order_Item();
            $orderItem->quantity = $cart->quantity;
            $orderItem->product_id = $cart->product_id;
            $orderItem->order_id = $order->id;
            $orderItem->save();
        }

        // Validate and save shipping info
        $request->validate([
            'address' => 'required|max:250',
            'number' => 'required|numeric',
            'landmark' => 'required',
            'postalcode' => 'required|numeric',
            'street_no' => 'required|numeric',
            'state' => 'required',
            'is_permanent' => 'required|boolean'
        ]);

        $shippingInfo = $request->is_permanent
            ? ShippingAddress::where('user_id', $user_id)->where('is_permanent', true)->first()
            : null;

        if ($shippingInfo) {
            $shippingInfo->address = $request->address;
            $shippingInfo->number = $request->number;
            $shippingInfo->landmark = $request->landmark;
            $shippingInfo->postalcode = $request->postalcode;
            $shippingInfo->street_no = $request->street_no;
            $shippingInfo->state = $request->state;
            $shippingInfo->is_permanent = $request->is_permanent;
            $shippingInfo->save();
        } else {
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

        // Save shipping info specific to this order
        $orderShipping = new ShippingAddress();
        $orderShipping->address = $request->address;
        $orderShipping->number = $request->number;
        $orderShipping->landmark = $request->landmark;
        $orderShipping->postalcode = $request->postalcode;
        $orderShipping->street_no = $request->street_no;
        $orderShipping->state = $request->state;
        $orderShipping->order_id = $order->id;
        $orderShipping->user_id = $user_id;
        $orderShipping->save();

        // Redirect to confirmation page (where payment is initiated)
        return redirect()->route('getConfirm', $order->id);
    }

    public function getConfirm($oid)
    {
        $order = Order::findOrFail($oid);
        $carts = Cart::where('user_id', auth()->id())->get();
        return view('frontend.confirm', compact('order', 'carts'));
    }

    public function success(Request $request)
    {
        // Get the order ID (you may need to pass this via the success URL or session)
        $order = Order::findOrFail($request->query('oid')); // Assuming oid is passed in the URL

        // Verify eSewa payment (simplified; you’d typically use an API call for production)
        $transactionUuid = $request->query('transaction_uuid'); // eSewa should return this
        if ($transactionUuid) {
            // Update order status to shipped
            $order->status = 'shipped';
            $order->save();

            // Create payment record
            $payment = new Payment();
            $payment->user_id = auth()->id();
            $payment->order_id = $order->id;
            $payment->payment_method = 'esewa';
            $payment->payment_status = 'completed';
            $payment->payment_id = $transactionUuid; // Store eSewa transaction ID
            $payment->save();


        }

        $carts = Cart::where('user_id', auth()->id())->get();

        foreach ($carts as $cart) {
            $cart->delete();
        }

        return view('frontend.success', compact('carts', 'order'))->with('success', 'Payment successful! Order is now shipped.');
    }

    public function failurePage()
    {
        $carts = Cart::where('user_id', auth()->id())->get();
        return view('frontend.failure', compact('carts'))->with('error', 'Payment failed. Please try again.');
    }

    public function myorder()
    {
        $user_id = Auth::id();
        $orders = Order::where('user_id', $user_id)->get();
        // Get user's cart items
        $carts = Cart::where('user_id', auth()->id())->get();
        // Return contact view with cart data
        return view('frontend.myorder', compact('orders', 'carts'));
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

