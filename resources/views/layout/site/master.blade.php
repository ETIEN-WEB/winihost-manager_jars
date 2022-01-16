<!doctype html>
<html lang="{{ App::getLocale() }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="{{ session('UserSession.app_info.detail.' . App::getLocale()) }}">

    <link rel="shortcut icon" href="{{ session('UserSession.app_info.logo.favicon') }}">

    <title>{{ session('UserSession.app_info.name') }} :: Manager</title>

    <link rel="stylesheet" href="{{ cdn_asset('/dist/all/css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ cdn_asset('/dist/all/css/materialdesignicons/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ cdn_asset('/dist/all/css/iox-loader/iox-loader.min.css') }}">

    @yield('style')

    <link rel="stylesheet" href="{{ cdn_asset('/dist/manager/css/site-style.min.css') }}">

    @if (session('MsgFlash'))
    <link rel="stylesheet" href="{{ cdn_asset('/dist/all/css/toastr/toastr.min.css') }}" type="text/css" />
    @endif

    <style>
        .w-27px {
            width: 27px !important;
        }

        .w-60 {
            width: 60% !important;
        }

        .w-35 {
            width: 35% !important;
        }

        .h-54 {
            width: 100px !important;
        }

        .badge-float {
            position: absolute;
        }

        .bg-033d8a {
            background: url("{{ cdn_asset('/dist/manager/img/banner-01.png') }}") !important;
        }

        ::-webkit-scrollbar-thumb {
            background: #033D8A;
            border: 0px none #ffffff;
            border-radius: 0px;
        }

        *::-webkit-scrollbar {
            width: 10px;
            background-color: silver;
        }
    </style>

</head>

<body>
    <div id="ioxLoaderRoot"></div>

    @include('layout.site.header')

    <div class="container">
        <div class="bg-white {{ Browser::isMobile() ? 'p-3' : 'p-4' }} content-custom">

            @include('layout.site.component.menu')

            @include('layout.site.component.breadcrumb', ['breadcrumb' => $breadcrumb])

            @yield('content')

        </div>
    </div>

    @include('layout.site.footer')

    <script src="{{ cdn_asset('/dist/all/js/jquery/jquery.min.js') }}"></script>
    <script src="{{ cdn_asset('/dist/all/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ cdn_asset('/dist/all/js/iox-loader/iox-loader.min.js') }}"></script>

    @if (session('MsgFlash'))
    <script src="{{ cdn_asset('/dist/all/js/toastr/toastr.min.js') }}"></script>
    <script src="{{ cdn_asset('/dist/all/js/toastr/toastr.options.js') }}"></script>
    <script type="text/javascript">
        toastr.{{ session('MsgFlash')['type'] }}("{{ isset(session('MsgFlash')['msg']) ? session('MsgFlash')['msg'] : null }}", "{{ isset(session('MsgFlash')['title']) ? session('MsgFlash')['title'] : null }}")
    </script>
    @endif
    <script>
        function AlertDeleteItem(item, text = "{{ __('site.wording.do_you_want_to_delete') }}") {
            Swal.fire({
            title: "{{ __('site.label.deletion') }} !",
            text: text,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "{{ __('site.label.delete') }}",
            cancelButtonText: "{{ __('site.label.cancel') }}"
            }).then((result) => {
                if (result.isConfirmed) {
                    var uuid = item.data('uuid');
                    $('#' + uuid).submit();
                }
            });
        }
    </script>
    @yield('scripts')

    @include('layout.share.google-analytics')
</body>

</html>