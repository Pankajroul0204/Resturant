<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@5.8.55/css/materialdesignicons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />


    <!-- Scripts -->
    @routes
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead
</head>

<body class="font-sans antialiased">
    @inertia
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/vendor/php-email-form/validate.js"></script>
    <script src="/vendor/aos/aos.js"></script>
    {{-- <script src="/vendor/swiper/swiper-bundle.min.js"></script> --}}
    <script src="/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>



</body>

</html>
