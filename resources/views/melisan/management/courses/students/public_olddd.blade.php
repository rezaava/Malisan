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


/*progress bar circle*/
.circular {
    height: 100px;
    width: 100px;
    position: relative;
    margin:auto;
}
.circular .inner {
    position: absolute;
    z-index: 6;
    top: 50%;
    left: 50%;
    height: 80px;
    width: 80px;
    margin: -40px 0 0 -40px;
    background: #EEEEEE;
    border-radius: 100%;
}
.circular .number {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 10;
    font-size: 18px;
    font-weight: 500;
    color: #4158D0;
}
.circular .bars {
    position: absolute;
    height: 100%;
    width: 100%;
    background: #fff;
    -webkit-border-radius: 100%;
    clip: rect(0px, 100px, 100px, 50px);
}
.circle .bars .progress {
    position: absolute;
    height: 100%;
    width: 100%;
    -webkit-border-radius: 100%;
    clip: rect(0px, 50px, 100px, 0px);
    background: #4158D0;
}
.circle .left .progress {
    z-index: 1;
    animation: left 2s linear both;
}
.circle .right .progress {
    animation: right 2s linear both;
    animation-delay: 2s;
}
.circle .right {
    transform: rotate(180deg);
    z-index: 3;
}
/*if need to set value 0deg to 180deg then change rotate value form left @keyframe*/
@keyframes left {
    100% {
        transform: rotate(180deg);
    }
}
/*if need to set value 180deg to 360deg then change rotate value form right @keyframe*/
/*value start form 180deg +
rotate(0deg)*/
@keyframes right {
    100% {
        transform: rotate(0deg);
    }
}

/*progress bar horizontal*/
.loader {
    width: 100%;
    height: 10px;
    background: #E1E4E8;
    border-radius: 3px;
    overflow: hidden;
}
.loader .loader-bar {
    display: block;
    height: 100%;
    background-size: 300% 100%;
    /*width: 35%;*/
    /*animation: progress-animation 3s normal forwards;*/
    background-color: #5A67F2;
}
/*@keyframes progress-animation {*/
/*    0% {*/
/*        width: 0;*/
/*    }*/
/*    100% {*/
/*        width: 68%;*/
/*    }*/
/*}*/

/*progress bar circle using style attribute*/
.circle-progress {
    width: 150px;
    height: 150px;
    line-height: 150px;
    background: none;
    margin: 0 auto;
    box-shadow: none;
    position: relative;
}

.circle-progress:after {
    content: "";
    width: 90%;
    height: 90%;
    border-radius: 50%;
    border: 7px solid #ddd;
    position: absolute;
    top: 0;
    left: 0;
}

.circle-progress > span {
    width: 50%;
    height: 100%;
    overflow: hidden;
    position: absolute;
    top: 0;
    z-index: 1;
}

.circle-progress .circle-progress-left {
    left: 0;
}

.circle-progress .circle-progress-bar {
    width: 90%;
    height: 90%;
    background: none;
    border-width: 7px;
    border-style: solid;
    position: absolute;
    top: 0;
}

.circle-progress .circle-progress-left .circle-progress-bar {
    left: 100%;
    border-top-right-radius: 75px;
    border-bottom-right-radius: 75px;
    border-left: 0;
    -webkit-transform-origin: center left;
    transform-origin: center left;
}

.circle-progress .circle-progress-right {
    right: 0;
}

.circle-progress .circle-progress-right .circle-progress-bar {
    left: -100%;
    border-top-left-radius: 75px;
    border-bottom-left-radius: 75px;
    border-right: 0;
    -webkit-transform-origin: center right;
    transform-origin: center right;
}

.circle-progress .circle-progress-value {
    display: flex;
    border-radius: 50%;
    font-size: 36px;
    text-align: center;
    line-height: 20px;
    align-items: center;
    justify-content: center;
    height: 100%;
    font-weight: 300;
}

