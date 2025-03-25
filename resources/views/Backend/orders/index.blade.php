@extends('backend.layouts.main')

@section('title', 'Order List')

@section('main-section')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard / </span> Order's</h4>
            <h1>Order's</h1>
            <div class="row">
                <div class="col">
                    <div class="card mb-4">
                        <h5 class="card-header">Order's List</h5>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">S.N</th>
                                            <th scope="col">Customer Name</th>
                                            <th scope="col">Total Quantity</th>
                                            <th scope="col">Total Cost</th>
                                            <th scope="col">Products</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td scope="row">{{ $loop->iteration }}</td>
                                                <td>{{ $order?->user?->name }}</td>
                                                <td>{{ $order->total_quantity }}</td>
                                                <td>Rs. {{ number_format($order->total_cost, 2) }}</td>
                                                <td>
                                                    @foreach ($order->orderItems as $item)
                                                        {{ $item?->product?->name }}</br>
                                                    @endforeach
                                                </td>
                                                <td>
                                                   
                                                   <span class="badge {{ $order->status == 'pending' ? 'bg-warning' : ($order->status == 'shipped' ? 'bg-primary' : 'bg-success') }}">{{ $order->status }}</span>
                                                    
                                                </td>
                                                <td>


                                                    {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#orderModal{{ $order->id }}">
                                                        View
                                                    </button> --}}

                                                    <!-- Modal -->
                                                    {{-- <div class="modal fade" id="orderModal{{ $order->id }}"
                                                        tabindex="-1" aria-labelledby="orderModalLabel{{ $order->id }}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="orderModalLabel{{ $order->id }}">Order
                                                                        Details</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p><strong>Customer Name:</strong>
                                                                        {{ $order?->user?->name }}</p>
                                                                    <p><strong>Total Quantity:</strong>
                                                                        {{ $order->total_quantity }}</p>
                                                                    <p><strong>Total Cost:</strong> Rs.
                                                                        {{ number_format($order->total_cost, 2) }}</p>
                                                                    <p><strong>Products:</strong></p>
                                                                    <ul>
                                                                        @foreach ($order->orderItems as $item)
                                                                            <li>{{ $item?->product?->name }} (Quantity:
                                                                                {{ $item->quantity }})</li>
                                                                        @endforeach
                                                                    </ul>
                                                                    <p><strong>Status:</strong> {{ $order->status }}</p>
                                                                    <p><strong>Address:</strong> {{ $order?->user?->shipping_address }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> --}}
                                                    <a class="btn btn-outline-primary"
                                                        href="{{ route('admin.orders.show', $order->id) }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-eye"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8a13.133 13.133 0 0 1-1.66 2.043C11.879 11.332 10.12 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.133 13.133 0 0 1 1.172 8z" />
                                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5z" />
                                                        </svg>
                                                    </a>
                                                    <form action="{{ route('admin.orders.ready', $order->id) }}"
                                                        method="post" class="d-inline-block">
                                                        @method('PUT')
                                                        @csrf
                                                        <button type="submit" class="btn btn-outline-success">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor" class="bi bi-check2"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M11.354 4.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708-.708l7-7a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-1 1a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1-.146-.354z" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('admin.orders.destroy', $order->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger"
                                                            onclick="return confirm('Are you sure you want to delete this order?')">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor" class="bi bi-trash"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M5.5 5.5A.5.5 0 0 1 6 5h4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5H6a.5.5 0 0 1-.5-.5v-7zM4.118 4a1 1 0 0 1 .876-.707h6.012a1 1 0 0 1 .876.707L12.5 4H14a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1h-1v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6H2a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h1.5l.618-.707zM5.118 4L5 4.118V5h6V4.118L10.882 4H5.118z" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div>
                                    Showing {{ $orders->firstItem() }} to {{ $orders->lastItem() }} of
                                    {{ $orders->total() }} results
                                </div>
                                <div>
                                    {{ $orders->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
