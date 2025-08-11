<head>

    <!-- META ============================================= -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="" />

    <!-- FAVICONS ICON ============================================= -->
    <link rel="icon" href="../error-404.html" type="image/x-icon" />
    <link rel="shortcut icon" type="image/x-icon" href="{{asset($systemInfo->fevicon_icon ?? '' )}}" />

    <!-- PAGE TITLE HERE ============================================= -->
    <title>{{$systemInfo->site_name ?? 'Site Name Not Set' }}</title>

    <!-- MOBILE SPECIFIC ============================================= -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

<!--[if lt IE 9]>
    <script src="{{asset('/')}}customer/js/html5shiv.min.js"></script>
    <script src="{{asset('/')}}customer/js/respond.min.js"></script>
    <script src="{{asset('/')}}customer/js/respond.min.js"></script>
    <![endif]-->

    <!-- All PLUGINS CSS ============================================= -->
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}customer/css/assets.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}customer/vendors/calendar/fullcalendar.css">

    <!-- TYPOGRAPHY ============================================= -->
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}customer/css/typography.css">

    <!-- SHORTCODES ============================================= -->
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}customer/css/shortcodes/shortcodes.css">

    <!-- STYLESHEETS ============================================= -->
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}customer/css/style.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}customer/css/calendar.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}customer/css/dashboard.css">
    <link class="skin" rel="stylesheet" type="text/css" href="{{asset('/')}}customer/css/color/color-1.css">

    <!-- toastr JS -->
    <link rel="stylesheet" href="{{asset('/')}}backend/css/toastr.min.css"/>
    <script src="{{asset('/')}}customer/js/toastr.min.js"></script>
    <script src="{{asset('/')}}customer/js/jquery.min.js"></script>

</head>
