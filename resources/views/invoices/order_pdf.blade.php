<!DOCTYPE html>
<html>

<head>
    <title>Invoice #{{ $invoice_number }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #2d3748;
            background-color: #f7fafc;
            line-height: 1.6;
        }

        .container {
            max-width: 850px;
            margin: 30px auto;
            background-color: #ffffff;
            border-radius: 6px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            padding: 30px;
            border-left: 4px solid #2c5282;
        }

        .invoice-header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px dashed #e2e8f0;
        }

        .invoice-header img {
            max-width: 160px;
            margin-bottom: 10px;
        }

        .invoice-header h1 {
            font-size: 28px;
            font-weight: 700;
            color: #2c5282;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        .invoice-header p {
            font-size: 13px;
            color: #718096;
            margin: 4px 0;
        }

        .address-section {
            display: flex;
            justify-content: space-between;
            margin-bottom: 35px;
            font-size: 13px;
            gap: 15px;
        }

        .address {
            width: 48%;
            padding: 15px;
            background-color: #f9fafb;
            border-radius: 4px;
            border-left: 3px solid #bee3f8;
        }

        .address h3 {
            font-size: 15px;
            font-weight: 600;
            color: #2c5282;
            margin: 0 0 10px 0;
            text-transform: uppercase;
        }

        .address p {
            margin: 5px 0;
            color: #4a5568;
        }

        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            font-size: 13px;
        }

        .details-table th,
        .details-table td {
            border: 1px solid #e2e8f0;
            padding: 12px 14px;
            text-align: left;
        }

        .details-table th {
            background-color: #edf2f7;
            font-weight: 600;
            color: #2d3748;
            text-transform: uppercase;
            font-size: 12px;
        }

        .details-table td {
            background-color: #ffffff;
            color: #4a5568;
        }

        .total-section {
            width: 35%;
            margin-left: auto;
            font-size: 13px;
            border-collapse: collapse;
        }

        .total-section tr td {
            padding: 10px 12px;
            border: 1px solid #e2e8f0;
        }

        .total-section .label {
            font-weight: 600;
            color: #2d3748;
            background-color: #f9fafb;
            text-align: right;
        }

        .total-section .value {
            text-align: right;
            background-color: #ffffff;
            font-weight: 500;
        }

        .discount-row .label,
        .discount-row .value {
            color: #c53030;
            font-weight: 600;
        }

        .grand-total .label,
        .grand-total .value {
            background-color: #2c5282;
            color: #ffffff;
            font-weight: 700;
            font-size: 14px;
            padding: 12px 14px;
        }

        .divider {
            width: 60px;
            height: 3px;
            background-color: #2c5282;
            margin: 20px auto;
            border-radius: 2px;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 11px;
            color: #718096;
        }

        .footer p {
            margin: 4px 0;
        }

        .footer .highlight {
            color: #2c5282;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="invoice-header">
            <img src="{{ url('frontend/assets/images/logo.png') }}" alt="Thulo Cart Logo">
            <h1>Invoice</h1>
            <p>Invoice #{{ $invoice_number }}</p>
            <p>Order Date: {{ $date }}</p>
            <p>Order ID: {{ $order->id }}</p>
        </div>

        <div class="address-section">
            <div class="address">
                <h3>Shipped To</h3>
                @if ($customer)
                    <p>{{ $customer->name }}</p>
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
                    <th>Price</th>
                    <th>Subtotal</th>
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
                <tr class="discount-row">
                    <td class="label">Discount ({{ $order->discount_percentage }}%)</td>
                    <td class="value">-Rs.
                        {{ number_format(($order->total_cost * $order->discount_percentage) / 100, 2) }}</td>
                </tr>
                <tr class="grand-total">
                    <td class="label">Total</td>
                    <td class="value">Rs.
                        {{ number_format($order->total_cost * (1 - $order->discount_percentage / 100), 2) }}</td>
                </tr>
            @else
                <tr class="grand-total">
                    <td class="label">Total</td>
                    <td class="value">Rs. {{ number_format($order->total_cost, 2) }}</td>
                </tr>
            @endif
        </table>

        <div class="divider"></div>

        <div class="footer">
            <p>Thank you for choosing <span class="highlight">Thulo Cart</span></p>
            <p>Contact us at <span class="highlight">contact@thulocart.com</span> | +123-456-7890</p>
            <p>Terms & conditions apply</p>
        </div>
    </div>
</body>

</html>
