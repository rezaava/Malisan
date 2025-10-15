{{--@extends('auth.layout.app')--}}
{{--@section('title','ثبت نام/ورود')--}}
{{--@section('content')--}}
{{--    <!-- Loader ends-->--}}
{{--    <!-- page-wrapper Start-->--}}
{{--    <div class="page-wrapper">--}}
{{--        <div class="container-fluid p-0">--}}
{{--            <!-- login page with video background start-->--}}
{{--            <div class="auth-bg-video">--}}
{{--                <video id="bgvid" poster="{{'/cuba-style/assets/images/other-images/coming-soon-bg.jpg'}}"--}}
{{--                       playsinline="" autoplay="" muted="" loop="">--}}
{{--                    <source src="http://admin.pixelstrap.com/cuba/assets/video/auth-bg.mp4" type="video/mp4">--}}
{{--                </video>--}}
{{--                <div class="authentication-box">--}}
{{--                    <div class="mt-4">--}}
{{--                        <div class="card-body" >--}}
{{--                            <div class="cont text-center" style="height: 450px">--}}
{{--                                <div>--}}
{{--                                    <form class="theme-form" method="post" action="login">--}}
{{--                                        @csrf--}}
{{--                                        @if (session()->has('error'))--}}
{{--                                            <div class="alert alert-danger"--}}
{{--                                                 role="alert">{{ session()->get('error') }}</div>--}}
{{--                                        @endif--}}
{{--                                        <h4>ورود</h4>--}}
{{--                                        <h6>نام کاربری و رمز عبور خود را وارد کنید</h6>--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label class="col-form-label pt-0" style="float: right">:نام کاربری</label>--}}
{{--                                            <input class="form-control" type="text" required="" name="email">--}}
{{--                                        </div>--}}

