<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\ShippingAddress;
use App\Models\Order_Item;
use App\Models\User;

class InvoiceController extends Controller
{
    public function generateInvoice($orderId)
    {
        try {
            // Fetch order with related items and user
            $order = Order::with('orderItems.product', 'user')->findOrFail($orderId);

            // Fetch shipping address for the order
            $shippingAddress = ShippingAddress::where('order_id', $orderId)->first();

            // Invoice data
            $data = [
                'order' => $order,
                'invoice_number' => 'INV-' . time(),
                'date' => now()->format('Y-m-d'),
                'customer' => $order->user,
                'shippingAddress' => $shippingAddress,
            ];

            // Generate PDF
            $pdf = Pdf::loadView('invoices.order_pdf', $data);

            // Download the PDF
            return $pdf->download('invoice_order_' . $order->id . '.pdf');
        } catch (\Exception $e) {
            // Handle case where order isn't found or other errors
            return redirect()->back()->with('error', 'Unable to generate invoice: ' . $e->getMessage());
        }
    }
}
