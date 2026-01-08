<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'BreadSMG')</title>

    <!-- Landing default CSS -->
    <link href="/template-assets/landing/css/bootstrap.min.css" rel="stylesheet">
    <link href="/template-assets/landing/css/style.css" rel="stylesheet">

    @stack('head')
</head>

<body>

    @yield('content')

    <!-- Default Scripts -->
    <script src="/template-assets/landing/lib/wow/wow.min.js"></script>
    <script src="/template-assets/landing/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="/template-assets/landing/js/main.js"></script>

    @stack('scripts')
</body>

</html>