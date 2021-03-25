<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>{{ isset($title) ? $title . ' - ' : '' }}LSP APP</title>
    
    <!-- ICON -->
    <link rel="apple-touch-icon" href="{{ assets('images/logo/logo.jpeg') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ assets('images/logo/logo.jpeg') }}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700" rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">

    <!-- CSS-->
    <link rel="stylesheet" type="text/css" href="{{ assets('css/vendors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ assets('vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ assets('vendors/css/forms/icheck/custom.css') }}">
    <link rel="stylesheet" type="text/css" href=".{{ assets('css/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ assets('css/app.css') }}">
    @stack('css')
</head>
@hasSection ('body') @yield('body') @else <body> @endif

    <!-- content -->
    @yield('content')
    
    <!-- JS-->
    <script type="text/javascript" src="{{ assets('vendors/js/vendors.min.js') }}"></script>
    <script type="text/javascript" src="{{ assets('js/core/app-menu.js') }}"></script>
    <script type="text/javascript" src="{{ assets('js/core/app.js') }}"></script>
    @stack('js')
</body>
</html>