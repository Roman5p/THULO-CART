@extends('frontend.layouts.main')

@section('title', 'Checkout Page')

@section('main-section')

    <div class="bg-primary">
        <div class="container py-4">
            <!-- Breadcrumb -->
            <nav class="d-flex">
                <h6 class="mb-0">
                    <a href="{{ route('index') }}" class="text-white-50 text-decoration-none">Home</a>
                    <span class="text-white-50 mx-2"> > </span>
                    <a href="{{ route('getcarts') }}" class="text-white-50 text-decoration-none">Shopping cart</a>
                    <span class="text-white-50 mx-2"> > </span>
                    <a href="{{ route('checkout') }}" class="text-white-50 text-decoration-none">Checkout</a>
                </h6>
            </nav>
            <!-- Breadcrumb -->
        </div>
    </div>

    <section class="bg-light py-5">
        <div class="container">
            <div class="row">
                <!-- Checkout Form (Left Side) -->
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
                            <h5 class="card-title mb-3">Checkout</h5>
                            <form action="{{ route('checkout.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <p class="mb-0">Address</p>
                                        <div class="form-outline">
                                            <input type="text" id="address"
                                                value="{{ old('address', $shippingInfo?->address) }}" name="address"
                                                class="form-control" />
                                        </div>
                                        @error('address')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-6 mb-3">
                                        <p class="mb-0">Number</p>
                                        <div class="form-outline">
                                            <input type="text" id="number"
                                                value="{{ old('number', $shippingInfo?->number) }}" name="number"
                                                class="form-control" />
                                        </div>
                                        @error('number')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-6 mb-3">
                                        <p class="mb-0">Landmark</p>
                                        <div class="form-outline">
                                            <input type="text" id="landmark"
                                                value="{{ old('landmark', $shippingInfo?->landmark) }}" name="landmark"
                                                class="form-control" />
                                        </div>
                                        @error('landmark')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-6 mb-3">
                                        <p class="mb-0">Postal Code</p>
                                        <div class="form-outline">
                                            <input type="number" id="postalcode"
                                                value="{{ old('postalcode', $shippingInfo?->postalcode) }}"
                                                name="postalcode" class="form-control" />
                                        </div>
                                        @error('postalcode')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-6 mb-3">
                                        <p class="mb-0">Street Number</p>
                                        <div class="form-outline">
                                            <input type="number" id="street_no"
                                                value="{{ old('street_no', $shippingInfo?->street_no) }}" name="street_no"
                                                class="form-control" />
                                        </div>
                                    </div>

                                    <div class="col-6 mb-3">
                                        <p class="mb-0">State</p>
                                        <div class="form-outline">
                                            <select class="form-select form-select-lg" name="state">
                                                <option value="" @selected(!old('state', $shippingInfo?->state))>Please select a state
                                                </option>
                                                <option value="province_no_1" @selected(old('state', $shippingInfo?->state) == 'province_no_1')>Province No. 1
                                                </option>
                                                <option value="province_no_2" @selected(old('state', $shippingInfo?->state) == 'province_no_2')>Province No. 2
                                                </option>
                                                <option value="bagmati" @selected(old('state', $shippingInfo?->state) == 'bagmati')>Bagmati</option>
                                                <option value="gandaki" @selected(old('state', $shippingInfo?->state) == 'gandaki')>Gandaki</option>
                                                <option value="lumbini" @selected(old('state', $shippingInfo?->state) == 'lumbini')>Lumbini</option>
                                                <option value="karnali" @selected(old('state', $shippingInfo?->state) == 'karnali')>Karnali</option>
                                                <option value="sudurpaschim" @selected(old('state', $shippingInfo?->state) == 'sudurpaschim')>Sudurpaschim
                                                </option>
                                            </select>
                                        </div>
                                        @error('state')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="hidden" value="0" name="is_permanent" />
                                    <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault"
                                        name="is_permanent" />
                                    <label class="form-check-label" for="flexCheckDefault">Is Permanent Address</label>
                                </div>

                                <div class="row">
                                    <div class="col-4">
                                        <a href="{{ route('getcarts') }}" class="btn btn-secondary w-100 my-2">Cancel</a>
                                    </div>
                                    <div class="col-8">
                                        <button type="submit" class="btn btn-primary w-100 my-2">Checkout</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Checkout -->
                </div>

                <!-- Order Summary (Right Side) -->
                <div class="col-xl-4 col-lg-4 mb-4">
                    <div class="summary-card p-4 shadow-sm">
                        <h5 class="mb-4">Order Summary</h5>

                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Subtotal</span>
                            <span>रु
                                {{ number_format($carts->sum(function ($cart) {return $cart->product->price * $cart->quantity;}),2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Discount</span>
                            <span class="text-success">-रु
                                {{ number_format($carts->sum(function ($cart) {return $cart->product->discount_amount * $cart->quantity;}),2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Shipping</span>
                            <span>रु</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-4">
                            <span class="fw-bold">Total</span>
                            <span
                                class="fw-bold">रु{{ number_format($carts->sum(function ($cart) {return $cart->product->actual_amount * $cart->quantity;}),2) }}</span>
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
                                <span class="badge bg-success-subtle text-success rounded-pill mt-0">रु
                                    {{ $cart->product->discount_amount }} OFF
                                </span>

                                <div class="">
                                    <a href="{{ route('productDetails', $cart->product->id) }}" class="nav-link">
                                        {{ $cart->product->name }}
                                    </a>
                                    <del class="text-muted">रु
                                        {{ number_format($cart->product->price * $cart->quantity, 2) }} </del>
                                    <div class="price text-muted"> Total:
                                        {{ number_format($cart->product->actual_amount * $cart->quantity, 2) }}</div>
                                </div>
                            </div>
                        @empty
                            <div class="card shadow-sm border-0 p-3 text-center">
                                <p class="text-muted mb-0">Your cart is empty.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
