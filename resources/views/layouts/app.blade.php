<!doctype html>
<html lang="en" data-bs-theme="">
    
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- favicon -->
    <link rel="icon" href="{{ asset('assets/images/logo-bayar-air.png') }}" type="image/png">
    <!-- loader -->
    <link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/js/pace.min.js') }}"></script>
    <!-- plugins -->
    <link href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/metismenu/metisMenu.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/metismenu/mm-vertical.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet">
    @if (request()->is('/'))
        <link href="{{ asset('assets/plugins/OwlCarousel/css/owl.carousel.min.css') }}">
        <link href="{{ asset('assets/plugins/lightbox/dist/css/glightbox.min.css') }}">
        <link href="{{ asset('assets/css/horizontal-menu.css') }}" rel="stylesheet">
    @endif
        <!-- bootstrap css -->
    <link rel="stylesheet" href="{{ asset('assets/css/extra-icons.css') }}">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap-extended.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons+Outlined" rel="stylesheet">
    <!-- main css -->
    @if (request()->is('/')) <!--dilanding page-->
        <link href="{{ asset('sass/main-landing.css') }}" rel="stylesheet">
        <link href="{{ asset('sass/landing/dark-theme.css') }}" rel="stylesheet">
        <link href="{{ asset('sass/landing/blue-theme.css') }}" rel="stylesheet">
        <link href="{{ asset('sass/landing/semi-dark.css') }}" rel="stylesheet">
        <link href="{{ asset('sass/landing/bordered-theme.css') }}" rel="stylesheet">
        <link href="{{ asset('sass/landing/responsive.css') }}" rel="stylesheet">
    @else <!--else-->
        <link href="{{ asset('sass/main.css') }}" rel="stylesheet">
        <link href="{{ asset('sass/dark-theme.css') }}" rel="stylesheet">
        <link href="{{ asset('sass/blue-theme.css') }}" rel="stylesheet">
        <link href="{{ asset('sass/semi-dark.css') }}" rel="stylesheet">
        <link href="{{ asset('sass/bordered-theme.css') }}" rel="stylesheet">
        <link href="{{ asset('sass/responsive.css') }}" rel="stylesheet">
    @endif
</head>

<body>

     @if (!request()->is('/')) 
        <!-- start header -->
        @include('partials.header')
        <!-- end header -->
        <!-- start sidebar -->
        @include('partials.sidebar')
        <!-- end sidebar -->
    @endif


    <!-- start main content -->
    @if (!request()->is('/'))
        <div class="main-wrapper">
            <div style="padding:1.5rem;">
                @yield('content')
            </div>
        </div>
    @else
        <div class="landing-main-wrapper" data-bs-spy="scroll" data-bs-target="#Parent_Scroll_Div" data-bs-smooth-scroll="false"
        tabindex="0">
            @yield('content')
        </div>
    @endif
    <!-- end main content -->

    <!-- theme switcher -->
    @if (!request()->is('/')) 
        <!-- start overlay -->
        <div class="overlay btn-toggle"></div>
        <!-- end overlay -->

        <!-- start footer -->
        <footer class="page-footer">
            <p class="mb-0">PTI Copyright ©{{ date('Y') }}. All right reserved.</p>
        </footer>
        <!-- end footer -->        
    @endif
    
    @include('components.switcher')
    
    <!-- bootstrap js -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <!-- plugins -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/plugins/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/apexchart/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/peity/jquery.peity.min.js') }}"></script>
    {{-- <script>
        $(".data-attributes span").peity("donut");
        new PerfectScrollbar(".user-list");
    </script> --}}
    @if (request()->is('/'))
        <script src="{{ asset('assets/js/landing-main.js') }}"></script>
    @else
        <script src="{{ asset('assets/js/main.js') }}"></script>
    @endif

    @yield('script')
</body>

</html>
