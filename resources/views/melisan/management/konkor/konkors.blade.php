@extends('melisan.layout.master')
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
@if(isset($konkors))

<div class="container mb-5">


    <div class="row" style="margin-right:10px">
        @foreach ($konkors as $course)
        @if($course['joined']==1)
        <div class="col-md-4 mt-3">
            <div class="card blue-grey darken-4 bg-image-1">
                <div class="card-content white-text">
                    <span class="card-title font-weight-400 mb-10">{{$course->dars}}

                        <i
                            class="material-icons" style="color: red">favorite</i>
                    </span>
                    <p>
                        {{$course->reshte}}
                        <br />
                        {{$course->gerayesh}}

                    </p>
                    <div class="border-non">
                        <a
                            href="/dashboard/konkor/enter?id={{ $course->id }}"
                            class="waves-effect waves-light btn-konkor red border-round box-shadow"> ورود به آزمون</a>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endforeach
        @foreach ($konkors as $course)
        @if($course['joined']==0)
        <div class="col-md-4 mt-3" style="box-sizing: border-box;">
            <div class="card blue-grey darken-4 bg-image-1">
                <div class="card-content white-text">
                    <span class="card-title font-weight-400 mb-10">{{$course->dars}}</span>
                    <p>
                        {{$course->reshte}}
                        <br />
                        {{$course->gerayesh}}
                    </p>
                    <div class="border-non mt-5">
                        <a
                            href="/dashboard/konkor/enter?id={{ $course->id }}"
                            class="waves-effect waves-light btn-konkor red border-round box-shadow"> ورود به آزمون</a>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
</div>
@elseif(!$user->mobile)
<div class="row">
    {{-- <form class="col s12" action="/dashboard/courses/list" method="get">--}}
    {{-- @csrf--}}

    <p>
        جهت تائید حساب وارد <a href="/dashboard/user/{{$user->id}}"> پروفایل </a>شوید و موبایل را وارد کنید
    </p>
    {{-- <div class="row">--}}
    {{-- <div class="input-field col s12">--}}
    {{-- <input id="code" name="code" type="text" class="validate">--}}
    {{-- <label class="contact-input" for="code">کد تائیدیه</label>--}}
    {{-- </div>--}}
    {{-- </div>--}}
    <!--<input type="submit" class="btn btn-primary btn-block" value="تائید">-->
    {{-- </form>--}}
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