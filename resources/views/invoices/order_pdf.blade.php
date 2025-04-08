<!DOCTYPE html>
<html>

<head>
    <title>Invoice #{{ $invoice_number }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            background-color: #f9f9f9;
            line-height: 1.6;
        }

        .container {
            max-width: 800px;
            margin: 30px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 40px;
        }

        .invoice-header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }

        .invoice-header img {
            max-width: 180px;
            margin-bottom: 15px;
        }

        .invoice-header h1 {
            font-size: 24px;
            font-weight: 600;
            color: #333;
            margin: 0 0 5px 0;
        }

        .invoice-header p {
            font-size: 14px;
            color: #666;
            margin: 4px 0;
        }

        .order-id {
            display: inline-block;
            background-color: #f0f0f0;
            padding: 4px 12px;
            border-radius: 4px;
            font-size: 13px;
            margin-top: 10px;
        }

        .address-section {
            margin-bottom: 30px;
        }

        .address {
            padding: 15px;
            background-color: #fafafa;
            border-radius: 6px;
            margin-bottom: 15px;
        }

        .address h3 {
            font-size: 15px;
            font-weight: 600;
            color: #444;
            margin: 0 0 10px 0;
        }

        .address p {
            margin: 5px 0;
            color: #555;
            font-size: 14px;
        }

        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            font-size: 14px;
        }

        .details-table th {
            background-color: #f5f5f5;
            font-weight: 600;
            color: #444;
            text-align: left;
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
        }

        .details-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
            color: #555;
        }

        .details-table tr:last-child td {
            border-bottom: none;
        }

        .total-section {
            width: 100%;
            max-width: 300px;
            margin-left: auto;
            font-size: 14px;
            border-collapse: collapse;
        }

        .total-section tr td {
            padding: 10px 15px;
            border-bottom: 1px solid #eee;
        }

        .total-section .label {
            font-weight: 500;
            color: #555;
            text-align: right;
        }

        .total-section .value {
            text-align: right;
            font-weight: 500;
            color: #333;
        }

        .grand-total .label,
        .grand-total .value {
            font-weight: 600;
            background-color: #f5f5f5;
        }

        .payment-method {
            margin-top: 25px;
            padding: 12px 15px;
            background-color: #fafafa;
            border-radius: 6px;
            font-size: 14px;
            color: #555;
        }

        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            text-align: center;
            font-size: 13px;
            color: #666;
        }

        .footer p {
            margin: 5px 0;
        }

        .footer a {
            color: #333;
            text-decoration: none;
            font-weight: 500;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="invoice-header">
            <img src="{{ asset('frontend/assets/images/logo.png') }}" alt="Thulo Cart Logo">
            <h1>Invoice</h1>
            <p>Invoice #{{ $order->orderItems->first()->product->id }}</p>
            <p>Date: {{ $date }}</p>
            <span class="order-id">Order #{{ $order->id }}</span>
        </div>

        <div class="address-section">
            <div class="address">
                <h3>Shipping Address</h3>
                @if ($customer)
                    <p><strong>{{ $customer->name }}</strong></p>
                    @if ($shippingAddress)
                        <p>{{ $shippingAddress->address }}</p>
                        <p>{{ $shippingAddress->landmark }}, Street {{ $shippingAddress->street_no }}</p>
                        <p>{{ $shippingAddress->state }} {{ $shippingAddress->postalcode }}</p>
                        <p>Phone: {{ $shippingAddress->number }}</p>
                    @else
                        <p>No shipping address provided</p>
                    @endif
                    <p>Email: {{ $customer->email }}</p>
                @else
                    <p>Guest Customer</p>
                @endif
            </div>
        </div>

        <table class="details-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Unit Price</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->orderItems as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>Rs. {{ number_format($item->product->actual_amount, 2) }}</td>
                        <td>Rs. {{ number_format($item->product->actual_amount * $item->quantity, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <table class="total-section">
            <tr>
                <td class="label">Subtotal</td>
                <td class="value">Rs. {{ number_format($order->total_cost, 2) }}</td>
            </tr>
            @if ($order->discount_percentage && $order->discount_percentage > 0)
                <tr>
                    <td class="label">Discount ({{ $order->discount_percentage }}%)</td>
                    <td class="value">-Rs. {{ number_format(($order->total_cost * $order->discount_percentage) / 100, 2) }}</td>
                </tr>
                <tr class="grand-total">
                    <td class="label">Total Amount</td>
                    <td class="value">Rs. {{ number_format($order->total_cost * (1 - $order->discount_percentage / 100), 2) }}</td>
                </tr>
            @else
                <tr class="grand-total">
                    <td class="label">Total Amount</td>
                    <td class="value">Rs. {{ number_format($order->total_cost, 2) }}</td>
                </tr>
            @endif
        </table>

        {{-- <div class="payment-method">
            <strong>Payment Method:</strong> 
            @if($order->payment_method === 'cod')
                Cash on Delivery
            @elseif($order->payment_method === 'online')
                Online Payment
            @else
                {{ ucfirst($order->payment_method) }}
            @endif
        </div> --}}

        <div class="footer">
            <p>Thank you for shopping with us</p>
            <p>Contact: <a href="mailto:contact@thulocart.com">contact@thulocart.com</a> | +123-456-7890</p>
            <p>Terms & conditions apply</p>
        </div>
    </div>
</body>

</html>