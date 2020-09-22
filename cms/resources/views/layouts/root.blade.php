<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title'){{ isset($siteLayout['title']) ? " | {$siteLayout['title']}" : '' }}</title>

    <!-- Scripts -->
    @stack('head_scripts')

    <!-- Styles -->
    @stack('head_styles')
</head>
<body>
    @yield('body_content')
    
    <!-- Scripts -->
    @yield('body_scripts')
</body>
</html>
