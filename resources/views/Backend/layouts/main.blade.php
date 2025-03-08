<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    @include('backend.layouts.header')
    @stack('header')
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @include('backend.layouts.sidebar')
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                @include('backend.layouts.navbar')
                <!-- / Navbar -->

                <!-- Toaster Notification -->
                @if (session('success') || session('error'))
                    <div class="toaster-notification alert {{ session('success') ? 'alert-success' : 'alert-danger' }}"
                        role="alert">
                        {{ session('success') ?? session('error') }}
                    </div>
                @endif

                <!-- Content wrapper -->
                <main>
                    @yield('main-section')
                </main>
                <!-- / Content -->

                <!-- Footer -->
                @include('backend.layouts.footer')
                <!-- / Footer -->

                <div class="content-backdrop fade"></div>
            </div>
            <!-- Content wrapper -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    @include('backend.layouts.footer-script')

    <!-- JavaScript for auto-hide -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toaster = document.querySelector('.toaster-notification');
            if (toaster) {
                setTimeout(() => {
                    toaster.style.transition = 'opacity 0.5s';
                    toaster.style.opacity = '0';
                    setTimeout(() => toaster.remove(), 500); // Remove after fade-out
                }, 3000); // Hide after 3 seconds
            }
        });
    </script>
</body>

</html>
