<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Dashboard {{ isset($title) ? '\\ ' . $title : '' }} - LSP APP</title>
    
    <!-- ICON -->
    <link rel="apple-touch-icon" href="{{ assets('images/logo/logo.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ assets('images/logo/logo.png') }}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700" rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">

    <!-- CSS-->
    <link rel="stylesheet" type="text/css" href="{{ assets('css/vendors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ assets('vendors/css/extensions/toastr.css') }}">
    @stack('css-library')
    <link rel="stylesheet" type="text/css" href="{{ assets('css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ assets('css/core/menu/menu-types/vertical-menu-modern.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ assets('css/core/colors/palette-gradient.css') }}">
    <style>
    .dataTable {  width: 100%!important;  border-collapse: collapse;  }
    .dataTables_wrapper { padding: 0!important; }
    .card-table { padding: 0; }
    .dataTables_wrapper .row:nth-child(1) { padding: 0 2rem; padding-top: 1.8rem; }
    .dataTables_wrapper .row:nth-child(2) { padding: 0 .05rem; }
    .dataTables_wrapper .row:nth-child(3) { padding: 0 2rem; padding-bottom: 1.8rem; }
    .custom-control-label::after { cursor: pointer; }
    </style>
    @stack('css')
</head>
@hasSection ('body')
    @yield('body')
@else
<body class="vertical-layout vertical-menu-modern 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
@endif

    <div id="app">
        <!-- navbar -->
        @hasSection ('navbar')
            @yield('navbar')
        @else
            <x-dashboard-navbar />
        @endif

        <!-- sidebar -->
        @hasSection ('sidebar')
            @yield('sidebar')
        @else
            <x-dashboard-sidebar />
        @endif

        <!-- wrapper -->
        <div class="app-content content">
            <div class="content-wrapper">
                @yield('content')
            </div>
        </div>

        <!-- footer -->
        <x-dashboard-footer />
    </div>
    
    <!-- JS-->
    <script type="text/javascript" src="{{ assets('vendors/js/vendors.min.js') }}"></script>
    <script type="text/javascript" src="{{ assets('vendors/js/extensions/toastr.min.js') }}"></script>
    @stack('js-library')
    <script type="text/javascript" src="{{ assets('js/core/app-menu.js') }}"></script>
    <script type="text/javascript" src="{{ assets('js/core/app.js') }}"></script>
    <script>
        $(function() {

            $('a.nav-link.nav-link-expand').on('click', () => {
                var btn = $('a.nav-link.nav-link-expand');
                if ( btn.hasClass('expanded') )
                {
                    btn.removeClass('expanded')
                    closeFullscreen()
                } else {
                    btn.addClass('expanded')
                    openFullscreen()
                }
            });

            /* View in fullscreen */
            function openFullscreen() {
                var elem = document.documentElement;
                if (elem.requestFullscreen) {
                    elem.requestFullscreen();
                } else if (elem.mozRequestFullScreen) { /* Firefox */
                    elem.mozRequestFullScreen();
                } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari and Opera */
                    elem.webkitRequestFullscreen();
                } else if (elem.msRequestFullscreen) { /* IE/Edge */
                    elem.msRequestFullscreen();
                }
            }

            /* Close fullscreen */
            function closeFullscreen() {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                } else if (document.mozCancelFullScreen) { /* Firefox */
                    document.mozCancelFullScreen();
                } else if (document.webkitExitFullscreen) { /* Chrome, Safari and Opera */
                    document.webkitExitFullscreen();
                } else if (document.msExitFullscreen) { /* IE/Edge */
                    document.msExitFullscreen();
                }
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    {{-- <script src="{{ assets('vendors/js/vue/vue.min.js') }}"></script> --}}
    @stack('js')
    <x-server-alert />
</body>
</html>