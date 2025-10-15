@extends('dashboard.layout.app')
@section('title','صفحه نمایش دوره')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('/cuba-style/assets/css/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/cuba-style/assets/css/owlcarousel.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/cuba-style/assets/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/cuba-style/assets/css/responsive.css')}}">



@endpush
@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-10">
                                <h3>ارزیابی فعالیت های درس {{$course->name}} </h3>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#"><i data-feather="home"></i></a></li>
                                    <li class="breadcrumb-item">ارزیابی</li>
                                    {{--<li class="breadcrumb-item">لیست دروس</li>--}}
                                </ol>
                            </div>
                            <div class="col-lg-2">
                                <!-- Bookmark Start-->
                                <div class="bookmark pull-right">
                                    <ul>
                                        <div class="bookmark pull-right">
                                            <ul>
                                                <li><a
                                                            href="/dashboard/courses/list"

                                                            data-container="body" data-toggle="popover"
                                                            data-placement="top"
                                                            title="" data-original-title="بازگشت"><img
                                                                src="{{asset('/cuba-style/assets/images/arrow-left.svg')}}"></a>
                                                </li>

                                            </ul>
                                        </div>
                                    </ul>
                                </div>
                                <!-- Bookmark Ends-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tabbable boxed parentTabs">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#q">سوالات</a>
            </li>
            <li><a href="#d">گزارش</a>
            </li>
            @if(Route::current()->getName() != 'referee')
                <li><a href="#e">تکلیف</a>
                </li>
                @if(Laratrust::hasRole('teacher'))
                    <li><a href="#setting">تنظیمات</a>
                    </li>
                @endif
            @endif
        </ul>
        <div class="tab-content">

            {{--q--}}
            <div class="tab-pane fade active in" id="q">

                <div class="tabbable">
                    <ul class="nav nav-tabs">

                        <li class="active"><a href="#q_n">بررسی نشده({{$q_not}})</a>
                        </li>
                        @if(Laratrust::hasRole('student') && Route::current()->getName() != 'referee')
                            <li><a href="#q_a">همه</a>
                            </li>
                            <li><a href="#q_o">تایید شده({{$q_ok}})</a>
                            </li>
                            <li><a href="#q_b">تایید نشده({{$q_bad}})</a>
                            </li>
                            <li><a href="#q_r">نیازمند اصلاح({{$q_ret}})</a>
                            </li>
                        @endif
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="q_n">

                            @foreach($questions_not as $question)
                            {{--@foreach($questions as $question)--}}
{{--                                @if($question->status ==null && $question->status!=-1)--}}
                                    @if( !(Route::current()->getName() == 'referee'&& $question->scores>2))
                                        <div class="card col-12">
                                            <div class="card-header">
                                                <div class="row">
                                                    <h6>جلسه {{$question->session->number}}
                                                        : {{$question->session->name}}</h6>
                                                </div>
                                                <div class="row">

                                                    <label style="size: 14px;line-height:20px">{!! $question->question !!}</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            @if(Laratrust::hasRole('teacher') )


                                                                <div class="col-md-9">
                                                                    @elseif( Route::current()->getName() == 'referee')
                                                                        <div class="col-md-7">

                                                                            @else
                                                                                <div class="col-md-12">

                                                                                    @endif
                                                                                    <div class="row"
                                                                                         style="@if($question->answer==1)color: forestgreen; @endif margin-bottom: 10px">
                                                                                        1.{{$question->answer1}}
                                                                                    </div>
                                                                                    <div class="row"
                                                                                         style="@if($question->answer==2)color: forestgreen; @endif margin-bottom: 10px">
                                                                                        2.{{$question->answer2}}
                                                                                    </div>
                                                                                    <div class="row"
                                                                                         style="@if($question->answer==3)color: forestgreen; @endif margin-bottom: 10px ">
                                                                                        3.{{$question->answer3}}
                                                                                    </div>
                                                                                    <div class="row"
                                                                                         style="@if($question->answer==4)color: forestgreen; @endif margin-bottom: 10px">
                                                                                        4.{{$question->answer4}}
                                                                                    </div>
                                                                                    @if(Laratrust::hasRole('teacher'))
                                                                                        @if(count($question['nazar'])>0)
                                                                                            @foreach($question['nazar'] as $key=>$nazar)
                                                                                                <div class="row"
                                                                                                     style="color: blue; margin-bottom: 10px">
                                                                                                    داور {{$key+1}}
                                                                                                    ({{$nazar->user}}):
                                                                                                    {{--@if($nazar->score==1)--}}
                                                                                                    {{--عالی--}}
                                                                                                    {{--@elseif($nazar->score==2)--}}
                                                                                                    {{--خوب--}}
                                                                                                    {{--@elseif($nazar->score==3)--}}
                                                                                                    {{--متوسط--}}
                                                                                                    {{--@elseif($nazar->score==4)--}}
                                                                                                    {{--ضعیف--}}
                                                                                                    {{--@endif--}}
                                                                                                    @if($nazar->comment)
                                                                                                    , {{$nazar->comment}}
                                                                                                    @endif
                                                                                                </div>
                                                                                            @endforeach
                                                                                        @endif
                                                                                    @endif
                                                                                </div>


                                                                                @if(Laratrust::hasRole('teacher') )
                                                                                    <div class=" col-md-3">
                                                                                        <form method="post"
                                                                                              action="{{"/dashboard/question/scoring?question_id=".$question->id}}"
                                                                                              enctype="multipart/form-data">
                                                                                            @csrf
                                                                                            <label>امتیاز</label>
                                                                                            <div class="col">

                                                                                                <input type="radio"
                                                                                                       id="awli"
                                                                                                       name="score"
                                                                                                       value="1" {{$question->status == 1 ? "checked":''}}>
                                                                                                <label for="awli">عالی</label><br>
                                                                                                <input type="radio"
                                                                                                       id="khob"
                                                                                                       name="score"
                                                                                                       value="2" {{$question->status == 2 ? "checked":''}}>
                                                                                                <label for="khob">خوب</label><br>
                                                                                                <input type="radio"
                                                                                                       id="motevaset"
                                                                                                       name="score"
                                                                                                       value="3" {{$question->status == 3 ? "checked":''}}>
                                                                                                <label for="motevaset">متوسط</label><br>
                                                                                                <input type="radio"
                                                                                                       id="bad"
                                                                                                       name="score"
                                                                                                       value="4" {{$question->status == 4 ? "checked":''}}>
                                                                                                <label for="bad">ضعیف</label><br>

                                                                                            </div>
                                                                                            <div class="form-group @if ($errors->has('question')) has-error @endif">
                                                                                                <label>توصیه به
                                                                                                    دانشجو</label>
                                                                                                <div class="input-group mb-3">
                                                                                                    <div class="col-lg-12">
