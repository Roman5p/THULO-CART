<!DOCTYPE html>
<html lang="en">
<head>
    {{-- Include the header section --}}
    @include('Frontend.layouts.header')
</head>
<body>
    {{-- Include the navbar section --}}
    @include('Frontend.layouts.navbar')
    <main>
        {{-- Main content section --}}
        @yield('main-section')
    </main>
    {{-- Include the footer section --}}
    @include('Frontend.layouts.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    {{-- Yield additional scripts --}}
    @yield('scripts')
</body>
</html>
