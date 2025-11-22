<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نظرسنجی</title>


    <link rel="apple-touch-icon" href="{{ asset('app-assets/images/favicon/apple-touch-icon-152x152.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('app-assets/images/favicon/favicon-32x32.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazir-font@v30.1.0/dist/font-face.css" rel="stylesheet"
        type="text/css">


    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/css-rtl/themes/vertical-modern-menu-template/style.min.css') }}">

    <link rel="stylesheet" href="{{ asset('app-assets/css-rtl/custom/style.css') }}">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/sweetalert/sweetalert.css">
    {{-- here For Add Specify Page Styles --}}

    <link rel="stylesheet" href="{{ asset('all-css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('all-css/my-style.css') }}">
    <style>
  
    </style>
</head>

<body class="body-nazr">

    <div class="container-fluid">
        <br><br>
        <div class="welcome-section pulse-effect">

            <h5 class="">
                @if ($user->hasRole('teacher')) استاد
                @elseif($user->hasRole('student')) دانشجو
                @elseif($user->hasRole('admin')) مدیر محترم
                @endif
                {{$user->name . ' ' . $user->family }} عزیز خوش آمدید
            </h5>
        </div> <br>
        <hr><br>
        <div class="row">

            <div class="col-md-6" style=" min-height: 50vh;">
        
                <div class="card h-100 box-nazr">
                    <div class="">
                        <div class="row">
                            <div class="">
                                <h4 class="nazar-title">{!! $random->text !!}</h4>
                            </div>
                        </div>
                    </div>
                    <form method="post" action="{{ route('survey.answer') }}">
                        @csrf
                        <input name="user_id" value="{{ $user->id }}" hidden>
                        <input name="random_id" value="{{ $random->id }}" hidden>
                        <input name="type" value="{{ $random->type }}" hidden>
                        <div class="row">
                            <div class="col-md-12">
                                @if ($random->type == 1)
                                    @include('melisan.layoutStudent.survay-textarea')
                                @else
                                    @include('melisan.layoutStudent.survay-radio')
                                @endif

                                <!-- <div class="input-field">
                                </div> -->
                            </div>

                        </div>
                        <div class="input-field col-md-12 ">
                            <button class="btn " type="submit" name="action" style="font-size:15px">ارسال پاسخ
                                <i class="material-icons right custom-send-material-icon"
                                    style="font-size:15px">send</i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-6">
         
                <div class="card h-100" style='box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;'>

                    <img src="{{ asset('files/main.png') }}" class="nazar-img mt-2" alt="materialize logo">
                    <br>
                    <p class="mtn-nazr">{{ isset($pageDescription) ? $pageDescription : '' }}</p>
                </div>
            </div>
        </div>




        <!-- BEGIN: footer-->
        <!-- <footer class="footer-dashbord">
            <div class="container-dushbord">
                <span>
                    &copy; 2020
                    <a href="http://mana-group.ir/" target="_blank">تیم مانا</a>
                    تمامی حقوق محفوظ است.
                </span>
                <span class="right hide-on-small-only"> </span>
            </div>
        </footer> -->

    </div>
</body>

</html>