<textarea class="form-control btn-square" name="comment"
          id="comment" minlength="5">@if(isset($question)){{$question->comment}}@endif</textarea>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <span class="text-danger"
                                                                                                      id="comment"
                                                                                                      style="color: red;">{{$errors->first('$question')}}</span>
                                                                                            </div>
                                                                                            <div class="card-footer">
                                                                                                <button class="btn btn-primary"
                                                                                                        type="submit">
                                                                                                    ثبت
                                                                                                </button>
                                                                                            </div>
                                                                                        </form>
                                                                                    </div>
                                                                                @endif

                                                                                @if( Route::current()->getName() == 'referee')
                                                                                    <div class=" col-md-5">
                                                                                        <form method="post"
                                                                                              action="{{"/dashboard/question/scoring?question_id=".$question->id}}"
                                                                                              enctype="multipart/form-data">
                                                                                            @csrf
                                                                                            <label>ایراد های
                                                                                                سوال</label>
                                                                                            <div class="col">

                                                                                                <input type="radio"
                                                                                                       id="awli"
                                                                                                       name="score"
                                                                                                       value="1">
                                                                                                <label for="awli">دارای
                                                                                                    غلط تایپی یا ایراد
                                                                                                    نگارشی
                                                                                                    است</label><br>
                                                                                                <input type="radio"
                                                                                                       id="khob"
                                                                                                       name="score"
                                                                                                       value="2">
                                                                                                <label for="khob">گزینه
                                                                                                    ها به هم ریخته
                                                                                                    است</label><br>
                                                                                                <input type="radio"
                                                                                                       id="motevaset"
                                                                                                       name="score"
                                                                                                       value="3">
                                                                                                <label for="motevaset">سوال
                                                                                                    برای آزمون مناست
                                                                                                    است</label><br>
                                                                                                <input type="radio"
                                                                                                       id="bad"
                                                                                                       name="score"
                                                                                                       value="4">
                                                                                                <label for="bad">سوال
                                                                                                    ایراد دارد و مناسب آزمون نیست</label><br>

                                                                                            </div>
                                                                                            <div class="form-group @if ($errors->has('question')) has-error @endif">
                                                                                                <label>ذکر دلیل </label>
                                                                                                <div class="input-group mb-3">
                                                                                                    <div class="col-lg-12">
