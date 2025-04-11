<!DOCTYPE html>
<html>

<head>
    <title>Invoice #{{ $invoice_number }}</title>
    <style>
        body {
            font-family: 'Roboto', Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            background-color: #f4f4f9;
            line-height: 1.6;
        }

        .container {
            max-width: 800px;
            margin: 30px auto;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 40px;
        }

        .invoice-header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #ddd;
        }

        .invoice-header img {
            max-width: 150px;
            margin-bottom: 10px;
        }

        .invoice-header h1 {
            font-size: 28px;
            font-weight: bold;
            color: #444;
            margin: 0;
        }

        .invoice-header p {
            font-size: 14px;
            color: #666;
            margin: 5px 0;
        }

        .order-id {
            display: inline-block;
            background-color: #e0f7fa;
            padding: 6px 14px;
            border-radius: 5px;
            font-size: 14px;
            color: #00796b;
            margin-top: 10px;
        }

        .address-section {
            margin-bottom: 30px;
        }

        .address {
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            border: 1px solid #ddd;
            margin-bottom: 15px;
        }

        .address h3 {
            font-size: 16px;
            font-weight: bold;
            color: #444;
            margin-bottom: 10px;
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
            background-color: #f0f0f0;
            font-weight: bold;
            color: #444;
            text-align: left;
            padding: 12px 15px;
            border-bottom: 2px solid #ddd;
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
            font-weight: bold;
            color: #555;
            text-align: right;
        }

        .total-section .value {
            text-align: right;
            font-weight: bold;
            color: #333;
        }

        .grand-total .label,
        .grand-total .value {
            font-weight: bold;
            background-color: #e0f7fa;
            color: #00796b;
        }

        .payment-method {
            margin-top: 25px;
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 8px;
            border: 1px solid #ddd;
            font-size: 14px;
            color: #555;
        }

        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 2px solid #ddd;
            text-align: center;
            font-size: 13px;
            color: #666;
        }

        .footer p {
            margin: 5px 0;
        }

        .footer a {
            color: #00796b;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="invoice-header">
            <img src="{{ asset('images/logo.jpg') }}" alt="Thulo Cart Logo">
            <h1>Invoice</h1>
            <p>Invoice #{{ $order->id }}-{{ $order->orderItems->pluck('id')->implode('-') }}</p>
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
                <td class="value">Rs. {{ number_format($order->orderItems->sum(fn($item) => $item->product->actual_amount * $item->quantity), 2) }}</td>
            </tr>

            <tr>
                <td class="label">eSewa Charges (10%)</td>
                <td class="value">Rs.
                    {{ number_format($order->orderItems->sum(fn($item) => $item->product->actual_amount * $item->quantity) * 0.1, 2) }}
                </td>
            </tr>
            <tr class="grand-total">
                <td class="label">Total Amount</td>
                <td class="value">
                    Rs. {{ number_format($order->orderItems->sum(fn($item) => $item->product->actual_amount * $item->quantity) * 1.1, 2) }}
                </td>
            </tr>
        </table>

        <div class="payment-method">
            <strong>Payment Method:</strong>
            @if ($order->payment_method === 'cod')
                Cash on Delivery
            @elseif($order->payment_method === 'online')
                Online Payment (eSewa)
            @else
                {{ ucfirst($order->payment_method) }}
            @endif
        </div>

        <div class="footer">
            <p>Thank you for shopping with us</p>
            <p>Contact: <a href="mailto:contact@thulocart.com">contact@thulocart.com</a> | +123-456-7890</p>
            <p>Terms & conditions apply</p>
        </div>
    </div>
</body>

</html>
