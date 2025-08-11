<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{$systemInfo->site_name ?? ''}}</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{asset($systemInfo->fevicon_icon ?? '')}}" />
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('/')}}backend/vendors/iconfonts/font-awesome/css/all.min.css">
    <link rel="stylesheet" href="{{asset('/')}}backend/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="{{asset('/')}}backend/vendors/css/vendor.bundle.addons.css">
    <!-- endinject -->

    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('/')}}backend/css/style.css">
    <link rel="stylesheet" href="{{asset('/')}}backend/css/toastr.min.css"/>


    <!-- toastr JS -->
    <script src="{{asset('/')}}backend/js/toastr.min.js"></script>
    <script src="{{asset('/')}}backend/js/jquery.min.js"></script>

  </head>
