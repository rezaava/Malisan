<html lang="fa" dir="rtl">

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
</head>

<body class="login-bg">
    <div class="container">
        <div class="register-card-req">

            <div class="neon-line-login"></div>

            <h3 class="h3-title-req">ثبت‌نام</h3>
         
            <form method="post" action="/register" enctype="multipart/form-data">
                @csrf
                <div class="form-floating mb-2 icon-input">
                    <input type="text" class="form-control" name="name" id="firstName" placeholder="نام" required>
                    <label for="firstName">نام</label>
                    <i class="material-icons ">person_outline</i>
                </div>

                <div class="form-floating mb-2 icon-input">
                    <i class="material-icons prefix pt-2">person_outline</i>
                    <input type="text" class="form-control" id="lastName" name="family" placeholder="نام خانوادگی"
                        required>
                    <label for="lastName">نام خانوادگی</label>
                </div>

                <div class="form-floating mb-2 icon-input">
                    <i class="material-icons prefix pt-2">credit_card</i>
                    <input type="text" class="form-control" id="nationalCode" name="national" placeholder="کد ملی"
                        maxlength="10" required>
                    <label for="nationalCode">کد ملی</label>
                </div>


                <div class="form-floating mb-2 icon-input">
                    <i class="material-icons prefix pt-2">smartphone</i>
                    <input type="tel" class="form-control" id="mobile" name="mobile" placeholder="شماره موبایل"
                        maxlength="11" required>
                    <label for="mobile">شماره موبایل</label>
                </div>

                <div class="form-floating mb-2 icon-input">
                    <i class="material-icons prefix pt-2">lock_outline</i>
                    <input type="password" class="form-control" id="password" name="password" placeholder="رمز عبور"
                        required>
                    <label for="password">رمز عبور</label>
                </div>
                <div class="form-group @if ($errors->has('type')) has-error @endif" hidden>
                    @if (\Route::current()->getName() == 'global')
                        <input type="radio" id="teacher" name="type" checked value="2">
                        <label for="teacher">استاد</label>
                    @else
                        <input type="radio" id="student" name="type" checked value="3">
                        <label for="student">دانشجو</label>
                    @endif

                </div>
                <button type="submit" class="btn-modern-req w-100">ثبت‌نام</button>

                <p class="text-center mt-4" style="color:white;">
                    قبلاً حساب دارید؟
                    <a href="{{ route('login') }}">ورود</a>
                </p>

            </form>
        </div>
    </div>
</body>

</html>