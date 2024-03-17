<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('/assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/font-awesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
</head>
<body>
@stack('navbar')

@include('partial.message')

@yield('body-content')

<script src="{{asset('/assets/jquery/jquery-3.7.1.min.js')}}"></script>
<script src="{{asset('/assets/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('/assets/sweetalert2/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('/assets/js/custom.js')}}"></script>

</body>
</html>