<textarea class="form-control btn-square" name="comment"
          id="comment" minlength="5" required>@if(isset($question)){{$question->comment}}@endif</textarea>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <span class="text-danger"
                                                                                                      id="comment"
                                                                                                      style="color: red;">{{$errors->first('$question')}}</span>
                                                                                            </div>
                                                                                            <div class="card-footer">
                                                                                                <button class="btn btn-primary"
                                                                                                        type="submit">
                                                                                                    ثبت
                                                                                                </button>
                                                                                            </div>
                                                                                        </form>
                                                                                    </div>
                                                                                @endif
                                                                        </div>
                                                                </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                                {{--@endif--}}
                                                @endforeach
                                            </div>

                                            @if(Laratrust::hasRole('student') && Route::current()->getName() != 'referee' )

                                            <div class="tab-pane fade" id="q_a">
                                                @foreach($questions as $question)
                                                    <div class="card col-12">
                                                        <div class="card-header">
                                                            <div class="row">
                                                                <h6>جلسه {{$question->session->number}}
                                                                    : {{$question->session->name}}</h6>
                                                            </div>
                                                            <div class="row">

                                                                <h5>{{$question->question}}</h5>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="card-body">
                                                                    <div class="col-md-12">
                                                                        <div class="row"
                                                                             style="@if($question->answer==1)color: forestgreen; @endif margin-bottom: 10px">
                                                                            1.{{$question->answer1}}
                                                                        </div>
                                                                        <div class="row"
                                                                             style="@if($question->answer==2)color: forestgreen; @endif margin-bottom: 10px">
                                                                            2.{{$question->answer2}}
                                                                        </div>
                                                                        <div class="row"
                                                                             style="@if($question->answer==3)color: forestgreen; @endif margin-bottom: 10px ">
                                                                            3.{{$question->answer3}}
                                                                        </div>
                                                                        <div class="row"
                                                                             style="@if($question->answer==4)color: forestgreen; @endif margin-bottom: 10px">
                                                                            4.{{$question->answer4}}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="tab-pane fade" id="q_b">
                                                @foreach($questions_bad as $question)
                                                {{--@foreach($questions as $question)--}}
                                                    {{--@if($question->status=='3' || $question->status=='4')--}}
                                                        <div class="card col-12">
                                                            <div class="card-header">
                                                                <div class="row">
                                                                    <h6>جلسه {{$question->session->number}}
                                                                        : {{$question->session->name}}</h6>
                                                                </div>
                                                                <div class="row">

                                                                    <h5>{{$question->question}}</h5>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="card-body">
                                                                        <div class="col-md-12">
                                                                            <div class="row"
                                                                                 style="@if($question->answer==1)color: forestgreen; @endif margin-bottom: 10px">
                                                                                1.{{$question->answer1}}
                                                                            </div>
                                                                            <div class="row"
                                                                                 style="@if($question->answer==2)color: forestgreen; @endif margin-bottom: 10px">
                                                                                2.{{$question->answer2}}
                                                                            </div>
                                                                            <div class="row"
                                                                                 style="@if($question->answer==3)color: forestgreen; @endif margin-bottom: 10px ">
                                                                                3.{{$question->answer3}}
                                                                            </div>
                                                                            <div class="row"
                                                                                 style="@if($question->answer==4)color: forestgreen; @endif margin-bottom: 10px">
                                                                                4.{{$question->answer4}}
                                                                            </div>
                                                                            @if($question->comment)
                                                                                <div class="row"
                                                                                     style="color: red;  margin-bottom: 10px">
                                                                                    نظر استاد.{{$question->comment}}
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    {{--@endif--}}
                                                @endforeach

                                            </div>
                                            <div class="tab-pane fade" id="q_o">
                                                @foreach($questions_ok as $question)
                                                {{--@foreach($questions as $question)--}}
                                                    {{--@if($question->status=='1' || $question->status=='2')--}}
                                                        <div class="card col-12">
                                                            <div class="card-header">
                                                                <div class="row">
                                                                    <h6>جلسه {{$question->session->number}}
                                                                        : {{$question->session->name}}</h6>
                                                                </div>
                                                                <div class="row">

                                                                    <h5>{{$question->question}}</h5>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="card-body">
                                                                        <div class="col-md-12">
                                                                            <div class="row"
                                                                                 style="@if($question->answer==1)color: forestgreen; @endif margin-bottom: 10px">
                                                                                1.{{$question->answer1}}
                                                                            </div>
                                                                            <div class="row"
                                                                                 style="@if($question->answer==2)color: forestgreen; @endif margin-bottom: 10px">
                                                                                2.{{$question->answer2}}
                                                                            </div>
                                                                            <div class="row"
                                                                                 style="@if($question->answer==3)color: forestgreen; @endif margin-bottom: 10px ">
                                                                                3.{{$question->answer3}}
                                                                            </div>
                                                                            <div class="row"
                                                                                 style="@if($question->answer==4)color: forestgreen; @endif margin-bottom: 10px">
                                                                                4.{{$question->answer4}}
                                                                            </div>
                                                                            @if($question->comment)
                                                                                <div class="row"
                                                                                     style="color: red;  margin-bottom: 10px">
                                                                                    نظر استاد.{{$question->comment}}
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    {{--@endif--}}
                                                @endforeach

                                            </div>

                                            <div class="tab-pane fade" id="q_r">

                                                @foreach($questions_ret as $question)
{{--                                                @foreach($questions as $question)--}}
{{--                                                    @if($question->status=='-1')--}}
                                                        <div class="card col-12">
                                                            <div class="card-header">
                                                                <div class="row">
                                                                    <h6>جلسه {{$question->session->number}}
                                                                        : {{$question->session->name}}</h6>
                                                                </div>
                                                                <div class="row">

                                                                    <h5>{{$question->question}}</h5>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="card-body">
                                                                        <div class="col-md-12">
                                                                            <div class="row"
                                                                                 style="@if($question->answer==1)color: forestgreen; @endif margin-bottom: 10px">
                                                                                1.{{$question->answer1}}
                                                                            </div>
                                                                            <div class="row"
                                                                                 style="@if($question->answer==2)color: forestgreen; @endif margin-bottom: 10px">
                                                                                2.{{$question->answer2}}
                                                                            </div>
                                                                            <div class="row"
                                                                                 style="@if($question->answer==3)color: forestgreen; @endif margin-bottom: 10px ">
                                                                                3.{{$question->answer3}}
                                                                            </div>
                                                                            <div class="row"
                                                                                 style="@if($question->answer==4)color: forestgreen; @endif margin-bottom: 10px">
                                                                                4.{{$question->answer4}}
                                                                            </div>
                                                                            <div class="row"
                                                                                 style="@if($question->answer==4)color: forestgreen; @endif margin-bottom: 10px">
                                                                                @if(count($question['nazar'])>0)
                                                                                    @foreach($question['nazar'] as $key=>$nazar)
                                                                                        <div class="row"
                                                                                             style="color: red; margin-bottom: 10px">
                                                                                            نظر داوری
                                                                                            :
                                                                                            @if($nazar->score==1)
                                                                                                دارای
                                                                                                غلط تایپی یا ایراد
                                                                                                نگارشی
                                                                                                است
                                                                                            @elseif($nazar->score==2)
                                                                                                گزینه
                                                                                                ها به هم ریخته
                                                                                                است

                                                                                            @elseif($nazar->score==4)
                                                                                                سوال
                                                                                                ایراد دارد یا تکراری
                                                                                                است
                                                                                            @endif
                                                                                            @if($nazar->comment)
                                                                                                , {{$nazar->comment}}
                                                                                            @endif
                                                                                        </div>
                                                                                    @endforeach
                                                                                @endif
                                                                            </div>

                                                                            @if($question->comment)
                                                                                <div class="row"
                                                                                     style="color: red;  margin-bottom: 10px">
                                                                                    نظر استاد.{{$question->comment}}
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                        <div class="card-footer">
                                                                            <a href="/dashboard/question/edit/{{$question->id}}"
                                                                               class="btn btn-primary"
                                                                               type="submit">
                                                                                ویرایش
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    {{--@endif--}}
                                                @endforeach

                                            </div>
                                                @endif
                                        </div>
                        </div>
                    </div>
                    {{--d--}}
                    <div class="tab-pane fade" id="d">
                        <div class="tabbable">
                            <ul class="nav nav-tabs">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#d_n">بررسی نشده({{$d_not}})</a>
                                    </li>
                                    @if(Laratrust::hasRole('student') && Route::current()->getName() != 'referee')
                                        <li><a href="#d_a">همه</a>
                                        </li>
                                        <li><a href="#d_o">تایید شده</a>
                                        </li>
                                        <li><a href="#d_b">تایید نشده</a>
                                        </li>
                                    @endif
                                </ul>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade active in" id="d_n">
                                    @foreach($disscussions as $disc)
                                        @if(!$disc->status)
                                            <div class="card col-12">
                                                <div class="card-header">
                                                    <div class="row">
                                                        <h6>جلسه {{$disc->session->number}}
                                                            : {{$disc->session->name}}</h6>
                                                    </div>
                                                    <div class="row">
                                                        <h5>{!!$disc->text!!}</h5>
                                                    </div>
                                                </div>
                                                <div class="row">

                                                    <div class="col-md-12">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                @if(Laratrust::hasRole('teacher') ||  Route::current()->getName() == 'referee')
                                                                    <div class=" col-md-12">
                                                                        <form method="post"
                                                                              action="{{"/dashboard/discussion/scoring?discussion_id=".$disc->id}}"
                                                                              enctype="multipart/form-data">
                                                                            @csrf
                                                                            <label>امتیاز</label>
                                                                            <div class="col">

                                                                                <input type="radio" id="awli"
                                                                                       name="score"
                                                                                       value="1" {{$disc->status == 1 ? "checked":''}}>
                                                                                <label for="awli">عالی</label><br>
                                                                                <input type="radio" id="khob"
                                                                                       name="score"
                                                                                       value="2" {{$disc->status == 2 ? "checked":''}}>
                                                                                <label for="khob">خوب</label><br>
                                                                                <input type="radio" id="motevaset"
                                                                                       name="score"
                                                                                       value="3" {{$disc->status == 3 ? "checked":''}}>
                                                                                <label for="motevaset">متوسط</label><br>
                                                                                <input type="radio" id="bad"
                                                                                       name="score"
                                                                                       value="4" {{$disc->status == 4 ? "checked":''}}>
                                                                                <label for="bad">ضعیف</label><br>

                                                                            </div>
                                                                            <div class="form-group @if ($errors->has('disc')) has-error @endif">
                                                                                <label>نظر</label>
                                                                                <div class="input-group mb-3">
                                                                                    <div class="col-lg-12">
