@extends('backend.layouts.main')

@section('title', 'Dashboard')

@section('main-section')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Dashboard Header -->
        <div class="mb-5 text-center">
            {{-- <h1 class="fw-bold text-dark display-4 animate__animated animate__bounceInDown" style="background: linear-gradient(45deg, #4a5568, #2d3748); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Admin Dashboard</h1> --}}
            <p class="text-muted fw-medium animate__animated animate__fadeInUp">Explore Your Business Insights</p>
        </div>

        <!-- Stats Cards -->
        <div class="row g-4">
            <!-- Total Orders -->
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card attractive-card h-100 border-0 animate__animated animate__zoomIn" style="--delay: 0.1s;">
                    <div class="card-body text-center p-4">
                        <i class="bi bi-cart-check-fill text-primary display-3 mb-3 icon-glow"></i>
                        <h5 class="card-title text-primary fw-bold">Total Orders</h5>
                        <p class="display-3 fw-bold text-dark mb-0">{{ $totalOrders }}</p>
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-primary-gradient mt-3">View Orders</a>
                    </div>
                </div>
            </div>

            <!-- Total Products -->
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card attractive-card h-100 border-0 animate__animated animate__zoomIn" style="--delay: 0.2s;">
                    <div class="card-body text-center p-4">
                        <i class="bi bi-box-seam-fill text-success display-3 mb-3 icon-glow"></i>
                        <h5 class="card-title text-success fw-bold">Total Products</h5>
                        <p class="display-3 fw-bold text-dark mb-0">{{ $totalProducts }}</p>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-success-gradient mt-3">View
                            Products</a>
                    </div>
                </div>
            </div>

            <!-- Total Users -->
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card attractive-card h-100 border-0 animate__animated animate__zoomIn" style="--delay: 0.3s;">
                    <div class="card-body text-center p-4">
                        <i class="bi bi-people-fill text-info display-3 mb-3 icon-glow"></i>
                        <h5 class="card-title text-info fw-bold">Total Users</h5>
                        <p class="display-3 fw-bold text-dark mb-0">{{ $totalUsers }}</p>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-info-gradient mt-3">View Users</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recently Ordered Items -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="card attractive-card border-0 animate__animated animate__fadeInUp" style="--delay: 0.4s;">
                    <div
                        class="card-header bg-gradient-light text-dark d-flex justify-content-between align-items-center py-3">
                        <h5 class="card-title mb-0 fw-bold text-dark">Recently Ordered Items</h5>
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-dark shadow-sm">View
                            All</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-attractive align-middle">
                                <thead class="bg-light-gradient">
                                    <tr>
                                        <th>Order ID</th>
                                        <th>User Name</th>
                                        <th>Status</th>
                                        <th>Payment Method</th>
                                        <th>Order Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentOrders as $order)
                                        <tr class="table-row-hover">
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->user->name ?? 'N/A' }}</td>
                                            <td>
                                                <span
                                                    class="badge badge-glow 
                                                    @if ($order->status == 'Pending') bg-warning 
                                                    @elseif($order->status == 'Completed') bg-success 
                                                    @else bg-secondary @endif px-3 py-2">
                                                    {{ $order->status }}
                                                </span>
                                            </td>
                                            <td>{{ $order->payment_method ?? 'Not Specified' }}</td>
                                            <td>{{ $order->created_at->format('d M Y, h:i A') }}</td>
                                            <td>
                                                <a href="{{ route('admin.orders.show', $order->id) }}"
                                                    class="btn btn-sm btn-primary">View</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-muted py-4">No recent orders
                                                available.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mostly Purchased Products -->
        <div class="row mt-5 mb-5">
            <div class="col-12">
                <div class="card attractive-card border-0 animate__animated animate__fadeInUp" style="--delay: 0.5s;">
                    <div
                        class="card-header bg-gradient-light text-dark d-flex justify-content-between align-items-center py-3">
                        <h5 class="card-title mb-0 fw-bold text-dark">Mostly Purchased Products</h5>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-outline-dark shadow-sm">View
                            All</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-attractive align-middle">
                                <thead class="bg-light-gradient">
                                    <tr>
                                        <th>Product ID</th>
                                        <th>Product Name</th>
                                        <th>Total Purchases</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($mostlyPurchasedProducts as $product)
                                        <tr class="table-row-hover">
                                            <td>{{ $product->id }}</td>
                                            <td>{{ $product->name ?? 'N/A' }}</td>
                                            <td>{{ $product->total_purchases }}</td>
                                            <td>Rs. {{ number_format($product->price ?? 0, 2) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted py-4">No data available for
                                                mostly purchased products.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Styles -->
    <style>
        /* Light Background and Base Styling */
        body {
            background: #f8fafc;
            color: #2d3748;
            font-family: 'Poppins', sans-serif;
        }

        .container-p-y {
            padding: 3rem 1.5rem;
        }

        /* Attractive Cards */
        .attractive-card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
        }

        .attractive-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
        }

        /* Gradient Buttons */
        .btn-primary-gradient {
            background: linear-gradient(45deg, #4299e1, #63b3ed);
            border: none;
            color: #fff;
            padding: 0.5rem 1.5rem;
            border-radius: 25px;
            box-shadow: 0 4px 10px rgba(66, 153, 225, 0.3);
            transition: all 0.3s ease;
        }

        .btn-primary-gradient:hover {
            background: linear-gradient(45deg, #2b6cb0, #4299e1);
            color: #fff;
            box-shadow: 0 6px 15px rgba(66, 153, 225, 0.5);
        }

        .btn-success-gradient {
            background: linear-gradient(45deg, #48bb78, #68d391);
            border: none;
            color: #fff;
            padding: 0.5rem 1.5rem;
            border-radius: 25px;
            box-shadow: 0 4px 10px rgba(72, 187, 120, 0.3);
            transition: all 0.3s ease;
        }

        .btn-success-gradient:hover {
            background: linear-gradient(45deg, #2f855a, #48bb78);
            color: #fff;
            box-shadow: 0 6px 15px rgba(72, 187, 120, 0.5);
        }

        .btn-info-gradient {
            background: linear-gradient(45deg, #00b5d8, #4dc9e6);
            border: none;
            color: #fff;
            padding: 0.5rem 1.5rem;
            border-radius: 25px;
            box-shadow: 0 4px 10px rgba(0, 181, 216, 0.3);
            transition: all 0.3s ease;
        }

        .btn-info-gradient:hover {
            background: linear-gradient(45deg, #007ea8, #00b5d8);
            color: #fff;
            box-shadow: 0 6px 15px rgba(0, 181, 216, 0.5);
        }

        /* Icon Glow */
        .icon-glow {
            filter: drop-shadow(0 0 8px rgba(0, 0, 0, 0.1));
            transition: filter 0.3s ease;
        }

        .icon-glow:hover {
            filter: drop-shadow(0 0 12px rgba(0, 0, 0, 0.2));
        }

        /* Table Styling */
        .table-attractive {
            background: #fff;
            border-radius: 15px;
            overflow: hidden;
        }

        .bg-light-gradient {
            background: linear-gradient(135deg, #f7fafc, #edf2f7);
        }

        .table-attractive thead th {
            background: linear-gradient(135deg, #edf2f7, #e2e8f0);
            color: #2d3748;
            border: none;
            padding: 1rem;
            font-weight: 600;
        }

        .table-row-hover {
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .table-row-hover:hover {
            background: #f1f5f9;
            transform: scale(1.01);
        }

        .badge-glow {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            font-size: 0.9rem;
            transition: box-shadow 0.3s ease;
        }

        .badge-glow:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        /* Animations */
        .animate__animated {
            animation-duration: 0.8s;
            animation-delay: var(--delay);
        }

        .animate__zoomIn {
            animation-name: zoomIn;
        }

        .animate__bounceInDown {
            animation-name: bounceInDown;
        }

        @keyframes zoomIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes bounceInDown {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }

            60% {
                opacity: 1;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endsection
