@extends('management.auth.layout.master')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/pages/login.css') }}">
@endsection
@section('title', 'ورود به حساب کاربری')
@section('main-content')

    <body
        class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu preload-transitions 1-column login-bg   blank-page blank-page"
        data-open="click" data-menu="vertical-modern-menu" data-col="1-column">
        <div class="row">
            <div class="col s12">
                <div class="container">
                    <div id="login-page" class="row">
                        <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 login-card bg-opacity-8">
                            <form class="login-form" action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="input-field col s12">
                                        <h5 class="ml-4">ورود</h5>
                                    </div>
                                </div>
                                <div class="row margin">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix pt-2">person_outline</i>
                                        <input id="username" type="text" name="national">
                                        <label for="username" class="center-align">نام کاربری</label>
                                    </div>
                                </div>
                                <div class="row margin">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix pt-2">lock_outline</i>
                                        <input id="password" type="password" name="password">
                                        <label for="password">رمز عبور</label>
                                    </div>
                                </div>
{{--                                <div class="row">--}}
{{--                                    <div class="col s12 m12 l12 ml-2 mt-1">--}}
{{--                                        <p>--}}
{{--                                            <label>--}}
{{--                                                <input type="checkbox" />--}}
{{--                                                <span>مرا به خاطر بسپار</span>--}}
{{--                                            </label>--}}
{{--                                        </p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input type="submit"
                                            class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12"
                                            value="وارد شدن">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6 m6 l6">
                                        <p class="margin medium-small"><a href="{{ route('register') }}">اکنون ثبت نام
                                                کنید</a>
                                        </p>
                                    </div>
{{--                                    <div class="input-field col s6 m6 l6">--}}
{{--                                        <p class="margin right-align medium-small"><a href="user-forgot-password.html">رمز--}}
{{--                                                عبور را فراموش کرده اید؟</a></p>--}}
{{--                                    </div>--}}
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="content-overlay"></div>
            </div>
        </div>
    </body>
@endsection
