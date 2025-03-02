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
</body>
</html>
