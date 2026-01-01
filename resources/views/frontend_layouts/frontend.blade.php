<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Bootstrap Icon CSS -->
    <link href="{{ asset('assets/css/bootstrap-icons.css') }}" rel="stylesheet">
    <!-- Swiper slider CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css') }}">
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/nice-select.css') }}">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/animate.min.css') }}">
    <!-- Fancybox CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.fancybox.min.css') }}">
    <!-- BoxIcon CSS -->
    <link href="{{ asset('assets/css/boxicons.min.css') }}" rel="stylesheet">
    <!-- Main style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <!-- Title & Favicon -->
    <title>RHD Auction</title>
    <link rel="icon" href="{{ asset('assets/img/logo.png') }}" type="image/webp" sizes="20x20">

    <style>
        .company-logo {
            width: 150px;
        }
        .btn-success {
            background-color: #01AA85;
            border-color: #037c64;
        }
    </style>
</head>

<body id="body">

    <!-- scroll top -->
    <div class="circle-container">
        <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
            <g>
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M7.03516 0.416666L7.03516 15H8.28516L8.28516 0.416666H7.03516Z" />
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M8.28516 1.04115C8.28516 3.98115 5.70016 6.38281 2.94349 6.38281H2.31849V5.13281H2.94349C5.03599 5.13281 7.03516 3.26448 7.03516 1.04115V0.416979H8.28516V1.04115Z" />
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M7.03333 1.04115C7.03333 3.98115 9.61833 6.38281 12.375 6.38281H13V5.13281H12.375C10.2817 5.13281 8.28333 3.26448 8.28333 1.04115V0.416979H7.03333V1.04115Z" />
            </g>
        </svg>
    </div>

    @include('frontend_layouts.partials.header')

    @yield('content')

    @include('frontend_layouts.partials.footer')

    <!-- Main jQuery -->
    <script data-cfasync="false" src="{{ asset('assets/js/email-decode.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <!-- Popper and Bootstrap JS -->
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <!-- Swiper slider JS -->
    <script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/slick.min.js') }}"></script>
    <!-- Waypoints JS -->
    <script src="{{ asset('assets/js/waypoints.min.js') }}"></script>
    <!-- Counterup JS -->
    <script src="{{ asset('assets/js/jquery.counterup.min.js') }}"></script>
    <!-- Nice Select JS -->
    <script src="{{ asset('assets/js/jquery.nice-select.min.js') }}"></script>
    <!-- Fancybox JS -->
    <script src="{{ asset('assets/js/jquery.fancybox.min.js') }}"></script>
    <!-- Wow JS -->
    <script src="{{ asset('assets/js/wow.min.js') }}"></script>
    <!-- Marquee JS -->
    <script src="{{ asset('assets/js/jquery.marquee.min.js') }}"></script>
    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Cloudflare beacon JS -->
    <script defer
        src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015"
        integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ=="
        data-cf-beacon='{"version":"2024.11.0","token":"70834e4b23964a2eaf7cf4ec0e5e9a84","r":1}' crossorigin="anonymous"></script>

    @stack('scripts')
</body>

</html>
