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
    <script>
        $(".delete").click(function(e){
            e.preventDefault();
            const form = $(this).parents("form");
            Swal.fire({
            title: "Are you sure?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
            }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
            });
        })
    </script>
</body>
</html>
