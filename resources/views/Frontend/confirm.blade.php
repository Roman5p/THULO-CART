@extends('frontend.layouts.main')

@section('title', 'Payment Page')

@section('main-section')

    <style>
        .bill-container {
            max-width: 900px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .bill-header {
            background-color: #f8f9fa;
            padding: 1.5rem;
            border-bottom: 1px solid #dee2e6;
        }

        .bill-section {
            padding: 1.5rem;
        }

        .table-bill {
            margin-bottom: 0;
        }

        .total-section {
            background-color: #f8f9fa;
            padding: 1rem;
            border-top: 1px solid #dee2e6;
        }

        .payment-method {
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 1rem;
        }

        .confirm-btn {
            max-width: 300px;
        }

        @media print {
            .no-print {
                display: none;
            }

            .bill-container {
                box-shadow: none;
                border: none;
            }
        }
    </style>

    <div class="container py-4">
        <div class="bill-container mx-auto">
            <!-- Header -->
            <div class="bill-header">
                <div class="row">
                    <div class="col-6">
                        <h2 class="h4 mb-0">Invoice</h2>
                        <p class="mb-0 text-muted">Invoice #: <span id="invoiceNum">[INV-XXXXXX]</span></p>
                    </div>
                    <div class="col-6 text-end">
                        <h5><img src="{{ asset('frontend/assets/images/logo.png') }}" alt="logo" height="50"></h5>
                        <p class="mb-0 text-muted">contact@thulocart.com.np</p>
                        <p class="mb-0 text-muted">+977 (987) 654-3210</p>
                    </div>
                </div>
            </div>

            <!-- Customer Info -->
            <div class="bill-section">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-muted">Bill To:</h6>
                        <div id="userAddress">
                            {{ Auth::user()->name }}<br>
                            {{ Auth::user()->email }}<br>
                            [Street Address]<br>
                            [City, State, ZIP]<br>
                            [Country]<br>
                        </div>
                    </div>
                    <div class="col-md-6 text-md-end mt-3 mt-md-0">
                        <p><strong>Date:</strong> {{ now()->format('F d, Y') }}</p>
                        <p><strong>Time:</strong> {{ now()->timezone('Asia/Kathmandu')->format('h:i A') }}</p>
                    </div>
                </div>
            </div>

            <!-- Product Details Table -->
            <div class="bill-section">
                <table class="table table-bill">
                    <thead class="table-light">

                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price Each</th>
                            <th scope="col">Subtotal</th>
                            <th scope="col">Discount</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($carts as $cart)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $cart->product->name }}</td>
                                <td>{{ $cart->quantity }}</td>
                                <td>रू {{ number_format($cart->product->price, 2) }}</td>
                                <td>रू {{ number_format($cart->quantity * $cart->product->price, 2) }}</td>
                                <td>
                                    <!-- Start: Check if discount exists -->
                                    @if ($cart->product->discount_amount)
                                        रू {{ number_format($cart->product->discount_amount * $cart->quantity, 2) }}
                                    @else
                                        रू 0.00
                                    @endif
                                    <!-- End: Check if discount exists -->
                                </td>
                                <td>रू
                                    {{ number_format($cart->quantity * $cart->product->price - ($cart->product->discount_amount * $cart->quantity ?? 0), 2) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Total Section -->
            <div class="total-section">
                <div class="row justify-content-end">
                    <div class="col-md-6 col-lg-4">
                        <div class="d-flex justify-content-between">
                            <span>Subtotal:</span>
                            <span id="subtotal">रू
                                {{ number_format($carts->sum(function ($cart) {return $cart->product->price * $cart->quantity;}),2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Total Discount:</span>
                            <span id="discount">रू
                                {{ number_format($carts->sum(function ($cart) {return $cart->product->discount_amount * $cart->quantity;}),2) }}</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between fw-bold">
                            <span>Grand Total:</span>
                            <span id="totalAmount">रू
                                {{ number_format($carts->sum(function ($cart) {return $cart->product->actual_amount * $cart->quantity;}),2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Method Selection -->
            <div class="bill-section no-print payment-method">
                <h6 class="mb-3">Select Payment Method</h6>
                <div class="d-flex flex-column gap-2">
                    <div class="form-check d-flex align-items-center gap-2">
                        <input class="form-check-input" type="radio" name="payment" id="esewa" value="esewa">
                        <label class="form-check-label" for="esewa">Esewa</label>
                        <img src="{{ asset('frontend/assets/images/esewa.png') }}" alt="Esewa" height="20">
                    </div>
                    <div class="form-check d-flex align-items-center gap-2">
                        <input class="form-check-input" type="radio" name="payment" id="khalti" value="khalti">
                        <label class="form-check-label" for="khalti">Khalti</label>
                        <img src="{{ asset('frontend/assets/images/khalti.png') }}" alt="Khalti" height="20">
                    </div>
                    <div class="form-check d-flex align-items-center gap-2">
                        <input class="form-check-input" type="radio" name="payment" id="card" value="card">
                        <label class="form-check-label" for="card">Cards (Visa/MasterCard)</label>
                        <img src="{{ asset('frontend/assets/images/credit.png') }}" alt="Cards" height="20">
                    </div>
                    <div class="form-check d-flex align-items-center gap-2">
                        <input class="form-check-input" type="radio" name="payment" id="cod" value="cod">
                        <label class="form-check-label" for="cod">Cash on Delivery (COD)</label>
                        <img src="{{ asset('frontend/assets/images/cash-on-delivery.webp') }}" alt="Cards" height="20">
                    
                    </div>
                </div>
            </div>

            <!-- Confirmation Button -->
            <div class="bill-section no-print text-center">
                <button class="btn btn-success confirm-btn" onclick="redirectToPayment()">Confirm Order</button>
            </div>

            <script>
                function redirectToPayment() {
                    const selectedPaymentMethod = document.querySelector('input[name="payment"]:checked');
                    if (!selectedPaymentMethod) {
                        alert('Please select a payment method.');
                        return;
                    }

                    const paymentMethod = selectedPaymentMethod.value;

                    switch (paymentMethod) {
                        case 'esewa':
                            window.location.href = "#";
                            break;
                        case 'khalti':
                            window.location.href = "#";
                            break;
                        case 'card':
                            window.location.href = "#";
                            break;
                        case 'cod':
                            window.location.href = "#";
                            break;
                        default:
                            alert('Invalid payment method selected.');
                    }
                }
            </script>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('frontend/assets/js/payment.js') }}"></script>
@endsection
