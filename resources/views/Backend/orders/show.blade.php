@extends('backend.layouts.main')

@section('title', 'Order Detail')

@section('main-section')

    <div class="container my-5">
        <div class="card">
            <div class="card-header text-black">
                <h3 class="mb-0">Order Details</h3>
            </div>
            <div class="card-body">
                <!-- User Information -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h5 class="card-title">Customer Information</h5>
                        <p class="mb-1"><strong>Name:</strong> {{ $order->user?->name ?? 'N/A' }}</p>
                        <p class="mb-1"><strong>Email:</strong> {{ $order->user?->email ?? 'N/A' }}</p>
                        <p class="mb-1"><strong>Phone:</strong> {{ $order->user?->contact ?? 'N/A' }}</p>
                        <p class="mb-1"><strong>Address:</strong>
                            {{ $order->user?->shipping_addresses ?? 'Not provided' }}</p>

                    </div>
                    <div class="col-md-6 text-md-end">
                        <h5 class="card-title">Order Summary</h5>
                        <p class="mb-1"><strong>Total Quantity:</strong> {{ $order->total_quantity }}</p>
                        <p class="mb-1"><strong>Total Price:</strong> Rs. {{ number_format($order->total_cost, 2) }}</p>
                        <p class="mb-1"><strong>Status:</strong> {{ $order->status }}</p>
                        <p class="mb-1"><strong>Payment Method:</strong> {{ $order->payment_method ?? 'Not specified' }}
                        </p>

                    </div>
                </div>
                <!-- Product List -->
                <h5 class="mb-3">Products:</h5>
                <div class="row">
                    @foreach ($order->orderItems as $item)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card h-100">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="{{ asset('storage/' . $item->product->image) }}"
                                            class="img-fluid rounded-start" alt="{{ $item->product->name }}"
                                            style="object-fit: cover; height: 100%;">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h6 class="card-title">{{ $item->product->name }}</h6>
                                            <p class="card-text">
                                                <small class="text-muted">
                                                    Quantity: {{ $item->quantity }}<br>
                                                    Price: Rs. {{ number_format($item->product->actual_amount, 2) }}
                                                </small>
                                            </p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Action Buttons -->
                <div class="mt-4 text-end">
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Back to Orders</a>
                    <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Are you sure you want to delete this order?')">
                            Delete Order
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
