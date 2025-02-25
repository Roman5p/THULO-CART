@extends('backend.layouts.main')

@section('title', 'Carousel')

@section('main-section')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard / </span> Carousel</h4>
        <h1>Carousel<h1>
                <!-- Button trigger modal to add a new carousel -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addcarousel">
                    Add Carousel
                </button>
                <!-- Modal for adding a new carousel -->
                <div class="modal fade" id="addcarousel" tabindex="-1" aria-labelledby="addcarouselLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('admin.carousel.store') }}" method="POST" enctype="multipart/form-data">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addcarouselLabel">Add Carousel</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Image</label>
                                        <input type="file" class="form-control" name="image" id="image" />
                                        @error('image')
                                            <small id="imageHelpId" class="form-text text-muted">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">S.N</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($carousels as $carousel)
                                    <tr class="">
                                        <td scope="row">{{ $loop->iteration }}</td>
                                        <td>
                                            <!-- Display carousel image -->
                                            <img src="{{ asset('storage/' . $carousel->image) }}" alt=""
                                                class="img-fluid" style="width: 500px" height="500px" />
                                        </td>
                                        <td>
                                            <!-- Button trigger modal to edit carousel -->
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal{{ $carousel->id }}">
                                                Edit
                                            </button>

                                            <!-- Modal for editing carousel -->
                                            <div class="modal fade" id="exampleModal{{ $carousel->id }}" tabindex="-1"
                                                aria-labelledby="exampleModal{{ $carousel->id }}Label" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form action="{{ route('admin.carousel.update', $carousel->id) }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="exampleModal{{ $carousel->id }}Label">Edit Carousel
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="">Current Image</label>
                                                                    <img src="{{ asset('storage/' . $carousel->image) }}"
                                                                        alt="" class="img-fluid">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="image" class="form-label">New
                                                                        Image</label>
                                                                    <input type="file" class="form-control"
                                                                        name="image" id="image" />
                                                                    @error('image')
                                                                        <small id="imageHelpId"
                                                                            class="form-text text-muted">{{ $message }}</small>
                                                                    @enderror
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
                                            <!-- Form to delete carousel -->
                                            <form action="{{ route('admin.carousel.delete', $carousel->id) }}"
                                                class="d-inline-block" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
    </div>
@endsection
