<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8') }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/styles.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/slick-carousel/slick/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/minimalect/jquery.minimalect.min.css') }}">
    <title>@yield('title', 'Региональный Фонд Капитального Ремонта Многоквартирных Домов Республики Крым')</title>
</head>
<body>
    @yield('content')
    @include('main.parts.footer')
    <script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/slick-carousel/slick/slick.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/animatescroll/animatescroll.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery.nicescroll/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/minimalect/jquery.minimalect.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-mask-plugin/dist/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('assets/libs/svgpolyfill/js/svg-icon-polyfill.js') }}"></script>
    <script src="{{ asset('assets/libs/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/libs/ckeditor/adapters/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>