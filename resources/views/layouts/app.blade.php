@php
    use App\Models\SiteSetting;
    $settings = SiteSetting::first();
@endphp

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <title>@yield('title', $settings->title ?? 'قالب رامَن')</title>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <meta name="publisher" content="{{ $settings->publisher ?? 'قالب رامَن' }}" />
    <meta name="title" content="{{ $settings->meta_title ?? 'قالب رامَن' }}" />
    <meta name="description" content="{{ $settings->meta_description ?? 'قالب رامَن' }}" />

    <meta http-equiv="content-language" content="fa" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />

    <link rel="icon" type="image/x-icon" href="{{ asset($settings->favicon ?? 'assets/favicon.ico') }}" />

    {{-- 📦 Font & Icons --}}
    <link rel="stylesheet" href="{{ asset('assets/fonts/@mdi/css/materialdesignicons.min.css') }}" />

    {{-- 📦 Bootstrap --}}
    <link id="bootstraplink" rel="stylesheet" href="{{ asset('assets/css/bootstrap-5.2.0/css/bootstrap.rtl.min.css') }}" />

    {{-- 📦 jQuery --}}
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>

    {{-- 📦 Slick Carousel --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    {{-- 📦 AOS Animation --}}
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>

    {{-- 📦 CountUp & Waypoints --}}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/countup.js/2.3.2/countUp.umd.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/noframework.waypoints.min.js"></script>

    {{-- 📦 Styles --}}
    <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/index.min.css') }}" />

    @yield('styles')
</head>

<body class="theme-middle-blue">

    {{-- ✅ Preloader --}}
    @include('layouts._partials.preloader')

    {{-- ✅ Navbar --}}
    @include('layouts._partials.navbar')

    {{-- ✅ Page Content --}}
    @yield('content')

    {{-- ✅ Footer --}}
    @include('layouts._partials.footer')

    {{-- 📦 Scripts --}}
    <script type="text/javascript" src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/css/bootstrap-5.2.0/js/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/main.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/index.js') }}"></script>

    @yield('scripts')
</body>
</html>
