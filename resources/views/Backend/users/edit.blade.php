@extends('backend.layouts.main')

@section('title', 'Add Product')

@section('main-section')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard / Users / </span> Edit</h4>
        <div class="row">
            <div class="col">
                <div class="card mb-4">
                    <h5 class="card-header">Edit User</h5>
                    <div class="card-body">
                        <form action="{{ route('admin.users.update', $user->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                                <label for="" class="form-label"><span class="text-danger">*</span>Name:</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    value="{{ old('name', $user->name) }}" />
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="gender" class="form-label"><span class="text-danger">*</span><span
                                            class="text-capitalize">Gender:</span></label>
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="male"
                                                value="male"
                                                {{ old('gender', $user->gender) == 'male' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="male">
                                                Male
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="female"
                                                value="female"
                                                {{ old('gender', $user->gender) == 'female' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="female">
                                                Female
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="other"
                                                value="other"
                                                {{ old('gender', $user->gender) == 'other' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="other">
                                                Other
                                            </label>
                                        </div>
                                    </div>
                                    @error('gender')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
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
                                            <img src="{{ asset('storage/' . $user->profile) }}" alt="" width="50px"
                                                height="50px">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="role" class="form-label"><span class="text-danger">*</span>Role:</label>
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="role" id="admin"
                                                value="admin" {{ old('role', $user->role) == 'admin' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="admin">
                                                Admin
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="role" id="user"
                                                value="user" {{ old('role', $user->role) == 'user' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="user">
                                                User
                                            </label>
                                        </div>
                                        @error('role')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="" class="form-label"><span
                                            class="text-danger">*</span>Contact:</label>
                                    <input type="text" class="form-control" name="contact" id="contact"
                                        value="{{ old('contact', $user->contact) }}" />
                                    @error('contact')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label"><span
                                                class="text-danger">*</span>Email:</label>
                                        <input type="email" class="form-control" name="email" id="email"
                                            value="{{ old('email',$user->email) }}" />
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="" class="form-label"><span
                                            class="text-danger">*</span>Password:</label>
                                    <input type="password" class="form-control" name="password" id="password"
                                        value="{{ old('password') }}" />
                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="password_confirmation" class="form-label"><span
                                            class="text-danger">*</span>Confirm Password:</label>
                                    <input type="password" class="form-control" name="password_confirmation"
                                        id="password_confirmation" />
                                </div>

                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endsection