<textarea class="form-control btn-square" name="comment"
          id="comment"></textarea>
                                                                                    </div>
                                                                                </div>
                                                                                <span class="text-danger"
                                                                                      id="comment"
                                                                                      style="color: red;">{{$errors->first('disc')}}</span>
                                                                            </div>
                                                                            <div class="card-footer">
                                                                                <button class="btn btn-primary"
                                                                                        type="submit">
                                                                                    ثبت
                                                                                </button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                @endif
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach                        </div>
                                <div class="tab-pane fade" id="d_a">
                                    @foreach($disscussions as $disc)
                                        <div class="card col-12">
                                            <div class="card-header">
                                                <div class="row">
                                                    <h6>جلسه {{$disc->session->number}}
                                                        : {{$disc->session->name}}</h6>
                                                </div>
                                                <div class="row">
                                                    <h5>{!!$disc->text!!}</h5>
                                                </div>
                                            </div>
                                            <div class="row">

                                                <div class="col-md-12">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            @if(Laratrust::hasRole('teacher'))
                                                                <div class=" col-md-12">
                                                                    <form method="post"
                                                                          action="{{"/dashboard/discussion/scoring?discussion_id=".$disc->id}}"
                                                                          enctype="multipart/form-data">
                                                                        @csrf
                                                                        <label>امتیاز</label>
                                                                        <div class="col">

                                                                            <input type="radio" id="awli"
                                                                                   name="score"
                                                                                   value="1" {{$disc->status == 1 ? "checked":''}}>
                                                                            <label for="awli">عالی</label><br>
                                                                            <input type="radio" id="khob"
                                                                                   name="score"
                                                                                   value="2" {{$disc->status == 2 ? "checked":''}}>
                                                                            <label for="khob">خوب</label><br>
                                                                            <input type="radio" id="motevaset"
                                                                                   name="score"
                                                                                   value="3" {{$disc->status == 3 ? "checked":''}}>
                                                                            <label for="motevaset">متوسط</label><br>
                                                                            <input type="radio" id="bad"
                                                                                   name="score"
                                                                                   value="4" {{$disc->status == 4 ? "checked":''}}>
                                                                            <label for="bad">ضعیف</label><br>

                                                                        </div>
                                                                        <div class="form-group @if ($errors->has('disc')) has-error @endif">
                                                                            <label>نظر</label>
                                                                            <div class="input-group mb-3">
                                                                                <div class="col-lg-12">
<textarea class="form-control btn-square" name="comment"
          id="comment"></textarea>
                                                                                </div>
                                                                            </div>
                                                                            <span class="text-danger" id="comment"
                                                                                  style="color: red;">{{$errors->first('disc')}}</span>
                                                                        </div>
                                                                        <div class="card-footer">
                                                                            <button class="btn btn-primary"
                                                                                    type="submit">
                                                                                ثبت
                                                                            </button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            @endif
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="tab-pane fade" id="d_b">
                                    @foreach($disscussions as $disc)
                                        @if($disc->status=='3' ||$disc->status=='4')
                                            <div class="card col-12">
                                                <div class="card-header">
                                                    <div class="row">
                                                        <h6>جلسه {{$disc->session->number}}
                                                            : {{$disc->session->name}}</h6>
                                                    </div>
                                                    <div class="row">
                                                        <h5>{!!$disc->text!!}</h5>
                                                    </div>
                                                </div>
                                                <div class="row">

                                                    <div class="col-md-12">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                @if(Laratrust::hasRole('teacher'))
                                                                    <div class=" col-md-12">
                                                                        <form method="post"
                                                                              action="{{"/dashboard/discussion/scoring?discussion_id=".$disc->id}}"
                                                                              enctype="multipart/form-data">
                                                                            @csrf
                                                                            <label>امتیاز</label>
                                                                            <div class="col">

                                                                                <input type="radio" id="awli"
                                                                                       name="score"
                                                                                       value="1" {{$disc->status == 1 ? "checked":''}}>
                                                                                <label for="awli">عالی</label><br>
                                                                                <input type="radio" id="khob"
                                                                                       name="score"
                                                                                       value="2" {{$disc->status == 2 ? "checked":''}}>
                                                                                <label for="khob">خوب</label><br>
                                                                                <input type="radio" id="motevaset"
                                                                                       name="score"
                                                                                       value="3" {{$disc->status == 3 ? "checked":''}}>
                                                                                <label for="motevaset">متوسط</label><br>
                                                                                <input type="radio" id="bad"
                                                                                       name="score"
                                                                                       value="4" {{$disc->status == 4 ? "checked":''}}>
                                                                                <label for="bad">ضعیف</label><br>

                                                                            </div>
                                                                            <div class="form-group @if ($errors->has('disc')) has-error @endif">
                                                                                <label>نظر</label>
                                                                                <div class="input-group mb-3">
                                                                                    <div class="col-lg-12">
