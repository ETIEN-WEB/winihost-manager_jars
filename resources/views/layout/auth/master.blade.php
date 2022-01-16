<!doctype html>
<html lang="{{ App::getLocale() }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="{{ Str::limit( session('UserSession.app_info.detail.' . App::getLocale() ), 160, '...') }}">

    <meta name="theme-color" content="#ffffff">
    <link rel="shortcut icon" href="{{ session('UserSession.app_info.logo.favicon') }}">
    <link rel="apple-touch-icon" href="{{ session('UserSession.app_info.logo.favicon') }}">

    <link rel="canonical" href="{{ url()->full() }}" />

    <title>{{ session('UserSession.app_info.name') }} :: Manager</title>

    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ session('UserSession.app_info.name') }} :: Manager">
    <meta property="og:site_name" content="{{ session('UserSession.app_info.name') }}">
    <meta property="og:url" content="{{ url()->full() }}">
    <meta property="og:description" content="{{ session('UserSession.app_info.detail.' . App::getLocale()) }}">
    <meta property="og:image" content="{{ session('UserSession.app_info.logo.name') }}">
    <meta property="og:locale" content="{{ App::getLocale() }}_{{ strtoupper(App::getLocale()) }}">

    <link rel="stylesheet" href="{{ cdn_asset('/dist/all/css/bootstrap/bootstrap.min.css') }}" defer>
    <link rel="stylesheet" href="{{ cdn_asset('/dist/all/css/materialdesignicons/materialdesignicons.min.css') }}"
        defer>
    <link rel="stylesheet" href="{{ cdn_asset('/dist/all/css/iox-loader/iox-loader.min.css') }}">

    @if (session('MsgFlash'))
    <link rel="stylesheet" href="{{ cdn_asset('/dist/all/css/toastr/toastr.min.css') }}" type="text/css" />
    @endif

    @yield('css')

    <link rel="stylesheet" href="{{ cdn_asset('/dist/manager/css/auth-style.css') }}">
    <style>
        .modal-content {
            background: #263E8F !important;
        }
    </style>
</head>

<body
    style="background-image: url({{ cdn_asset('/dist/all/img/bg/auth.png') }}); background-repeat: no-repeat; background-size: cover">

    <div id="ioxLoaderRoot"></div>

    @include('layout.auth.header')

    @yield('content')

    <script src="{{ cdn_asset('/dist/all/js/jquery/jquery.min.js') }}"></script>
    <script src="{{ cdn_asset('/dist/all/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ cdn_asset('/dist/all/js/iox-loader/iox-loader.min.js') }}"></script>

    @if (session('MsgFlash'))
    <script src="{{ cdn_asset('/dist/all/js/toastr/toastr.min.js') }}"></script>
    <script src="{{ cdn_asset('/dist/all/js/toastr/toastr.options.js') }}"></script>
    <script type="text/javascript">
        toastr.{{ session('MsgFlash')['type'] }}("{{ isset(session('MsgFlash')['msg']) ? session('MsgFlash')['msg'] : null }}")
    </script>
    @endif

    @yield('js')

    @include('layout.share.google-analytics')

</body>

</html>