<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'NetChits') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/fede84c5f3.js" crossorigin="anonymous"></script>
</head>
<body>
    <div id="app">
	@include('layouts.includes.navbar')
	@if (auth()->check())
	    <div class="left-sidebar">
		@include('layouts.includes.sidebar')
	    </div>
	@endif
	<div class="clearfix"></div>
        <main class="py-4">
            @yield('content')
        </main>
	@include('layouts.includes.footer')
    </div>
    @if (request()->route()->getName() == 'settings')
	<script src="{{ asset('js/upload.js') }}"></script>
    @endif
</body>
</html>
