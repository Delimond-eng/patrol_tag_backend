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
    <title>Patrol Tag By Rapid Tech Solution</title>
    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}" />
    <!-- END: CSS Assets-->
</head>
<!-- BEGIN: JS Assets-->
<body class="login">
    @yield("content")
    <!-- BEGIN: Js assets -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
    @yield("scripts")
    <!-- END: JS Assets-->
</body>

</html>