<textarea class="form-control btn-square" name="comment"
          id="comment"></textarea>
                                                                                    </div>
                                                                                </div>
                                                                                <span class="text-danger"
                                                                                      id="comment"
                                                                                      style="color: red;">{{$errors->first('disc')}}</span>
                                                                            </div>
                                                                            <div class="card-footer">
                                                                                <button class="btn btn-primary"
                                                                                        type="submit">
                                                                                    ثبت
                                                                                </button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                @endif
                                                                @if($disc->comment)
                                                                    <div class="row"
                                                                         style="color: red;  margin-bottom: 10px">
                                                                        نظر استاد.{{$disc->comment}}
                                                                    </div>
                                                                @endif
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="tab-pane fade" id="d_o">
                                    @foreach($disscussions as $disc)
                                        @if($disc->status=='1' ||$disc->status=='2')
                                            <div class="card col-12">
                                                <div class="card-header">
                                                    <div class="row">
                                                        <h6>جلسه {{$disc->session->number}}
                                                            : {{$disc->session->name}}</h6>
                                                    </div>
                                                    <div class="row">
                                                        <h5>{!!$disc->text!!}</h5>
                                                    </div>
                                                </div>
                                                <div class="row">

                                                    <div class="col-md-12">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                @if(Laratrust::hasRole('teacher'))
                                                                    <div class=" col-md-12">
                                                                        <form method="post"
                                                                              action="{{"/dashboard/discussion/scoring?discussion_id=".$disc->id}}"
                                                                              enctype="multipart/form-data">
                                                                            @csrf
                                                                            <label>امتیاز</label>
                                                                            <div class="col">

                                                                                <input type="radio" id="awli"
                                                                                       name="score"
                                                                                       value="1" {{$disc->status == 1 ? "checked":''}}>
                                                                                <label for="awli">عالی</label><br>
                                                                                <input type="radio" id="khob"
                                                                                       name="score"
                                                                                       value="2" {{$disc->status == 2 ? "checked":''}}>
                                                                                <label for="khob">خوب</label><br>
                                                                                <input type="radio" id="motevaset"
                                                                                       name="score"
                                                                                       value="3" {{$disc->status == 3 ? "checked":''}}>
                                                                                <label for="motevaset">متوسط</label><br>
                                                                                <input type="radio" id="bad"
                                                                                       name="score"
                                                                                       value="4" {{$disc->status == 4 ? "checked":''}}>
                                                                                <label for="bad">ضعیف</label><br>

                                                                            </div>
                                                                            <div class="form-group @if ($errors->has('disc')) has-error @endif">
                                                                                <label>نظر</label>
                                                                                <div class="input-group mb-3">
                                                                                    <div class="col-lg-12">
<textarea class="form-control btn-square" name="comment"
          id="comment"></textarea>
                                                                                    </div>
                                                                                </div>
                                                                                <span class="text-danger"
                                                                                      id="comment"
                                                                                      style="color: red;">{{$errors->first('disc')}}</span>
                                                                            </div>
                                                                            <div class="card-footer">
                                                                                <button class="btn btn-primary"
                                                                                        type="submit">
                                                                                    ثبت
                                                                                </button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                @endif
                                                                @if($disc->comment)
                                                                    <div class="row"
                                                                         style="color: red;  margin-bottom: 10px">
                                                                        نظر استاد.{{$disc->comment}}
                                                                    </div>
                                                                @endif
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(Route::current()->getName() != 'referee')

                        {{--e--}}
                        <div class="tab-pane fade" id="e">
                            <div class="tabbable">
                                <ul class="nav nav-tabs">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#e_n">بررسی نشده({{$e_not}})</a>
                                        </li>
                                        @if(Laratrust::hasRole('student'))
                                            <li><a href="#e_a">همه</a>
                                            </li>
                                            <li><a href="#e_o">تایید شده</a>
                                            </li>
                                            <li><a href="#e_b">تایید نشده</a>
                                            </li>
                                        @endif
                                    </ul>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade active in" id="e_n">
                                        @foreach($ex_answers as $ans)
                                            @if(!$ans->status)

                                                <div class="card col-12">
                                                    <div class="card-header">
                                                        <div class="row">
                                                            <h6>جلسه {{$ans->session->number}}
                                                                : {{$ans->session->name}}</h6>
                                                        </div>
                                                        <div class="row">
                                                            <label style="size: 19px">سوال: {!!$ans->exercise->text !!}</label>
                                                        </div>
                                                        <div class="row">
                                                            <label style="size: 13px;line-height:20px">پاسخ:{!! $ans->answer !!}</label>
                                                            @if($ans->file)
                                                                <a href="{{ URL::to( '/files/answer' . $ans->file)  }}"
                                                                   target="_blank">
                                                                    دانلود
                                                                </a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="row">

                                                        <div class="col-md-12">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    @if(Laratrust::hasRole('teacher'))
                                                                        <div class=" col-md-12">
                                                                            <form method="post"
                                                                                  action="{{"/dashboard/exercise/scoring?answer_id=".$ans->id}}"
                                                                                  enctype="multipart/form-data">
                                                                                @csrf
                                                                                <label>امتیاز</label>
                                                                                <div class="col">

                                                                                    <input type="radio" id="awli"
                                                                                           name="score"
                                                                                           value="1" {{$ans->status == 1 ? "checked":''}}>
                                                                                    <label for="awli">عالی</label><br>
                                                                                    <input type="radio" id="khob"
                                                                                           name="score"
                                                                                           value="2" {{$ans->status == 2 ? "checked":''}}>
                                                                                    <label for="khob">خوب</label><br>
                                                                                    <input type="radio"
                                                                                           id="motevaset"
                                                                                           name="score"
                                                                                           value="3" {{$ans->status == 3 ? "checked":''}}>
                                                                                    <label for="motevaset">متوسط</label><br>
                                                                                    <input type="radio" id="bad"
                                                                                           name="score"
                                                                                           value="4" {{$ans->status == 4 ? "checked":''}}>
                                                                                    <label for="bad">ضعیف</label><br>

                                                                                </div>
                                                                                <div class="form-group @if ($errors->has('ans')) has-error @endif">
                                                                                    <label>نظر</label>
                                                                                    <div class="input-group mb-3">
                                                                                        <div class="col-lg-12">
