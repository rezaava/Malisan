<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ملیسان</title>
    <link rel="icon" type="image/x-icon" href="{{asset("style/assets/img/favicon.ico")}}"/>
    <link href="{{asset("style/assets/css/loader.css")}}" rel="stylesheet" type="text/css" />
    <script src="{{asset("style/assets/js/loader.js")}}"></script>

    <!-- BEGIN GLOBAL MANDATORY STYaLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="{{asset("style/bootstrap/css/bootstrap.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("style/assets/css/plugins.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("style/assets/css/structure.css")}}" rel="stylesheet" type="text/css" class="structure" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="{{asset("style/plugins/apex/apexcharts.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("style/assets/css/dashboard/dash_1.css")}}" rel="stylesheet" type="text/css" class="dashboard-analytics" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link rel="stylesheet" type="text/css" href="{{asset("style/assets/css/elements/alert.css")}}">

    <link rel="stylesheet" type="text/css" href="{{asset("style/plugins/table/datatable/datatables.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("style/assets/css/forms/theme-checkbox-radio.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("style/plugins/table/datatable/dt-global_style.css")}}">

    {{--alert--}}
    <link rel="stylesheet" type="text/css" href="{{asset("style/assets/css/elements/alert.css")}}">
    <style>
        .btn-light { border-color: transparent; }
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js" integrity="sha512-WNLxfP/8cVYL9sj8Jnp6et0BkubLP31jhTG9vhL/F5uEZmg5wEzKoXp1kJslzPQWwPT1eyMiSxlKCgzHLOTOTQ==" crossorigin="anonymous"></script>

    @yield('start')

    {{--scrum--}}
    <link href="{{asset("style/assets/css/elements/miscellaneous.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("style/assets/css/elements/breadcrumb.css")}}" rel="stylesheet" type="text/css" />

    {{--icons--}}
    <style>
        .feather-icon .icon-section {
            padding: 30px;
        }
        .feather-icon .icon-section h4 {
            color: #bfc9d4;
            font-size: 17px;
            font-weight: 600;
            margin: 0;
            margin-bottom: 16px;
        }
        .feather-icon .icon-content-container {
            padding: 0 16px;
            width: 86%;
            margin: 0 auto;
            border: 1px solid #191e3a;
            border-radius: 6px;
        }
        .feather-icon .icon-section p.fs-text {
            padding-bottom: 30px;
            margin-bottom: 30px;
        }
        .feather-icon .icon-container { cursor: pointer; }
        .feather-icon .icon-container svg {
            color: #bfc9d4;
            margin-right: 6px;
            vertical-align: middle;
            width: 20px;
            height: 20px;
            fill: rgba(0, 23, 55, 0.08);
        }
        .feather-icon .icon-container:hover svg {
            color: #888ea8;
        }
        .feather-icon .icon-container span { display: none; }
        .feather-icon .icon-container:hover span { color: #888ea8; }
        .feather-icon .icon-link {
            color: #888ea8;
            font-weight: 600;
            font-size: 14px;
        }


        /*FAB*/
        .fontawesome .icon-section {
            padding: 30px;
        }
        .fontawesome .icon-section h4 {
            color: #bfc9d4;
            font-size: 17px;
            font-weight: 600;
            margin: 0;
            margin-bottom: 16px;
        }
        .fontawesome .icon-content-container {
            padding: 0 16px;
            width: 86%;
            margin: 0 auto;
            border: 1px solid #191e3a;
            border-radius: 6px;
        }
        .fontawesome .icon-section p.fs-text {
            padding-bottom: 30px;
            margin-bottom: 30px;
        }
        .fontawesome .icon-container { cursor: pointer; }
        .fontawesome .icon-container i {
            font-size: 20px;
            color: #bfc9d4;
            vertical-align: middle;
            margin-right: 10px;
        }
        .fontawesome .icon-container:hover i { color: #888ea8; }
        .fontawesome .icon-container span { color: #888ea8; display: none; }
        .fontawesome .icon-container:hover span { color: #888ea8; }
        .fontawesome .icon-link {
            color: #888ea8;
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



{{--<script src="{{asset("style/assets/js/libs/jquery-3.1.1.min.js")}}"></script>--}}
<script src="{{asset("style/bootstrap/js/popper.min.js")}}"></script>
<script src="{{asset("style/bootstrap/js/bootstrap.min.js")}}"></script>
<script src="{{asset("style/plugins/perfect-scrollbar/perfect-scrollbar.min.js")}}"></script>
<script src="{{asset("style/assets/js/app.js")}}"></script>
<script>
    $(document).ready(function () {
        App.init();
    });
</script>
<script src="{{asset("style/assets/js/custom.js")}}"></script>
<!-- END GLOBAL MANDATORY SCRIPTS -->

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
<script src="{{asset("style/plugins/apex/apexcharts.min.js")}}"></script>
<script src="{{asset("style/assets/js/dashboard/dash_1.js")}}"></script>
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

{{--alert--}}
{{--<script src="{{asset("style/assets/js/scrollspyNav.js")}}></script>--}}

{{--icons--}}
<script src="{{("/style/plugins/font-icons/feather/feather.min.js")}}"></script>
<script type="text/javascript">
    feather.replace();
</script>

@yield('end')

<script src="https://www.gstatic.com/firebasejs/5.7.1/firebase.js"></script>
<script>
    // Initialize Firebase
            {{--const firebaseConfig = {--}}
            {{--apiKey: "AIzaSyBrTg919wcBG8OtNuu2pdd1jPa-M6Iverw",--}}
            {{--authDomain: "malisan.firebaseapp.com",--}}
            {{--projectId: "malisan",--}}
            {{--storageBucket: "malisan.appspot.com",--}}
            {{--messagingSenderId: "836379810099",--}}
            {{--appId: "1:836379810099:web:1eaa8866eccf9120af4646",--}}
            {{--measurementId: "G-KMRJG4KYJR"--}}
            {{--};--}}


    var config = {
                apiKey: "AIzaSyBrTg919wcBG8OtNuu2pdd1jPa-M6Iverw",
                authDomain: "malisan.firebaseapp.com",
                projectId: "malisan",
                storageBucket: "malisan.appspot.com",
                messagingSenderId: "836379810099",
                appId: "1:836379810099:web:1eaa8866eccf9120af4646",
                measurementId: "G-KMRJG4KYJR"
    };
    firebase.initializeApp(config);
    // Retrieve Firebase Messaging object.

    const messaging = firebase.messaging();

    messaging.requestPermission().then(function() {
        console.log('Notification permission granted.');
        getFCM();
    }).catch(function(err) {
        console.log('Unable to get permission to notify.', err);
    });

    function getFCM() {
        // Get Instance ID token. Initially this makes a network call, once retrieved
// subsequent calls to getToken will return from cache.
        messaging.getToken({vapidKey: "BOUaDsVLjJRKouChsRZ2j7d7OSo5W3nACFhwGenmL0HrAOtI_g9xtMZZJUBsnXHiOqGHgPYVUiBV-GdB9dJ9rMk"}).then(function(currentToken) {

            if (currentToken) {
                console.log(currentToken);
                sendTokenToServer(currentToken);
            } else {
                // Show permission request.
                console.log('No Instance ID token available. Request permission to generate one.');
                // Show permission UI.
                // updateUIForPushPermissionRequired();
                // setTokenSentToServer(false);
            }
        }).catch(function(err) {
            console.log('An error occurred while retrieving token. ', err);
            // showToken('Error retrieving Instance ID token. ', err);
            // setTokenSentToServer(false);
        });
    }

    function sendTokenToServer(token) {
        var tokenl = document.head.querySelector('meta[name="csrf-token"]').content;
        $.post('/sendTokenToServer',{
            _token : tokenl,
            token : token,
        },function (response) {
            console.log(response);
        });

    }

    messaging.onMessage(function(payload) {
        alert("das");
        console.log('Message received. ', payload.data);
        var notification = new Notification(payload.data.title, {
            icon: 'https://malisan.ir/files/icons/minilogo.png',
            body: payload.data.body,
        });
        if (payload.data.click_action != "") {
            notification.onclick = function () {
                window.open("http://google.com");
            };
        }
        // location.reload();
    });

</script>


</body>
</html>
