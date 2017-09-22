<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8') }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=2.0, minimum-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/styles.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/slick-carousel/slick/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/minimalect/jquery.minimalect.min.css') }}">
    <title>RFKR</title>
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