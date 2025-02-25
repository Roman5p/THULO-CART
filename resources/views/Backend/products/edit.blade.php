@extends('backend.layouts.main')

@section('title', 'Product Edit')

@section('main-section')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Page Header -->
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard / Product / </span> Edit</h4>
        <div class="row">
            <div class="col">
                <div class="card mb-4">
                    <!-- Card Header -->
                    <h5 class="card-header">Product Edit</h5>
                    <div class="card-body">
                        <!-- Form Start -->
                        <form action="{{ route('admin.products.update', $product->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <!-- Product Name Input -->
                            <div class="mb-3">
                                <label for="" class="form-label"><span class="text-danger">*</span>Name:</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    value="{{ old('name', $product->name) }}" />
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row">
                                <!-- Product Price Input -->
                                <div class="col-md-6">
                                    <label for="" class="form-label"><span
                                            class="text-danger">*</span>Price:</label>
                                    <input type="text" class="form-control" name="price" id="Price"
                                        value="{{ old('Price', $product->price) }}" />
                                    @error('price')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- Product Quantity Input -->
                                <div class="col-md-6">
                                    <label for="" class="form-label"><span
                                            class="text-danger">*</span>Quantity:</label>
                                    <input type="text" class="form-control" name="quantity" id="quantity"
                                        value="{{ old('Quantity', $product->quantity) }}" />
                                    @error('quantity')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <!-- Product Discount Amount Input -->
                                <div class="col-md-6">
                                    <label for="" class="form-label"><span class="text-danger">*</span>Discount
                                        Amount:</label>
                                    <input type="text" class="form-control" name="discount_amount" id="Discount Amount"
                                        value="{{ old('discount_amount', $product->discount_amount) }}" />
                                    @error('discount_amount')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- Product Category Selection -->
                                <div class="col-md-6">
                                    <label for="category_id" class="form-label"><span class="text-danger">*</span><span
                                            class="text-capitalize">Category:</span></label>
                                    <div class="mb-3">
                                        <select class="form-select form-label" name="category_id" id="category_id">
                                            @foreach ($categories as $data)
                                                <option value="{{ $data->id }}"@selected($data->id == $product->category_id)>
                                                    {{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('category_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="row">
                                    <!-- Product Image Upload -->
                                    <div class="col-md-6">
                                        <label for="" class="form-label">Image:</label>
                                        <input type="file" class="form-control" name="image" id="Image"
                                            value="{{ old('Image') }}" />
                                        @error('Image')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Current Product Image Display -->
                                    <div class="col-md-6">
                                        <label for="" class="form-label">Current Image:</label>
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="" width="50px"
                                            height="50px">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="featureproduct" class="form-label">Is Feature:</label>
                                    <div class="form-check">
                                        <input type="hidden" value="0" name="is_feature">
                                        <input class="form-check-input" type="checkbox" value="1" name="is_feature"
                                            id="featureproduct"
                                            {{ old('is_feature', $product->is_feature ?? 0) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="featureproduct">This will ensure to show or not
                                            in Feature.</label>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="sellingproduct" class="form-label">Is Selling:</label>
                                    <div class="form-check">
                                        <input type="hidden" value="0" name="is_selling">
                                        <input class="form-check-input" type="checkbox" value="1" name="is_selling"
                                            id="sellingproduct"
                                            {{ old('is_selling', $product->is_selling ?? 0) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="sellingproduct">This will ensure to show or
                                            not in Selling Products.</label>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="popularproduct" class="form-label">Is Popular:</label>
                                    <div class="form-check">
                                        <input type="hidden" value="0" name="is_popular">
                                        <input class="form-check-input" type="checkbox" value="1" name="is_popular"
                                            id="popularproduct"
                                            {{ old('is_popular', $product->is_popular ?? 0) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="popularproduct">This will ensure to show or
                                            not in Popular Products.</label>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="newproduct" class="form-label">Is New Arrival:</label>
                                    <div class="form-check">
                                        <input type="hidden" value="0" name="is_new">
                                        <input class="form-check-input" type="checkbox" value="1" name="is_new"
                                            id="newproduct" {{ old('is_new', $product->is_new ?? 0) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="newproduct">This will ensure to show or not
                                            in New Arrival.</label>
                                    </div>
                                </div>
                            </div>


                            <!-- Product Description Input -->
                            <div class="mb-3">
                                <label for="" class="form-label"><span
                                        class="text-capitalize">Description:</span></label>
                                <textarea class="form-control" name="description" id="" rows="3">{{ old('description', $product->description) }}</textarea>
                                @error('Description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                        <!-- Form End -->
                    </div>
                </div>
            </div>
        @endsection
