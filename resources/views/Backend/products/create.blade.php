@extends('backend.layouts.main') <!-- Extends the main layout -->

@section('title', 'Add Product') <!-- Sets the title of the page -->

@section('main-section') <!-- Main section of the page -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard / Product / </span> Create</h4>
        <!-- Breadcrumb and page title -->
        <div class="row">
            <div class="col">
                <div class="card mb-4">
                    <h5 class="card-header">Create Product</h5> <!-- Card header -->
                    <div class="card-body">
                        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                            <!-- Form to create a new product -->
                            @csrf <!-- CSRF token for security -->
                            <div class="mb-3">
                                <label for="" class="form-label"><span class="text-danger">*</span>Name:</label>
                                <!-- Product name label -->
                                <input type="text" class="form-control" name="name" id="name"
                                    value="{{ old('name') }}" /> <!-- Product name input -->
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div> <!-- Error message for name -->
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="" class="form-label"><span
                                            class="text-danger">*</span>Price:</label> <!-- Product price label -->
                                    <input type="text" class="form-control" name="price" id="Price"
                                        value="{{ old('Price') }}" /> <!-- Product price input -->
                                    @error('Price')
                                        <div class="text-danger">{{ $message }}</div> <!-- Error message for price -->
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="" class="form-label"><span
                                            class="text-danger">*</span>Quantity:</label> <!-- Product quantity label -->
                                    <input type="text" class="form-control" name="quantity" id="quantity"
                                        value="{{ old('Quantity') }}" /> <!-- Product quantity input -->
                                    @error('Quantity')
                                        <div class="text-danger">{{ $message }}</div> <!-- Error message for quantity -->
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="" class="form-label"><span class="text-danger">*</span>Discount
                                        Amount:</label> <!-- Discount amount label -->
                                    <input type="text" class="form-control" name="discount_amount" id="Discount Amount"
                                        value="{{ old('Discount Amount') }}" /> <!-- Discount amount input -->
                                    @error('Discount Amount')
                                        <div class="text-danger">{{ $message }}</div>
                                        <!-- Error message for discount amount -->
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="category_id" class="form-label"><span class="text-danger">*</span><span
                                            class="text-capitalize">Category:</span></label> <!-- Category label -->
                                    <div class="mb-3">
                                        <select class="form-select form-label" name="category_id" id="category_id">
                                            <!-- Category select dropdown -->
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $data)
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                                <!-- Category options -->
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('Category')
                                        <div class="text-danger">{{ $message }}</div> <!-- Error message for category -->
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label"><span class="text-danger">*</span>Image:</label>
                                <!-- Product image label -->
                                <input type="file" class="form-control" name="image" id="Image"
                                    value="{{ old('Image') }}" /> <!-- Product image input -->
                                @error('Image')
                                    <div class="text-danger">{{ $message }}</div> <!-- Error message for image -->
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="featureproduct" class="form-label">Is Feature:</label>
                                    <div class="form-check">
                                        <input type="hidden" value="0" name="is_feature">
                                        <input class="form-check-input" type="checkbox" value="1" name="is_feature"
                                            id="featureproduct">
                                        <label class="form-check-label" for="featureproduct">This will ensure to show or not
                                            in Feature.</label>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="sellingproduct" class="form-label">Is Selling:</label>
                                    <div class="form-check">
                                        <input type="hidden" value="0" name="is_selling">
                                        <input class="form-check-input" type="checkbox" value="1" name="is_selling"
                                            id="sellingproduct">
                                        <label class="form-check-label" for="sellingproduct">This will ensure to show or
                                            not in Selling Products.</label>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="popularproduct" class="form-label">Is Popular:</label>
                                    <div class="form-check">
                                        <input type="hidden" value="0" name="is_popular">
                                        <input class="form-check-input" type="checkbox" value="1" name="is_popular"
                                            id="popularproduct">
                                        <label class="form-check-label" for="popularproduct">This will ensure to show or
                                            not in Popular Products.</label>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="newproduct" class="form-label">Is New Arrival:</label>
                                    <div class="form-check">
                                        <input type="hidden" value="0" name="is_new">
                                        <input class="form-check-input" type="checkbox" value="1" name="is_new"
                                            id="newproduct">
                                        <label class="form-check-label" for="newproduct">This will ensure to show or not
                                            in New Arrival.</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label"><span
                                        class="text-capitalize">Description:</span></label>
                                <!-- Product description label -->
                                <textarea class="form-control" name="description" id="" rows="3"></textarea> <!-- Product description textarea -->
                                @error('Description')
                                    <div class="text-danger">{{ $message }}</div> <!-- Error message for description -->
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Create</button> <!-- Submit button -->
                        </form>
                    </div>
                </div>
            </div>
        @endsection <!-- End of main section -->