.circle-progress .circle-progress-value div {
    margin-top: 10px;
}

.circle-progress .circle-progress-value span {
    font-size: 12px;
    text-transform: uppercase;
}



</style>
@endsection
@section('title', 'صفحه اصلی')
@section('main-content')
    @if(isset($courses))
    <div class="row">
        <div class="col 12 s12">

            @if ($user->hasRole('teacher'))
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

    <div class="container">
    </div>

    <div class="row" style="margin-right:10px">
        @foreach ($courses as $course)

            <div class="col-md-4">
                <div class="card horizontal border-radius-6">
                    <div class="card-image ">
                        <img class="responsive-img height " src="{{ asset('/files/icons/' . $course->header.'.jpg') }}" alt="">
                    </div>
                    <div class="card-stacked">
                        <div class="card-content pl-2 pt-2 pr-2 pb-2">
                            <h6><a href="#" class="mt-5">{{$course->name}}</a></h6>
                            <!-- <p onmouseenter="this.innerHTML='{{$course->desc , 50}}'" onmouseleave="this.innerHTML='{{\Illuminate\Support\Str::limit($course->desc,50)}}'">
                                 {{\Illuminate\Support\Str::limit($course->desc,50)}}

                            </p> -->
                            <p> اینجا تگ هست</p>
                            <div class="mt-5 p-3 m-3">
                                <div class=" s7 p-0 mt-5">
                                    <a href="/dashboard/courses/sessions?course_id={{ $course->id }}"><span class="ml-1 vertical-align-top">کد درس:</span></a>
                                    <span class="ml-1 vertical-align-top">{{$course->code}}</span>
                                </div>
                                <div class=" s7 p-0 mt-1">
                                    <a href="/dashboard/courses/sessions?course_id={{ $course->id }}"><span class="ml-1 vertical-align-top">تعداد جلسه:</span></a>

                                    <span class="ml-1 vertical-align-top">{{$course->sessions_length}}</span>
                                </div>
                                <div class=" s7 p-0 mt-1">
                                    <a href="/dashboard/courses/sessions?course_id={{ $course->id }}"><span class="ml-1 vertical-align-top">طول دوره(روز):</span></a>

                                    <span class="ml-1 vertical-align-top">{{$course->length}}</span>
                                </div>
                                <div class="s7 p-0 mt-1">
                                    <a href="/dashboard/courses/sessions?course_id={{ $course->id }}"><span class="ml-1 vertical-align-top">هزینه(تومان):</span></a>

                                    <span class="ml-1 vertical-align-top">{{$course->price}}</span>
                                </div>
                                <div class=" s7 p-0 mt-1">
{{--                                    <a href="#"><span class="ml-1 vertical-align-top">توضیح:</span></a>--}}

                                    <span class="ml-1 vertical-align-top"> @if($course->type==1)
                                            آموزش زبان
                                        @elseif($course->type==2)
                                            مهارت آموزی
                                        @elseif($course->type==3)
                                            آزمون های بسندگی
                                        @elseif($course->type==4)
                                            هنر آموزی
                                        @elseif($course->type==5)
                                            آموزش های عمومی
                                        @else
                                            <br>
                                        @endif</span>
                                </div>

                                <div class="bar-container">
                                    <div class="loader" style="width: {{$course['activated']}}">
                                        <span class="loader-bar" style="width: {{$course['activated']}}%"></span>
                                    </div>
                                </div>



                            </div>
                        </div>
                        <div class="card-action pt-4 pb-3 center-align ">
                            <div class="row mt-4">
                                <div class=" s7 mt-1 center-align ">
                                    <a
                                        href="/dashboard/courses/sessions?course_id={{ $course->id }}"
                                        class="waves-effect waves-light card-width btn gradient-45deg-light-blue-cyan box-shadow-none border-round mr-1 mb-1">مشاهده </a>
                                </div>
                            </div>
                        </div>
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
