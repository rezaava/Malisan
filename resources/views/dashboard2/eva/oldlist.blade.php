@extends('dashboard2.layout.app')

@section('start')
@endsection
@section('main')

    <div id="content" class="main-content">

        <div class="row">
            @include('dashboard.layout.message')
            <div id="breadcrumbDefault" class="col-xl-12 col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-content widget-content-area">

                        <nav class="breadcrumb-one" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/dashboard">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                             stroke-linecap="round" stroke-linejoin="round"
                                             class="feather feather-home">
                                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                        </svg>
                                    </a></li>
                                <li class="breadcrumb-item " aria-current="page"><a
                                            href="/dashboard/courses/sessions?course_id={{$course->id}}">
                                        <span>درس {{$course->name}}</span></a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span>ارزیابی</span></li>
                            </ol>
                        </nav>


                    </div>
                </div>
            </div>

        </div>

        <div class="layout-px-spacing" style="margin-bottom: -300px">

            <div class="page-header">
                <div class="page-title">
                    <div class="row">
                        @if(Route::current()->getName() == 'referee')
                            <h3 style="padding-left: 30px">داوری فعالیت ها در درس {{$course->name}}</h3>
                        @elseif(Laratrust::hasRole('teacher'))
                            <h3 style="padding-left: 30px">ارزیابی فعالیت های درس {{$course->name}}</h3>
                        @else
                            <h3 style="padding-left: 30px"> فعالیت های من در درس {{$course->name}}</h3>
                        @endif
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

                    @endif
                </ul>


            </div>


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
                                        @endforeach
                                    </div>
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





        @endsection

        @section('end')

            {{----}}
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
            <script>
                $("ul.nav-tabs a").click(function (e) {
                    e.preventDefault();
                    $(this).tab('show');
                });
            </script>
            {{----}}

            <script src="{{("/new-style/assets/js/apps/mailbox-chat.js")}}"></script>
            <script src="{{("/new-style/assets/js/widgets/modules-widgets.js")}}"></script>

            <script src="{{("/new-style/assets/js/scrollspyNav.js")}}"></script>


            <script src="{{("/new-style/assets/js/scrollspyNav.js")}}"></script>
            <script src="{{("/new-style/plugins/font-icons/feather/feather.min.js")}}"></script>
            <script type="text/javascript">
                feather.replace();
            </script>
            <script>
                $('.user-list-box .person').on('click', function (event) {
                    $idd = $(this).find('.user-id').text();
                    $ex_c = $(this).find('.user-ex').text();
                    if ($ex_c == 0)
                        document.getElementById("homework").hidden = true;
                    else
                        document.getElementById("homework").hidden = false;


                    document.getElementById("questions").href = '/dashboard/question/show?session_id=' + $idd;
                    document.getElementById("homework").href = '/dashboard/exercise/show?session_id=' + $idd;
                    document.getElementById("edit").href = '/dashboard/session/edit/' + $idd;
                    document.getElementById("create").href = '/dashboard/courses/sessions/create?course_id={{$course->id}}';

                });

            </script>

@endsection
