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
                                                    <div class="d-flex gap-2 align-items-center">
                                                        <a href="{{ route('admin.products.edit', $product->id) }}"
                                                            class="btn btn-outline-success btn-sm text-primary" title="Edit">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                height="20" fill="currentColor"
                                                                class="bi bi-pen" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M15.502 1.94a.5.5 0 0 1 0 .706l-1.5 1.5a.5.5 0 0 1-.707 0l-1.5-1.5a.5.5 0 0 1 0-.707l1.5-1.5a.5.5 0 0 1 .707 0l1.5 1.5z" />
                                                                <path
                                                                    d="M1 13.5V16h2.5l9.354-9.354-2.5-2.5L1 13.5zm1.207-.793 8.647-8.647 1.086 1.086-8.647 8.647H2.207z" />
                                                            </svg>
                                                        </a>
                                                        <form action="{{ route('admin.products.destroy', $product->id) }}"
                                                            method="post" onsubmit="return confirm('Are you sure?')"
                                                            class="m-0">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn btn-outline-primary btn-sm p-0 text-danger"
                                                                title="Delete">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                    height="20" fill="currentColor" class="bi bi-trash3"
                                                                    viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M6.5 1.5A1.5 1.5 0 0 1 8 0h2a1.5 1.5 0 0 1 1.5 1.5H14a.5.5 0 0 1 0 1h-1v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V2.5H2a.5.5 0 0 1 0-1h1.5zM5 2.5v11a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V2.5H5z" />
                                                                    <path
                                                                        d="M7.5 5a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0v-6a.5.5 0 0 1 .5-.5zm3 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0v-6a.5.5 0 0 1 .5-.5z" />
                                                                </svg>
                                                            </button>
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
