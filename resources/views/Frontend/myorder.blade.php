@extends('frontend.layouts.main')

@section('title', 'Order Details')

@section('main-section')

    <div class="container py-4">
        <!-- Main Content -->
        <div class="bg-white p-4 rounded shadow-sm border">
            <!-- Search Bar -->
            <div class="d-flex justify-content-end mb-3">
                <input type="text" class="form-control w-25 me-2" placeholder="Search your orders here">
                <button class="btn btn-primary" id="searchOrdersButton">Search Orders</button>

            </div>

            <!-- Order Items -->
            <div class="container py-4">
                @if ($orders->isEmpty())
                    <div class="alert alert-info text-center">
                        <i class="fa-solid fa-shopping-cart fa-2x mb-2"></i>
                        <strong>No orders found!</strong> Start shopping to place your first order.
                    </div>
                @else
                    <!-- Table Heading -->
                    <div class="row fw-bold border-bottom pb-2 mb-3">
                        <div class="col-md-2 col-6 text-center text-md-start">Order ID</div>
                        <div class="col-md-2 col-6 text-center text-md-start">Date</div>
                        <div class="col-md-3 col-12 text-center text-md-start">Items</div>
                        <div class="col-md-2 col-6 text-center text-md-start">Total</div>
                        <div class="col-md-2 col-6 text-center text-md-start">Status</div>
                        <div class="col-md-1 col-12 text-center text-md-end">Action</div>
                    </div>

                    @foreach ($orders as $order)
                        <div class="card mb-4 shadow-sm border-0">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <!-- Order ID -->
                                    <div class="col-md-2 col-6 text-center text-md-start">
                                        <p class="mb-0 fw-bold">{{ $order->id }}</p>
                                    </div>

                                    <!-- Date -->
                                    <div class="col-md-2 col-6 text-center text-md-start">
                                        <p class="mb-0 fw-bold">{{ $order->created_at->format('Y-m-d') }}</p>
                                    </div>

                                    <!-- Items -->
                                    <div class="col-md-3 col-12 text-center text-md-start">
                                        <p class="mb-0 fw-bold">Quantity: {{ $order->total_quantity }}</p>
                                    </div>

                                    <!-- Total -->
                                    <div class="col-md-2 col-6 text-center text-md-start">
                                        <p class="mb-0 fw-bold">₹{{ $order->total_cost }}</p>
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-2 col-6 text-center text-md-start">

                                        <span
                                            class="badge 
                                                {{ $order->status === 'pending'
                                                    ? 'bg-warning text-dark'
                                                    : ($order->status === 'shipped'
                                                        ? 'bg-primary'
                                                        : ($order->status === 'delivered'
                                                            ? 'bg-success'
                                                            : ($order->status === 'cancelled'
                                                                ? 'bg-danger'
                                                                : 'bg-secondary'))) }}">
                                            {{ ucfirst($order->status) }}
                                        </span>

                                    </div>

                                    <!-- Invoice -->
                                    <!-- Invoice -->
                                    <div class="col-md-1 col-12 text-center text-md-end">
                                        <!-- Invoice Button -->
                                        <a href="{{ route('invoice.generate', ['orderId' => $order->id]) }}" }}"
                                            class="btn btn-outline-primary btn-sm w-100 mb-2 d-flex align-items-center justify-content-center gap-1">
                                            <i class="fa-solid fa-file-invoice-dollar"></i>
                                            <span class="d-none d-md-inline">Invoice</span>
                                        </a>

                                        <!-- View Button -->
                                        <button type="button"
                                            class="btn btn-outline-secondary btn-sm w-100 d-flex align-items-center justify-content-center gap-1"
                                            data-bs-toggle="modal" data-bs-target="#viewOrderModal{{ $order->id }}">
                                            <i class="fa-solid fa-eye"></i>
                                            <span class="d-none d-md-inline">View</span>
                                        </button>
                                    </div>
                                    <!-- Modal -->
                                    <div class="modal fade" id="viewOrderModal{{ $order->id }}" tabindex="-1"
                                        aria-labelledby="viewOrderModalLabel{{ $order->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title" id="viewOrderModalLabel{{ $order->id }}">
                                                        Order Details - {{ $order->id }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="container my-4">
                                                        <div class="card border-0 shadow-sm">
                                                            <div class="card-header bg-light">
                                                                <h4 class="mb-0">Order Details</h4>
                                                            </div>
                                                            <div class="card-body">
                                                                <!-- User Information -->
                                                                <div class="row mb-4">
                                                                    <div class="col-md-6">
                                                                        <h5 class="text-primary">Customer Information</h5>
                                                                        <p class="mb-1"><strong>Name:</strong>
                                                                            {{ $order->user?->name ?? 'N/A' }}</p>
                                                                        <p class="mb-1"><strong>Email:</strong>
                                                                            {{ $order->user?->email ?? 'N/A' }}</p>
                                                                        <p class="mb-1"><strong>Phone:</strong>
                                                                            {{ $order->user?->contact ?? 'N/A' }}</p>
                                                                        <p class="mb-1"><strong>Address:</strong>
                                                                            {{ $order->user?->shipping_addresses ?? 'Not provided' }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-md-6 text-md-end">
                                                                        <h5 class="text-primary">Order Summary</h5>
                                                                        <p class="mb-1"><strong>Total Quantity:</strong>
                                                                            {{ $order->total_quantity }}</p>

                                                                        <p class="mb-1"><strong>Subtotal Price:</strong>
                                                                            ₹{{ number_format($order->total_cost, 2) }}</p>
                                                                        <p class="mb-1"><strong>Status:</strong> <span
                                                                                class="badge 
                                                                                {{ $order->status === 'pending'
                                                                                    ? 'bg-warning text-dark'
                                                                                    : ($order->status === 'shipped'
                                                                                        ? 'bg-primary'
                                                                                        : ($order->status === 'delivered'
                                                                                            ? 'bg-success'
                                                                                            : ($order->status === 'cancelled'
                                                                                                ? 'bg-danger'
                                                                                                : 'bg-secondary'))) }}">
                                                                                {{ ucfirst($order->status) }}
                                                                            </span>
                                                                        </p>
                                                                        <p class="mb-1"><strong>Payment Method:</strong>
                                                                            {{ $order->payment?->payment_method ?? 'Not specified' }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <!-- Product List -->
                                                                <h5 class="text-primary mb-3">Products:</h5>
                                                                <div class="row">
                                                                    @foreach ($order->orderItems as $item)
                                                                        <div class="col-md-6 col-lg-4 mb-4">
                                                                            <div class="card h-100 border-0 shadow-sm">
                                                                                <div class="row g-0">
                                                                                    <div class="col-md-4">
                                                                                        <div
                                                                                            class="d-flex justify-content-center align-items-center h-100">
                                                                                            <img src="{{ asset('storage/' . $item->product->image) }}"
                                                                                                class="img-fluid rounded shadow-sm"
                                                                                                alt="{{ $item->product->name }}"
                                                                                                style="object-fit: cover; max-height: 150px; max-width: 100%;">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-8">
                                                                                        <div class="card-body">
                                                                                            <h6
                                                                                                class="card-title text-primary">
                                                                                                {{ $item->product->name }}
                                                                                            </h6>
                                                                                            <p class="card-text">
                                                                                                <small class="text-muted">
                                                                                                    Quantity:
                                                                                                    {{ $item->quantity }}<br>
                                                                                                    Price:
                                                                                                    ₹{{ number_format($item->product->actual_amount, 2) }}
                                                                                                    Subtotal:
                                                                                                    ₹{{ number_format($item->product->actual_amount * $item->quantity, 2) }}
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
                                                                    <a href="{{ route('myorder') }}"
                                                                        class="btn btn-outline-secondary me-2 d-flex align-items-center justify-content-center gap-1">
                                                                        <i class="fa-solid fa-arrow-left"></i>
                                                                        <span>Back to Orders</span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <!-- Add Font Awesome for the download icon -->
            {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"> --}}
        </div>
    </div>


@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
