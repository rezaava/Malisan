<link href="{{asset("style/assets/css/elements/breadcrumb.css")}}" rel="stylesheet" type="text/css" />



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>ملیسان</title>
    <link rel="icon" type="image/x-icon" href="{{asset("style/assets/img/favicon.ico")}}"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="{{asset("style/bootstrap/css/bootstrap.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("style/assets/css/plugins.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("style/assets/css/structure.css")}}" rel="stylesheet" type="text/css" class="structure" />
    <link href="{{asset("style/assets/css/authentication/form-1.css")}}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="{{asset("style/assets/css/forms/theme-checkbox-radio.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("style/assets/css/forms/switches.css")}}">
</head>
<body class="form">
@if ($message = Session::get('success'))
    <div class="alert alert-light-warning mb-4" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
        <strong>هشدار!</strong>
        {{ $message }}    </div>
@endif

@if ($message = Session::get('error'))
    <div class="alert alert-light-danger mb-4" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
        <strong>هشدار!</strong>
        {{ $message }}    </div>
@endif


@if ($message = Session::get('warning'))
    <div class="alert alert-light-warning mb-4" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
        <strong>هشدار!</strong>
        {{ $message }}    </div>
@endif


@if ($message = Session::get('info'))
    <div class="alert alert-light-info mb-4" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
        <strong>هشدار!</strong>
        {{ $message }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-info alert-block">

        {{ implode('', $errors->all(':message')) }}
    </div>
@endif


<div class="form-container">
    <div class="form-form">
        <div class="form-form-wrap">
            <div class="form-container">
                <div class="form-content">

                    <h1 class="">ورود به <a href="#"><span class="brand-name">ملیسان</span></a></h1>
                    <h5 class=""><span class="brand-name" style="color: blue">مدیریت، لذت ، یادگیری در سامانه آموزش نوین</span></h5>
                    <p class="signup-link">حساب ندارید؟ <a href="/reg"> یک حساب کاربری ایجاد کنید</a></p>
                        <form class="text-left" method="post" action="login">
                            @csrf

                            <div class="form">

                            <div id="username-field" class="field-wrapper input">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                <input id="username" name="national" type="text" class="form-control" placeholder="کد ملی">
                            </div>

                            <div id="password-field" class="field-wrapper input mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                <input id="password" name="password" type="password" class="form-control" placeholder="رمزعبور">
                            </div>
                            <div class="d-sm-flex justify-content-between">
                                <div class="field-wrapper toggle-pass">
                                    <p class="d-inline-block">نمایش رمز</p>
                                    <label class="switch s-primary">
                                        <input type="checkbox" id="toggle-password" class="d-none">
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                                <div class="field-wrapper">
                                    <button type="submit" class="btn btn-primary" value="">ورودی</button>
                                </div>

                            </div>

                        </div>
                    </form>
                    <p class="terms-conditions">Copyright 2020-2021 Malisan.ir All Rights Reserved© </p>

                </div>
            </div>
        </div>
    </div>
    <div class="form-image">
        <div class="l-image">
        </div>
    </div>
</div>


<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="{{asset("style/assets/js/libs/jquery-3.1.1.min.js")}}"></script>
<script src="{{asset("style/bootstrap/js/popper.min.js")}}"></script>
<script src="{{asset("style/bootstrap/js/bootstrap.min.js")}}"></script>

<!-- END GLOBAL MANDATORY SCRIPTS -->
<script src="{{asset("style/assets/js/authentication/form-1.js")}}"></script>

</body>
</html>