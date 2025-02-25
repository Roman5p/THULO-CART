<div class="preloader-wrapper">
    <div class="preloader">
    </div>
</div>

<div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasCart">
    <div class="offcanvas-header justify-content-end">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="order-md-last">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-primary">Your cart</span>
                <span class="badge bg-primary rounded-pill">{{ $carts->count() }}</span>
            </h4>
            <ul class="list-group mb-3">
                @foreach ($carts as $cart)
                    <li class="list-group-item d-flex justify-content-between">
                        <div>
                            <h6 class="my-0">{{ $loop->iteration }}. {{ optional($cart->product)->name }}</h6>
                            <small class="text-body-secondary"></small>
                        </div>
                        <span class="text-body-secondary">Rs.{{ $cart->product->actual_amount }}</span>
                        <form action="{{ route('deleteCart', $cart->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-link p-0 m-0">
                                <i class="bi bi-trash remove-btn"></i>
                            </button>
                        </form>
                    </li>
                @endforeach

                <li class="list-group-item d-flex justify-content-between">
                    <span>Total (NPR)</span>
                    <strong>Rs. {{ $carts->sum(function ($cart) {return $cart->product->actual_amount;}) }}</strong>
                </li>
            </ul>
            <a href="{{ route('getcarts') }}" class="w-100 btn btn-primary btn-lg">Continue to checkout</a>
        </div>
    </div>
</div>

