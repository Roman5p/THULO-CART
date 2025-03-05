@extends('frontend.layouts.main')

@section('title', 'Checkout Page')

@section('main-section')

    <div class="bg-primary">
      <div class="container py-4">
        <!-- Breadcrumb -->
        <nav class="d-flex">
          <h6 class="mb-0">
            <a href="{{route('index')}}" class="text-white-50 text-decoration-none">Home</a>
            <span class="text-white-50 mx-2"> > </span>
            <a href="{{route('getcarts')}}" class="text-white-50 text-decoration-none">Shopping cart</a>
            <span class="text-white-50 mx-2"> > </span>
            <a href="{{route('checkout')}}" class="text-white-50 text-decoration-none">Checkout</a>
            {{-- <span class="text-white-50 mx-2"> > </span>
            <a href="" class="text-white text-decoration-none">3. Order info</a>
            <span class="text-white-50 mx-2"> > </span>
            <a href="" class="text-white-50 text-decoration-none">4. Payment</a> --}}
          </h6>
        </nav>
        <!-- Breadcrumb -->
      </div>
    </div>

    <section class="bg-light py-5">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-8 mb-4">
                    @guest
                        <div class="card mb-4 border shadow-0">
                            <div class="p-4 d-flex justify-content-between">
                                <div class="">
                                    <h5>Have an account?</h5>
                                    <p class="mb-0 text-wrap">If you already have an account, please sign in to proceed with the
                                        checkout process.</p>
                                </div>
                                <div class="d-flex align-items-center justify-content-center flex-column flex-md-row">
                                    <a href="#"
                                        class="btn btn-outline-primary me-0 me-md-2 mb-2 mb-md-0 w-100">Register</a>
                                    <a href="#" class="btn btn-primary shadow-0 text-nowrap w-100">Sign in</a>
                                </div>
                            </div>
                        </div>

                    @endguest


                    <!-- Checkout -->
                    <div class="card shadow-0 border">
                        <div class="p-4">
                            <h5 class="card-title mb-3">{{ Auth::user()->name }}'s checkout</h5>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <p class="mb-0">First name</p>
                                    <div class="form-outline">
                                        <input type="text" id="typeText" placeholder="Type here" class="form-control" />
                                    </div>
                                </div>

                                <div class="col-6">
                                    <p class="mb-0">Last name</p>
                                    <div class="form-outline">
                                        <input type="text" id="typeText" placeholder="Type here" class="form-control" />
                                    </div>
                                </div>

                                <div class="col-6 mb-3">
                                    <p class="mb-0">Phone</p>
                                    <div class="form-outline">
                                        <input type="tel" id="typePhone" value="+48 " class="form-control" />
                                    </div>
                                </div>

                                <div class="col-6 mb-3">
                                    <p class="mb-0">Email</p>
                                    <div class="form-outline">
                                        <input type="email" id="typeEmail" placeholder="example@gmail.com"
                                            class="form-control" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                <label class="form-check-label" for="flexCheckDefault">Keep me up to date on news</label>
                            </div>

                            <hr class="my-4" />

                            <h5 class="card-title mb-3">Shipping info</h5>

                            <div class="row mb-3">
                                <div class="col-lg-4 mb-3">
                                    <!-- Default checked radio -->
                                    <div class="form-check h-100 border rounded-3">
                                        <div class="p-3">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                id="flexRadioDefault1" checked />
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Express delivery <br />
                                                <small class="text-muted">3-4 days via Fedex </small>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <!-- Default radio -->
                                    <div class="form-check h-100 border rounded-3">
                                        <div class="p-3">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                id="flexRadioDefault2" />
                                            <label class="form-check-label" for="flexRadioDefault2">
                                                Post office <br />
                                                <small class="text-muted">20-30 days via post </small>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <!-- Default radio -->
                                    <div class="form-check h-100 border rounded-3">
                                        <div class="p-3">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                id="flexRadioDefault3" />
                                            <label class="form-check-label" for="flexRadioDefault3">
                                                Self pick-up <br />
                                                <small class="text-muted">Come to our shop </small>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-8 mb-3">
                                    <p class="mb-0">Address</p>
                                    <div class="form-outline">
                                        <input type="text" id="typeText" placeholder="Type here" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <p class="mb-0">Number</p>
                                    <div class="form-outline">
                                        <input type="number" id="typeText" placeholder="Type here" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <p class="mb-0">Landmark</p>
                                    <div class="form-outline">
                                        <input type="text" id="typeText" placeholder="Type here"
                                            class="form-control" />
                                    </div>
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <p class="mb-0">State</p>
                                    <select class="form-select">
                                        <option value="1">New York</option>
                                        <option value="2">Moscow</option>
                                        <option value="3">Samarqand</option>
                                    </select>
                                </div>
                                <div class="col-sm-4 col-6 mb-3">
                                    <p class="mb-0">Postal code</p>
                                    <div class="form-outline">
                                        <input type="text" id="typeText" class="form-control" />
                                    </div>
                                </div>

                                <div class="col-sm-4 col-6 mb-3">
                                    <p class="mb-0">Street Number:</p>
                                    <div class="form-outline">
                                        <input type="text" id="typeText" class="form-control" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault1" />
                                <label class="form-check-label" for="flexCheckDefault1">Save this address</label>
                            </div>

                            <div class="mb-3">
                                <p class="mb-0">Message to seller</p>
                                <div class="form-outline">
                                    <textarea class="form-control" id="textAreaExample1" rows="2"></textarea>
                                </div>
                            </div>

                            <div class="float-end">
                                <button class="btn btn-light border">Cancel</button>
                                <button class="btn btn-success shadow-0 border">Continue</button>
                            </div>
                        </div>
                    </div>
                    <!-- Checkout -->
                </div>
                <div class="col-lg-4">
                    <div class="summary-card p-4 shadow-sm">
                        <h5 class="mb-4">Order Summary</h5>

                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Subtotal</span>
                            <span>Rs.
                                {{ number_format($carts->sum(function ($cart) {return $cart->product->price * $cart->quantity;}),2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Discount</span>
                            <span class="text-success">-Rs.
                                {{ number_format($carts->sum(function ($cart) {return $cart->product->discount_amount * $cart->quantity;}),2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Shipping</span>
                            <span>Rs.</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-4">
                            <span class="fw-bold">Total</span>
                            <span
                                class="fw-bold">Rs.{{ number_format($carts->sum(function ($cart) {return $cart->product->actual_amount * $cart->quantity;}),2) }}</span>
                        </div>

                        <!-- Promo Code -->
                        <div class="mb-4">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Promo code">
                                <button class="btn btn-outline-secondary" type="button">Apply</button>
                            </div>
                        </div>

                        <hr />
                        <h6 class="text-dark my-4">Items in cart</h6>
                        @forelse ($carts as $cart)
                            <div class="d-flex align-items-center mb-4">
                                <div class="me-3 position-relative">
                                    <span
                                        class=" badge bg-success-subtle position-absolute top-0 start-0 translate-middle badge rounded-pill"
                                        style="color: black">
                                        {{ $cart->quantity }}
                                    </span>
                                    <img src="{{ asset('storage/' . $cart->product->image) }}"
                                        alt="{{ $cart->product->name }}" class="img-fluid rounded-3"
                                        style="object-fit: cover; max-height: 100px; width: 100px;">
                                </div>
                                <span class="badge bg-success-subtle text-success rounded-pill mt-0">Rs.
                                    {{ $cart->product->discount_amount }} OFF
                                </span>

                                <div class="">
                                    <a href="{{ route('productDetails', $cart->product->id) }}" class="nav-link">
                                        {{ $cart->product->name }}
                                    </a>
                                    <del class="text-muted">Rs.
                                        {{ number_format($cart->product->price * $cart->quantity, 2) }} </del>
                                    <div class="price text-muted">Total:
                                        {{ number_format($cart->product->actual_amount * $cart->quantity, 2) }}</div>
                                </div>
                            </div>
                        @empty
                            <div class="card shadow-sm border-0 p-3 text-center">
                                <p class="text-muted mb-0">Your cart is empty.</p>
                            </div>
                        @endforelse
                        <!-- Product Cards -->
                        {{-- 
                        <!-- Product Details -->
                        <div class="col-md-4 col-8">
                            <h6 class="mb-1 fw-semibold text-dark">{{ $cart->product->name }}</h6>
                            <span class="badge bg-success-subtle text-success rounded-pill mt-1">Rs.
                                {{ $cart->product->discount_amount }} OFF
                            </span>
                        </div>
                        <!-- Quantity Controls -->
                        <div class="col-md-3 col-6">
                            <div class="input-group input-group-sm w-75">
                                <button class="btn btn-outline-secondary" type="button"
                                    onclick="updateQuantity('{{ $cart->id }}', -1)">-</button>
                                <input type="number" class="form-control text-center quantity-input"
                                    value="{{ $cart->quantity }}" min="1" data-cart-id="{{ $cart->id }}"
                                    readonly>
                                <button class="btn btn-outline-secondary" type="button"
                                    onclick="updateQuantity('{{ $cart->id }}', 1)">+</button>
                            </div>
                        </div>
                        <!-- Price -->
                        <div class="col-md-2 col-4">
                            <div class="text-end text-md-start">
                                <del class="text-muted">Rs.
                                    {{ number_format($cart->product->price * $cart->quantity, 2) }}</del>
                                <div class="fw-bold text-dark">Rs.

                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