<textarea class="form-control btn-square" name="comment"
          id="comment"></textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                    <span class="text-danger"
                                                                                          id="comment"
                                                                                          style="color: red;">{{$errors->first('ans')}}</span>
                                                                                </div>
                                                                                <div class="card-footer">
                                                                                    <button class="btn btn-primary"
                                                                                            type="submit">
                                                                                        ثبت
                                                                                    </button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    @endif
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="tab-pane fade" id="e_a">
                                        @foreach($ex_answers as $ans)
                                            <div class="card col-12">
                                                <div class="card-header">
                                                    <div class="row">
                                                        <h6>جلسه {{$ans->session->number}}
                                                            : {{$ans->session->name}}</h6>
                                                    </div>
                                                    <div class="row">
                                                        <h6>سوال: {!! $ans->exercise->text !!}</h6>
                                                    </div>
                                                    <div class="row">
                                                        <h5>پاسخ:{!!$ans->answer  !!}</h5>
                                                        @if($ans->file)
                                                            <a href="{{ URL::to( '/files/answer' . $ans->file)  }}"
                                                               target="_blank">
                                                                دانلود
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row">

                                                    <div class="col-md-12">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                @if(Laratrust::hasRole('teacher'))
                                                                    <div class=" col-md-12">
                                                                        <form method="post"
                                                                              action="{{"/dashboard/exercise/scoring?answer_id=".$ans->id}}"
                                                                              enctype="multipart/form-data">
                                                                            @csrf
                                                                            <label>امتیاز</label>
                                                                            <div class="col">

                                                                                <input type="radio" id="awli"
                                                                                       name="score"
                                                                                       value="1" {{$ans->status == 1 ? "checked":''}}>
                                                                                <label for="awli">عالی</label><br>
                                                                                <input type="radio" id="khob"
                                                                                       name="score"
                                                                                       value="2" {{$ans->status == 2 ? "checked":''}}>
                                                                                <label for="khob">خوب</label><br>
                                                                                <input type="radio" id="motevaset"
                                                                                       name="score"
                                                                                       value="3" {{$ans->status == 3 ? "checked":''}}>
                                                                                <label for="motevaset">متوسط</label><br>
                                                                                <input type="radio" id="bad"
                                                                                       name="score"
                                                                                       value="4" {{$ans->status == 4 ? "checked":''}}>
                                                                                <label for="bad">ضعیف</label><br>

                                                                            </div>
                                                                            <div class="form-group @if ($errors->has('ans')) has-error @endif">
                                                                                <label>نظر</label>
                                                                                <div class="input-group mb-3">
                                                                                    <div class="col-lg-12">
<textarea class="form-control btn-square" name="comment"
          id="comment"></textarea>
                                                                                    </div>
                                                                                </div>
                                                                                <span class="text-danger"
                                                                                      id="comment"
                                                                                      style="color: red;">{{$errors->first('ans')}}</span>
                                                                            </div>
                                                                            <div class="card-footer">
                                                                                <button class="btn btn-primary"
                                                                                        type="submit">
                                                                                    ثبت
                                                                                </button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                @endif
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="tab-pane fade" id="e_o">
                                        @foreach($ex_answers as $ans)
                                            @if($ans->status=='1' || $ans->status=='2')

                                                <div class="card col-12">
                                                    <div class="card-header">
                                                        <div class="row">
                                                            <h6>جلسه {{$ans->session->number}}
                                                                : {{$ans->session->name}}</h6>
                                                        </div>
                                                        <div class="row">
                                                            <h6>سوال: {!! $ans->exercise->text !!}</h6>
                                                        </div>
                                                        <div class="row">
                                                            <h5>پاسخ:{!! $ans->answer !!}</h5>
                                                            @if($ans->file)
                                                                <a href="{{ URL::to( '/files/answer' . $ans->file)  }}"
                                                                   target="_blank">
                                                                    دانلود
                                                                </a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="row">

                                                        <div class="col-md-12">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    @if(Laratrust::hasRole('teacher'))
                                                                        <div class=" col-md-12">
                                                                            <form method="post"
                                                                                  action="{{"/dashboard/exercise/scoring?answer_id=".$ans->id}}"
                                                                                  enctype="multipart/form-data">
                                                                                @csrf
                                                                                <label>امتیاز</label>
                                                                                <div class="col">

                                                                                    <input type="radio" id="awli"
                                                                                           name="score"
                                                                                           value="1" {{$ans->status == 1 ? "checked":''}}>
                                                                                    <label for="awli">عالی</label><br>
                                                                                    <input type="radio" id="khob"
                                                                                           name="score"
                                                                                           value="2" {{$ans->status == 2 ? "checked":''}}>
                                                                                    <label for="khob">خوب</label><br>
                                                                                    <input type="radio"
                                                                                           id="motevaset"
                                                                                           name="score"
                                                                                           value="3" {{$ans->status == 3 ? "checked":''}}>
                                                                                    <label for="motevaset">متوسط</label><br>
                                                                                    <input type="radio" id="bad"
                                                                                           name="score"
                                                                                           value="4" {{$ans->status == 4 ? "checked":''}}>
                                                                                    <label for="bad">ضعیف</label><br>

                                                                                </div>
                                                                                <div class="form-group @if ($errors->has('ans')) has-error @endif">
                                                                                    <label>نظر</label>
                                                                                    <div class="input-group mb-3">
                                                                                        <div class="col-lg-12">
