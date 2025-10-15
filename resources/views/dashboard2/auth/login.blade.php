<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>CORK الگوی مدیریتی تمام ریسپانسیو - Lockscreen Login Page</title>
    <link rel="icon" type="image/x-icon" href="{{asset("assets/img/favicon.ico")}}"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="{{asset("bootstrap/css/bootstrap.min.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("assets/css/plugins.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("assets/css/structure.css")}}" rel="stylesheet" type="text/css" class="structure"/>
    <link href="{{asset("assets/css/authentication/form-1.css")}}" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/forms/theme-checkbox-radio.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/forms/switches.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/elements/alert.css")}}">

</head>
<body class="form">


<div class="form-container">
    <div class="form-form">
        {{--alert--}}
        @if ($errors->any())
            <div class="widget-content widget-content-area">
                @if ($errors->any())
                    <div class="widget-content widget-content-area">
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-arrow-left alert-icon-left alert-light-primary mb-4" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <svg xmlns="http://www.w3.org/2000/svg" data-dismiss="alert" width="24" height="24"
                                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close">
                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                </button>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                     class="feather feather-bell">
                                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                    <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                                </svg>
                                <strong>هشدار!   </strong>{!! $error !!}
                            </div>
                        @endforeach
                    </div>
                @endif
                @if ($message = Session::get('success'))
                    <div class="alert alert-arrow-left alert-icon-left alert-light-primary mb-4" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <svg xmlns="http://www.w3.org/2000/svg" data-dismiss="alert" width="24" height="24"
                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                 stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-bell">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg>
                        <strong>هشدار!   </strong>{!! $message !!}
                    </div>

                @endif
                @if ($message = Session::get('error'))
                    <div class="alert alert-arrow-left alert-icon-left alert-light-primary mb-4" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <svg xmlns="http://www.w3.org/2000/svg" data-dismiss="alert" width="24" height="24"
                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                 stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-bell">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg>
                        <strong>هشدار!   </strong>{!! $message !!}
                    </div>

                @endif
            </div>
        @endif
        <div class="form-form-wrap">

            <div class="form-container">

                <div class="form-content">

                    <div class="d-flex user-meta">
                        <img src="assets/img/90x90.jpg" class="usr-profile" alt="avatar">
                        <div class="">
                            <p class="">زیلوتم</p>
                        </div>
                    </div>
                    @if(!session()->has('mobile'))
{{--                    @if(!isset($mobile))--}}
                        <form class="text-left" method="post" action="/"
                              enctype="multipart/form-data">
                            @CSRF
                            <div class="form">

                                <div id="password-field" class="field-wrapper input mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="feather feather-lock">
                                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                    </svg>
                                    <input id="mobile" name="mobile" type="text" class="form-control"
                                           placeholder="موبایل" required>
                                </div>
                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper">
                                        <button type="submit" class="btn btn-primary" value="">ورود</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @else
                        <form class="text-left" method="post" action="/code"
                              enctype="multipart/form-data">
                            @CSRF
                            <input name="mobile" value="{{session()->get('mobile')}}" >
                            <div class="form">
                                <div id="password-field" class="field-wrapper input mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="feather feather-lock">
                                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                    </svg>
                                    <input id="code" name="code" type="text" class="form-control" placeholder="کد">
                                </div>
                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper">
                                        <button type="submit" class="btn btn-primary" value="">اعتبار سنجی</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @endif
                    <p class="terms-conditions">© کپی رایت</p>

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
<script src="{{asset("assets/js/libs/jquery-3.1.1.min.js")}}"></script>
<script src="{{asset("bootstrap/js/popper.min.js")}}"></script>
<script src="{{asset("bootstrap/js/bootstrap.min.js")}}"></script>

<!-- END GLOBAL MANDATORY SCRIPTS -->
<script src="{{asset("assets/js/authentication/form-1.js")}}"></script>

</body>
</html>