@extends('frontend.layouts.main')

@section('title', 'Index')

@section('main-section')
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-center gx-5">
                <div class="col-lg-6">
                    <div class="text-center text-lg-start">
                        <span class="text-primary fw-semibold">Our Story</span>
                        <h2 class="display-4 fw-bold mt-2">About Us</h2>
                        <p class="text-muted mt-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud.</p>
                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                            incididunt ut labore et dolore magna aliqua. Ut enim ad minim.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="text-center">
                        <img class="img-fluid rounded-3 shadow-lg"
                            src="https://freefrontend.dev/assets/square.png" alt="About Us Image">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
