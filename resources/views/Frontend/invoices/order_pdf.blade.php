<!DOCTYPE html>
<html>
<head>
    <title>Invoice #{{ $invoice_number }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #333;
        }
        .invoice-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .invoice-header h1 {
            margin: 0;
            font-size: 24px;
            color: #555;
        }
        .invoice-header p {
            margin: 5px 0;
            font-size: 14px;
        }
        .address-section {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        .address {
            width: 45%;
            font-size: 14px;
            line-height: 1.6;
        }
        .address h3 {
            margin-bottom: 10px;
            font-size: 16px;
            color: #555;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-size: 14px;
        }
        td {
            font-size: 13px;
        }
        .total {
            font-weight: bold;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="invoice-header">
        <h1>Invoice</h1>
        <p>Invoice #{{ $invoice_number }}</p>
        <p>Date: {{ $date }}</p>
    </div>

    <div class="address-section">
        <div class="address">
            <h3>From:</h3>
            <p>Company Name</p>
            <p>123 Business Street</p>
            <p>City, State, ZIP</p>
            <p>Email: company@example.com</p>
        </div>
        <div class="address">
            <h3>To:</h3>
            @if($customer)
                <p>{{ $customer->name }}</p>
                <p>{{ $customer->address }}</p>
                <p>Email: {{ $customer->email }}</p>
            @else
                <p>Guest Customer</p>
            @endif
        </div>
    </div>

    <h3>Order Details</h3>
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Unit Price</th>
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
        <tfoot>
            <tr>
                <td colspan="3" class="total">Total</td>
                <td class="total">Rs. {{ number_format($order->total_cost, 2) }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>Thank you for your business!</p>
    </div>
</body>
</html>