<!DOCTYPE html>

<html lang="en" class="light">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <meta charset="utf-8">
    <link href="assets/images/patrol.svg" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Icewall admin for weeding app">
    <meta name="keywords" content="Rapid Tech Property">
    <meta name="author" content="Gaston Delimond Dev">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Patrol Tag By Rapid Tech Solution</title>
    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/js/libs/sweetalert2/sweetalert2.min.css') }}" />
    <!-- END: CSS Assets-->
</head>
<!-- BEGIN: JS Assets-->
<body class="main">
    <!-- BEGIN: Mobile Menu -->
    @include("components.mobile_menu")
    <!-- END: Mobile Menu -->
    <!-- BEGIN: Top Bar -->
    @include("components.top_bar_fixed")
    <!-- END: Top Bar -->

    {{-- <!-- BEGIN: Top Menu -->
    @include("components.top_nav")
    <!-- END: Top Menu -->  --}}


    <div class="wrapper">
        <div class="wrapper-box {{--  wrapper--top-nav  --}}">
            <!-- BEGIN: Side Menu -->
            @include("components.side_nav")
            <!-- END: Side Menu -->
            <!-- BEGIN: Content -->
            @yield("content")
            <!-- END: Content -->
        </div>
    </div>


    <!-- BEGIN: Js assets -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/libs/toastify.min.js') }}"></script>
    <script src="{{ asset('assets/js/libs/pristine.min.js') }}"></script>
    <script src="{{ asset('assets/js/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/js/libs/vue2.js') }}"></script>
    {{-- For pusher notification  --}}
    <script src="{{ asset('assets/js/libs/pusher.min.js') }}"></script>
    <script type="module" src="{{ asset('assets/js/modules/pusher.init.js') }}"></script>
    @yield("scripts")
    <!-- END: JS Assets-->
</body>

</html>
