@extends('frontend.layouts.main')

@section('title', 'Order Confirmation')

@section('main-section')

    <style>
        /* General Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f9fafb;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
        }

        .confirmation-header {
            text-align: center;
            margin-bottom: 30px;
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            padding: 20px;
            border-radius: 10px;
        }

        .confirmation-header i {
            font-size: 50px;
            margin-bottom: 15px;
            animation: bounce 0.6s;
        }

        .confirmation-header h1 {
            font-size: 26px;
            font-weight: 700;
        }

        .confirmation-header p {
            font-size: 16px;
            font-weight: 500;
        }

        .order-summary {
            margin-bottom: 30px;
        }

        .order-summary h2 {
            font-size: 20px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 20px;
        }

        .order-item {
            display: flex;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #f1f3f5;
            transition: transform 0.2s, background-color 0.2s;
        }

        .order-item:hover {
            background-color: #f9fafb;
            transform: scale(1.02);
        }

        .order-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            margin-right: 20px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
        }

        .order-details h4 {
            font-size: 16px;
            font-weight: 600;
            color: #1f2937;
        }

        .order-price {
            font-size: 16px;
            font-weight: 600;
            color: #1f2937;
        }

        .total-amount {
            display: flex;
            justify-content: flex-end;
            padding: 15px 0;
            border-top: 1px solid #f1f3f5;
            margin-top: 20px;
        }

        .total-amount h3 {
            font-size: 20px;
            font-weight: 700;
            color: #1f2937;
        }

        .continue-shopping {
            text-align: center;
            margin-top: 30px;
        }

        .continue-shopping a {
            display: inline-block;
            padding: 12px 25px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            transition: background-color 0.3s, transform 0.2s;
        }

        .continue-shopping a:hover {
            background-color: #0056b3;
            transform: translateY(-3px);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            .confirmation-header h1 {
                font-size: 22px;
            }

            .order-item {
                flex-direction: column;
                align-items: flex-start;
            }

            .order-image {
                margin-bottom: 15px;
            }

            .total-amount {
                justify-content: flex-start;
            }
        }
    </style>

    <div class="container py-3 py-md-4">
        <div class="confirmation-header text-center">
            <i class="fas fa-check-circle text-success" style="font-size: 40px;"></i>
            <h1>Payment Successful!</h1>
            <p>Order Number: #{{ $order->id }}</p>
            <p>We have sent a confirmation email to {{ $order->email ?? Auth::user()->email }}.</p>
            {{-- <p>Estimated Delivery Date:
                {{ \Carbon\Carbon::parse($order->shippingAddress->first()->created_at)->addDays(7)->format('F j, Y') }}</p> --}}
            <p>Status: {{ ucfirst($order->status) }}</p>
            <a href="{{ route('index') }}" class="btn btn-primary mt-3">Continue Shopping</a>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
