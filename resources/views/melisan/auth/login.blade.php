<html class="loading" lang="fa" data-textdirection="rtl">
<!-- BEGIN: Head-->

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="author" content="Reza Avareh">
    <title>ملیسان | @yield('title')</title>
    <link rel="apple-touch-icon" href="{{ asset('app-assets/images/favicon/apple-touch-icon-152x152.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('app-assets/images/favicon/favicon-32x32.png') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="all-css/app-assets/sweetalert.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('all-css/auth.css') }}">
    {{-- here For Add Specify Page Styles --}}
    @yield('styles')
</head>
<!-- END: Head-->

<body class="login-bg">
    <div class="container">
        <!-- پیام موفقیت و خطا -->
        <div class="alertCat">
            @if(session('success'))
                <div class="alert-success-custom">
                    <div class="alert-content">
                        <span class="alert-icon">✓</span>
                        <span class="alert-message">{{ session('success') }}</span>
                        <button class="alert-close"
                            onclick="this.parentElement.parentElement.style.display='none'">×</button>
                    </div>
                </div>
            @elseif(session('error'))
                <div class="alert-error-custom">
                    <div class="alert-content">
                        <span class="alert-icon">!</span>
                        <span class="alert-message">{{ session('error') }}</span>
                        <button class="alert-close"
                            onclick="this.parentElement.parentElement.style.display='none'">×</button>
                    </div>
                </div>
            @endif
        </div>
        <div class="login-card-login ">
            <div class="neon-line-login"></div>
            <h3 class="h3-login">ورود به حساب</h3>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <!-- Floating Label اصلی Bootstrap -->
                <div class="form-floating mb-3 icon-input">
                    <input type="text" class="form-control" id="username" placeholder="نام کاربری" name="national">
                    <label for="username">نام کاربری</label>
                    <i class="material-icons">person_outline</i>
                </div>

                <div class="form-floating mb-3 icon-input">
                    <input type="password" class="form-control" id="password" placeholder="رمز عبور" name="password">
                    <label for="password">رمز عبور</label>
                    <i class="material-icons">lock_outline</i>
                </div>

                {{-- <div class="row">--}}
                    {{-- <div class="col s12 m12 l12 ml-2 mt-1">--}}
                        {{-- <p>--}}
                            {{-- <label>--}}
                                {{-- <input type="checkbox" />--}}
                                {{-- <span>مرا به خاطر بسپار</span>--}}
                                {{-- </label>--}}
                            {{-- </p>--}}
                        {{-- </div>--}}
                    {{-- </div>--}}

                <button class="btn-modern-login w-100">ورود</button>

                <p class="text-center mt-4" style="color:white;">
                    حساب ندارید؟
                    <a href="{{ route('register') }}">ثبت‌نام</a>
                </p>
            </form>
        </div>

        {{-- <div class="input-field col s6 m6 l6">--}}
            {{-- <p class="margin right-align medium-small"><a href="user-forgot-password.html">رمز--}}
                    {{-- عبور را فراموش کرده اید؟</a></p>--}}
            {{-- </div>--}}
        <div class="content-overlay"></div>

    </div>

</body>


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