<textarea class="form-control btn-square" name="comment"
          id="comment"></textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                    <span class="text-danger"
                                                                                          id="comment"
                                                                                          style="color: red;">{{$errors->first('ans')}}</span>
                                                                                </div>
                                                                                <div class="card-footer">
                                                                                    <button class="btn btn-primary"
                                                                                            type="submit">
                                                                                        ثبت
                                                                                    </button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    @endif
                                                                    @if($ans->comment)
                                                                        <div class="row"
                                                                             style="color: red;  margin-bottom: 10px">
                                                                            نظر استاد.{{$ans->comment}}
                                                                        </div>
                                                                    @endif

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="tab-pane fade" id="e_b">
                                        @foreach($ex_answers as $ans)
                                            @if($ans->status=='3' || $ans->status=='4')

                                                <div class="card col-12">
                                                    <div class="card-header">
                                                        <div class="row">
                                                            <h6>جلسه {{$ans->session->number}}
                                                                : {{$ans->session->name}}</h6>
                                                        </div>
                                                        <div class="row">
                                                            <h6>سوال: {!! $ans->exercise->text !!}</h6>
                                                        </div>
                                                        <div class="row">
                                                            <h5>پاسخ:{!! $ans->answer !!}</h5>
                                                            @if($ans->file)
                                                                <a href="{{ URL::to( '/files/answer' . $ans->file)  }}"
                                                                   target="_blank">
                                                                    دانلود
                                                                </a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="row">

                                                        <div class="col-md-12">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    @if(Laratrust::hasRole('teacher'))
                                                                        <div class=" col-md-12">
                                                                            <form method="post"
                                                                                  action="{{"/dashboard/exercise/scoring?answer_id=".$ans->id}}"
                                                                                  enctype="multipart/form-data">
                                                                                @csrf
                                                                                <label>امتیاز</label>
                                                                                <div class="col">

                                                                                    <input type="radio" id="awli"
                                                                                           name="score"
                                                                                           value="1" {{$ans->status == 1 ? "checked":''}}>
                                                                                    <label for="awli">عالی</label><br>
                                                                                    <input type="radio" id="khob"
                                                                                           name="score"
                                                                                           value="2" {{$ans->status == 2 ? "checked":''}}>
                                                                                    <label for="khob">خوب</label><br>
                                                                                    <input type="radio"
                                                                                           id="motevaset"
                                                                                           name="score"
                                                                                           value="3" {{$ans->status == 3 ? "checked":''}}>
                                                                                    <label for="motevaset">متوسط</label><br>
                                                                                    <input type="radio" id="bad"
                                                                                           name="score"
                                                                                           value="4" {{$ans->status == 4 ? "checked":''}}>
                                                                                    <label for="bad">ضعیف</label><br>

                                                                                </div>
                                                                                <div class="form-group @if ($errors->has('ans')) has-error @endif">
                                                                                    <label>نظر</label>
                                                                                    <div class="input-group mb-3">
                                                                                        <div class="col-lg-12">
