@extends('frontend.layouts.main')

@section('title', 'Checkout Page')

@section('main-section')

    <!-- Include custom CSS -->
    <link href="{{ asset('css/payment.css') }}" rel="stylesheet">


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
                    <span class="text-white-50 mx-2"> > </span>
                    <a href="{{ route('payment') }}" class="text-white-50 text-decoration-none">Payment</a>
                </h6>
            </nav>
            <!-- Breadcrumb -->
        </div>
    </div>

    <div class="container mt-4">
        <div class="row">
            <!-- Left Column - Payment Method -->
            <div class="col-md-8">
                <h5 class="card-title mb-3">Select Payment Method</h5>
                <div class="card card-custom mb-4">
                    <div class="card-body">
                        <div class="row row-cols-1 row-cols-md-5 g-3">
                            <div class="col">
                                <div class="payment-option text-center" data-payment="credit-card">
                                    <img src="{{ asset('frontend/assets/images/credit.png') }}" alt="Credit/Debit Card"
                                        class="img-fluid" style="width: 30px; height: auto;">
                                    <p class="mb-0 mt-2 text-muted">Credit/Debit Card</p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="payment-option text-center" data-payment="ime-pay">
                                    <img src="{{ asset('frontend/assets/images/imepay.avif') }}" alt="IME Pay"
                                        class="img-fluid" style="width: 30px; height: auto;">
                                    <p class="mb-0 mt-2 text-muted">IME Pay Mobile Wallet</p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="payment-option text-center" data-payment="cash-on-delivery">
                                    <img src="{{ asset('frontend/assets/images/cash.png') }}" alt="Cash on Delivery"
                                        class="img-fluid" style="width: 30px; height: auto;">
                                    <p class="mb-0 mt-2 text-muted">Cash on Delivery</p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="payment-option text-center" data-payment="esewa">
                                    <img src="{{ asset('frontend/assets/images/esewa.jpeg') }}" alt="eSewa Mobile Wallet"
                                        class="img-fluid" style="width: 30px; height: auto;">
                                    <p class="mb-0 mt-2 text-muted">eSewa Mobile Wallet</p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="payment-option text-center" data-payment="khalti">
                                    <img src="{{ asset('frontend/assets/images/khalti.png') }}" alt="Khalti Mobile Wallet"
                                        class="img-fluid" style="width: 30px; height: auto;">
                                    <p class="mb-0 mt-2 text-muted">Khalti Mobile Wallet</p>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Method Details Sections -->
                        <div id="credit-card-details" class="mt-4" style="display: none;">
                            <div class="mb-3">
                                <img src="{{ asset('frontend/assets/images/Visa.png') }}" alt="Visa" class="me-2">
                                <img src="{{ asset('frontend/assets/images/mastercard.png') }}" alt="Master Card"
                                    class="me-2">

                            </div>
                            <div class="mb-3">
                                <label for="cardNumber" class="form-label"><span class="text-danger">*</span> Card
                                    number</label>
                                <input type="text" class="form-control" id="cardNumber" placeholder="Card number"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="cardName" class="form-label"><span class="text-danger">*</span> Name on
                                    card</label>
                                <input type="text" class="form-control" id="cardName" placeholder="Name on card"
                                    required>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="expiryDate" class="form-label"><span class="text-danger">*</span> Expiry
                                        date</label>
                                    <input type="text" class="form-control" id="expiryDate" placeholder="MM/YYYY"
                                        required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="cvv" class="form-label"><span class="text-danger">*</span> CVV <i
                                            class="bi bi-question-circle" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Card Verification Value"></i></label>
                                    <input type="text" class="form-control" id="cvv" placeholder="CVV"
                                        required>
                                </div>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input"
                                    style="background-color: orangered; border-color: orangered;" type="checkbox"
                                    id="saveCard">
                                <label class="form-check-label" for="saveCard">
                                    Save Card
                                    <span class="text-muted">We will save this card for your convenience. If required, you
                                        can remove the card in the "Payment Options" section in the "Account" menu.</span>
                                </label>
                            </div>
                            <button class="btn btn-primary w-100" id="payNow">Pay Now</button>
                        </div>

                        <div id="ime-pay-details" class="mt-4" style="display: none;">
                            <p class="text-center">Please use the IME Pay app to complete your payment. Scan the QR code or
                                enter your IME Pay credentials.</p>
                            <a href="https://www.imepay.com.np/" class="btn btn-primary w-100 mt-3">Proceed with IME
                                Pay</a>
                        </div>

                        <div id="cash-on-delivery-details" class="mt-4" style="display: none;">
                            <p class="text-center">Cash on Delivery selected. Payment will be collected upon delivery.</p>
                            <button class="btn btn-primary w-100 mt-3">Confirm Cash on Delivery</button>
                        </div>

                        <div id="esewa-details" class="mt-4" style="display: none;">
                            <p class="text-center">Please use the eSewa app to complete your payment. Scan the QR code or
                                enter your eSewa credentials.</p>
                            <a href="https://esewa.com.np/" class="btn btn-primary w-100 mt-3">Proceed with eSewa</a>

                        </div>

                        <div id="khalti-details" class="mt-4" style="display: none;">
                            <p class="text-center">Please use the Khalti app to complete your payment. Scan the QR code or
                                enter your Khalti credentials.</p>
                            <a href="https://khalti.com/" class="btn btn-primary w-100 mt-3">Proceed with
                                Khalti</a>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Order Summary -->
            <div class="col-md-4">
                <div class="card card-custom sticky-top" style="top: 20px;">
                    <div class="card-body">
                        <h5 class="card-title">Order Summary</h5>
                        <p>Subtotal:
                            {{ number_format($carts->sum(function ($cart) {return $cart->product->price * $cart->quantity;}),2) }}
                        </p>
                        <p>Shipping Fee: <span class="text-success">FREE</span></p>
                        <hr>
                        <p>Total incl. VAT:
                            <strong>{{ number_format($carts->sum(function ($cart) {return $cart->product->actual_amount * $cart->quantity;}),2) }}</strong>
                        </p>
                        <button class="btn btn-primary w-100">PLACE ORDER</button>
                        <p class="text-muted mt-2">
                            Security and Privacy: Our checkout is safe and secure. Your personal and payment information
                            is securely transmitted via 128-bit encryption. We do not store any payment card information on
                            our systems.
                        </p>
                        <p class="text-muted">
                            © 2025 {{ env('APP_NAME') }}. All Rights Reserved. <a href="#">Terms of Use</a> | <a
                                href="#">Terms of Sale</a> | <a href="#">Privacy Policy</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('frontend/assets/js/payment.js') }}"></script>
@endsection
