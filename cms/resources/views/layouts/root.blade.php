<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ ''/* $pageTitle */ }} | {{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @stack('head-scripts')

    <!-- Styles -->
    @stack('head-styles')
</head>
<body>
    @yield('body-content')
    
    <!-- Scripts -->
    @yield('body-scripts')
</body>
</html>
