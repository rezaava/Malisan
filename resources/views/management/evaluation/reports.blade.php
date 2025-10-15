@extends('management.layout.master')
@section('add-styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/pages/page-account-settings.min.css') }}">
    <style>
        .carousel-item.active{
            z-index: 100 !important;
        }
    </style>
@endsection
@section('title', 'ارزیابی')
@section('main-content')
    <div class="row">
        <div class="col s12 m12 l12">
            <div id="swipeable-tabs" class="card card card-default scrollspy">
                <div class="card-content">
                    {{--                    <h4 class="header">میخوام یه آمار از عملکردت بهت بدم</h4>--}}
                    <section class="tabs-vertical mt-1 section">
                        <div class="col l3 s12 mt-3">
                            <!-- tabs  -->
                            <div class="card-panel">
                                <ul class="tabs">
                                    <a class="custom-main-tab-link"
                                       href="/dashboard/evaluation?course_id={{$course->id}}&&page=questions"
                                    >
                                        <li class="btn btn-block mb-2">

                                            <i class="material-icons dp48">record_voice_over</i>
                                            @if (Laratrust::hasRole('teacher'))
                                                سوالات({{ $q_not }})
                                            @else
                                                سوالات
                                            @endif
                                        </li>
                                    </a>
                                    <a class="custom-main-tab-link" href="/dashboard/evaluation?course_id={{$course->id}}&&page=reports"
                                    >
                                        <li class="btn btn-block mb-2">

                                            <i class="material-icons dp48">record_voice_over</i>
                                            @if (Laratrust::hasRole('teacher'))
                                                گزارش({{ $d_not }})
                                            @else
                                                گزارش
                                            @endif
                                        </li>
                                    </a>
                                    <a @if (Laratrust::hasRole('teacher')) href="/dashboard/evaluation?course_id={{$course->id}}&&page=operator" @endif
                                    class="custom-main-tab-link"

                                    >
                                        <li class="btn btn-block mb-2" @if (Laratrust::hasRole('student')) disabled @endif>

                                            <i class="material-icons dp48">work</i>
                                            @if (Laratrust::hasRole('teacher'))
                                                تکلیف({{ $e_not }})
                                            @else
                                                تکلیف(بزودی)
                                            @endif
                                        </li>
                                    </a>
                                    <li class="tab" style="visibility: hidden">
                                        <a  class="custom-main-tab-link"  >

                                        </a>
                                    </li>
                                    <li class="indicator" style="left: 0px; right: 0px;"></li>
                                </ul>                            </div>
                        </div>
                    </section>

                    <div class="row d-flex">
                        <div class="col s12">
                            <ul id="tabs-swipe-demo" class="tabs">
                                <li class="tab col-md-3 m4 custom_active_tabes">
                                    <a href="#test-swipe-1" class=" custom-main-tab-link custom_actuality_tab">
                                        در حال داوری({{ $d_not }})
                                    </a>
                                </li>
                                @if ( Route::current()->getName() != 'referee')
                                    {{--                                    <li class="tab col-md-3 m4 custom_active_tabes">--}}
                                    {{--                                        <a class="custom-main-tab-link custom_actuality_tab" href="#test-swipe-2">همه</a>--}}
                                    {{--                                    </li>--}}
                                    <li class="tab col-md-3 m4 custom_active_tabes">
                                        <a class="active custom-main-tab-link custom_actuality_tab" href="#test-swipe-3">تایید
                                            شده({{$d_ok}})</a>
                                    </li>
                                    <li class="tab col-md-3 m4 custom_active_tabes">
                                        <a class="custom-main-tab-link custom_actuality_tab" href="#test-swipe-4">تایید
                                            نشده({{$d_bad}})</a>
                                    </li>
                                    @if(Laratrust::hasRole('student') )
                                        <li class="tab col-md-3 m4 custom_active_tabes">
                                            <a class="custom-main-tab-link custom_actuality_tab" href="#test-swipe-5">نیازمند
                                                اصلاح({{ $d_ret }})</a>
                                        </li>
                                    @endif
                                @endif
                                <li class="indicator" style="left: 15px; right: 1039px;"></li>
                            </ul>
                            <div class="tabs-content carousel carousel-slider">
                                <div id="test-swipe-1" class="col s12 carousel carousel-item"
                                     style="overflow:scroll !important;z-index: -1; opacity: 0.058505; visibility: visible; transform: translateX(0px) translateX(-2257.6px) translateZ(0px);">
                                    {{--                                    <div class="quetion_container z-depth-5"></div>--}}
                                    {{--                                    <div class="col s12 mt-1 custom_question_wrapper">--}}
                                    @foreach ($discs_not as $disc)
                                        <small class="question_title">جلسه {{ $disc->session->number }}
                                            : {{ $disc->session->name }}</small>
                                        <h6>{!! $disc->text !!}</h6>
                                        @if (Laratrust::hasRole('teacher'))
                                            @if (count($disc['nazar']) > 0)
                                                @foreach ($disc['nazar'] as $key => $nazar)
                                                    <span
                                                         style="color: blue; margin-bottom: 10px; @if($nazar->score==1)
                                                             color:green;
                                                         @elseif($nazar->score==2)
                                                             color:red;
                                                         @endif">
                                                        داور {{ $key + 1 }}
                                                        ({{ $nazar->user }}):
                                                        @if ($nazar->comment)
                                                            , {{ $nazar->comment }}
                                                        @endif
                                                    </span>
                                                @endforeach
                                            @endif
                                        @endif
                                        @if (Laratrust::hasRole('teacher'))
                                            <div class=" col-md-3">
                                                <form method="post"
                                                      action="{{ '/dashboard/discussion/scoring?disc_id=' . $disc->id }}"
                                                      enctype="multipart/form-data">
                                                    @csrf
                                                    <h6 style="font-size: 14px">امتیاز</h6>
                                                    <div class="col">
                                                        <label
                                                            class="new-control new-checkbox checkbox-success"
                                                            style="height: 21px; margin-bottom: 0; margin-right: 0">
                                                            <input type="radio" class="new-control-input"
                                                                   name="score"
                                                                   value="1" {{$disc->status == 1 ? "checked":''}}
                                                            >
                                                            <span class="new-control-indicator">عالی</span>
                                                        </label>

                                                        <label
                                                            class="new-control new-checkbox checkbox-success"
                                                            style="height: 21px; margin-bottom: 0; margin-right: 0">
                                                            <input type="radio" class="new-control-input"
                                                                   name="score"
                                                                   value="2" {{$disc->status == 2 ? "checked":''}}
                                                            >
                                                            <span class="new-control-indicator">خوب</span>
                                                        </label>

                                                        <label
                                                            class="new-control new-checkbox checkbox-success"
                                                            style="height: 21px; margin-bottom: 0; margin-right: 0">
                                                            <input type="radio" class="new-control-input"
                                                                   name="score"
                                                                   value="3" {{$disc->status == 3 ? "checked":''}}
                                                            >
                                                            <span class="new-control-indicator">متوسط</span>
                                                        </label>

                                                        <label
                                                            class="new-control new-checkbox checkbox-success"
                                                            style="height: 21px; margin-bottom: 0; margin-right: 0">
                                                            <input type="radio" class="new-control-input"
                                                                   name="score"
                                                                   value="4" {{$disc->status == 4 ? "checked":''}}
                                                            >
                                                            <span class="new-control-indicator">بد</span>
                                                        </label>
                                                        {{--                                                        <input type="radio" id="awli" name="score" value="1"--}}
                                                        {{--                                                               {{ $disc->status == 1 ? 'checked' : '' }} required>--}}
                                                        {{--                                                        <label for="awli">عالی</label><br>--}}
                                                        {{--                                                        <input type="radio" id="khob" name="score" value="2"--}}
                                                        {{--                                                            {{ $disc->status == 2 ? 'checked' : '' }}>--}}
                                                        {{--                                                        <label for="khob">خوب</label><br>--}}
                                                        {{--                                                        <input type="radio" id="motevaset" name="score" value="3"--}}
                                                        {{--                                                            {{ $disc->status == 3 ? 'checked' : '' }}>--}}
                                                        {{--                                                        <label for="motevaset">متوسط</label><br>--}}
                                                        {{--                                                        <input type="radio" id="bad" name="score" value="4"--}}
                                                        {{--                                                            {{ $disc->status == 4 ? 'checked' : '' }}>--}}
                                                        {{--                                                        <label for="bad">ضعیف</label><br>--}}

                                                    </div>
                                                    <div class="form-group @if ($errors->has('disc')) has-error @endif">
                                                        <h6 style="font-size: 13px">توصیه به
                                                            دانشجو</h6>
                                                        <div class="input-group mb-3">
                                                            <div class="col-lg-12">
                                                                    <textarea class="form-control btn-square" name="comment"
                                                                              id="comment"
                                                                              minlength="5">@if (isset($disc)){{ $disc->comment }}@endif</textarea>
                                                            </div>
                                                        </div>
                                                        <span class="text-danger" id="comment"
                                                              style="color: red;">{{ $errors->first('$disc') }}</span>
                                                    </div>
                                                    <div class="card-footer">
                                                        <button class="btn btn-primary" type="submit">
                                                            ثبت
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        @endif

                                        @if (Route::current()->getName() == 'referee')
                                            <div class=" col-md-5">
                                                <form method="post"
                                                      action="{{ '/dashboard/discussion/scoring?disc_id=' . $disc->id }}"
                                                      enctype="multipart/form-data">
                                                    @csrf
                                                    <label>ایراد های
                                                        گزارش</label>
                                                    <div class="col">

                                                        <input type="radio" id="awli" name="score" value="1" required>
                                                        <label for="awli">
                                                            نیازمند اصلاح : مشکل نگارشی
                                                        </label><br>
                                                        <input type="radio" id="khob" name="score" value="2">
                                                        <label for="khob">
                                                            نیازمند اصلاح : فاقد محتوای
                                                            آموزشی
                                                        </label><br>
                                                        <input type="radio" id="motevaset" name="score" value="3">
                                                        <label for="motevaset">گزارش خوب
                                                            نوشته شده است</label><br>
                                                        <input type="radio" id="bad" name="score" value="4">
                                                        <label for="bad"> بدون ذکر
                                                            منبع از جای دیگری کپی شده
                                                        </label><br>

                                                    </div>
                                                    <div class="form-group @if ($errors->has('disc')) has-error @endif">
                                                        <label>ذکر دلیل </label>
                                                        <div class="input-group mb-3">
                                                            <div class="col-lg-12">
                                                                    <textarea class="form-control btn-square" name="comment"
                                                                              id="comment" minlength="5"
                                                                              required>@if (isset($disc)){{ $disc->comment }}@endif</textarea>
                                                            </div>
                                                        </div>
                                                        <span class="text-danger" id="comment"
                                                              style="color: red;">{{ $errors->first('$disc') }}</span>
                                                    </div>
                                                    <div class="card-footer">
                                                        <button class="btn btn-primary" type="submit">
                                                            ثبت
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        @endif
                                    @endforeach
                                    {{--                                    </div>--}}
                                </div>
                                <div id="test-swipe-2" class="col s12 carousel carousel-item"
                                     style="overflow:scroll !important;transform: translateX(0px) translateX(-1535px) translateZ(0px); z-index: -1; opacity: 1; visibility: visible;">
                                    {{--                                    <div class="quetion_container z-depth-5"></div>--}}
                                    {{--                                    <div class="col s12 mt-1 custom_question_wrapper">--}}
                                    @foreach ($discs as $disc)
                                        <small class="question_title">جلسه {{ $disc->session->number }}
                                            : {{ $disc->session->name }}</small>
                                        <h6>{!! $disc->text !!}</h6>
                                   
                                   @if (Laratrust::hasRole('teacher'))
                                            <div class=" col-md-3">
                                                <form method="post"
                                                      action="{{ '/dashboard/discussion/scoring?disc_id=' . $disc->id }}"
                                                      enctype="multipart/form-data">
                                                    @csrf
                                                    <h6 style="font-size: 14px">امتیاز</h6>
                                                    <div class="col">
                                                        <label
                                                            class="new-control new-checkbox checkbox-success"
                                                            style="height: 21px; margin-bottom: 0; margin-right: 0">
                                                            <input type="radio" class="new-control-input"
                                                                   name="score"
                                                                   value="1" {{$disc->status == 1 ? "checked":''}}
                                                            >
                                                            <span class="new-control-indicator">عالی</span>
                                                        </label>

                                                        <label
                                                            class="new-control new-checkbox checkbox-success"
                                                            style="height: 21px; margin-bottom: 0; margin-right: 0">
                                                            <input type="radio" class="new-control-input"
                                                                   name="score"
                                                                   value="2" {{$disc->status == 2 ? "checked":''}}
                                                            >
                                                            <span class="new-control-indicator">خوب</span>
                                                        </label>

                                                        <label
                                                            class="new-control new-checkbox checkbox-success"
                                                            style="height: 21px; margin-bottom: 0; margin-right: 0">
                                                            <input type="radio" class="new-control-input"
                                                                   name="score"
                                                                   value="3" {{$disc->status == 3 ? "checked":''}}
                                                            >
                                                            <span class="new-control-indicator">متوسط</span>
                                                        </label>

                                                        <label
                                                            class="new-control new-checkbox checkbox-success"
                                                            style="height: 21px; margin-bottom: 0; margin-right: 0">
                                                            <input type="radio" class="new-control-input"
                                                                   name="score"
                                                                   value="4" {{$disc->status == 4 ? "checked":''}}
                                                            >
                                                            <span class="new-control-indicator">بد</span>
                                                        </label>
                                                        {{--                                                        <input type="radio" id="awli" name="score" value="1"--}}
                                                        {{--                                                               {{ $disc->status == 1 ? 'checked' : '' }} required>--}}
                                                        {{--                                                        <label for="awli">عالی</label><br>--}}
                                                        {{--                                                        <input type="radio" id="khob" name="score" value="2"--}}
                                                        {{--                                                            {{ $disc->status == 2 ? 'checked' : '' }}>--}}
                                                        {{--                                                        <label for="khob">خوب</label><br>--}}
                                                        {{--                                                        <input type="radio" id="motevaset" name="score" value="3"--}}
                                                        {{--                                                            {{ $disc->status == 3 ? 'checked' : '' }}>--}}
                                                        {{--                                                        <label for="motevaset">متوسط</label><br>--}}
                                                        {{--                                                        <input type="radio" id="bad" name="score" value="4"--}}
                                                        {{--                                                            {{ $disc->status == 4 ? 'checked' : '' }}>--}}
                                                        {{--                                                        <label for="bad">ضعیف</label><br>--}}

                                                    </div>
                                                    <div class="form-group @if ($errors->has('disc')) has-error @endif">
                                                        <h6 style="font-size: 13px">توصیه به
                                                            دانشجو</h6>
                                                        <div class="input-group mb-3">
                                                            <div class="col-lg-12">
                                                                    <textarea class="form-control btn-square" name="comment"
                                                                              id="comment"
                                                                              minlength="5">@if (isset($disc)){{ $disc->comment }}@endif</textarea>
                                                            </div>
                                                        </div>
                                                        <span class="text-danger" id="comment"
                                                              style="color: red;">{{ $errors->first('$disc') }}</span>
                                                    </div>
                                                    <div class="card-footer">
                                                        <button class="btn btn-primary" type="submit">
                                                            ثبت
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        @endif
                                   
                                   
                                   
                                    @endforeach
                                    
                                    {{--                                    </div>--}}
                                </div>
                                {{--                                @if (Laratrust::hasRole('student'))--}}

                                <div id="test-swipe-3" class="col s12 carousel carousel-item active"
                                     style="overflow:scroll !important;transform: translateX(0px) translateX(0px) translateX(0px) translateZ(0px); z-index: 0; opacity: 1; visibility: visible;">
                                    {{--                                    <div class="quetion_container z-depth-5"></div>--}}
                                    {{--                                    <div class="col s12 mt-1 custom_question_wrapper">--}}
                                    @foreach ($discs_ok as $disc)
                                        <small class="question_title">جلسه {{ $disc->session->number }}
                                            : {{ $disc->session->name }}</small>
                                        <h6>{!! $disc->text !!}</h6>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card-body">
                                                    <div class="col-md-12">
                                                        @if ($disc->comment)
                                                            <div class="row" style="color: red;  margin-bottom: 10px">
                                                                نظر استاد.{{ $disc->comment }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if (Laratrust::hasRole('teacher'))
                                            <div class=" col-md-3">
                                                <form method="post"
                                                      action="{{ '/dashboard/discussion/scoring?disc_id=' . $disc->id }}"
                                                      enctype="multipart/form-data">
                                                    @csrf
                                                    <h6 style="font-size: 14px">امتیاز</h6>
                                                    <div class="col">
                                                        <label
                                                            class="new-control new-checkbox checkbox-success"
                                                            style="height: 21px; margin-bottom: 0; margin-right: 0">
                                                            <input type="radio" class="new-control-input"
                                                                   name="score"
                                                                   value="1" {{$disc->status == 1 ? "checked":''}}
                                                            >
                                                            <span class="new-control-indicator">عالی</span>
                                                        </label>

                                                        <label
                                                            class="new-control new-checkbox checkbox-success"
                                                            style="height: 21px; margin-bottom: 0; margin-right: 0">
                                                            <input type="radio" class="new-control-input"
                                                                   name="score"
                                                                   value="2" {{$disc->status == 2 ? "checked":''}}
                                                            >
                                                            <span class="new-control-indicator">خوب</span>
                                                        </label>

                                                        <label
                                                            class="new-control new-checkbox checkbox-success"
                                                            style="height: 21px; margin-bottom: 0; margin-right: 0">
                                                            <input type="radio" class="new-control-input"
                                                                   name="score"
                                                                   value="3" {{$disc->status == 3 ? "checked":''}}
                                                            >
                                                            <span class="new-control-indicator">متوسط</span>
                                                        </label>

                                                        <label
                                                            class="new-control new-checkbox checkbox-success"
                                                            style="height: 21px; margin-bottom: 0; margin-right: 0">
                                                            <input type="radio" class="new-control-input"
                                                                   name="score"
                                                                   value="4" {{$disc->status == 4 ? "checked":''}}
                                                            >
                                                            <span class="new-control-indicator">بد</span>
                                                        </label>
                                                        {{--                                                        <input type="radio" id="awli" name="score" value="1"--}}
                                                        {{--                                                               {{ $disc->status == 1 ? 'checked' : '' }} required>--}}
                                                        {{--                                                        <label for="awli">عالی</label><br>--}}
                                                        {{--                                                        <input type="radio" id="khob" name="score" value="2"--}}
                                                        {{--                                                            {{ $disc->status == 2 ? 'checked' : '' }}>--}}
                                                        {{--                                                        <label for="khob">خوب</label><br>--}}
                                                        {{--                                                        <input type="radio" id="motevaset" name="score" value="3"--}}
                                                        {{--                                                            {{ $disc->status == 3 ? 'checked' : '' }}>--}}
                                                        {{--                                                        <label for="motevaset">متوسط</label><br>--}}
                                                        {{--                                                        <input type="radio" id="bad" name="score" value="4"--}}
                                                        {{--                                                            {{ $disc->status == 4 ? 'checked' : '' }}>--}}
                                                        {{--                                                        <label for="bad">ضعیف</label><br>--}}

                                                    </div>
                                                    <div class="form-group @if ($errors->has('disc')) has-error @endif">
                                                        <h6 style="font-size: 13px">توصیه به
                                                            دانشجو</h6>
                                                        <div class="input-group mb-3">
                                                            <div class="col-lg-12">
                                                                    <textarea class="form-control btn-square" name="comment"
                                                                              id="comment"
                                                                              minlength="5">@if (isset($disc)){{ $disc->comment }}@endif</textarea>
                                                            </div>
                                                        </div>
                                                        <span class="text-danger" id="comment"
                                                              style="color: red;">{{ $errors->first('$disc') }}</span>
                                                    </div>
                                                    <div class="card-footer">
                                                        <button class="btn btn-primary" type="submit">
                                                            ثبت
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        @endif
                                    @endforeach
                                    
                                    {{--                                    </div>--}}
                                </div>
                                <div id="test-swipe-4" class="col s12 carousel carousel-item  active"
                                     style="overflow:scroll !important;transform: translateX(0px) translateX(0px) translateX(0px) translateZ(0px); z-index: 0; opacity: 1; visibility: visible;">
                                    {{--                                    <div class="quetion_container z-depth-5"></div>--}}
                                    {{--                                    <div class="col s12 mt-1 custom_question_wrapper">--}}
                                    @foreach ($discs_bad as $disc)
                                        <small class="question_title">جلسه {{ $disc->session->number }}
                                            : {{ $disc->session->name }}</small>
                                        <h6>{!! $disc->text !!}</h6>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card-body">
                                                    <div class="col-md-12">
                                                        @if ($disc->comment)
                                                            <div class="row" style="color: red;  margin-bottom: 10px">
                                                                نظر استاد.{{ $disc->comment }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if (Laratrust::hasRole('teacher'))
                                            <div class=" col-md-3">
                                                <form method="post"
                                                      action="{{ '/dashboard/discussion/scoring?disc_id=' . $disc->id }}"
                                                      enctype="multipart/form-data">
                                                    @csrf
                                                    <h6 style="font-size: 14px">امتیاز</h6>
                                                    <div class="col">
                                                        <label
                                                            class="new-control new-checkbox checkbox-success"
                                                            style="height: 21px; margin-bottom: 0; margin-right: 0">
                                                            <input type="radio" class="new-control-input"
                                                                   name="score"
                                                                   value="1" {{$disc->status == 1 ? "checked":''}}
                                                            >
                                                            <span class="new-control-indicator">عالی</span>
                                                        </label>

                                                        <label
                                                            class="new-control new-checkbox checkbox-success"
                                                            style="height: 21px; margin-bottom: 0; margin-right: 0">
                                                            <input type="radio" class="new-control-input"
                                                                   name="score"
                                                                   value="2" {{$disc->status == 2 ? "checked":''}}
                                                            >
                                                            <span class="new-control-indicator">خوب</span>
                                                        </label>

                                                        <label
                                                            class="new-control new-checkbox checkbox-success"
                                                            style="height: 21px; margin-bottom: 0; margin-right: 0">
                                                            <input type="radio" class="new-control-input"
                                                                   name="score"
                                                                   value="3" {{$disc->status == 3 ? "checked":''}}
                                                            >
                                                            <span class="new-control-indicator">متوسط</span>
                                                        </label>

                                                        <label
                                                            class="new-control new-checkbox checkbox-success"
                                                            style="height: 21px; margin-bottom: 0; margin-right: 0">
                                                            <input type="radio" class="new-control-input"
                                                                   name="score"
                                                                   value="4" {{$disc->status == 4 ? "checked":''}}
                                                            >
                                                            <span class="new-control-indicator">بد</span>
                                                        </label>
                                                        {{--                                                        <input type="radio" id="awli" name="score" value="1"--}}
                                                        {{--                                                               {{ $disc->status == 1 ? 'checked' : '' }} required>--}}
                                                        {{--                                                        <label for="awli">عالی</label><br>--}}
                                                        {{--                                                        <input type="radio" id="khob" name="score" value="2"--}}
                                                        {{--                                                            {{ $disc->status == 2 ? 'checked' : '' }}>--}}
                                                        {{--                                                        <label for="khob">خوب</label><br>--}}
                                                        {{--                                                        <input type="radio" id="motevaset" name="score" value="3"--}}
                                                        {{--                                                            {{ $disc->status == 3 ? 'checked' : '' }}>--}}
                                                        {{--                                                        <label for="motevaset">متوسط</label><br>--}}
                                                        {{--                                                        <input type="radio" id="bad" name="score" value="4"--}}
                                                        {{--                                                            {{ $disc->status == 4 ? 'checked' : '' }}>--}}
                                                        {{--                                                        <label for="bad">ضعیف</label><br>--}}

                                                    </div>
                                                    <div class="form-group @if ($errors->has('disc')) has-error @endif">
                                                        <h6 style="font-size: 13px">توصیه به
                                                            دانشجو</h6>
                                                        <div class="input-group mb-3">
                                                            <div class="col-lg-12">
                                                                    <textarea class="form-control btn-square" name="comment"
                                                                              id="comment"
                                                                              minlength="5">@if (isset($disc)){{ $disc->comment }}@endif</textarea>
                                                            </div>
                                                        </div>
                                                        <span class="text-danger" id="comment"
                                                              style="color: red;">{{ $errors->first('$disc') }}</span>
                                                    </div>
                                                    <div class="card-footer">
                                                        <button class="btn btn-primary" type="submit">
                                                            ثبت
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        @endif
                                    @endforeach
                                    {{--                                    </div>--}}
                                </div>
                                @if (Laratrust::hasRole('student'))

                                    <div id="test-swipe-5" class="col s12 carousel carousel-item  active"
                                         style="overflow:scroll !important;transform: translateX(0px) translateX(0px) translateX(0px) translateZ(0px); z-index: 0; opacity: 1; visibility: visible;">
                                        {{--                                    <div class="quetion_container z-depth-5"></div>--}}
                                        {{--                                    <div class="col s12 mt-1 custom_question_wrapper">--}}
                                        @foreach ($discs_ret as $disc)
                                            <small class="question_title">جلسه {{ $disc->session->number }}
                                                : {{ $disc->session->name }}</small>
                                            <h6>{!! $disc->text !!}</h6>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card-body">
                                                        <div class="col-md-12">
                                                            <div class="row" style="@if ($disc->answer == 4)color: forestgreen; @endif margin-bottom: 10px">
                                                                @if (count($disc['nazar']) > 0)
                                                                    @foreach ($disc['nazar'] as $key => $nazar)
                                                                        <span style="color: red; margin-bottom: 10px;
                                                                        @if($nazar->score==1)
                                                                            color:green;
                                                                        @elseif($nazar->score==2)
                                                                            color:red;
                                                                        @endif">
                                                                            {{$key}} نظر داوری
                                                                            :
                                                                            {{--                                                                            @if ($nazar->score == 1)--}}
                                                                            {{--                                                                                دارای--}}
                                                                            {{--                                                                                غلط تایپی یا ایراد--}}
                                                                            {{--                                                                                نگارشی--}}
                                                                            {{--                                                                                است--}}
                                                                            {{--                                                                            @elseif($nazar->score == 2)--}}
                                                                            {{--                                                                                گزینه--}}
                                                                            {{--                                                                                ها به هم ریخته--}}
                                                                            {{--                                                                                است--}}

                                                                            {{--                                                                            @elseif($nazar->score == 4)--}}
                                                                            {{--                                                                                سوال--}}
                                                                            {{--                                                                                ایراد دارد یا تکراری--}}
                                                                            {{--                                                                                است--}}
                                                                            {{--                                                                            @endif--}}
                                                                            @if ($nazar->comment)
                                                                                , {{ $nazar->comment }}
                                                                            @endif
                                                                        </span>
                                                                    @endforeach
                                                                @endif
                                                            </div>

                                                            @if ($disc->comment)
                                                                <div class="row" style="color: red;  margin-bottom: 10px">
                                                                    نظر استاد.{{ $disc->comment }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="card-footer">
                                                            <a href="/dashboard/discussion/create/{{ $disc->session->id }}"
                                                               class="btn btn-primary" type="submit">
                                                                ویرایش
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        {{--                                    </div>--}}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function handleActuality(page) {
            window.location.search += `&&page=${page}`;
        }
    </script>
    <script src="{{ asset('app-assets/js/scripts/page-account-settings.min.js') }}"></script>
@endsection
