@extends('management.layout.master')
@section('add-styles')
<style>
/*@media screen and (max-width:632px)*/
/*  .darsha {*/
/*    width: 100% !important;*/
/*  }*/
/*}*/
/*@media screen and (min-width: 800px) {*/
/*  .darsha {*/
/*    width: 33% ;*/
/*  }*/
/*}*/




</style>
@endsection
@section('title', 'صفحه اصلی')
@section('main-content')
    @if(isset($courses))
    <div class="row">
        <div class="col 12 s12">

            @if (Laratrust::hasRole('teacher'))
                @include('management.layout.components.btn-loader.btn-loader' ,
                ['url' => '/dashboard/courses/create' ,
                'icon' => "<i class='material-icons dp48'>add_circle_outline</i>" ,
                'pos' => 'top' ,
                'text' => 'درس جدید'
                ])
            @endif
        </div>
    </div>

    
    <div class="container">
    </div>
    
    <div class="row" style="margin-right:10px">
        @foreach ($courses as $course)
            <div class="col s12 m4 " id="">
                <div id="profile-card" class="card">
                    <div class="card-image waves-effect waves-block waves-light">
                        <img class="activator" src="{{ asset('/files/icons/' . $course->header.'.jpg') }}" height="100%" alt="user bg">
                    </div>
                    <div class="card-content">
    {{--                                        <img src="{{ asset('/files/user/' . $course->user->image) }}" 
                        alt=""
                             class="circle responsive-img activator card-profile-image red lighten-1 padding-2 custom_teacher_profile">
--}}
                        <a class="btn-floating activator btn-move-up waves-effect waves-light red accent-2 z-depth-4 right"
                           href="/dashboard/courses/sessions?course_id={{ $course->id }}">
                            <i class="material-icons dp48">remove_red_eye</i>edit</i>
                        </a>
                        <h5 class="card-title activator grey-text text-darken-4">
                            {{ $course->name }}</h5>
        {{--                <p><i
                                class="material-icons profile-card-i">perm_identity</i>{{ $course->user->name . ' ' . $course->user->family }}
                        </p>
                        --}}
                        <p><i class="material-icons profile-card-i">perm_phone_msg</i>{{ $course->code }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @elseif(!$user->mobile)
        <div class="row">
{{--            <form class="col s12" action="/dashboard/courses/list" method="get">--}}
{{--                @csrf--}}

                <p>
                   جهت تائید حساب وارد <a href="/dashboard/user/{{$user->id}}"> پروفایل </a>شوید و موبایل را وارد کنید
                </p>
{{--                <div class="row">--}}
{{--                    <div class="input-field col s12">--}}
{{--                        <input id="code" name="code" type="text" class="validate">--}}
{{--                        <label class="contact-input" for="code">کد تائیدیه</label>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <!--<input type="submit" class="btn btn-primary btn-block" value="تائید">-->
{{--            </form>--}}
        </div>
    @else
        <div class="row">
            <form class="col s12" action="/dashboard/courses/list" method="get">
                @csrf

                <p>
                    کد تائیدیه sms شده را وارد کنید
                </p>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="code" name="code" type="text" class="validate">
                        <label class="contact-input" for="code">کد تائیدیه</label>
                    </div>
                </div>
                <input type="submit" class="btn btn-primary btn-block" value="تائید">
            </form>
        </div>
    @endif
@endsection
@section('js')

@endsection