<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar">

    <div class="offcanvas-header justify-content-between">
        <h4 class="fw-normal text-uppercase fs-6">Menu</h4>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body">

        <ul class="navbar-nav justify-content-end menu-list list-unstyled d-flex gap-md-3 mb-0">
            <li class="nav-item border-dashed active">
                <a href="index.html" class="nav-link d-flex align-items-center gap-3 text-dark p-2">
                    <svg width="24" height="24" viewBox="0 0 24 24">
                        <use xlink:href="#fruits"></use>
                    </svg>
                    <span>Fruits and vegetables</span>
                </a>
            </li>
            <li class="nav-item border-dashed">
                <a href="index.html" class="nav-link d-flex align-items-center gap-3 text-dark p-2">
                    <svg width="24" height="24" viewBox="0 0 24 24">
                        <use xlink:href="#dairy"></use>
                    </svg>
                    <span>Dairy and Eggs</span>
                </a>
            </li>
            <li class="nav-item border-dashed">
                <a href="index.html" class="nav-link d-flex align-items-center gap-3 text-dark p-2">
                    <svg width="24" height="24" viewBox="0 0 24 24">
                        <use xlink:href="#meat"></use>
                    </svg>
                    <span>Meat and Poultry</span>
                </a>
            </li>
            <li class="nav-item border-dashed">
                <a href="index.html" class="nav-link d-flex align-items-center gap-3 text-dark p-2">
                    <svg width="24" height="24" viewBox="0 0 24 24">
                        <use xlink:href="#seafood"></use>
                    </svg>
                    <span>Seafood</span>
                </a>
            </li>
            <li class="nav-item border-dashed">
                <a href="index.html" class="nav-link d-flex align-items-center gap-3 text-dark p-2">
                    <svg width="24" height="24" viewBox="0 0 24 24">
                        <use xlink:href="#bakery"></use>
                    </svg>
                    <span>Bakery and Bread</span>
                </a>
            </li>
            <li class="nav-item border-dashed">
                <a href="index.html" class="nav-link d-flex align-items-center gap-3 text-dark p-2">
                    <svg width="24" height="24" viewBox="0 0 24 24">
                        <use xlink:href="#canned"></use>
                    </svg>
                    <span>Canned Goods</span>
                </a>
            </li>
            <li class="nav-item border-dashed">
                <a href="index.html" class="nav-link d-flex align-items-center gap-3 text-dark p-2">
                    <svg width="24" height="24" viewBox="0 0 24 24">
                        <use xlink:href="#frozen"></use>
                    </svg>
                    <span>Frozen Foods</span>
                </a>
            </li>
            <li class="nav-item border-dashed">
                <a href="index.html" class="nav-link d-flex align-items-center gap-3 text-dark p-2">
                    <svg width="24" height="24" viewBox="0 0 24 24">
                        <use xlink:href="#pasta"></use>
                    </svg>
                    <span>Pasta and Rice</span>
                </a>
            </li>
            <li class="nav-item border-dashed">
                <a href="index.html" class="nav-link d-flex align-items-center gap-3 text-dark p-2">
                    <svg width="24" height="24" viewBox="0 0 24 24">
                        <use xlink:href="#breakfast"></use>
                    </svg>
                    <span>Breakfast Foods</span>
                </a>
            </li>
            <li class="nav-item border-dashed">
                <a href="index.html" class="nav-link d-flex align-items-center gap-3 text-dark p-2">
                    <svg width="24" height="24" viewBox="0 0 24 24">
                        <use xlink:href="#snacks"></use>
                    </svg>
                    <span>Snacks and Chips</span>
                </a>
            </li>
            <li class="nav-item border-dashed">
                <button
                    class="btn btn-toggle dropdown-toggle position-relative w-100 d-flex justify-content-between align-items-center text-dark p-2"
                    data-bs-toggle="collapse" data-bs-target="#beverages-collapse" aria-expanded="false">
                    <div class="d-flex gap-3">
                        <svg width="24" height="24" viewBox="0 0 24 24">
                            <use xlink:href="#beverages"></use>
                        </svg>
                        <span>Beverages</span>
                    </div>
                </button>
                <div class="collapse" id="beverages-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal ps-5 pb-1">
                        <li class="border-bottom py-2"><a href="index.html" class="dropdown-item">Water</a></li>
                        <li class="border-bottom py-2"><a href="index.html" class="dropdown-item">Juice</a></li>
                        <li class="border-bottom py-2"><a href="index.html" class="dropdown-item">Soda</a></li>
                        <li class="border-bottom py-2"><a href="index.html" class="dropdown-item">Tea</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item border-dashed">
                <a href="index.html" class="nav-link d-flex align-items-center gap-3 text-dark p-2">
                    <svg width="24" height="24" viewBox="0 0 24 24">
                        <use xlink:href="#spices"></use>
                    </svg>
                    <span>Spices and Seasonings</span>
                </a>
            </li>
            <li class="nav-item border-dashed">
                <a href="index.html" class="nav-link d-flex align-items-center gap-3 text-dark p-2">
                    <svg width="24" height="24" viewBox="0 0 24 24">
                        <use xlink:href="#baby"></use>
                    </svg>
                    <span>Baby Food and Formula</span>
                </a>
            </li>
            <li class="nav-item border-dashed">
                <a href="index.html" class="nav-link d-flex align-items-center gap-3 text-dark p-2">
                    <svg width="24" height="24" viewBox="0 0 24 24">
                        <use xlink:href="#health"></use>
                    </svg>
                    <span>Health and Wellness</span>
                </a>
            </li>
            <li class="nav-item border-dashed">
                <a href="index.html" class="nav-link d-flex align-items-center gap-3 text-dark p-2">
                    <svg width="24" height="24" viewBox="0 0 24 24">
                        <use xlink:href="#household"></use>
                    </svg>
                    <span>Household Supplies</span>
                </a>
            </li>
            <li class="nav-item border-dashed">
                <a href="index.html" class="nav-link d-flex align-items-center gap-3 text-dark p-2">
                    <svg width="24" height="24" viewBox="0 0 24 24">
                        <use xlink:href="#personal"></use>
                    </svg>
                    <span>Personal Care</span>
                </a>
            </li>
            <li class="nav-item border-dashed">
                <a href="index.html" class="nav-link d-flex align-items-center gap-3 text-dark p-2">
                    <svg width="24" height="24" viewBox="0 0 24 24">
                        <use xlink:href="#pet"></use>
                    </svg>
                    <span>Pet Food and Supplies</span>
                </a>
            </li>
        </ul>

    </div>

</div>

