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
        :root {
            --primary-color: #8e24aa;
            --secondary-color: #7b1fa2;
            --accent-color: #ab47bc;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --success-color: #ce93d8;
            --warning-color: #f72585;
            --text-color: #333;
            --border-radius: 12px;
            --box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s ease;
        }

        @font-face {
            font-family: 'Dana1';
            src: url(assets/fonts/Dana-Black.ttf);
            src: url(assets/fonts/Dana-Black.woff2) format('woff');
        }

        @font-face {
            font-family: 'Dana2';
            src: url(assets/fonts/Dana-Medium.ttf);
            src: url(assets/fonts/Dana-Medium.woff2) format('woff');
        }

        @font-face {
            font-family: 'Dana3';
            src: url(assets/fonts/Dana-Bold.ttf);
            src: url(assets/fonts/Dana-Bold.woff2) format('woff');
        }

        * {
            font-family: kalame3;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: Dana2;

        }

        .font {
            font-family: Dana3;
        }

        .font-bold {
            font-family: Dana1;
            position: relative;
            z-index: 999;
        }

        /* end font */

        body {
            background: #ebdbee;
            color: var(--text-color);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        .container-floud {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            flex: 1;
        }

        .welcome-section {
            /* background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); */
            color: white;
            padding: 25px;
            border-radius: var(--border-radius);
            margin-bottom: 25px;
            box-shadow: var(--box-shadow);
            text-align: center;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .welcome-section::before {
            content: "";
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: rgba(255, 255, 255, 0.1);
            transform: rotate(25deg);
        }

        .welcome-section h5 {
            margin: 0;
            font-size: 1.4rem;
            font-weight: 600;
            position: relative;
            z-index: 1;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .box-nazr {
            background-color: white;
            border-radius: var(--border-radius);
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: var(--box-shadow);
            border-right: 4px solid var(--accent-color);
            transition: var(--transition);
        }

        .box-nazr:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(142, 36, 170, 0.15);
        }

        .mtn-nazr {
            margin: 0;
            font-size: 1.1rem;
            color: var(--dark-color);
            text-align: center;
            font-weight: 500;
        }

        #html-validations {
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--box-shadow);
            margin-bottom: 30px;
            border: none;
            transition: var(--transition);
        }

        #html-validations:hover {
            box-shadow: 0 8px 30px rgba(142, 36, 170, 0.2);
        }

        .card-tabs {
            background: white;
        }

        .card-content {
            padding: 30px;
        }

        .nazar-title {
            color: black;
            font-weight: 700;
            font-size: large;
            text-align: center;
            margin: 0;
            line-height: 1.4;
        }


        form {
            margin-top: 20px;
        }

        .input-field {
            margin-top: 20px;
        }

        .nazar-img {
            width: 63%;
            text-align: center;
            padding-right: 39%;
            padding-bottom: 5%;
        }

        .btn {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 50px;
            padding: 0 35px;
            height: 48px;
            line-height: 48px;
            font-weight: 600;
            text-transform: none;
            box-shadow: 0 4px 15px rgba(142, 36, 170, 0.4);
            transition: var(--transition);
            border: none;
            font-size: 1rem;
        }

        .btn:hover {
            background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
            box-shadow: 0 6px 20px rgba(142, 36, 170, 0.6);
            transform: translateY(-2px);
        }

        .custom-send-material-icon {
            margin-right: 8px;
            margin-left: 0;
            transition: var(--transition);
        }

        .btn:hover .custom-send-material-icon {
            transform: translateX(5px);
        }




        .container-dushbord {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            position: relative;
            z-index: 1;
        }


        /* استایل‌های سفارشی برای فرم‌ها */
        textarea.materialize-textarea {
            border-radius: 8px;
            padding: 15px;
            border: 1px solid #ddd;
            transition: var(--transition);
            font-family: 'Vazir', sans-serif;
        }

        textarea.materialize-textarea:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 1px var(--primary-color);
        }

        [type="radio"]:checked+span:after {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        /* افکت‌های اضافی */
        .pulse-effect {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(142, 36, 170, 0.4);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(142, 36, 170, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(142, 36, 170, 0);
            }
        }

        /* ریسپانسیو */
        @media (max-width: 768px) {
            .container-floud {
                padding: 15px;
            }

            .welcome-section {
                padding: 20px;
            }

            .welcome-section h5 {
                font-size: 1.2rem;
            }

            .card-content {
                padding: 20px;
            }

            .nazar-title {
                font-size: medium;
            }

            .box-nazr {
                padding: 20px;
            }
        }

        @media (max-width: 480px) {
            .welcome-section h5 {
                font-size: 1.1rem;
            }

            .card-content {
                padding: 15px;
            }

            .nazar-title {
                font-size: medium;
            }

            .btn {
                width: 100%;
                padding: 0 20px;
            }

            footer.footer-dashbord {
                padding: 20px 0;
            }
        }
    </style>
</head>

<body>

    <div class="container-floud">
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

            <div class="col-md-6">

                <div class="box-nazr">
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
                            <div class="col s12">
                                @if ($random->type == 1)
                                    @include('melisan.layoutStudent.survay-textarea')
                                @else
                                    @include('melisan.layoutStudent.survay-radio')
                                @endif

                                <div class="input-field">
                                </div>
                            </div>
                            <div class="input-field col s12">
                                <button class="btn waves-effect waves-light right iransans" type="submit"
                                    name="action">ارسال پاسخ
                                    <i class="material-icons right custom-send-material-icon">send</i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class=""><img src="{{ asset('files/main.png') }}" class="nazar-img" alt="materialize logo" />
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