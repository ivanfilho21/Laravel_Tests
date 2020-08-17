<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no, user-scalable=1">
    <title>@yield('page-title')</title>
    @stack('head-styles')
    @stack('head-scripts')
</head>
<body>
    @yield('body')
    @stack('body-scripts')
</body>
</html>