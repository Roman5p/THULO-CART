@extends('frontend.layouts.main')

@section('title', 'Order Confirmation')

@section('main-section')

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f7fa;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            border: 1px solid #e5e7eb;
        }

        .confirmation-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .confirmation-header i {
            color: #28a745;
            font-size: 40px;
            margin-bottom: 15px;
            animation: bounce 0.6s;
        }

        @keyframes bounce {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateY(0);
            }

            40% {
                transform: translateY(-20px);
            }

            60% {
                transform: translateY(-10px);
            }
        }

        .confirmation-header h1 {
            font-size: 24px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 10px;
        }

        .confirmation-header p {
            font-size: 16px;
            color: #6b7280;
        }

        .order-summary {
            margin-bottom: 30px;
        }

        .order-summary h2 {
            font-size: 18px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 20px;
        }

        .order-item {
            display: flex;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #f1f3f5;
            transition: background-color 0.2s;
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .order-item:hover {
            background-color: #f9fafb;
        }

        .order-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            margin-right: 20px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
        }

        .order-details {
            flex: 1;
        }

        .order-details h4 {
            font-size: 16px;
            font-weight: 500;
            color: #1f2937;
            margin-bottom: 8px;
            line-height: 1.4;
        }

        .order-details p {
            font-size: 13px;
            color: #6b7280;
            margin-bottom: 5px;
        }

        .order-price {
            font-size: 16px;
            font-weight: 600;
            color: #1f2937;
            margin-right: 20px;
        }

        .order-status {
            text-align: right;
        }

        .order-status p {
            font-size: 14px;
            color: #007bff;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .total-amount {
            display: flex;
            justify-content: flex-end;
            padding: 15px 0;
            border-top: 1px solid #f1f3f5;
            margin-top: 20px;
        }

        .total-amount h3 {
            font-size: 18px;
            font-weight: 600;
            color: #1f2937;
        }

        .continue-shopping {
            text-align: center;
            margin-top: 30px;
        }

        .continue-shopping a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            font-weight: 500;
            transition: background-color 0.2s;
        }

        .continue-shopping a:hover {
            background-color: #0056b3;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            .confirmation-header h1 {
                font-size: 20px;
            }

            .confirmation-header p {
                font-size: 14px;
            }

            .order-item {
                flex-direction: column;
                align-items: flex-start;
            }

            .order-image {
                margin-bottom: 15px;
            }

            .order-price {
                margin-right: 0;
                margin-bottom: 15px;
            }

            .order-status {
                text-align: left;
            }

            .total-amount {
                justify-content: flex-start;
            }
        }
    </style>

    <div class="container">
        <!-- Confirmation Header -->
        <div class="confirmation-header">
            <i class="fas fa-check-circle"></i>
            <h1>Thank You! Your Order Has Been Placed</h1>
            <p>Order Number: #{{ $order->order_number ?? 'ORD123456' }}</p>
        </div>

        <!-- Order Summary -->
        <div class="order-summary">
            <h2>Order Summary</h2>

            @isset($order->items)
                @foreach ($order->items as $item)
                    <div class="order-item">
                        <img src="{{ asset($item->image ?? 'frontend/assets/images/placeholder.jpg') }}" alt="{{ $item->name }}"
                            class="order-image">
                        <div class="order-details">
                            <h4>{{ $item->name ?? 'Product Name' }}</h4>
                            <p>Color: {{ $item->color ?? 'Default' }}</p>
                            <p>Quantity: {{ $item->quantity ?? 1 }}</p>
                        </div>
                        <div class="order-price">₹{{ $item->price ?? '0' }}</div>
                        <div class="order-status">
                            <p><i class="fas fa-spinner"></i> Processing</p>
                        </div>
                    </div>
                @endforeach
            @else
                <!-- Fallback content if no order items are passed -->
                <div class="order-item">
                    <img src="{{ asset('frontend/assets/images/placeholder.jpg') }}" alt="Product 1" class="order-image">
                    <div class="order-details">
                        <h4>Sample Product Name</h4>
                        <p>Color: Default</p>
                        <p>Quantity: 1</p>
                    </div>
                    <div class="order-price">₹0</div>
                    <div class="order-status">
                        <p><i class="fas fa-spinner"></i> Processing</p>
                    </div>
                </div>
            @endisset
        </div>

        <!-- Total Amount -->
        <div class="total-amount">
            <h3>Total Amount: ₹{{ $order->total_amount ?? '0' }}</h3>
        </div>

        <!-- Continue Shopping Button -->
        <div class="continue-shopping">
            <a href="{{ route('index') }}">Continue Shopping</a>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
