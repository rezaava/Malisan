<!DOCTYPE html>

<html class="loading" lang="En" data-textdirection="rtl">

<header>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Reza avareh">

    <title>ملیسان | @yield('title')</title>

    <!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
    <link rel="stylesheet" href="{{ asset('all-css/app-assets/vendors.min.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <link rel="apple-touch-icon" href="{{ asset('files/main.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('files/main.png') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('all-css/app-assets/style-rtl.min.css') }}">
    <link rel="stylesheet" href="{{ asset('all-css/custom.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('all-css/materialize.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('all-css/style.min.css') }}">
    <link rel="stylesheet" href="{{ asset('all-css/style.css') }}">
    {{-- here For Add Specify Page Styles --}}
    <link rel="stylesheet" href="{{ asset('all-css/my-style.css') }}">
    @yield('add-styles')
<!-- Boxicons -->
<link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

    </head>

    <body class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu 2-columns"
        data-open="click" data-menu="vertical-modern-menu" data-col="2-columns">
        <div class="container">
            <!-- BEGIN: Header-->
            @include('melisan.layout.partials.top-header')
            <!-- END: Header-->
            <!-- BEGIN: SideNav-->
            @include('melisan.layout.partials.aside')
            <!-- END: SideNav-->

            <!-- BEGIN: Page Main-->
            <div id="main">
                <div class="row">
                    <!-- bread crumbs-->
                    @include('melisan.layout.partials.page-detial')
                    <div class="col s12">
                        <div class="container">

                            @yield('main-content')

                        </div>
                    </div>
                </div>
                <footer
                    class="page-footer footer footer-static footer-dark gradient-45deg-purple-deep-orange gradient-shadow navbar-border navbar-shadow">
                    <div class="footer-copyright">
                        <div class="container">
                            <span>
                                &copy; 2020
                                <a href="http://mana-group.ir/" target="_blank">تیم مانا</a>
                                تمامی حقوق محفوظ است.</span>
                            <span class="right hide-on-small-only"> </span>
                        </div>
                    </div>
                </footer>

            </div>
    </body>

    <script src="{{ asset('app-assets/js/vendors.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/plugins.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/search.min.js') }}"></script>
    <script src="{{ asset('app-assets/js-rtl/custom/custom-script-rtl.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/ui-alerts.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/axios.min.js') }}"></script>
    <script>
    const mobileBtn = document.getElementById('mobileMenuBtn');
    const mainMenu = document.getElementById('mainMenu');

    mobileBtn.addEventListener('click', () => {
        mainMenu.classList.toggle('show');
    });
</script>
    @yield('js')

</html>