<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme" style="transition: all 0.3s ease;">
    <div class="app-brand demo d-flex justify-content-between align-items-center p-3 border-bottom">
        <a href="{{ route('admin.dashboard') }}" class="app-brand-link d-flex align-items-center">
            <span class="app-brand-logo demo">
                <img src="{{ asset('frontend/assets/images/logo(1).png') }}" alt="Logo"
                    style=" object-fit: contain;">
            </span>
            
        </a>

        <button class="btn btn-sm btn-outline-secondary d-xl-none" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-expanded="false" aria-controls="sidebarMenu">
            <i class="bx bx-menu"></i>
        </button>
    </div>

    <div class="menu-inner-shadow"></div>

    <div class="collapse d-xl-block" id="sidebarMenu">
        <ul class="menu-inner py-2 px-1">
            <!-- Dashboard -->
            <li class="menu-item {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="Analytics">Dashboard</div>
                </a>
            </li>

            <!-- Products -->
            <li
                class="menu-item {{ Route::is('admin.product-category.*') || Route::is('admin.products.*') ? 'active' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-layout"></i>
                    <div data-i18n="Products">Products</div>
                </a>
                <ul class="menu-sub"
                    style="{{ Route::is('admin.product-category.*') || Route::is('admin.products.*') ? 'display: block;' : '' }}">
                    <li class="menu-item {{ Route::is('admin.product-category.index') ? 'active' : '' }}">
                        <a href="{{ route('admin.product-category.index') }}" class="menu-link">
                            <div data-i18n="Product Category">Product Category</div>
                        </a>
                    </li>
                    <li class="menu-item {{ Route::is('admin.products.index') ? 'active' : '' }}">
                        <a href="{{ route('admin.products.index') }}" class="menu-link">
                            <div data-i18n="Products">Products</div>
                        </a>
                    </li>
                    <li class="menu-item {{ Route::is('admin.products.create') ? 'active' : '' }}">
                        <a href="{{ route('admin.products.create') }}" class="menu-link">
                            <div data-i18n="Add Products">Add Products</div>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Users -->
            <li class="menu-item {{ Route::is('admin.users.*') ? 'active' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-dock-top"></i>
                    <div data-i18n="Account Settings">Users</div>
                </a>
                <ul class="menu-sub" style="{{ Route::is('admin.users.*') ? 'display: block;' : '' }}">
                    <li class="menu-item {{ Route::is('admin.users.index') ? 'active' : '' }}">
                        <a href="{{ route('admin.users.index') }}" class="menu-link">
                            <div data-i18n="Account">Users List</div>
                        </a>
                    </li>
                    <li class="menu-item {{ Route::is('admin.users.create') ? 'active' : '' }}">
                        <a href="{{ route('admin.users.create') }}" class="menu-link">
                            <div data-i18n="Notifications">Create Users</div>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Carousel -->
            <li class="menu-item {{ Route::is('admin.carousel.index') ? 'active' : '' }}">
                <a href="{{ route('admin.carousel.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-carousel"></i>
                    <div data-i18n="Carousel">Carousel</div>
                </a>
            </li>

            <!-- Orders -->
            <li class="menu-item {{ Route::is('admin.orders.index') ? 'active' : '' }}">
                <a href="{{ route('admin.orders.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="Analytics">Order List</div>
                </a>
            </li>
        </ul>
    </div>
</aside>

<!-- Add this CSS in your stylesheet -->
<style>
    .menu-item.active .menu-link {
        background-color: #007BFF !important; /* Changed to a blue shade */
        color: rgb(152, 207, 24) !important;
        border-radius: 4px;
    }

    .menu-item.active .menu-link .menu-icon {
        color: rgb(152, 207, 24) !important;
    }

    .menu-link {
        transition: all 0.2s ease;
    }

    .menu-link:hover {
        background-color: rgba(0, 123, 255, 0.1); /* Adjusted hover color to match blue theme */
        color: #007BFF !important;
    }

    .menu-sub {
        background-color: rgba(0, 0, 0, 0.02);
    }

    .menu-item.active .menu-sub .menu-item.active .menu-link {
        background-color: #0056b3 !important; /* Slightly darker blue for active sub-menu */
    }

    .menu-sub {
        transition: all 0.3s ease;
    }
</style>
