@extends('frontend.layouts.main')

@section('title', 'Contact Us')

@section('main-section')
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center gx-5">
                <div class="col-md-12">
                    <div class="text-center">
                        <span class="text-muted text-uppercase fs-6">Contact</span>
                        <h2 class="display-5 fw-bold mt-3 text-primary">Get in Touch</h2>
                        <p class="text-secondary mt-3 fs-5">Have questions or need assistance? We're here to help. Reach out to us anytime, and we'll get back to you as soon as possible!</p>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-lg-8 offset-lg-2">
                    <div class="card shadow-lg border-0">
                        <div class="card-body p-5">
                            <h4 class="card-title text-center mb-4 text-primary fw-bold">Contact Us</h4>
                            <form action="" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label for="name" class="form-label fw-semibold">Full Name</label>
                                    <input type="text" class="form-control rounded-pill shadow-sm" id="name" name="name" placeholder="Enter your full name" required>
                                </div>
                                <div class="mb-4">
                                    <label for="email" class="form-label fw-semibold">Email Address</label>
                                    <input type="email" class="form-control rounded-pill shadow-sm" id="email" name="email" placeholder="Enter your email address" required>
                                </div>
                                <div class="mb-4">
                                    <label for="subject" class="form-label fw-semibold">Subject</label>
                                    <input type="text" class="form-control rounded-pill shadow-sm" id="subject" name="subject" placeholder="Enter the subject" required>
                                </div>
                                <div class="mb-4">
                                    <label for="message" class="form-label fw-semibold">Your Message</label>
                                    <textarea class="form-control rounded-3 shadow-sm" id="message" name="message" rows="6" placeholder="Write your message here..." required></textarea>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary px-5 py-2 rounded-pill shadow-sm fw-bold">Send Message</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
