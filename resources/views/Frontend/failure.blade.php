@extends('frontend.layouts.main')

@section('title', 'Index')

@section('main-section')
    <div class="d-flex flex-column align-items-center justify-content-center"
        style="min-height: 70vh; background-color: #f8d7da; color: #721c24; padding: 20px; border-radius: 10px;">
        <img src="https://cdn-icons-png.flaticon.com/512/2748/2748558.png" alt="Payment Failed"
            style="width: 120px; height: auto; margin-bottom: 20px;">
        <h1 style="font-size: 2rem; font-weight: bold; margin-bottom: 10px;">Payment Failed</h1>
        <p style="font-size: 1.2rem; text-align: center; margin-bottom: 20px;">We encountered an issue processing your
            payment. Please try again or contact support if the issue persists.</p>
        <a href="{{ route('index') }}" class="btn btn-danger" style="padding: 10px 20px; font-size: 1rem;">Return to Home</a>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection