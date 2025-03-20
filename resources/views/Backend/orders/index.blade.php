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
                                                    {{ $order->status }}
                                                </td>
                                                <td>
                                                    <a class="btn btn-primary" href="">View</a>
                                                    {{-- <a class="btn btn-primary" href="">Edit</a> --}}
                                                    <form action="{{ route('admin.orders.destroy', $order->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"
                                                            onclick="return confirm('Are you sure you want to delete this order?')">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div>
                                    Showing {{ $orders->firstItem() }} to {{ $orders->lastItem() }} of {{ $orders->total() }} results
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
