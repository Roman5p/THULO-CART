@extends('frontend.layouts.main')

@section('title', 'Profile')

@section('main-section')

    <div class="container mt-5">
        <h2 class="mb-4 text-center text-primary">My Profile</h2>
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-header bg-gradient-primary text-white rounded-top-4 text-center">
            </div>
            <div class="card-body p-4">
                <div class="d-flex flex-column flex-md-row align-items-center mb-4">
                    <img src="{{ asset('storage/' . auth()->user()->profile) }}" alt="Profile Picture"
                        class="rounded-circle object-fit-cover border border-3 border-primary mb-3 mb-md-0 me-md-3 profile-img" width="100"
                        height="100">
                    <div class="text-center text-md-start">
                        <form action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="profile_photo" class="form-control mb-2" accept="image/*">
                            <button type="submit" class="btn btn-sm btn-primary shadow-sm">Change Photo</button>
                        </form>
                    </div>
                </div>
                <h5 class="mb-0 text-primary text-center text-md-start">{{ Auth::user()->name }}</h5>
                <small class="text-muted text-center text-md-start d-block">{{ Auth::user()->role }}</small>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                        <p><strong>Contact Number:</strong> {{ Auth::user()->contact ?? 'Not Provided' }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5 class="text-primary">Permanent Address:</h5>
                        <p>
                            {{ Auth::user()->shippingAddress->first()->address ?? 'Not Provided' }},
                            {{ Auth::user()->shippingAddress->first()->number ?? '' }},
                            {{ Auth::user()->shippingAddress->first()->landmark ?? '' }},
                            {{ Auth::user()->shippingAddress->first()->street_no ?? 'N/A' }},
                            {{ Auth::user()->shippingAddress->first()->postal_code ?? 'N/A' }},
                            {{ Auth::user()->shippingAddress->first()->state ?? '' }}
                        </p>
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-center flex-column flex-md-row gap-3">
                    <a href="{{ route('myorder') }}" class="btn btn-primary shadow-sm">View My Orders</a>
                    <a href="" class="btn btn-warning shadow-sm">Change Password</a>
                </div>
            </div>
        </div>
    </div>
    <style>
        @media (max-width: 768px) {
            .card-body {
                padding: 1.5rem;
            }
            .d-flex.flex-column.flex-md-row {
                flex-direction: column !important;
            }
            .me-md-3 {
                margin-right: 0 !important;
            }
        }
        .btn-warning {
            color: #fff;
        }
    </style>

@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('frontend/assets/js/payment.js') }}"></script>
@endsection
