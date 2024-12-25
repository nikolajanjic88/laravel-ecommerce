<!DOCTYPE html>
<html lang="en">
@include('home.layout.head')
<body>
    <div class="hero_area">
        @include('home.layout.header')
    </div>

    @yield('content')

    @include('home.layout.footer')

    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
</body>
</html>
