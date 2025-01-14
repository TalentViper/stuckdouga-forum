<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="title" content="" />    
    <meta name="language" content="en" />
    <title>@yield('title')</title>

    <meta property="og:image" content="{{static_asset('default-image/default-730x400.png') }}" alt="" />
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ static_asset('admin/css/bootstrap.min.css') }}">

    <!-- Icon -->
    <link rel="stylesheet" href="{{ static_asset('admin/boxicons/css/boxicons.css') }}">
    <link rel="stylesheet" href="{{ static_asset('frontend/css/materialdesignicons.min.css') }}">

    <!-- Library -->
    <link rel="stylesheet" href="{{ static_asset('admin/css/selectric.css') }}">
    <link rel="stylesheet" href="{{ static_asset('admin/css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ static_asset('admin/css/select2.min.css') }}">

    @yield('page-style')

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ static_asset('admin/css/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="{{ static_asset('admin/css/components.css') }}">
    <link rel="stylesheet" href="{{ static_asset('admin/css/style.css') }}">
    <link rel="stylesheet" href="{{ static_asset('admin/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ static_asset('admin/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ static_asset('admin/css/yoori.css') }}">
    <link rel="stylesheet" href="{{ static_asset('admin/css/elite-gardeners.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sceditor@3/minified/themes/default.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sceditor@3/minified/sceditor.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sceditor@3/minified/formats/bbcode.min.js"></script>
    <!-- <link rel="stylesheet" href="{{ static_asset('fonts/inter/css.css') }}"> -->
    <link rel="stylesheet" href="{{ static_asset('admin/css/bootstrap-multiselect.css') }}">
    <!-- Custom CSS -->
    <style>
     .scheduler_message_area{
            display: none;
      }
   </style>
    @if (request()->is('admin/pos'))
        <link rel="stylesheet" href="{{static_asset('frontend/css/vue-toastr-2.min.css')}}">
    @endif
    <link rel="stylesheet" href="{{ static_asset('admin/css/custom.css') }}?version=130">

    <script  src="{{ static_asset('admin/js/dhtmlxscheduler.js') }}?v=6.0.5" charset="utf-8"></script>
    <link rel="stylesheet" href="{{ static_asset('admin/css/dhtmlxscheduler_material.css') }}?v=6.0.5">

    <!-- Favicon -->

    <link rel="apple-touch-icon" sizes="57x57"
        href="{{ static_asset('images/ico/favicon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60"
        href="{{ static_asset('images/ico/favicon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72"
        href="{{ static_asset('images/ico/favicon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76"
        href="{{ static_asset('images/ico/favicon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114"
        href="{{ static_asset('images/ico/favicon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120"
        href="{{ static_asset('images/ico/favicon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144"
        href="{{ static_asset('images/ico/favicon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152"
        href="{{ static_asset('images/ico/favicon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180"
        href="{{ static_asset('images/ico/favicon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"
        href="{{ static_asset('images/favicon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ static_asset('images/ico/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96"
        href="{{ static_asset('images/ico/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ static_asset('images/ico/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ static_asset('images/ico/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage"
        content="{{ static_asset('images/ico/favicon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">
    <meta name="get-me" content="{{'admin'}}" />
    <!-- End Favicon -->
    @yield('style')
    @stack('style')
</head>
