<!DOCTYPE html>

<html class="loading" lang="En" data-textdirection="rtl">

<header>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Reza avareh">
    <title>ملیسان | @yield('title')</title>
    <!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">

    <link rel="apple-touch-icon" href="{{ asset('files/main.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('files/main.png') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('all-css/app-assets/vendors.min.css') }}">
    <!-- END: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('all-css/app-assets/style-rtl.min.css') }}">
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/css-rtl/themes/vertical-menu-nav-dark-template/materialize.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/css-rtl/themes/vertical-menu-nav-dark-template/style.min.css') }}">
    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/custom/custom.css') }}">
    <!-- END: Custom CSS-->
    <link rel="stylesheet" href="{{ asset('app-assets/css-rtl/custom/style.css') }}">
    {{-- here For Add Specify Page Styles --}}
    <link rel="stylesheet" href="{{ asset('app-assets/css/custom/my-style.css') }}">
    @yield('add-styles')
</head>
<!-- END: Head-->

<body class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu 2-columns" data-open="click"
    data-menu="vertical-modern-menu" data-col="2-columns">

    <!-- BEGIN: Header-->
    @include('melisan.management.layout.partials.top-header')
    <!-- END: Header-->
    <!-- BEGIN: SideNav-->
    @include('melisan.management.layout.partials.aside')
    <!-- END: SideNav-->

    <!-- BEGIN: Page Main-->
    <div id="main">
        <div class="row">
            <!-- bread crumbs-->
            @include('management.layout.partials.page-detial')
            <div class="col s12">
                <div class="container">

                    @yield('main-content')

                </div>
            </div>
        </div>    <!-- END: Page Main-->

    <!-- BEGIN: Footer-->

        <footer class="page-footer footer footer-static footer-dark gradient-45deg-purple-deep-orange gradient-shadow navbar-border navbar-shadow">
            <div class="footer-copyright">
                <div class="container"><span>&copy; 2020 <a href="http://mana-group.ir/" target="_blank">تیم  مانا</a>
                    تمامی حقوق محفوظ است.</span><span class="right hide-on-small-only"> </span></div>
            </div>
        </footer>


</body>

<script src="{{ asset('app-assets/js/vendors.min.js') }}"></script>
<script src="{{ asset('app-assets/js/plugins.min.js') }}"></script>
<script src="{{ asset('app-assets/js/search.min.js') }}"></script>
<script src="{{ asset('app-assets/js-rtl/custom/custom-script-rtl.min.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/ui-alerts.min.js') }}"></script>
<script src="{{ asset('app-assets/js/axios.min.js') }}"></script>
@yield('js')

</html>
