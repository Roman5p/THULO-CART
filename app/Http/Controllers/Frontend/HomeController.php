<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\product;
use App\Models\ShippingAddress;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function index()
    {
        $carousels = Carousel::all();
        $categories = Category::all();
        $carts = Cart::where('user_id', auth()->id())->get();
        $featureProducts = Product::where('is_feature', true)->limit(9)->get();
        $sellingProducts = Product::where('is_selling', true)->limit(10)->get();
        $popularProducts = Product::where('is_popular', true)->limit(9)->get();
        $newProducts = Product::where('is_new', true)->limit(9)->get();
        return view('Frontend.index', compact('carousels', 'featureProducts', 'sellingProducts', 'popularProducts', 'newProducts', 'categories', 'carts'));
    }

    public function productDetails($id)
    {
        $product = Product::findOrFail($id);
        $carts = Cart::where('user_id', auth()->id())->get();
        return view('frontend.product-details', compact('product', 'carts'));
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

    public function checkout()
    {
        $user_id = auth()->id();
        $shippingInfo = ShippingAddress::where('user_id', $user_id)->where('is_permanent',true)->first();
        $carts = Cart::where('user_id', auth()->id())->get();
        return view('frontend.checkout', compact('carts', 'shippingInfo'));
    }

    public function storeCheckout(Request $request){
        $user_id = auth()->id();

        $carts = Cart::where('user_id', $user_id)->get();

        $order = new Order();
        $order->user_id = $user_id;
        

        $shippingInfo = null;
        $request->validate(
            [
                'address' => 'required | max:250',
                'number' => 'required | numeric',
                'landmark' => 'required',
                'postalcode' => 'required | numeric',
                'street_no' => 'required | numeric',
                'state' => 'required',
                'is_permanent' => 'required | boolean'

            
            ]);

        if($request->is_permanent){
            $shippingInfo = ShippingAddress::where('user_id', $user_id)->where('is_permanent',true)->first();   
        }

        if($shippingInfo){
            $shippingInfo->address = $request->address;
            $shippingInfo->number = $request->number;
            $shippingInfo->landmark = $request->landmark;
            $shippingInfo->postalcode = $request->postalcode;
            $shippingInfo->street_no = $request->street_no;
            $shippingInfo->state = $request->state;
            $shippingInfo->is_permanent = $request->is_permanent;
            $shippingInfo->save();
        }

        foreach($carts as $cart){
            $cart->delete();
        }

        return redirect('getConfirm', $order->id)->with('success','Checkout successful');
    }

    public function getConfirm($oid){
        $order = Order::find($oid);
        return view('frontend.confirm', compact('order', 'carts'));
}

    public function payment()
    {
        $carts = Cart::where('user_id', auth()->id())->get();
        return view('frontend.payment', compact('carts'));
    }
}
