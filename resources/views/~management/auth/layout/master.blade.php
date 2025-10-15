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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/sweetalert/sweetalert.css">
    {{-- here For Add Specify Page Styles --}}
    @yield('styles')
</head>
<!-- END: Head-->
{{-- import Notifications Program Status --}}
@include('management.layout.notifications.notifications')
{{-- import Error Program --}}
@include('management.layout.notifications.error')
{{-- Main Content Is Here --}}
@yield('main-content')
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
