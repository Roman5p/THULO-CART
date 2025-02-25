@extends('frontend.layouts.main')

@section('title', 'Index')

@section('main-section')

    <div class="cart-wrapper">
        <div class="container">
            <div class="row g-4">
                <!-- Cart Items Section -->
                <div class="col-lg-8">
                    <!-- Cart Header -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="mb-0 fw-bold text-dark">Shopping Cart</h4>
                        <span class="badge bg-secondary rounded-pill px-3 py-2">{{ $carts->count() }} Items</span>
                    </div>

                    <!-- Product Cards -->
                    <div class="d-flex flex-column gap-3">
                        @forelse ($carts as $cart)
                            <div class="card shadow-sm border-0 p-3">
                                <div class="row align-items-center g-3">
                                    <!-- Product Image -->
                                    <div class="col-md-2 col-4">
                                        <img src="{{ asset('storage/' . $cart->product->image) }}"
                                            alt="{{ $cart->product->name }}" class="img-fluid rounded-3"
                                            style="object-fit: cover; max-height: 100px;">
                                    </div>

                                    <!-- Product Details -->
                                    <div class="col-md-4 col-8">
                                        <h6 class="mb-1 fw-semibold text-dark">{{ $cart->product->name }}</h6>
                                        <span class="badge bg-success-subtle text-success rounded-pill mt-1">
                                            {{ $cart->product->discount_amount }}% OFF
                                        </span>
                                    </div>

                                    <!-- Quantity Controls -->
                                    <div class="col-md-3 col-6">
                                        <div class="input-group input-group-sm w-75">
                                            <button class="btn btn-outline-secondary" type="button"
                                                onclick="updateQuantity('{{ $cart->id }}', -1)">-</button>
                                            <input type="number" class="form-control text-center quantity-input"
                                                value="{{ $cart->quantity }}" min="1"
                                                data-cart-id="{{ $cart->id }}" readonly>
                                            <button class="btn btn-outline-secondary" type="button"
                                                onclick="updateQuantity('{{ $cart->id }}', 1)">+</button>
                                        </div>
                                    </div>

                                    <!-- Price -->
                                    <div class="col-md-2 col-4">
                                        <div class="text-end text-md-start">
                                            <del class="text-muted">Rs. {{ number_format($cart->product->price, 2) }}</del>
                                            <div class="fw-bold text-dark">Rs.
                                                {{ number_format($cart->product->actual_amount, 2) }}</div>
                                        </div>
                                    </div>

                                    <!-- Delete Button -->
                                    <div class="col-md-1 col-2 text-end">
                                        <form action="{{ route('deleteCart', $cart->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm p-1" title="Remove">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="card shadow-sm border-0 p-3 text-center">
                                <p class="text-muted mb-0">Your cart is empty.</p>
                            </div>
                        @endforelse
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
                            <span>Rs.</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-4">
                            <span class="fw-bold">Total</span>
                            <span class="fw-bold">Rs.</span>
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
