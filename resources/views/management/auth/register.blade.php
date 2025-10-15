@extends('management.auth.layout.master')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/pages/register.min.css') }}">
@endsection
@section('title', 'ایجاد حساب کاربری')
@section('main-content')

    <body
        class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu preload-transitions 1-column register-bg   blank-page blank-page"
        data-open="click" data-menu="vertical-modern-menu" data-col="1-column">
        <div class="row">
            <div class="col s12">
                <div class="container">
                    <div id="register-page" class="row">
                        <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 register-card bg-opacity-8">
                            <form class="login-form" method="post"  action="register"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="input-field col s12">
                                        <h5 class="ml-4">ثبت نام</h5>
                                        <p class="ml-4">اکنون به  ما بپیوندید!</p>
                                    </div>
                                </div>
                                <div class="row margin">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix pt-2">person_outline</i>
                                        <input id="name" name="name" type="text" required>
                                        <label for="name" class="center-align">نام </label>
                                    </div>
                                </div>
                                <div class="row margin">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix pt-2">person_outline</i>
                                        <input id="family" name="family" type="text" required>
                                        <label for="family" class="center-align">فامیل </label>
                                    </div>
                                </div>
                                <div class="row margin">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix pt-2">person_outline</i>
                                        <input id="national"  pattern="[0-9]{10}"  name="national" type="text" placeholder="1234567890" required>
                                        <label for="national" class="center-align">کد ملی </label>
                                    </div>
                                </div>
 <div class="row margin">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix pt-2">person_outline</i>
                                        <input id="mobile" pattern="[0-9]{11}"   name="mobile" type="text" placeholder="09123456789" required>
                                        <label for="national" class="center-align">موبایل </label>
                                    </div>
                                </div>
                                <div class="row margin">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix pt-2">lock_outline</i>
                                        <input id="password" name="password" type="password">
                                        <label for="password">رمز عبور</label>
                                    </div>
                                </div>
                                <div class="form-group @if ($errors->has('type')) has-error @endif" hidden>
                                    @if (\Route::current()->getName() == 'global')
                                        <input type="radio" id="teacher" name="type" checked value="1">
                                        <label for="teacher">استاد</label>
                                    @else
                                        <input type="radio" id="student" name="type" checked value="2">
                                        <label for="student">دانشجو</label>
                                    @endif

                                </div>
                                <div class="row">
                                   <button type="submit" class="input-field col s12 
                                   btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12
                                   "
                                    style="color: #fff"
                                    >
                                    
                                    ثبت نام
                                        <!--<input type="submit"-->
                                        <!--    class=""-->
                                        <!--    value="ثبت نام" style="color: #fff">-->
                                 
                                    </button>
                                </div>

                                <div class="row">
                                    <div class="input-field col s12">
                                        <p class="margin medium-small"><a href="{{ route('login') }}">از قبل حساب دارید؟
                                                وارد
                                                شوید</a></p>
                                    </div>
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
