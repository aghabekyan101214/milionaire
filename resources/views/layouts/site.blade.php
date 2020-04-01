<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Stdev</title>
    <link rel="icon" href="{{ URL::asset('assets/images/favicon.ico') }}" type="image/x-icon"/>
    <link rel="stylesheet" href="{{ asset("assets/site/bootstrap/css/bootstrap.min.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/site/style/stylev3.css") }}">
    @stack('head')
</head>

<body>
<div class="page-wrapper">
    <div class="col-lg-12 mt-4 text-right">
        <form action="/player/logout" method="post" class="mb-3">
            @csrf
            <button class="btn btn-danger">Logout</button>
        </form>
        <a href="/player" class="mt-3">
            <button class="btn btn-primary">Dashboard</button>
        </a>
    </div>
    @yield("content")
</div>
</body>
<script src="{{ asset("assets/site/jquery/jquery.min.js") }}"></script>
<script src="{{ asset("assets/site/bootstrap/js/bootstrap.min.js") }}"></script>
@stack("footer")
</html>
