@extends('frontend.layouts.main')

@section('title', 'Payment Page')

@section('main-section')

    <style>
        .bill-container {
            max-width: 900px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
        }

        .bill-header {
            background-color: #f8f9fa;
            padding: 1rem;
            border-bottom: 1px solid #dee2e6;
        }

        .bill-section {
            padding: 1rem;
        }

        .table-bill {
            margin-bottom: 0;
            font-size: 0.9rem;
        }

        .table-bill th,
        .table-bill td {
            vertical-align: middle;
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
            width: 100%;
            max-width: 300px;
            padding: 0.75rem;
            font-size: 1rem;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .bill-header h2.h4 {
                font-size: 1.25rem;
            }

            .bill-header img {
                height: 40px;
            }

            .bill-section {
                padding: 0.75rem;
            }

            .table-bill {
                font-size: 0.8rem;
            }

            .table-bill th,
            .table-bill td {
                padding: 0.5rem;
            }

            .total-section {
                font-size: 0.9rem;
            }

            .payment-method .form-check {
                margin-bottom: 0.75rem;
            }
        }

        @media (max-width: 576px) {
            .bill-header {
                padding: 0.75rem;
                text-align: center;
            }

            .bill-header .col-6 {
                width: 100%;
                margin-bottom: 0.5rem;
            }

            .bill-header .text-end {
                text-align: center !important;
            }

            .bill-section .col-md-6 {
                width: 100%;
                text-align: center;
                margin-bottom: 1rem;
            }

            .total-section .col-md-6 {
                width: 100%;
            }

            .confirm-btn {
                font-size: 0.9rem;
                padding: 0.5rem;
            }

            .payment-method img {
                height: 16px;
            }
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

    <div class="container py-3 py-md-4">
        <div class="bill-container">
            <!-- Header -->
            <div class="bill-header">
                <div class="row align-items-center">
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
                            {{ Auth::user()->contact }}<br>
                            <p>
                                {{ Auth::user()->shippingAddress->first()->address ?? 'Not Provided' }},
                                {{ Auth::user()->shippingAddress->first()->number ?? '' }},
                                {{ Auth::user()->shippingAddress->first()->landmark ?? '' }},
                                {{ Auth::user()->shippingAddress->first()->street_no ?? 'N/A' }},
                                {{ Auth::user()->shippingAddress->first()->postal_code ?? 'N/A' }},
                                {{ Auth::user()->shippingAddress->first()->state ?? '' }}
                            </p>
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
                <div class="table-responsive">
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
                                        @if ($cart->product->discount_amount)
                                            रू {{ number_format($cart->product->discount_amount * $cart->quantity, 2) }}
                                        @else
                                            रू 0.00
                                        @endif
                                    </td>
                                    <td>रू
                                        {{ number_format($cart->quantity * $cart->product->price - ($cart->product->discount_amount * $cart->quantity ?? 0), 2) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
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
                    <!-- eSewa -->
                    <div class="form-check d-flex align-items-center gap-2">
                        <input class="form-check-input" type="radio" name="payment" id="esewa" value="esewa">
                        <label class="form-check-label" for="esewa">eSewa</label>
                        <img src="{{ asset('frontend/assets/images/esewa.png') }}" alt="eSewa" height="30">
                        <!-- Inside the eSewa form section -->
                        @php
                            $esewa_transaction_uuid = Illuminate\Support\Str::orderedUuid()->toString();
                            $esewa_message = "total_amount={$carts->sum(function ($cart) {
    return $cart->product->actual_amount * $cart->quantity;
})},transaction_uuid={$esewa_transaction_uuid},product_code=EPAYTEST";
                            $esewa_secret = '8gBm/:&EnhH.1/q';
                            $esewa_s = hash_hmac('sha256', $esewa_message, $esewa_secret, true);
                            $esewa_value = base64_encode($esewa_s);
                        @endphp
                        <form id="esewa-payment-form" action="https://rc-epay.esewa.com.np/api/epay/main/v2/form"
                            method="POST">
                            <input type="text" id="esewa_amount" name="amount"
                                value="{{ $carts->sum(function ($cart) {return $cart->product->actual_amount * $cart->quantity;}) - 0 }}"
                                required hidden>
                            <input type="text" id="esewa_tax_amount" name="tax_amount" value="0" required hidden>
                            <input type="text" id="esewa_total_amount" name="total_amount"
                                value="{{ $carts->sum(function ($cart) {return $cart->product->actual_amount * $cart->quantity;}) }}"
                                required hidden>
                            <input type="text" id="esewa_transaction_uuid" name="transaction_uuid"
                                value="{{ $esewa_transaction_uuid }}" required hidden>
                            <input type="text" id="esewa_product_code" name="product_code" value="EPAYTEST" required
                                hidden>
                            <input type="text" id="esewa_product_service_charge" name="product_service_charge"
                                value="0" required hidden>
                            <input type="text" id="esewa_product_delivery_charge" name="product_delivery_charge"
                                value="0" required hidden>
                            <input type="text" id="esewa_success_url" name="success_url"
                                value="{{ route('payment.success', ['oid' => $order->id]) }}" required hidden>
                            <input type="text" id="esewa_failure_url" name="failure_url"
                                value="{{ route('payment.failure') }}" required hidden>
                            <input type="text" id="esewa_signed_field_names" name="signed_field_names"
                                value="total_amount,transaction_uuid,product_code" required hidden>
                            <input type="text" id="esewa_signature" name="signature" value="{{ $esewa_value }}"
                                required hidden>
                        </form>
                    </div>

                    <!-- Khalti -->
                    <div class="form-check d-flex align-items-center gap-2">
                        <input class="form-check-input" type="radio" name="payment" id="khalti" value="khalti">
                        <label class="form-check-label" for="khalti"></label>Khalti
                        <img src="{{ asset('frontend/assets/images/khalti.png') }}" alt="Khalti" height="30">

                    </div>

                    <!-- Card -->
                    {{-- <div class="form-check d-flex align-items-center gap-2">
                        <input class="form-check-input" type="radio" name="payment" id="card" value="card">
                        <label class="form-check-label" for="card">Cards (Visa/MasterCard)</label>
                        <img src="{{ asset('frontend/assets/images/credit.png') }}" alt="Cards" height="20">
                        <!-- Add card form here if needed -->
                    </div>

                    <!-- Cash on Delivery -->
                    <div class="form-check d-flex align-items-center gap-2">
                        <input class="form-check-input" type="radio" name="payment" id="cod" value="cod">
                        <label class="form-check-label" for="cod">Cash on Delivery (COD)</label>
                        <img src="{{ asset('frontend/assets/images/cash-on-delivery.webp') }}" alt="COD"
                            height="20">
                        <!-- Add COD form or logic here if needed -->
                    </div> --}}
                </div>

                <!-- Confirm Order Button -->
                <div class="bill-section no-print text-center mt-3">
                    <button class="btn btn-primary confirm-btn" type="button" onclick="submitPaymentForm()">Confirm
                        Order</button>
                </div>
            </div>

            <script>
                function submitPaymentForm() {
                    // Check if a payment method is selected
                    const selectedPaymentMethod = document.querySelector('input[name="payment"]:checked');

                    if (!selectedPaymentMethod) {
                        alert('Please select a payment method.');
                        return;
                    }

                    const paymentMethod = selectedPaymentMethod.value;

                    // Handle form submission based on payment method
                    switch (paymentMethod) {
                        case 'esewa':
                            document.getElementById('esewa-payment-form').submit();
                            break;
                        case 'khalti':
                            document.getElementById('khalti-payment-form').submit();
                            break;
                            // case 'card':
                            //     alert('Card payment processing is not implemented yet.');
                            //     // Add card payment logic here (e.g., redirect or form submission)
                            //     break;
                            // case 'cod':
                            //     alert('Cash on Delivery selected. Proceed with order confirmation.');
                            //     // Add COD logic here (e.g., redirect to order confirmation)
                            //     break;
                        default:
                            alert('Unsupported payment method selected.');
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
