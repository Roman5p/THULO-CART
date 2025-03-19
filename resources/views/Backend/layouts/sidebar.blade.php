<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('admin.dashboard') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('frontend\assets\images\logo(1).png') }}" alt="Logo" style="width: auto; height: auto; object-fit: fill;">
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2"></span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item active">
            <a href="{{ route('admin.dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <!-- Layouts -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Products">Products</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('admin.product-category.index') }}" class="menu-link">
                        <div data-i18n="Product Category">Product Category</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.products.index') }}" class="menu-link">
                        <div data-i18n="Products">Products</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.products.create') }}" class="menu-link">
                        <div data-i18n="Add Products">Add Products</div>
                    </a>

            </ul>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings">Users</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('admin.users.index') }}" class="menu-link">
                        <div data-i18n="Account">Users List</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.users.create') }}" class="menu-link">
                        <div data-i18n="Notifications">Create Users</div>
                    </a>
                </li>
            </ul>
        <li class="menu-item">
            <a href="{{route('admin.carousel.index')}}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-carousel"></i>
            <div data-i18n="Carousel">Carousel</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="#" class="menu-link">
            <i class="menu-icon tf-icons bx bx-carousel"></i>
            <div data-i18n="Carousel">Order List</div>
            </a>
        </li>
        
    </ul>
</aside>
