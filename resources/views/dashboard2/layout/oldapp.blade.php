<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>ملیسان</title>
    <link rel="icon" type="image/x-icon" href="{{asset("new-style/assets/img/favicon.ico")}}"/>
    <link href="{{asset("new-style/assets/css/loader.css")}}" rel="stylesheet" type="text/css" />
    <script src="{{asset("new-style/assets/js/loader.js")}}"></script>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="{{asset("new-style/bootstrap/css/bootstrap.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("new-style/assets/css/plugins.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("new-style/assets/css/structure.css")}}" rel="stylesheet" type="text/css" class="structure" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="{{asset("new-style/plugins/apex/apexcharts.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("new-style/assets/css/dashboard/dash_1.css")}}" rel="stylesheet" type="text/css" class="dashboard-analytics" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link rel="stylesheet" type="text/css" href="{{asset("new-style/assets/css/elements/alert.css")}}">

    <link rel="stylesheet" type="text/css" href="{{asset("new-style/plugins/table/datatable/datatables.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("new-style/assets/css/forms/theme-checkbox-radio.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("new-style/plugins/table/datatable/dt-global_style.css")}}">

    {{--alert--}}
    <link rel="stylesheet" type="text/css" href="{{asset("new-style/assets/css/elements/alert.css")}}">
    <style>
        .btn-light { border-color: transparent; }
    </style>
    @yield('start')

    {{--scrum--}}
    <link href="{{asset("new-style/assets/css/elements/miscellaneous.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("new-style/assets/css/elements/breadcrumb.css")}}" rel="stylesheet" type="text/css" />

    {{--icons--}}
    <style>
        .feather-icon .icon-section {
            padding: 30px;
        }

        .feather-icon .icon-section h4 {
            color: #3b3f5c;
            font-size: 17px;
            font-weight: 600;
            margin: 0;
            margin-bottom: 16px;
        }

        .feather-icon .icon-content-container {
            padding: 0 16px;
            width: 86%;
            margin: 0 auto;
            border: 1px solid #bfc9d4;
            border-radius: 6px;
        }

        .feather-icon .icon-section p.fs-text {
            padding-bottom: 30px;
            margin-bottom: 30px;
        }

        .feather-icon .icon-container {
            cursor: pointer;
        }

        .feather-icon .icon-container svg {
            color: #3b3f5c;
            margin-right: 6px;
            vertical-align: middle;
            width: 20px;
            height: 20px;
            fill: rgba(0, 23, 55, 0.08);
        }

        .feather-icon .icon-container:hover svg {
            color: #1b55e2;
            fill: rgba(27, 85, 226, 0.23921568627450981);
        }

        .feather-icon .icon-container span {
            display: none;
        }

        .feather-icon .icon-container:hover span {
            color: #1b55e2;
        }

        .feather-icon .icon-link {
            color: #1b55e2;
            font-weight: 600;
            font-size: 14px;
        }

        /*FAB*/
        .fontawesome .icon-section {
            padding: 30px;
        }

        .fontawesome .icon-section h4 {
            color: #3b3f5c;
            font-size: 17px;
            font-weight: 600;
            margin: 0;
            margin-bottom: 16px;
        }

        .fontawesome .icon-content-container {
            padding: 0 16px;
            width: 86%;
            margin: 0 auto;
            border: 1px solid #bfc9d4;
            border-radius: 6px;
        }

        .fontawesome .icon-section p.fs-text {
            padding-bottom: 30px;
            margin-bottom: 30px;
        }

        .fontawesome .icon-container {
            cursor: pointer;
        }

        .fontawesome .icon-container i {
            font-size: 20px;
            color: #3b3f5c;
            vertical-align: middle;
            margin-right: 10px;
        }

        .fontawesome .icon-container:hover i {
            color: #1b55e2;
        }

        .fontawesome .icon-container span {
            color: #888ea8;
            display: none;
        }

        .fontawesome .icon-container:hover span {
            color: #1b55e2;
        }

        .fontawesome .icon-link {
            color: #1b55e2;
            font-weight: 600;
            font-size: 14px;
        }
    </style>


</head>
<body class="dashboard-analytics">

<!-- BEGIN LOADER -->
<div id="load_screen"> <div class="loader"> <div class="loader-content">
            <div class="spinner-grow align-self-center"></div>
        </div></div></div>
<!--  END LOADER -->
@include('dashboard2.layout.navbar')

<div class="main-container" id="container">

    <div class="overlay"></div>
    {{--<div class="search-overlay"></div>--}}
@include('dashboard2.layout.sidebar')




    @yield('main')




</div>
<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="{{asset("new-style/assets/js/libs/jquery-3.1.1.min.js")}}"></script>


<script src="{{asset("new-style/bootstrap/js/popper.min.js")}}"></script>
<script src="{{asset("new-style/bootstrap/js/bootstrap.min.js")}}"></script>
<script src="{{asset("new-style/plugins/perfect-scrollbar/perfect-scrollbar.min.js")}}"></script>
<script src="{{asset("new-style/assets/js/app.js")}}"></script>
<script>
    $(document).ready(function () {
        App.init();
    });
</script>
<script src="{{asset("new-style/assets/js/custom.js")}}"></script>
<!-- END GLOBAL MANDATORY SCRIPTS -->

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
<script src="{{asset("new-style/plugins/apex/apexcharts.min.js")}}"></script>
<script src="{{asset("new-style/assets/js/dashboard/dash_1.js")}}"></script>
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

{{--alert--}}
{{--<script src="{{asset("new-style/assets/js/scrollspyNav.js")}}></script>--}}

{{--icons--}}
<script src="{{("/new-style/plugins/font-icons/feather/feather.min.js")}}"></script>
<script type="text/javascript">
    feather.replace();
</script>
@yield('end')


</body>
</html>
