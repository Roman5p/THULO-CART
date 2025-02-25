
@extends('backend.layouts.main')

@section('title', 'Product Category')

@section('main-section')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard / Product / </span> Category</h4>
        <h1>Product Category<h1>
                <!-- Button trigger modal to add a new category -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addcategory">
                    Add Category
                </button>
                <!-- Modal for adding a new category -->
                <div class="modal fade" id="addcategory" tabindex="-1" aria-labelledby="addcategoryLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('admin.product-category.store') }}" method="POST" enctype="multipart/form-data">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addcategoryLabel">Add Category</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body" >

                                    @csrf

                                    <div class="mb-3">
                                        <label for="" class="form-label">Name</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            aria-describedby="nameHelpId" />
                                        @error('name')
                                            <small id="nameHelpId" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label"><span class="text-danger"></span>Image:</label> <!-- Product image label -->
                                        <input type="file" class="form-control" name="image" id="Image"
                                            value="{{ old('Image') }}" /> <!-- Product image input -->
                                        @error('Image')
                                            <div class="text-danger">{{ $message }}</div> <!-- Error message for image -->
                                        @enderror
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="">
                                <tr>
                                    <th scope="col">S.N</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($categories as $category)
                                    <tr class="">
                                        <td scope="row">{{ $loop->iteration }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td><img src="{{ asset('storage/' . $category->image) }}" alt=""
                                            width="50px" height="50px"></td>
                                        <td>
                                            <!-- Button trigger modal to edit a category -->
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal{{ $category->id }}">
                                                Edit
                                            </button>

                                            <!-- Modal for editing a category -->
                                            <div class="modal fade" id="exampleModal{{ $category->id }}" tabindex="-1"
                                                aria-labelledby="exampleModal{{ $category->id }}Label" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <!-- Form for updating a category -->
                                                        <form
                                                            action="{{ route('admin.product-category.update', $category->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="exampleModal{{ $category->id }}Label">Edit Category
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="name{{ $category->id }}"
                                                                        class="form-label">Name</label>
                                                                    <input type="text" class="form-control"
                                                                        name="name"
                                                                        value="{{ old('name', $category->name) }}"
                                                                        id="name{{ $category->id }}"
                                                                        aria-describedby="NameHelpId" />
                                                                    @error('name')
                                                                        <small id="NameHelpId"
                                                                            class="form-text text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                                <div class="mb-3">
                                                                    <div class="row">
                                                                        <!-- Product Image Upload -->
                                                                        <div class="col-md-6">
                                                                            <label for="" class="form-label">Image:</label>
                                                                            <input type="file" class="form-control" name="image" id="image"
                                                                                value="{{ old('image') }}" />
                                                                            @error('image')
                                                                                <div class="text-danger">{{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                        <!-- Current Product Image Display -->
                                                                        <div class="col-md-6">
                                                                            <label for="" class="form-label">Current Image:</label>
                                                                            <img src="{{ asset('storage/' . $category->image) }}" alt="" width="50px"
                                                                                height="50px">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save
                                                                    changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Form for deleting a category -->
                                            <form action="{{ route('admin.product-category.delete', $category->id) }}"
                                                class="d-inline-block" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this category?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
    </div>
    <!-- / Content -->
@endsection
