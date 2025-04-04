@extends('backend.layouts.main')
{{-- Extends the main layout from the backend layouts --}}

@section('title', 'Dashboard')
{{-- Sets the title of the page to 'Dashboard' --}}

@section('main-section')
    {{-- Starts the main section of the page --}}
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Total Orders -->
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title text-primary">Total Orders</h5>
                        <p class="display-4 fw-bold">1,245</p>
                        <a href="" class="btn btn-sm btn-outline-primary">View Orders</a>
                    </div>
                </div>
            </div>

            <!-- Total Products -->
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title text-success">Total Products</h5>
                        <p class="display-4 fw-bold">320</p>
                        <a href="" class="btn btn-sm btn-outline-success">View Products</a>
                    </div>
                </div>
            </div>

            <!-- Total Users -->
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title text-info">Total Users</h5>
                        <p class="display-4 fw-bold">850</p>
                        <a href="" class="btn btn-sm btn-outline-info">View Users</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
