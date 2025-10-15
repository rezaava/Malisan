<!DOCTYPE html>
<!--
Template Name: Materialize - Material Design Admin Template
Author: PixInvent
Website: http://www.pixinvent.com/
Contact: hello@pixinvent.com
Follow: www.twitter.com/pixinvents
Like: www.facebook.com/pixinvents
Purchase: https://themeforest.net/item/materialize-material-design-admin-template/11446068?ref=pixinvent
Renew Support: https://themeforest.net/item/materialize-material-design-admin-template/11446068?ref=pixinvent
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.

-->
<html class="loading" lang="en" data-textdirection="rtl">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description"
        content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google.">
    <meta name="keywords"
        content="materialize, admin template, dashboard template, flat admin template, responsive admin template, eCommerce dashboard, analytic dashboard">
    <meta name="author" content="ThemeSelect">
    <title>ملیسان | @yield('title')</title>
    <link rel="apple-touch-icon" href="{{ asset('app-assets/images/favicon/apple-touch-icon-152x152.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('app-assets/images/favicon/favicon-32x32.png') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/vendors.min.css') }}">
    <!-- END: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/style-rtl.min.css') }}">
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/css-rtl/themes/vertical-modern-menu-template/materialize.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/css-rtl/themes/vertical-modern-menu-template/style.min.css') }}">
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
    @include('management.layout.partials.top-header')
    <!-- END: Header-->
    <!-- BEGIN: SideNav-->
    @include('management.layout.partials.aside')
    <!-- END: SideNav-->

    <!-- BEGIN: Page Main-->
    <div id="main">
        <div class="row">
            <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
            {{-- this Is For Page Detials -- Page-title -- Page Breadcrumb --}}
            @include('management.layout.partials.page-detial')
            {{-- end Of Page Details --}}
            <div class="col s12">
                <div class="container">
                    {{-- import Notifications Program Status --}}
                    @include('management.layout.notifications.notifications')
                    {{-- import Error Program --}}
                    @include('management.layout.notifications.error')
                    {{-- Main Content Is Here --}}
                    <div class="section">
                        <div class="card">
                            <div class="card-content">
                                <p class="caption mb-0">{{ isset($pageDescription) ? $pageDescription : '' }}</p>
                            </div>
                        </div>
                        @yield('main-content')
                    </div>
                    <!-- END RIGHT SIDEBAR NAV -->
                    <div style="bottom: 50px; right: 19px;" class="fixed-action-btn direction-top"><a
                            class="btn-floating btn-large gradient-45deg-light-blue-cyan gradient-shadow"><i
                                class="material-icons">add</i></a>
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
                    </div>
                </div>
                <div class="content-overlay"></div>
            </div>
        </div>
    </div>
    <!-- END: Page Main-->

    <!-- BEGIN: Footer-->

    <footer
        class="page-footer footer footer-static footer-dark gradient-45deg-indigo-purple gradient-shadow navbar-border navbar-shadow">
        <div class="footer-copyright">
            <div class="container"><span>© ۲۰۲۰ <a href="http://ticktockteam.ir/" target="_blank">گروه مهندسی
                        مانا</a>
                    تمامی حقوق محفوظ است.</span>
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
