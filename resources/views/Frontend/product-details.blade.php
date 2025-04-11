@extends('frontend.layouts.main')

@section('title', 'Product Details')

@section('main-section')
    <div class="container mt-5">
        <div class="row">
            <!-- Product Images -->
            <div class="col-md-6 mb-4">
                <div class="d-flex justify-content-between">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="Thumbnail 1"
                        class="thumbnail rounded active img-fluid" style="max-width: 100%; height: auto; object-fit: cover;"
                        onclick="changeImage(event, this.src)">
                </div>
            </div>

            <!-- Product Details -->
            <div class="col-md-6">
                <h2 class="mb-3">{{ $product->name }}</h2>
                <p class="text-muted mb-4">SKU: </p>
                <p class="text-muted mb-4">Category: {{ $product->category->name }}</p>
                <div class="mb-3">
                    <span class="h4 me-2">Rs.{{ $product->actual_amount }}</span>
                    <span class="text-muted"><s>Rs.{{ $product->price }}</s></span>
                    <span class="text-success ms-2">Save Rs.{{ $product->actual_amount - $product->price }}</span>

                </div>
                <div class="mb-3">
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-half text-warning"></i>
                    <span class="ms-2">4.5 (120 reviews)</span>
                </div>
                {{-- <div class="mb-4">
                    <h5>Color:</h5>
                    <div class="btn-group" role="group" aria-label="Color selection">
                        <input type="radio" class="btn-check" name="color" id="black" autocomplete="off" checked>
                        <label class="btn btn-outline-dark" for="black">Black</label>
                        <input type="radio" class="btn-check" name="color" id="silver" autocomplete="off">
                        <label class="btn btn-outline-secondary" for="silver">Silver</label>
                        <input type="radio" class="btn-check" name="color" id="blue" autocomplete="off">
                        <label class="btn btn-outline-primary" for="blue">Blue</label>
                    </div>
                </div> --}}
                <div class="mb-4">
                    <label for="quantity" class="form-label">Quantity: {{ $product->quantity }}</label>
                    <input type="number" class="form-control" id="quantity" value="1" min="1"
                        style="width: 80px;">
                </div>
                <form action="{{ route('addtoCart', $product->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-lg mb-3 me-2">
                        <i class="bi bi-cart-plus"></i> Add to Cart
                    </button>
                </form>
                <button class="btn btn-outline-secondary btn-lg mb-3">
                    <i class="bi bi-heart"></i> Add to Wishlist
                </button>
                <div class="mt-4">
                    <h5>Key Features: </h5>
                    <p>{!! nl2br(e($product->description ?? '')) !!}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
