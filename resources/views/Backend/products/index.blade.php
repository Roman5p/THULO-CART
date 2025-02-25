{{-- 
    This file is a Blade template for displaying the list of products in the backend of the SIMPLEECOMMERCE application.
--}}

{{-- 
    Extends the main layout for the backend.
--}}
@extends('backend.layouts.main')

{{-- 
    Sets the title of the page to "Product".
--}}
@section('title', 'Product')

{{-- 
    Main content section of the page.
--}}
@section('main-section')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            {{-- 
                Page header with breadcrumb navigation and title.
            --}}
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard / </span> Product</h4>
            <h1>Products</h1>
            <div class="row">
                <div class="col">
                    {{-- 
                        Button to add a new product.
                    --}}
                    <a name="" id="" class="btn btn-primary my-2" href="{{ route('admin.products.create') }}"
                        role="button"> + Add Product</a>
                    <div class="card mb-4">
                        <h5 class="card-header">Products</h5>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">S.N</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Discount</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Feature</th>
                                            <th scope="col">Selling</th>
                                            <th scope="col">Popular</th>
                                            <th scope="col">New</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr>
                                                <td scope="row">{{ $loop->iteration }}</td>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->actual_amount }}</td>
                                                <td>{{ $product->quantity }}</td>
                                                <td>{{ $product->discount_amount }}</td>
                                                <td>{{ $product->category->name }}</td>
                                                <td>
                                                    <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image"
                                                        class="img-fluid" style="width: 50px; height: 50px;">
                                                </td>
                                                <td>{{ $product->is_feature ? 'Yes' : 'No' }}</td>
                                                <td>{{ $product->is_selling ? 'Yes' : 'No' }}</td>
                                                <td>{{ $product->is_popular ? 'Yes' : 'No' }}</td>
                                                <td>{{ $product->is_new ? 'Yes' : 'No' }}</td>
                                                <td>
                                                    <div class="d-flex gap-1 align-items-center">
                                                        <a class="btn btn-sm btn-primary px-2 py-1"
                                                            href="{{ route('admin.products.edit', $product->id) }}">Edit</a>
                                                        <form action="{{ route('admin.products.destroy', $product->id) }}"
                                                            method="post" onsubmit="return confirm('Are you sure?')"
                                                            class="m-0">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-danger px-2 py-1">Delete</button>
                                                        </form>
                                                    </div>


                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
@endsection
