@extends('frontend.layouts.main')

@section('title', 'Index')

@section('main-section')
    <div class="container-fluid" id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner mt-2">
            @if ($carousels->empty())
                <div class="carousel-item active">
                    <img src="{{ asset('Frontend/assets/img/phone.jpg') }}" class="d-block w-100" alt="..."
                        style="height: 500px; object-fit: cover;">
                </div>
            @else
                @foreach ($carousels as $carousel)
                    <div class="carousel-item active">
                        <img src="{{ asset('storage/' . $carousel->image) }}" class="d-block w-100" alt="..."
                            style="height: 500px; object-fit: cover;">
                    </div>
                @endforeach
            @endif

        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="container my-4">
        <h2 class="text-center">Coming Soon</h2>
    </div>

    <div class="container">
        <div class="row d-flex justify-content-between">
            <div class="card" style="width: 18rem;">
                <img src="{{ asset('Frontend/assets/img/products/10.jpg') }}" class="card-img-top" alt="...">
                <div class="card-body text-center">
                    <p class="card-text"><strong>Nike Air Max</strong></p>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="{{ asset('Frontend/assets/img/products/13.jpg') }}" class="card-img-top" alt="...">
                <div class="card-body text-center">
                    <p class="card-text"><strong>Adidas Ultraboost</strong></p>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="{{ asset('Frontend/assets/img/products/6.jpg') }}" class="card-img-top" alt="...">
                <div class="card-body text-center">
                    <p class="card-text"><strong>Puma RS-X</strong></p>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="{{ asset('Frontend/assets/img/products/12.jpg') }}" class="card-img-top" alt="...">
                <div class="card-body text-center">
                    <p class="card-text"><strong>Reebok Classic</strong></p>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="container">
        <h2 class="text-center">Products</h2>
        <div class="row gy-4">
            <div class="col-lg-3 col-md-4">
                <div class="card">
                    <img src="{{ asset('frontend/assets/img/products/1.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body text-center">
                        <p class="card-text"><strong>Nike Air Max</strong></p>
                        <div class="row justify-content-between">
                            <div class="col-5">
                                <a name="" id="" class="btn btn-sm btn-primary" href="#"
                                    role="button">View More</a>
                            </div>
                            <div class="col-5">
                                <a name="" id="" class="btn btn-sm btn-success" href="#"
                                    role="button">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4">
                <div class="card">
                    <img src="{{ asset('frontend/assets/img/products/13.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body text-center">
                        <p class="card-text"><strong>Adidas Ultraboost</strong></p>
                        <div class="row justify-content-between">
                            <div class="col-5">
                                <a name="" id="" class="btn btn-sm btn-primary" href="#"
                                    role="button">View More</a>
                            </div>
                            <div class="col-5">
                                <a name="" id="" class="btn btn-sm btn-success" href="#"
                                    role="button">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4">
                <div class="card">
                    <img src="{{ asset('frontend/assets/img/products/12.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body text-center">
                        <p class="card-text"><strong>Reebok Classic</strong></p>
                        <div class="row justify-content-between">
                            <div class="col-5">
                                <a name="" id="" class="btn btn-sm btn-primary" href="#"
                                    role="button">View More</a>
                            </div>
                            <div class="col-5">
                                <a name="" id="" class="btn btn-sm btn-success" href="#"
                                    role="button">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4">
                <div class="card">
                    <img src="{{ asset('frontend/assets/img/products/4.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body text-center">
                        <p class="card-text"><strong>Puma RS-X</strong></p>
                        <div class="row justify-content-between">
                            <div class="col-5">
                                <a name="" id="" class="btn btn-sm btn-primary" href="#"
                                    role="button">View More</a>
                            </div>
                            <div class="col-5">
                                <a name="" id="" class="btn btn-sm btn-success" href="#"
                                    role="button">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4">
                <div class="card">
                    <img src="{{ asset('frontend/assets/img/products/13.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body text-center">
                        <p class="card-text"><strong>Adidas Ultraboost</strong></p>
                        <div class="row justify-content-between">
                            <div class="col-5">
                                <a name="" id="" class="btn btn-sm btn-primary" href="#"
                                    role="button">View More</a>
                            </div>
                            <div class="col-5">
                                <a name="" id="" class="btn btn-sm btn-success" href="#"
                                    role="button">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4">
                <div class="card">
                    <img src="{{ asset('frontend/assets/img/products/6.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body text-center">
                        <p class="card-text"><strong>Nike Air Max</strong></p>
                        <div class="row justify-content-between">
                            <div class="col-5">
                                <a name="" id="" class="btn btn-sm btn-primary" href="#"
                                    role="button">View More</a>
                            </div>
                            <div class="col-5">
                                <a name="" id="" class="btn btn-sm btn-success" href="#"
                                    role="button">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4">
                <div class="card">
                    <img src="{{ asset('frontend/assets/img/products/7.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body text-center">
                        <p class="card-text"><strong>Reebok Classic</strong></p>
                        <div class="row justify-content-between">
                            <div class="col-5">
                                <a name="" id="" class="btn btn-sm btn-primary" href="#"
                                    role="button">View More</a>
                            </div>
                            <div class="col-5">
                                <a name="" id="" class="btn btn-sm btn-success" href="#"
                                    role="button">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset('frontend/assets/img/products/8.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body text-center">
                        <p class="card-text"><strong>Puma RS-X</strong></p>
                        <div class="row justify-content-between">
                            <div class="col-5">
                                <a name="" id="" class="btn btn-sm btn-primary" href="#"
                                    role="button">View More</a>
                            </div>
                            <div class="col-5">
                                <a name="" id="" class="btn btn-sm btn-success" href="#"
                                    role="button">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
