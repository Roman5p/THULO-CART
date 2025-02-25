<!DOCTYPE html>
<html lang="en">
<head>
    @include('frontend.layouts.header')
</head>
<body>
    @include('frontend.layouts.navbar')
    <main>
        @yield('main-section')
    </main>
    @include('frontend.layouts.footer')
</body>
</html>