<header>
    <div class="container-fluid">
        <div class="row py-3 border-bottom">

            <div
                class="col-sm-4 col-lg-2 text-center text-sm-start d-flex gap-3 justify-content-center justify-content-md-start">
                <div class="d-flex align-items-center my-3 my-sm-0">
                    <a href="{{ route('index') }}" class="navbar-brand">
                        <img src="{{ asset('frontend/assets/images/logo.png') }}" alt="logo" class="img-fluid">
                    </a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                    <svg width="24" height="24" viewBox="0 0 24 24">
                        <use xlink:href="#menu"></use>
                    </svg>
                </button>
            </div>

            <div class="col-sm-6 offset-sm-2 offset-md-0 col-lg-4">
                <div class="search-bar row bg-light p-2 rounded-4">
                    <div class="col-md-4 d-none d-md-block">
                        <select name="category" class="form-select border-0 bg-transparent">
                            <option>All Categories</option>
                            <option>Groceries</option>
                            <option>Drinks</option>
                            <option>Chocolates</option>
                        </select>
                    </div>
                    <div class="col-11 col-md-7">
                        <form id="search-form" class="text-center" action="index.html" method="post">
                            <input type="text" class="form-control border-0 bg-transparent"
                                placeholder="Search for more than 20,000 products">
                        </form>
                    </div>
                    <div class="col-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M21.71 20.29L18 16.61A9 9 0 1 0 16.61 18l3.68 3.68a1 1 0 0 0 1.42 0a1 1 0 0 0 0-1.39ZM11 18a7 7 0 1 1 7-7a7 7 0 0 1-7 7Z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <ul
                    class="navbar-nav list-unstyled d-flex flex-row gap-3 gap-lg-5 justify-content-center flex-wrap align-items-center mb-0 fw-bold text-uppercase text-dark">
                    <li class="nav-item active">
                        <a href="{{ route('index') }}" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle pe-3" role="button" id="pages"
                            data-bs-toggle="dropdown" aria-expanded="false">Pages</a>
                        <ul class="dropdown-menu border-0 p-3 rounded-0 shadow" aria-labelledby="pages">
                            <li><a href="index.html" class="dropdown-item">About Us </a></li>
                            <li><a href="index.html" class="dropdown-item">Shop </a></li>
                            <li><a href="index.html" class="dropdown-item">Single Product </a></li>
                            <li><a href="index.html" class="dropdown-item">Cart </a></li>
                            <li><a href="index.html" class="dropdown-item">Checkout </a></li>
                            <li><a href="index.html" class="dropdown-item">Blog </a></li>
                            <li><a href="index.html" class="dropdown-item">Single Post </a></li>
                            <li><a href="index.html" class="dropdown-item">Styles </a></li>
                            <li><a href="index.html" class="dropdown-item">Contact </a></li>
                            <li><a href="index.html" class="dropdown-item">Thank You </a></li>
                            <li><a href="index.html" class="dropdown-item">My Account </a></li>
                            <li><a href="index.html" class="dropdown-item">404 Error </a></li>
                        </ul>
                    </li>
                </ul>
            </div>

            <div
                class="col-sm-8 col-lg-2 d-flex gap-5 align-items-center justify-content-center justify-content-sm-end">
                <ul class="d-flex justify-content-end list-unstyled m-0">
                    {{-- <li>
                        <a href="#" class="p-2 mx-1">
                            <svg width="24" height="24">
                                <use xlink:href="#user"></use>
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="p-2 mx-1">
                            <svg width="24" height="24">
                                <use xlink:href="#wishlist"></use>
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="p-2 mx-1" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasCart" aria-controls="offcanvasCart">
                            <svg width="24" height="24">
                                <use xlink:href="#shopping-bag"></use>
                            </svg>
                        </a>
                    </li> --}}
                    @guest
                        <li>
                            <a href="{{ route('login') }}"
                                class="p-2 mx-1 text-decoration-none d-flex align-items-center gap-2">
                                <svg width="24" height="24">
                                    <use xlink:href="#user"></use>
                                </svg>
                                <span>Login</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('register') }}"
                                class="p-2 mx-1 text-decoration-none d-flex align-items-center gap-2">
                                <svg width="24" height="24">
                                    <use xlink:href="#user"></use>
                                </svg>
                                <span>Register</span>
                            </a>
                        </li>
                    @else
                        <li class="d-flex align-items-center gap-1">
                            <div class="dropdown">
                                <a href="#" class="p-2 mx-1 text-decoration-none d-flex align-items-center gap-1"
                                    id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ asset('storage/' . auth()->user()->profile) }}" alt="Profile Picture"
                                        class="rounded-circle" width="50" height="45">
                                    <span>{{ Auth::user()->name }}</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow-lg">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-3">
                                                    <img src="{{ asset('storage/' . auth()->user()->profile) }}"
                                                        alt="Profile Picture" class="rounded-circle" width="50"
                                                        height="47">
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span class="fw-semibold d-block">{{ auth()->user()->name }}</span>
                                                    {{-- <small class="text-muted">Admin</small> --}}
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="bi bi-person me-2"></i>
                                            <span class="align-middle">My Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="bi bi-gear me-2"></i>
                                            <span class="align-middle">Settings</span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <form action="{{ route('logout') }}" class="d-inline-block" method='post'>
                                            @csrf
                                            <button type="submit" class="dropdown-item text-danger">
                                                <i class="bi bi-power me-2"></i>Logout
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                            <a href="" class="p-2 mx-1 text-decoration-none d-flex align-items-center gap-1"
                                data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart" aria-controls="offcanvasCart">
                                <svg width="24" height="24">
                                    <use xlink:href="#shopping-bag"></use>
                                </svg>
                                <span>Cart</span>
                                <span class="badge bg-primary rounded-pill">{{ $carts->count() }}</span>
                            </a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </div>
</header>
