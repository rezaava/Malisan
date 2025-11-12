<!DOCTYPE html>
<html class="loading" lang="en">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- <meta name="description"
        content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google.">
    <meta name="keywords"
        content="materialize, admin template, dashboard template, flat admin template, responsive admin template, eCommerce dashboard, analytic dashboard"> -->
    <!-- BEGIN: VENDOR CSS-->
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/vendors.min.css') }}"> -->
    <!-- END: VENDOR CSS-->
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/style-rtl.min.css') }}"> -->
    <!-- BEGIN: Page Level CSS-->
    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/custom/custom.css') }}"> -->
    <!-- END: Custom CSS-->

    <meta name="author" content="ThemeSelect">
    <title>ملیسان | @yield('title')</title>
    <link rel="apple-touch-icon" href="{{ asset('app-assets/images/favicon/apple-touch-icon-152x152.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('app-assets/images/favicon/favicon-32x32.png') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/css-rtl/themes/vertical-modern-menu-template/materialize.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/css-rtl/themes/vertical-modern-menu-template/style.min.css') }}">

    <link rel="stylesheet" href="{{ asset('app-assets/css-rtl/custom/style.css') }}">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/sweetalert/sweetalert.css">
    {{-- here For Add Specify Page Styles --}}

    <link rel="stylesheet" href="{{ asset('all-css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('all-css/my-style.css') }}">
    @yield('styles')
</head>

<!-- END: Head-->
{{-- import Notifications Program Status --}}
@include('melisan.layoutStudent.notifications.notifications')
@include('melisan.layoutStudent.notifications.error')


<body class="" data-open="click" data-menu="vertical-modern-menu" data-col="2-columns">
    <div class="container_fluid">

        @include('melisan.layoutStudent.top-header')
        <!-- BEGIN: Page Main-->
        <div id="main" style="margin-top:5%">
            <div class="row">
                <div class=""></div>
                {{-- this Is For Page Detials -- Page-title -- Page Breadcrumb --}}
                @include('melisan.layoutStudent.page-detial')
                {{-- end Of Page Details --}}
                <div class="col s12">
                        <div class="section">
                            <div class="card">
                                <div class="box-nazr">
                                    <p class="mtn-nazr">{{ isset($pageDescription) ? $pageDescription : '' }}</p>
                                </div>
                            </div>
                            @yield('main-content')
                        </div>
                        <!-- END RIGHT SIDEBAR NAV -->
                        <!-- <div style="bottom: 50px; right: 19px;" class="fixed-action-btn direction-top">
                        <a   class="btn-floating btn-large gradient-45deg-light-blue-cyan gradient-shadow">
                            <i     class="material-icons">add</i></a>
                        <ul>
                            <li><a href="css-helpers.html" class="btn-floating blue"><i
                                        class="material-icons">help_outline</i></a></li>
                            <li><a href="cards-extended.html" class="btn-floating green"><i
                                        class="material-icons">widgets</i></a></li>
                            <li><a href="app-calendar.html" class="btn-floating amber"><i
                                        class="material-icons">today</i></a></li>
                            <li><a href="app-email.html" class="btn-floating red"><i
                                        class="material-icons">mail_outline</i></a></li>
                        </ul>
                    </div> -->
        
                    <div class="content-overlay"></div>
                </div>
            </div>
        </div>
        <!-- END: Page Main-->

        <!-- BEGIN: footer-->
        <footer class="footer-dashbord">
            <div class="container-dushbord ">
                <span>
                    &copy; 2020
                    <a href="http://mana-group.ir/" style="color: black;">تیم مانا</a>
                    تمامی حقوق محفوظ است.</span>
                <span class="right hide-on-small-only"> </span>
            </div>
        </footer>

        <!-- BEGIN VENDOR JS-->
        <script src="../../../app-assets/js/vendors.min.js"></script>
        <!-- BEGIN VENDOR JS-->
        <!-- BEGIN PAGE VENDOR JS-->
        <!-- END PAGE VENDOR JS-->
        <!-- BEGIN THEME  JS-->
        <script src="app-assets/js/plugins.min.js"></script>
        <script src="app-assets/js/search.min.js"></script>
        <script src="app-assets/js-rtl/custom/custom-script-rtl.min.js"></script>
        <script src="app-assets/js/scripts/customizer.min.js"></script>
        <!-- END THEME  JS-->
        <!-- BEGIN PAGE LEVEL JS-->
        <!-- END PAGE LEVEL JS-->


        <div class="sidenav-overlay" style="display: none;"></div>
        <div class="drag-target right-aligned"></div>
        <div class="sidenav-overlay"></div>
        <div class="drag-target"></div>
        <div class="sidenav-overlay"></div>
        <div class="drag-target"></div>
        <div class="sidenav-overlay"></div>
        <div class="drag-target"></div>
    </div>
</body>
{{-- End Main Content --}}
<!-- BEGIN VENDOR JS-->
<script src="{{ asset('app-assets/js/vendors.min.js') }}"></script>
<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
<!-- END PAGE VENDOR JS-->
<!-- BEGIN THEME  JS-->
<script src="{{ asset('app-assets/js/plugins.min.js') }}"></script>
<script src="{{ asset('app-assets/js/search.min.js') }}"></script>
<script src="{{ asset('app-assets/js-rtl/custom/custom-script-rtl.min.js') }}"></script>
<!-- END THEME  JS-->
<!-- BEGIN PAGE LEVEL JS-->
<!-- END PAGE LEVEL JS-->
{{-- here For Ad Specify Pages Js --}}
@yield('js')

</html>