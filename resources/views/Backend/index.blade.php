@extends('backend.layouts.main')
{{-- Extends the main layout from the backend layouts --}}

@section('title', 'Dashboard')
{{-- Sets the title of the page to 'Dashboard' --}}

@section('main-section')
    {{-- Starts the main section of the page --}}
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
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Address</th>
                                            <th scope="cole">Product</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- Ends the main section --}}
