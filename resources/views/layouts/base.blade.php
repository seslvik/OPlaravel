<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ОП и ПГ</title>{{--{{ config('app.name', 'Laravel') }}--}}
    @include('includes.styles_and_js')
</head>
<body>

<header id="topnav">
    @include('includes.menu')
    <div class="clearfix"></div>
</header>
    @yield('content')
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/jquery.app.js') }}"></script>
</body>
</html>
