@extends('frontend.layouts.main')

@section('title', 'Index')

@section('main-section')

    <div class="cart-wrapper">
        <div class="container">
            <div class="row g-4">
                <!-- Cart Items Section -->
                <div class="col-lg-8">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="mb-0">Shopping Cart</h4>
                        <span class="text-muted">{{ $carts->count() }} items</span>
                    </div>

                    <!-- Product Cards -->
                    <div class="d-flex flex-column gap-3">
                        <!-- Product 1 -->
                        @foreach ($carts as $cart)
                            <div class="product-card p-3 shadow-sm">
                                <div class="row align-items-center">
                                    <div class="col-md-2">
                                        <img src="{{ asset('storage/' . $cart->product->image) }}" alt="Product"
                                            class="product-image">
                                    </div>
                                    <div class="col-md-4">
                                        {{-- {{$loop->iteration}} --}}
                                        <h6 class="mb-1">{{ $cart->product->name }}</h6>
                                        {{-- <p class="text-muted mb-0"></p> --}}
                                        <span class="discount-badge mt-2">{{ $cart->product->discount_amount }}% OFF</span>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="d-flex align-items-center gap-2">
                                            <button class="quantity-btn"
                                                onclick="updateQuantity({{ $loop->iteration }}, -1)">-</button>
                                            <input type="number" class="quantity-input" value="1" min="1">
                                            <button class="quantity-btn"
                                                onclick="updateQuantity({{ $loop->iteration }}, 1)">+</button>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <del>Rs.{{ $cart->product->price }}</del>
                                        <span class="text-dark fw-semibold">Rs.{{ $cart->product->actual_amount }}</span>
                                        {{-- <span class="fw-bold">Rs. {{ $cart->product->price }}</span> --}}
                                    </div>
                                    <div class="col-md-1">
                                        <form action="{{ route('deleteCart', $cart->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link p-0 m-0">
                                                <i class="bi bi-trash remove-btn"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Summary Section -->
                <div class="col-lg-4">
                    <div class="summary-card p-4 shadow-sm">
                        <h5 class="mb-4">Order Summary</h5>

                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Subtotal</span>
                            <span>Rs. </span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Discount</span>
                            <span class="text-success">-Rs. </span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Shipping</span>
                            <span>$5.00</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-4">
                            <span class="fw-bold">Total</span>
                            <span class="fw-bold">$458.97</span>
                        </div>

                        <!-- Promo Code -->
                        <div class="mb-4">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Promo code">
                                <button class="btn btn-outline-secondary" type="button">Apply</button>
                            </div>
                        </div>

                        <button class="btn btn-primary checkout-btn w-100 mb-3">
                            Proceed to Checkout
                        </button>

                        <div class="d-flex justify-content-center gap-2">
                            <i class="bi bi-shield-check text-success"></i>
                            <small class="text-muted">Secure checkout</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
