@extends('frontend.layouts.main')

@section('title', 'Profile')

@section('main-section')

    <div class="container mt-5">
        <h2 class="mb-4">My Profile</h2>
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">User Profile</h5>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center mb-4">
                    <img src="{{ asset('storage/' . auth()->user()->profile) }}" alt="Profile Picture"
                        class="rounded-circle object-fit-cover me-3" width="80" height="80">
                    <div>
                        <form action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="profile_photo" class="form-control mb-2" accept="image/*">
                            <button type="submit" class="btn btn-sm btn-primary">Change Photo</button>
                        </form>
                    </div>
                </div>
                <h5 class="mb-0">{{ Auth::user()->name }}</h5>
                <small class="text-muted">{{ Auth::user()->role }}</small>
                <hr>
                <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                <p><strong>Contact Number:</strong> {{ Auth::user()->contact ?? 'Not Provided' }}</p>
                <p><strong>Address:</strong> {{ Auth::user()->address ?? 'Not Provided' }}</p>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('frontend/assets/js/payment.js') }}"></script>
@endsection
