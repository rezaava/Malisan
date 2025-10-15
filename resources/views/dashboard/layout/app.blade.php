<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{asset('/cuba-style/assets/images/favicon.png')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('/cuba-style/assets/images/favicon.png')}}" type="image/x-icon">
    <title>@yield('title')</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
    <!-- Font Awesome-->
{{--    <link rel="stylesheet" type="text/css" href="{{asset('/cuba-style/assets/css/fontawesome.css')}}">--}}
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{asset('/cuba-style/assets/css/icofont.css')}}">
    <!-- Themify icon-->
{{--    <link rel="stylesheet" type="text/css" href="{{asset('/cuba-style/assets/css/themify.css')}}">--}}
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('/cuba-style/assets/css/flag-icon.css')}}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{'/cuba-style/assets/css/feather-icon.css'}}">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{asset('/cuba-style/assets/css/prism.css')}}">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{asset('/cuba-style/assets/css/bootstrap.css')}}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{asset('/cuba-style/assets/css/style.css')}}">
    <link id="color" rel="stylesheet" href="{{asset('/cuba-style/assets/css/color-1.css')}}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{asset('/cuba-style/assets/css/responsive.css')}}">

    @stack('css')
</head>
<body main-theme-layout="rtl">
<!-- Loader starts-->
<div class="loader-wrapper">
    <div class="loader-index"><span></span></div>
    <svg>
        <defs></defs>
        <filter id="goo">
            <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
            <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo">    </fecolormatrix>
        </filter>
    </svg>
</div>
<!-- Loader ends-->
<!-- page-wrapper Start-->
<div class="page-wrapper compact-wrapper" id="pageWrapper">
    <!-- Page Header Start-->
    @include('dashboard.layout.header')
    <!-- Page Header Ends                              -->
    <!-- Page Body Start-->
    <div class="page-body-wrapper sidebar-icon">
        <!-- Page Sidebar Start-->
            @include('dashboard.layout.sidebar')
        <!-- Page Sidebar Ends-->
        <div class="page-body">
                @yield('content')
            <!-- Container-fluid starts-->

            <!-- Container-fluid Ends-->
        </div>
        <!-- footer start-->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 footer-copyright">
                        <p class="mb-0">Copyright 2018 © MANA-GROUP All rights reserved.</p>
                    </div>
                    <div class="col-md-6">
                        <p class="pull-right mb-0">Hand crafted & made with <i class="fa fa-heart font-secondary"></i></p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
<!-- latest jquery-->
<script src="{{asset('/cuba-style/assets/js/jquery-3.5.1.min.js')}}"></script>
<!-- Bootstrap js-->
<script src="{{asset('/cuba-style/assets/js/bootstrap/popper.min.js')}}"></script>
<script src="{{asset('/cuba-style/assets/js/bootstrap/bootstrap.js')}}"></script>
<!-- feather icon js-->
<script src="{{asset('/cuba-style/assets/js/icons/feather-icon/feather.min.js')}}"></script>
<script src="{{asset('/cuba-style/assets/js/icons/feather-icon/feather-icon.js')}}"></script>
<!-- Sidebar jquery-->
<script src="{{asset('/cuba-style/assets/js/sidebar-menu.js')}}"></script>
<script src="{{asset('/cuba-style/assets/js/config.js')}}"></script>
<!-- Plugins JS start-->
{{--<script src="{{asset('/cuba-style/assets/js/prism/prism.min.js')}}"></script>--}}
{{--<script src="{{asset('/cuba-style/assets/js/clipboard/clipboard.min.js')}}"></script>--}}
{{--<script src="{{asset('/cuba-style/assets/js/custom-card/custom-card.js')}}"></script>--}}
{{--<script src="{{asset('/cuba-style/assets/js/tooltip-init.js')}}"></script>--}}
<!-- Plugins JS Ends-->
<!-- Theme js-->
<script src="{{asset('/cuba-style/assets/js/script.js')}}"></script>
<script src="{{asset('/cuba-style/assets/js/theme-customizer/customizer.js')}}"></script>
@stack('scripts')
<!-- login js-->
<!-- Plugin used-->
</body>
</html>