<textarea class="form-control btn-square" name="comment"
          id="comment"></textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                    <span class="text-danger"
                                                                                          id="comment"
                                                                                          style="color: red;">{{$errors->first('ans')}}</span>
                                                                                </div>
                                                                                <div class="card-footer">
                                                                                    <button class="btn btn-primary"
                                                                                            type="submit">
                                                                                        ثبت
                                                                                    </button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    @endif
                                                                    @if($ans->comment)
                                                                        <div class="row"
                                                                             style="color: red;  margin-bottom: 10px">
                                                                            نظر استاد.{{$ans->comment}}
                                                                        </div>
                                                                    @endif

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{--setting--}}
                        <div class="tab-pane fade" id="setting">
                            <div class="row justify-content-center" style="margin-top: 5px; color: red;">
                                ضریب اثر هر کدام از فعالیت ها
                            </div>
                            <form action="/dashboard/evaluation/edit"
                                  method="post" enctype="multipart/form-data">
                                @csrf
                                <input name="course_id" value="{{$course->id}}" hidden>
                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="card-body">
                                            <div class="table-responsive product-table">
                                                <table class="display" id="table-1">
                                                    <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>عالی</th>
                                                        <th>خوب</th>
                                                        <th>متوسط</th>
                                                        <th>ضعیف</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    {{--                                            طراحی سوال--}}
                                                    <tr>
                                                        <td>
                                                            طراحی سوال
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    {{--<div class="input-group-prepend">--}}
                                                                    {{--<span class="input-group-text">سقف نمره</span>--}}
                                                                    {{--</div>--}}
                                                                    <input
                                                                            placeholder="امتیاز " type="text"
                                                                            name="q_1"
                                                                            class="form-control rtl"
                                                                            value=" {{$scoring->q_1}}">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    {{--<div class="input-group-prepend">--}}
                                                                    {{--<span class="input-group-text">سقف نمره</span>--}}
                                                                    {{--</div>--}}
                                                                    <input
                                                                            placeholder="امتیاز " type="text"
                                                                            name="q_2"
                                                                            class="form-control rtl"
                                                                            value=" {{$scoring->q_2}}">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    {{--<div class="input-group-prepend">--}}
                                                                    {{--<span class="input-group-text">سقف نمره</span>--}}
                                                                    {{--</div>--}}
                                                                    <input
                                                                            placeholder="امتیاز " type="text"
                                                                            name="q_3"
                                                                            class="form-control rtl"
                                                                            value=" {{$scoring->q_3}}">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    {{--<div class="input-group-prepend">--}}
                                                                    {{--<span class="input-group-text">سقف نمره</span>--}}
                                                                    {{--</div>--}}
                                                                    <input
                                                                            placeholder="امتیاز " type="text"
                                                                            name="q_4"
                                                                            class="form-control rtl"
                                                                            value=" {{$scoring->q_4}}">
                                                                </div>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    {{--                                            گزارش--}}
                                                    <tr>
                                                        <td>
                                                            گزارش
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    {{--<div class="input-group-prepend">--}}
                                                                    {{--<span class="input-group-text">سقف نمره</span>--}}
                                                                    {{--</div>--}}
                                                                    <input
                                                                            placeholder="امتیاز " type="text"
                                                                            name="d_1"
                                                                            class="form-control rtl"
                                                                            value=" {{$scoring->d_1}}">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    {{--<div class="input-group-prepend">--}}
                                                                    {{--<span class="input-group-text">سقف نمره</span>--}}
                                                                    {{--</div>--}}
                                                                    <input
                                                                            placeholder="امتیاز " type="text"
                                                                            name="d_2"
                                                                            class="form-control rtl"
                                                                            value=" {{$scoring->d_2}}">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    {{--<div class="input-group-prepend">--}}
                                                                    {{--<span class="input-group-text">سقف نمره</span>--}}
                                                                    {{--</div>--}}
                                                                    <input
                                                                            placeholder="امتیاز " type="text"
                                                                            name="d_3"
                                                                            class="form-control rtl"
                                                                            value=" {{$scoring->d_3}}">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    {{--<div class="input-group-prepend">--}}
                                                                    {{--<span class="input-group-text">سقف نمره</span>--}}
                                                                    {{--</div>--}}
                                                                    <input
                                                                            placeholder="امتیاز " type="text"
                                                                            name="d_4"
                                                                            class="form-control rtl"
                                                                            value=" {{$scoring->d_4}}">
                                                                </div>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    {{--                                            تکلیف--}}
                                                    <tr>
                                                        <td>
                                                            تکلیف
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    {{--<div class="input-group-prepend">--}}
                                                                    {{--<span class="input-group-text">سقف نمره</span>--}}
                                                                    {{--</div>--}}
                                                                    <input
                                                                            placeholder="امتیاز " type="text"
                                                                            name="e_1"
                                                                            class="form-control rtl"
                                                                            value=" {{$scoring->e_1}}">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    {{--<div class="input-group-prepend">--}}
                                                                    {{--<span class="input-group-text">سقف نمره</span>--}}
                                                                    {{--</div>--}}
                                                                    <input
                                                                            placeholder="امتیاز " type="text"
                                                                            name="e_2"
                                                                            class="form-control rtl"
                                                                            value=" {{$scoring->e_2}}">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    {{--<div class="input-group-prepend">--}}
                                                                    {{--<span class="input-group-text">سقف نمره</span>--}}
                                                                    {{--</div>--}}
                                                                    <input
                                                                            placeholder="امتیاز " type="text"
                                                                            name="e_3"
                                                                            class="form-control rtl"
                                                                            value=" {{$scoring->e_3}}">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    {{--<div class="input-group-prepend">--}}
                                                                    {{--<span class="input-group-text">سقف نمره</span>--}}
                                                                    {{--</div>--}}
                                                                    <input
                                                                            placeholder="امتیاز " type="text"
                                                                            name="e_4"
                                                                            class="form-control rtl"
                                                                            value=" {{$scoring->e_4}}">
                                                                </div>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    {{--                                            سمینار--}}
                                                    <tr>
                                                        <td>
                                                            سمینار
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    {{--<div class="input-group-prepend">--}}
                                                                    {{--<span class="input-group-text">سقف نمره</span>--}}
                                                                    {{--</div>--}}
                                                                    <input
                                                                            placeholder="امتیاز " type="text"
                                                                            name="s_1"
                                                                            class="form-control rtl"
                                                                            value=" {{$scoring->s_1}}">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    {{--<div class="input-group-prepend">--}}
                                                                    {{--<span class="input-group-text">سقف نمره</span>--}}
                                                                    {{--</div>--}}
                                                                    <input
                                                                            placeholder="امتیاز " type="text"
                                                                            name="s_2"
                                                                            class="form-control rtl"
                                                                            value=" {{$scoring->s_2}}">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    {{--<div class="input-group-prepend">--}}
                                                                    {{--<span class="input-group-text">سقف نمره</span>--}}
                                                                    {{--</div>--}}
                                                                    <input
                                                                            placeholder="امتیاز " type="text"
                                                                            name="s_3"
                                                                            class="form-control rtl"
                                                                            value=" {{$scoring->s_3}}">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    {{--<div class="input-group-prepend">--}}
                                                                    {{--<span class="input-group-text">سقف نمره</span>--}}
                                                                    {{--</div>--}}
                                                                    <input
                                                                            placeholder="امتیاز " type="text"
                                                                            name="s_4"
                                                                            class="form-control rtl"
                                                                            value=" {{$scoring->s_4}}">
                                                                </div>
                                                            </div>
                                                        </td>

                                                    </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-10 offset-md-1">
                                        <button type="submit" class="btn btn-block btn-outline-primary" id="btn">
                                            ذخیره
                                        </button>
                                    </div>
                                </div>
                            </form>


                        </div>
                    @endif

                </div>
            </div>


            {{--exer--}}
            {{--</div>--}}

            {{--<div class="tab-pane fade active in" id="not_e">--}}

            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            @endsection

            @push('scripts')
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
                <script>
                    $("ul.nav-tabs a").click(function (e) {
                        e.preventDefault();
                        $(this).tab('show');
                    });
                </script>

                <script src="{{asset('/cuba-style/assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
                <script src="{{asset('/cuba-style/assets/js/rating/jquery.barrating.js')}}"></script>
                <script src="{{asset('/cuba-style/assets/js/owlcarousel/owl.carousel.js')}}"></script>
                <script src="{{asset('/cuba-style/assets/js/ecommerce.js')}}"></script>
                <script src="{{asset('/cuba-style/assets/js/product-list-custom.js')}}"></script>
                <script src="{{asset('/cuba-style/assets/js/tooltip-init.js')}}"></script>
                <script>
                    $('#table-1').DataTable({
                        "paging": false,
                        "searching": false,
                        "ordering": false,
                        "info": false,
                        "columnDefs": [
                            {"width": "50px", "targets": 0},
                            {"width": "5px", "targets": 1},
                            {"width": "200px", "targets": 2}
                        ]
                    });
                </script>