{{--                                        <div class="form-group">--}}
{{--                                            <label class="col-form-label" style="float: right">:رمز عبور</label>--}}
{{--                                            <input class="form-control" type="password" name="password" required="">--}}
{{--                                        </div>--}}
{{--                                        <div class="container">--}}
{{--                                            <input type="checkbox">--}}
{{--                                            <label>مرا به خاطر بسپار</label>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-group row mt-3 mb-0">--}}
{{--                                            <button class="btn btn-primary btn-block" type="submit">ورود</button>--}}
{{--                                        </div>--}}
{{--                                                                            <div class="social mt-3">--}}
{{--                                                                                <div class="row btn-showcase">--}}
{{--                                                                                    <div class="col-md-4 col-sm-6">--}}
{{--                                                                                        <button class="btn social-btn btn-fb">Facebook</button>--}}
{{--                                                                                    </div>--}}
{{--                                                                                    <div class="col-md-4 col-sm-6">--}}
{{--                                                                                        <button class="btn social-btn btn-twitter">Twitter</button>--}}
{{--                                                                                    </div>--}}
{{--                                                                                    <div class="col-md-4 col-sm-6">--}}
{{--                                                                                        <button class="btn social-btn btn-google">Google + </button>--}}
{{--                                                                                    </div>--}}
{{--                                                                                </div>--}}
{{--                                                                            </div>--}}
{{--                                    </form>--}}
{{--                                </div>--}}
{{--                                <div class="sub-cont">--}}
{{--                                    <div class="img">--}}
{{--                                        <div class="img__text m--up">--}}
{{--                                            <h2>کاربر جدید؟</h2>--}}
{{--                                            <p>ثبت نام کنید و فرصت های جدید را کشف کنید</p>--}}
{{--                                        </div>--}}
{{--                                        <div class="img__text m--in">--}}
{{--                                            <h2>یکی از ما؟</h2>--}}
{{--                                            <p>اگر قبلاً حساب کاربری دارید ، فقط وارد سیستم شوید. دلتنگ شما شده ایم!</p>--}}
{{--                                        </div>--}}
{{--                                        <div class="img__btn" style="margin-top: -5%"><span--}}
{{--                                                    class="m--up">ثبت نام</span><span class="m--in">ورود</span></div>--}}
{{--                                    </div>--}}
{{--                                    <div>--}}
{{--                                        <form method="post" class="theme-form" action="register"--}}
{{--                                              enctype="multipart/form-data">--}}
{{--                                            @csrf--}}
{{--                                            <h4 class="text-center">کاربر جدید</h4>--}}
{{--                                            <h6 class="text-center">نام کاربری و رمز ورود خود را برای ثبت نام وارد--}}
{{--                                                کنید</h6>--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <input type="radio" id="teacher" name="type" value="1">--}}
{{--                                                    <label for="teacher">استاد</label>--}}
{{--                                                    <input type="radio" id="student" name="type" value="2">--}}
{{--                                                    <label for="student">دانشجو</label>--}}

{{--                                                </div>--}}
{{--                                                    <div class="form-group @if ($errors->has('name')) has-error @endif">--}}
{{--                                                        <input class="form-control" type="text" dir="rtl"--}}
{{--                                                               placeholder="نام" name="name" >--}}
{{--                                                    </div>--}}
{{--                                            <span class="text-danger" id="name"--}}
{{--                                                  style="color: red;">{{$errors->first('name')}}</span>--}}

{{--                                            <div class="form-group @if ($errors->has('email')) has-error @endif">--}}
{{--                                                <input class="form-control" type="text" dir="rtl" placeholder="ایمیل"--}}
{{--                                                       name="email" >--}}
{{--                                            </div>--}}
{{--                                            <span class="text-danger" id="name"--}}
{{--                                                  style="color: red;">{{$errors->first('email')}}</span>--}}

{{--                                            <div class="form-group @if ($errors->has('password')) has-error @endif">--}}
{{--                                                <input class="form-control" type="password" dir="rtl"--}}
{{--                                                       placeholder="رمزعبور" name="password" >--}}
{{--                                            </div>--}}
{{--                                            <span class="text-danger" id="name"--}}
{{--                                                  style="color: red;">{{$errors->first('password')}}</span>--}}
{{--                                            <div class="row">--}}
{{--                                                <div class="col-sm-4">--}}
{{--                                                    <button class="btn btn-primary" type="submit">--}}
{{--                                                        ثبت نام--}}
{{--                                                    </button>--}}
{{--                                                </div>--}}
{{--                                                <div class="col-sm-8">--}}
{{--                                                    <div class="text-left mt-2 m-l-20">قبلا ثبت نام کرده اید؟ <a--}}
{{--                                                                class="btn-link text-capitalize"--}}
{{--                                                                href="login.html">ورود</a></div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}

{{--                                        </form>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!-- login page with video background end-->--}}
{{--        </div>--}}

{{--    </div>--}}
{{--    <!-- latest jquery-->--}}
{{--@endsection--}}
{{--<!-- login js-->--}}
{{--<!-- Plugin used-->--}}


@extends('auth.layout.app')
@section('title','ثبت نام/ورود')
<!-- Loader ends-->
<!-- page-wrapper Start-->
@section('content')

    <div class="page-wrapper">
        <div class="container-fluid p-0">
            <!-- login page with video background start-->
            <div class="auth-bg-video">
                <video id="bgvid" poster="../assets/images/other-images/coming-soon-bg.jpg" playsinline="" autoplay=""
                       muted="" loop="">
                    <source src="http://admin.pixelstrap.com/cuba/assets/video/auth-bg.mp4" type="video/mp4">
                </video>
                <div class="authentication-box">
                    <div class="mt-4">
                        <div class="card-body">
                            <div class="cont text-center">
                                <div>
                                    <form class="theme-form" method="post" action="login">
                                        @csrf
                                        @if (session()->has('error'))
                                            <div class="alert alert-danger"
                                                 role="alert">{{ session()->get('error') }}</div>
                                        @endif
                                        <h4>ورود</h4>
                                        <h6>نام کاربری و رمز عبور خود را وارد کنید</h6>
                                        <div class="form-group">
                                            <label class="col-form-label pt-0" style="float: right">:نام کاربری</label>
                                            <input class="form-control" type="text" required="" name="email">
                                        </div>

                                        <div class="form-group">
                                            <label class="col-form-label" style="float: right">:رمز عبور</label>
                                            <input class="form-control" type="password" name="password" required="">
                                        </div>
                                        <div class="container">
                                            <input type="checkbox">
                                            <label>مرا به خاطر بسپار</label>
                                        </div>
                                        <div class="form-group row mt-3 mb-0">
                                            <button class="btn btn-primary btn-block" type="submit">ورود</button>
                                        </div>
                                        <div class="social mt-3">
                                            <div class="row btn-showcase">
                                                <div class="col-md-4 col-sm-6">
                                                    <div class="btn social-btn btn-fb">Facebook</div>
                                                </div>
                                                <div class="col-md-4 col-sm-6">
                                                    <div class="btn social-btn btn-twitter">Twitter</div>
                                                </div>
                                                <div class="col-md-4 col-sm-6">
                                                    <div class="btn social-btn btn-google">Google +</div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="sub-cont">
                                    <div class="img">
                                        <div class="img__text m--up">
                                            <h2>کاربر جدید؟</h2>
                                            <p>ثبت نام کنید و فرصت های جدید را کشف کنید</p>
                                        </div>
                                        <div class="img__text m--in">
                                            <h2>یکی از ما؟</h2>
                                            <p>اگر قبلاً حساب کاربری دارید ، فقط وارد سیستم شوید. دلتنگ شما شده ایم!</p>
                                        </div>
                                        <div class="img__btn" style="margin-top: -10%">
                                            <span class="m--up">ورود</span><span class="m--in">ثبت نام</span>
                                        </div>

                                    </div>
                                    <div>

                                        <form method="post" class="theme-form" action="register"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <h4 class="text-center">کاربر جدید</h4>
                                            <h6 class="text-center">نام کاربری و رمز ورود خود را برای ثبت نام وارد
                                                کنید</h6>
                                            <div class="form-group @if ($errors->has('type')) has-error @endif">
                                                @if (\Route::current()->getName() == 'global')
                                                    <input type="radio" id="teacher" name="type" checked value="1">
                                                    <label for="teacher">استاد</label>
                                                @else
                                                    <input type="radio" id="student" name="type" checked value="2">
                                                    <label for="student">دانشجو</label>
                                                @endif

                                            </div>
                                            <span class="text-danger" id="name"
                                                  style="color: red;">{{$errors->first('type')}}</span>
                                            <div class="form-group @if ($errors->has('name')) has-error @endif">
                                                <input class="form-control" type="text" dir="rtl"
                                                       placeholder="نام" name="name">
                                            </div>
                                            <span class="text-danger" id="name"
                                                  style="color: red;">{{$errors->first('name')}}</span>

                                            <div class="form-group @if ($errors->has('family')) has-error @endif">
                                                <input class="form-control" type="text" dir="rtl"
                                                       placeholder="فامیل" name="family">
                                            </div>
                                            <span class="text-danger" id="family"
                                                  style="color: red;">{{$errors->first('family')}}</span>

                                            <div class="form-group @if ($errors->has('email')) has-error @endif">
                                                <input class="form-control" type="text" dir="rtl" placeholder="ایمیل"
                                                       name="email">
                                            </div>
                                            <span class="text-danger" id="name"
                                                  style="color: red;">{{$errors->first('email')}}</span>

                                            <div class="form-group @if ($errors->has('password')) has-error @endif">
                                                <input class="form-control" type="password" dir="rtl"
                                                       placeholder="رمزعبور(حداقل 8 کاراکتر)" name="password">
                                            </div>
                                            <span class="text-danger" id="name"
                                                  style="color: red;">{{$errors->first('password')}}</span>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <button class="btn btn-primary" type="submit">
                                                        ثبت نام
                                                    </button>
                                                </div>

                                            </div>
                                            {{--                                        <div class="social mt-3">--}}
                                            {{--                                            <div class="row btn-showcase">--}}
                                            {{--                                                <div class="col-sm-4">--}}
                                            {{--                                                    <button class="btn social-btn btn-fb">Facebook</button>--}}
                                            {{--                                                </div>--}}
                                            {{--                                                <div class="col-sm-4">--}}
                                            {{--                                                    <button class="btn social-btn btn-twitter">Twitter</button>--}}
                                            {{--                                                </div>--}}
                                            {{--                                                <div class="col-sm-4">--}}
                                            {{--                                                    <button class="btn social-btn btn-google">Google +</button>--}}
                                            {{--                                                </div>--}}
                                            {{--                                            </div>--}}
                                            {{--                                        </div>--}}
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- login page with video background end-->
        </div>
    </div>
@endsection

