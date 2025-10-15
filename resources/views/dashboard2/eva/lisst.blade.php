@extends('dashboard2.layout.app')

@section('start')

    <link href="{{ '/style/assets/css/scrollspyNav.css' }}" rel="stylesheet" type="text/css" />
    <link href="{{ '/style/assets/css/components/tabs-accordian/custom-tabs.css' }}" rel="stylesheet" type="text/css" />
@endsection
@section('main')

    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            @include('dashboard.layout.message')

            <div class="row">
                <div class="col-lg-12 col-12  layout-spacing">
                    <div class="widget-content widget-content-area animated-underline-content">

                        {{-- tabs --}}
                        <ul class="nav nav-tabs  mb-3" id="animateLine" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link
                                @if (session('tab'))
                                @if (session('tab') == 'q')
                                    active
                                @endif
                                @else
                                    active
                                @endif

                                {{-- {{   session('tab')== 'q' ? 'active' : '' }} --}}

                                {{-- {{ !empty($tab) && $tab == 'q' ? 'active' : '' }} --}}
                                    "
                                    id="animated-underline-home-tab" data-toggle="tab" href="#q" role="tab"
                                    aria-controls="animated-underline-home" aria-selected="true">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-home">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                    </svg>
                                    @if (Laratrust::hasRole('teacher'))
                                        سوالات({{ $q_not }})
                                    @else
                                        سوالات
                                    @endif
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link
                             @if (session('tab'))
                                @if (session('tab') == 'd')
                                    active
                            @endif
                                @endif
                                {{-- {{   session('tab')== 'd' ? 'active' : '' }} --}}
                                {{-- {{ !empty($tab) && $tab == 'q' ? 'active' : '' }} --}}
                                    "
                                    id="animated-underline-profile-tab" data-toggle="tab" href="#d" role="tab"
                                    aria-controls="animated-underline-profile" aria-selected="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    @if (Laratrust::hasRole('teacher'))
                                        گزارش({{ $d_not }})
                                    @else
                                        گزارش
                                    @endif

                                </a>
                            </li>
                            @if (Route::current()->getName() != 'referee')
                                <li class="nav-item">
                                    <a class="nav-link
{{-- {{   session('tab')== 'e' ? 'active' : '' }} --}}
                                    @if (session('tab'))
                                    @if (session('tab') == 'e')
                                        active
                                    @endif

                                    @endif
                                    {{-- {{ !empty($tab) && $tab == 'q' ? 'active' : '' }} --}}
                                        "
                                        id="animated-underline-contact-tab" data-toggle="tab" href="#exer" role="tab"
                                        aria-controls="animated-underline-contact" aria-selected="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="feather feather-phone">
                                            <path
                                                d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                            </path>
                                        </svg>
                                        @if (Laratrust::hasRole('teacher'))
                                            تکلیف({{ $e_not }})
                                        @else
                                            تکلیف
                                        @endif

                                    </a>
                                </li>
                            @endif

                        </ul>


                        <div class="tab-content" id="animateLineContent-4">
                            {{-- q content --}}
                            <div class="tab-pane fade show active" id="q" role="tabpanel"
                                aria-labelledby="animated-underline-home-tab" style="margin-top:-30px ">


                                <div class="widget-content widget-content-area simple-pills">
                                    <ul class="nav nav-pills mb-3 mt-3" id="pills-tab" role="tablist"
                                        style="margin-top: -1rem!important;">
                                        <li class="nav-item">
                                            <a class="nav-link
                                        @if (session('tab'))
                                            @if (session('tab') == 'q')
                                                active
                                        @endif
                                            @else
                                                active
                                        @endif
                                                "
                                                id="pills-home-tab" data-toggle="pill" href="#qn" role="tab"
                                                aria-controls="pills-home" aria-selected="true">
                                                بررسی نشده({{ $q_not }})
                                            </a>
                                        </li>
                                        @if (Laratrust::hasRole('student') && Route::current()->getName() != 'referee')
                                            <li class="nav-item">
                                                <a class="nav-link" id="pills-contact-tab" data-toggle="pill"
                                                    href="#qa" role="tab" aria-controls="pills-contact"
                                                    aria-selected="false">همه</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="pills-contact-tab" data-toggle="pill"
                                                    href="#qo" role="tab" aria-controls="pills-contact"
                                                    aria-selected="false">
                                                    تایید شده({{ $q_ok }})
                                                </a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" id="pills-contact-tab" data-toggle="pill"
                                                    href="#qb" role="tab" aria-controls="pills-contact"
                                                    aria-selected="false">
                                                    تایید نشده({{ $q_bad }})</a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" id="pills-contact-tab" data-toggle="pill"
                                                    href="#qr" role="tab" aria-controls="pills-contact"
                                                    aria-selected="false">
                                                    نیازمند اصلاح({{ $q_ret }})</a>
                                            </li>

                                        @endif
                                    </ul>
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="qn" role="tabpanel"
                                            aria-labelledby="pills-home-tab">
                                            {{-- qn cont --}}
                                            @foreach ($questions_not as $question)
                                                @if (!(Route::current()->getName() == 'referee' && $question->scores >= 5))
                                                    <div class="card col-12">
                                                        <div class="card-header">
                                                            <div class="row">
                                                                <h6>جلسه {{ $question->session->number }}
                                                                    : {{ $question->session->name }}</h6>
                                                            </div>
                                                            <div class="row">

                                                                <label
                                                                    style="size: 14px;line-height:20px">{!! $question->question !!}</label>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="card-body">
                                                                    <div class="row">


                                                                        <div @if (Laratrust::hasRole('teacher'))
                                                                            class="col-md-9"
                                                                        @elseif( Route::current()->getName() ==
                                                                            'referee')
                                                                            class="col-md-7"
                                                                        @else
                                                                            class="col-md-12"
                                                @endif
                                                >

                                                <div class="row"
                                                    style="@if ($question->answer == 1)color: forestgreen; @endif margin-bottom: 10px">
                                                    1.{{ $question->answer1 }}
                                                </div>
                                                <div class="row"
                                                    style="@if ($question->answer == 2)color: forestgreen; @endif margin-bottom: 10px">
                                                    2.{{ $question->answer2 }}
                                                </div>
                                                <div class="row"
                                                    style="@if ($question->answer == 3)color: forestgreen; @endif margin-bottom: 10px ">
                                                    3.{{ $question->answer3 }}
                                                </div>
                                                <div class="row"
                                                    style="@if ($question->answer == 4)color: forestgreen; @endif margin-bottom: 10px">
                                                    4.{{ $question->answer4 }}
                                                </div>
                                                @if (Laratrust::hasRole('teacher'))
                                                    @if (count($question['nazar']) > 0)
                                                        @foreach ($question['nazar'] as $key => $nazar)
                                                            <div class="row"
                                                                style="color: blue; margin-bottom: 10px">
                                                                داور {{ $key + 1 }}
                                                                ({{ $nazar->user }}):
                                                                @if ($nazar->comment)
                                                                    , {{ $nazar->comment }}
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                @endif
                                        </div>


                                        @if (Laratrust::hasRole('teacher'))
                                            <div class=" col-md-3">
                                                <form method="post"
                                                    action="{{ '/dashboard/question/scoring?question_id=' . $question->id }}"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <label>امتیاز</label>
                                                    <div class="col">

                                                        <input type="radio" id="awli" name="score" value="1"
                                                            {{ $question->status == 1 ? 'checked' : '' }} required>
                                                        <label for="awli">عالی</label><br>
                                                        <input type="radio" id="khob" name="score" value="2"
                                                            {{ $question->status == 2 ? 'checked' : '' }}>
                                                        <label for="khob">خوب</label><br>
                                                        <input type="radio" id="motevaset" name="score" value="3"
                                                            {{ $question->status == 3 ? 'checked' : '' }}>
                                                        <label for="motevaset">متوسط</label><br>
                                                        <input type="radio" id="bad" name="score" value="4"
                                                            {{ $question->status == 4 ? 'checked' : '' }}>
                                                        <label for="bad">ضعیف</label><br>

                                                    </div>
                                                    <div class="form-group @if ($errors->has('question')) has-error @endif">
                                                        <label>توصیه به
                                                            دانشجو</label>
                                                        <div class="input-group mb-3">
                                                            <div class="col-lg-12">
                                                                <textarea class="form-control btn-square" name="comment"
                                                                    id="comment"
                                                                    minlength="5">@if (isset($question)){{ $question->comment }}@endif</textarea>
                                                            </div>
                                                        </div>
                                                        <span class="text-danger" id="comment"
                                                            style="color: red;">{{ $errors->first('$question') }}</span>
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
                                                    action="{{ '/dashboard/question/scoring?question_id=' . $question->id }}"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <label>ایراد های
                                                        سوال</label>
                                                    <div class="col">

                                                        <input type="radio" id="awli" name="score" value="1" required>
                                                        <label for="awli">
                                                            برگشت سوال (ایراد نگارشی یا
                                                            ...)
                                                        </label><br>
                                                        <input type="radio" id="khob" name="score" value="2">
                                                        <label for="khob">
                                                            برگشت سوال ( ضعیف یا غیر
                                                            مرتبط )
                                                        </label><br>
                                                        <input type="radio" id="motevaset" name="score" value="3">
                                                        <label for="motevaset">
                                                            سطح سوال عالی است
                                                        </label><br>
                                                        <input type="radio" id="bad" name="score" value="4">
                                                        <label for="bad">
                                                            سطح سوال متوسط است
                                                        </label><br>

                                                    </div>
                                                    <div class="form-group @if ($errors->has('question')) has-error @endif">
                                                        <label>ذکر دلیل </label>
                                                        <div class="input-group mb-3">
                                                            <div class="col-lg-12">
                                                                <textarea class="form-control btn-square" name="comment"
                                                                    id="comment" minlength="5"
                                                                    required>@if (isset($question)){{ $question->comment }}@endif</textarea>
                                                            </div>
                                                        </div>
                                                        <span class="text-danger" id="comment"
                                                            style="color: red;">{{ $errors->first('$question') }}</span>
                                                    </div>
                                                    <div class="card-footer">
                                                        <button class="btn btn-primary" type="submit">
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
                    {{-- @endif --}}
                    @endforeach

                    {{-- end qn --}}
                </div>
                @if (Laratrust::hasRole('student') && Route::current()->getName() != 'referee')

                    <div class="tab-pane fade" id="qa" role="tabpanel" aria-labelledby="pills-profile-tab">
                        {{-- qa cont --}}
                        @foreach ($questions as $question)
                            <div class="card col-12">
                                <div class="card-header">
                                    <div class="row">
                                        <h6>جلسه {{ $question->session->number }}
                                            : {{ $question->session->name }}</h6>
                                    </div>
                                    <div class="row">

                                        <h5>{{ $question->question }}</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card-body">
                                            <div class="col-md-12">
                                                <div class="row"
                                                    style="@if ($question->answer == 1)color: forestgreen; @endif margin-bottom: 10px">
                                                    1.{{ $question->answer1 }}
                                                </div>
                                                <div class="row"
                                                    style="@if ($question->answer == 2)color: forestgreen; @endif margin-bottom: 10px">
                                                    2.{{ $question->answer2 }}
                                                </div>
                                                <div class="row"
                                                    style="@if ($question->answer == 3)color: forestgreen; @endif margin-bottom: 10px ">
                                                    3.{{ $question->answer3 }}
                                                </div>
                                                <div class="row"
                                                    style="@if ($question->answer == 4)color: forestgreen; @endif margin-bottom: 10px">
                                                    4.{{ $question->answer4 }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        {{-- end qa --}}
                    </div>
                    <div class="tab-pane fade" id="qo" role="tabpanel" aria-labelledby="pills-profile-tab2">

                        {{-- qo cont --}}
                        @foreach ($questions_ok as $question)
                            {{-- @foreach ($questions as $question) --}}
                            {{-- @if ($question->status == '1' || $question->status == '2') --}}
                            <div class="card col-12">
                                <div class="card-header">
                                    <div class="row">
                                        <h6>جلسه {{ $question->session->number }}
                                            : {{ $question->session->name }}</h6>
                                    </div>
                                    <div class="row">

                                        <h5>{{ $question->question }}</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card-body">
                                            <div class="col-md-12">
                                                <div class="row"
                                                    style="@if ($question->answer == 1)color: forestgreen; @endif margin-bottom: 10px">
                                                    1.{{ $question->answer1 }}
                                                </div>
                                                <div class="row"
                                                    style="@if ($question->answer == 2)color: forestgreen; @endif margin-bottom: 10px">
                                                    2.{{ $question->answer2 }}
                                                </div>
                                                <div class="row"
                                                    style="@if ($question->answer == 3)color: forestgreen; @endif margin-bottom: 10px ">
                                                    3.{{ $question->answer3 }}
                                                </div>
                                                <div class="row"
                                                    style="@if ($question->answer == 4)color: forestgreen; @endif margin-bottom: 10px">
                                                    4.{{ $question->answer4 }}
                                                </div>


                                                <div class="row"
                                                    style="@if ($question->answer == 4)color: forestgreen; @endif margin-bottom: 10px">
                                                    @if (count($question['nazar']) > 0)
                                                        @foreach ($question['nazar'] as $key => $nazar)
                                                            <div class="row"
                                                                style="color: red; margin-bottom: 10px">
                                                                نظر داوری
                                                                :


                                                                {{-- برگشت سوال (ایراد نگارشی یا ...) --}}
                                                                {{-- برگشت سوال ( ضعیف یا غیر مرتبط ) --}}
                                                                {{-- سطح سوال عالی است --}}
                                                                {{-- سطح سوال متوسط است --}}

                                                                @if ($nazar->score == 1)
                                                                    برگشت سوال (ایراد نگارشی یا
                                                                    ...)
                                                                @elseif($nazar->score==2)
                                                                    برگشت سوال ( ضعیف یا غیر
                                                                    مرتبط )


                                                                @elseif($nazar->score==3)
                                                                    سطح سوال عالی است
                                                                @elseif($nazar->score==4)
                                                                    سطح سوال متوسط است

                                                                @endif
                                                                @if ($nazar->comment)
                                                                    , {{ $nazar->comment }}
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>


                                                @if ($question->comment)
                                                    <div class="row" style="color: red;  margin-bottom: 10px">
                                                        نظر استاد.{{ $question->comment }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- @endif --}}
                        @endforeach

                        {{-- qo end --}}
                    </div>
                    <div class="tab-pane fade" id="qb" role="tabpanel" aria-labelledby="pills-profile-tab">
                        {{-- qb cont --}}
                        @foreach ($questions_bad as $question)
                            {{-- @foreach ($questions as $question) --}}
                            {{-- @if ($question->status == '3' || $question->status == '4') --}}
                            <div class="card col-12">
                                <div class="card-header">
                                    <div class="row">
                                        <h6>جلسه {{ $question->session->number }}
                                            : {{ $question->session->name }}</h6>
                                    </div>
                                    <div class="row">

                                        <h5>{{ $question->question }}</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card-body">
                                            <div class="col-md-12">
                                                <div class="row"
                                                    style="@if ($question->answer == 1)color: forestgreen; @endif margin-bottom: 10px">
                                                    1.{{ $question->answer1 }}
                                                </div>
                                                <div class="row"
                                                    style="@if ($question->answer == 2)color: forestgreen; @endif margin-bottom: 10px">
                                                    2.{{ $question->answer2 }}
                                                </div>
                                                <div class="row"
                                                    style="@if ($question->answer == 3)color: forestgreen; @endif margin-bottom: 10px ">
                                                    3.{{ $question->answer3 }}
                                                </div>
                                                <div class="row"
                                                    style="@if ($question->answer == 4)color: forestgreen; @endif margin-bottom: 10px">
                                                    4.{{ $question->answer4 }}
                                                </div>
                                                @if ($question->comment)
                                                    <div class="row" style="color: red;  margin-bottom: 10px">
                                                        نظر استاد.{{ $question->comment }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- @endif --}}
                        @endforeach

                        {{-- end qb --}}
                    </div>
                    <div class="tab-pane fade" id="qr" role="tabpanel" aria-labelledby="pills-profile-tab2">

                        {{-- qr cont --}}
                        @foreach ($questions_ret as $question)
                            {{-- @foreach ($questions as $question) --}}
                            {{-- @if ($question->status == '-1') --}}
                            <div class="card col-12">
                                <div class="card-header">
                                    <div class="row">
                                        <h6>جلسه {{ $question->session->number }}
                                            : {{ $question->session->name }}</h6>
                                    </div>
                                    <div class="row">

                                        <h5>{{ $question->question }}</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card-body">
                                            <div class="col-md-12">
                                                <div class="row"
                                                    style="@if ($question->answer == 1)color: forestgreen; @endif margin-bottom: 10px">
                                                    1.{{ $question->answer1 }}
                                                </div>
                                                <div class="row"
                                                    style="@if ($question->answer == 2)color: forestgreen; @endif margin-bottom: 10px">
                                                    2.{{ $question->answer2 }}
                                                </div>
                                                <div class="row"
                                                    style="@if ($question->answer == 3)color: forestgreen; @endif margin-bottom: 10px ">
                                                    3.{{ $question->answer3 }}
                                                </div>
                                                <div class="row"
                                                    style="@if ($question->answer == 4)color: forestgreen; @endif margin-bottom: 10px">
                                                    4.{{ $question->answer4 }}
                                                </div>
                                                <div class="row"
                                                    style="@if ($question->answer == 4)color: forestgreen; @endif margin-bottom: 10px">
                                                    @if (count($question['nazar']) > 0)
                                                        @foreach ($question['nazar'] as $key => $nazar)
                                                            <div class="row"
                                                                style="color: red; margin-bottom: 10px">
                                                                نظر داوری
                                                                :
                                                                @if ($nazar->score == 1)
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
                                                                @if ($nazar->comment)
                                                                    , {{ $nazar->comment }}
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>

                                                @if ($question->comment)
                                                    <div class="row" style="color: red;  margin-bottom: 10px">
                                                        نظر استاد.{{ $question->comment }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="card-footer">
                                                <a href="/dashboard/question/edit/{{ $question->id }}"
                                                    class="btn btn-primary" type="submit">
                                                    ویرایش
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- @endif --}}
                        @endforeach

                        {{-- qr end --}}
                    </div>
                @endif

            </div>
            {{--  --}}


        </div>
    </div>


    {{-- d content --}}
    <div class="tab-pane fade show" id="d" role="tabpanel" aria-labelledby="animated-underline-home-tab"
        style="margin-top:-30px ">


        <div class="widget-content widget-content-area simple-pills">
            <ul class="nav nav-pills mb-3 mt-3" id="pills-tab" role="tablist" style="margin-top: -1rem!important;">
                <li class="nav-item">
                    <a class="nav-link
@if (session('tab'))
                                            @if (session('tab') == 'd')
                                                active
@endif
                                            {{-- @else --}}
                                            {{-- active --}}
                                            @endif
                                                "
                        id="pills-home-tab" data-toggle="pill" href="#dn" role="tab" aria-controls="pills-home"
                        aria-selected="true"> بررسی
                        نشده({{ $d_not }})
                    </a>
                </li>
                @if (Laratrust::hasRole('student') && Route::current()->getName() != 'referee')
                    <li class="nav-item">
                        <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#da" role="tab"
                            aria-controls="pills-contact" aria-selected="false">همه</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#do" role="tab"
                            aria-controls="pills-contact" aria-selected="false">تایید
                            شده({{ $d_ok }})</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#db" role="tab"
                            aria-controls="pills-contact" aria-selected="false">تایید
                            نشده({{ $d_bad }})</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#dr" role="tab"
                            aria-controls="pills-contact" aria-selected="false">نیازمند
                            اصلاح({{ $d_ret }})</a>
                    </li>

                @endif
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="dn" role="tabpanel" aria-labelledby="pills-home-tab">
                    {{-- dn cont --}}
                    @foreach ($discs_not as $disc)
                        @if (!(Route::current()->getName() == 'referee' && $disc->scores >= 5))
                            <div class="card col-12">
                                <div class="card-header">
                                    <div class="row">
                                        <h6>جلسه {{ $disc->session->number }}
                                            : {{ $disc->session->name }}</h6>
                                    </div>
                                    <div class="row">

                                        <h5>{!! $disc->text !!}</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card-body">
                                            <div class="row">


                                                <div @if (Laratrust::hasRole('teacher'))
                                                    class="col-md-9"
                                                @elseif( Route::current()->getName() == 'referee')
                                                    class="col-md-7"
                                                @else
                                                    class="col-md-12"
                        @endif
                        >
                        @if (Laratrust::hasRole('teacher'))
                            @if (count($disc['nazar']) > 0)
                                @foreach ($disc['nazar'] as $key => $nazar)
                                    <div class="row" style="color: blue; margin-bottom: 10px">
                                        داور {{ $key + 1 }}
                                        ({{ $nazar->user }}):
                                        @if ($nazar->comment)
                                            , {{ $nazar->comment }}
                                        @endif
                                    </div>
                                @endforeach
                            @endif
                        @endif
                </div>


                @if (Laratrust::hasRole('teacher'))
                    <div class=" col-md-3">
                        <form method="post" action="{{ '/dashboard/discussion/scoring?disc_id=' . $disc->id }}"
                            enctype="multipart/form-data">
                            @csrf
                            <label>امتیاز</label>
                            <div class="col">

                                <input type="radio" id="awli" name="score" value="1"
                                    {{ $disc->status == 1 ? 'checked' : '' }} required>
                                <label for="awli">عالی</label><br>
                                <input type="radio" id="khob" name="score" value="2"
                                    {{ $disc->status == 2 ? 'checked' : '' }}>
                                <label for="khob">خوب</label><br>
                                <input type="radio" id="motevaset" name="score" value="3"
                                    {{ $disc->status == 3 ? 'checked' : '' }}>
                                <label for="motevaset">متوسط</label><br>
                                <input type="radio" id="bad" name="score" value="4"
                                    {{ $disc->status == 4 ? 'checked' : '' }}>
                                <label for="bad">ضعیف</label><br>

                            </div>
                            <div class="form-group @if ($errors->has('disc')) has-error @endif">
                                <label>توصیه به
                                    دانشجو</label>
                                <div class="input-group mb-3">
                                    <div class="col-lg-12">
                                        <textarea class="form-control btn-square" name="comment" id="comment"
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
                        <form method="post" action="{{ '/dashboard/discussion/scoring?disc_id=' . $disc->id }}"
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
                                        <textarea class="form-control btn-square" name="comment" id="comment" minlength="5"
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
            </div>
        </div>
    </div>
    </div>
    </div>
    @endif
    {{-- @endif --}}
    @endforeach

    {{-- end dn --}}
    </div>
    @if (Laratrust::hasRole('student') && Route::current()->getName() != 'referee')

        <div class="tab-pane fade" id="da" role="tabpanel" aria-labelledby="pills-profile-tab">
            {{-- da cont --}}
            @foreach ($discs as $disc)
                <div class="card col-12">
                    <div class="card-header">
                        <div class="row">
                            <h6>جلسه {{ $disc->session->number }}
                                : {{ $disc->session->name }}</h6>
                        </div>
                        <div class="row">

                            <h5>{!! $disc->text !!}</h5>
                        </div>
                    </div>
                </div>
            @endforeach

            {{-- end da --}}
        </div>
        <div class="tab-pane fade" id="do" role="tabpanel" aria-labelledby="pills-profile-tab2">

            {{-- do cont --}}
            @foreach ($discs_ok as $disc)
                {{-- @foreach ($discs as $disc) --}}
                {{-- @if ($disc->status == '1' || $disc->status == '2') --}}
                <div class="card col-12">
                    <div class="card-header">
                        <div class="row">
                            <h6>جلسه {{ $disc->session->number }}
                                : {{ $disc->session->name }}</h6>
                        </div>
                        <div class="row">

                            <h5>{!! $disc->text !!}</h5>
                        </div>
                    </div>
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
                </div>
                {{-- @endif --}}
            @endforeach

            {{-- do end --}}
        </div>
        <div class="tab-pane fade" id="db" role="tabpanel" aria-labelledby="pills-profile-tab">
            {{-- db cont --}}
            @foreach ($discs_bad as $disc)
                {{-- @foreach ($discs as $disc) --}}
                {{-- @if ($disc->status == '3' || $disc->status == '4') --}}
                <div class="card col-12">
                    <div class="card-header">
                        <div class="row">
                            <h6>جلسه {{ $disc->session->number }}
                                : {{ $disc->session->name }}</h6>
                        </div>
                        <div class="row">

                            <h5>{!! $disc->text !!}</h5>
                        </div>
                    </div>
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
                </div>
                {{-- @endif --}}
            @endforeach

            {{-- end db --}}
        </div>
        <div class="tab-pane fade" id="dr" role="tabpanel" aria-labelledby="pills-profile-tab2">

            {{-- dr cont --}}
            @foreach ($discs_ret as $disc)
                {{-- @foreach ($discs as $disc) --}}
                {{-- @if ($disc->status == '-1') --}}
                <div class="card col-12">
                    <div class="card-header">
                        <div class="row">
                            <h6>جلسه {{ $disc->session->number }}
                                : {{ $disc->session->name }}</h6>
                        </div>
                        <div class="row">

                            <h5>{!! $disc->text !!}</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="row" style="@if ($disc->answer == 4)color: forestgreen; @endif margin-bottom: 10px">
                                        @if (count($disc['nazar']) > 0)
                                            @foreach ($disc['nazar'] as $key => $nazar)
                                                <div class="row" style="color: red; margin-bottom: 10px">
                                                    نظر داوری
                                                    :
                                                    @if ($nazar->score == 1)
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
                                                    @if ($nazar->comment)
                                                        , {{ $nazar->comment }}
                                                    @endif
                                                </div>
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
                </div>
                {{-- @endif --}}
            @endforeach

            {{-- dr end --}}
        </div>
    @endif

    </div>
    {{--  --}}


    </div>
    </div>


    {{-- e content --}}
    @if (Route::current()->getName() != 'referee')
        <div class="tab-pane fade show " id="exer" role="tabpanel" aria-labelledby="animated-underline-home-tab"
            style="margin-top:-30px ">


            <div class="widget-content widget-content-area simple-pills">
                <ul class="nav nav-pills mb-3 mt-3" id="pills-tab" role="tablist" style="margin-top: -1rem!important;">
                    <li class="nav-item">
                        <a class="nav-link
{{-- {{   session('tab')== 'e' ? 'active' : '' }} --}}
                                                @if (session('tab'))
                                                @if (session('tab') == 'e')
                                                    active
@endif
                                                {{-- @else --}}
                                                {{-- active --}}
                                                @endif
                                                    "
                            id="pills-home-tab" data-toggle="pill" href="#en" role="tab" aria-controls="pills-home"
                            aria-selected="true"> بررسی نشده({{ $e_not }})
                        </a>
                    </li>
                    @if (Laratrust::hasRole('student') && Route::current()->getName() != 'referee')
                        <li class="nav-item">
                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#ea" role="tab"
                                aria-controls="pills-contact" aria-selected="false">همه</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#eo" role="tab"
                                aria-controls="pills-contact" aria-selected="false">تایید
                                شده</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#eb" role="tab"
                                aria-controls="pills-contact" aria-selected="false">تایید
                                نشده</a>
                        </li>


                    @endif
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="en" role="tabpanel" aria-labelledby="pills-home-tab">
                        {{-- en cont --}}
                        @foreach ($ex_answers as $ans)
                            @if (!$ans->status)

                                <div class="card col-12">
                                    <div class="card-header">
                                        <div class="row">
                                            <h6>جلسه {{ $ans->session->number }}
                                                : {{ $ans->session->name }}</h6>
                                        </div>
                                        <div class="row">
                                            <label style="size: 19px">سوال: {!! $ans->exercise->text !!}</label>
                                        </div>
                                        <div class="row">
                                            <label style="size: 13px;line-height:20px">پاسخ:{!! $ans->answer !!}</label>
                                            @if ($ans->file)
                                                <a href="{{ URL::to('/files/answer' . $ans->file) }}" target="_blank">
                                                    دانلود
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="card-body">
                                                <div class="row">
                                                    @if (Laratrust::hasRole('teacher'))
                                                        <div class=" col-md-12">
                                                            <form method="post"
                                                                action="{{ '/dashboard/exercise/scoring?answer_id=' . $ans->id }}"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                <label>امتیاز</label>
                                                                <div class="col">

                                                                    <input type="radio" id="awli" name="score" value="1"
                                                                        {{ $ans->status == 1 ? 'checked' : '' }}
                                                                        required>
                                                                    <label for="awli">عالی</label><br>
                                                                    <input type="radio" id="khob" name="score" value="2"
                                                                        {{ $ans->status == 2 ? 'checked' : '' }}>
                                                                    <label for="khob">خوب</label><br>
                                                                    <input type="radio" id="motevaset" name="score"
                                                                        value="3"
                                                                        {{ $ans->status == 3 ? 'checked' : '' }}>
                                                                    <label for="motevaset">متوسط</label><br>
                                                                    <input type="radio" id="bad" name="score" value="4"
                                                                        {{ $ans->status == 4 ? 'checked' : '' }}>
                                                                    <label for="bad">ضعیف</label><br>

                                                                </div>
                                                                <div class="form-group @if ($errors->has('ans')) has-error @endif">
                                                                    <label>نظر</label>
                                                                    <div class="input-group mb-3">
                                                                        <div class="col-lg-12">
                                                                            <textarea class="form-control btn-square"
                                                                                name="comment" id="comment"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <span class="text-danger" id="comment"
                                                                        style="color: red;">{{ $errors->first('ans') }}</span>
                                                                </div>
                                                                <div class="card-footer">
                                                                    <button class="btn btn-primary" type="submit">
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
                        {{-- end en --}}
                    </div>
                    @if (Laratrust::hasRole('student') && Route::current()->getName() != 'referee')

                        <div class="tab-pane fade" id="ea" role="tabpanel" aria-labelledby="pills-profile-tab">
                            {{-- ea cont --}}
                            @foreach ($ex_answers as $ans)
                                <div class="card col-12">
                                    <div class="card-header">
                                        <div class="row">
                                            <h6>جلسه {{ $ans->session->number }}
                                                : {{ $ans->session->name }}</h6>
                                        </div>
                                        <div class="row">
                                            <h6>سوال: {!! $ans->exercise->text !!}</h6>
                                        </div>
                                        <div class="row">
                                            <h5>پاسخ:{!! $ans->answer !!}</h5>
                                            @if ($ans->file)
                                                <a href="{{ URL::to('/files/answer' . $ans->file) }}" target="_blank">
                                                    دانلود
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="card-body">
                                                <div class="row">
                                                    @if (Laratrust::hasRole('teacher'))
                                                        <div class=" col-md-12">
                                                            <form method="post"
                                                                action="{{ '/dashboard/exercise/scoring?answer_id=' . $ans->id }}"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                <label>امتیاز</label>
                                                                <div class="col">

                                                                    <input type="radio" id="awli" name="score" value="1"
                                                                        {{ $ans->status == 1 ? 'checked' : '' }}
                                                                        required>
                                                                    <label for="awli">عالی</label><br>
                                                                    <input type="radio" id="khob" name="score" value="2"
                                                                        {{ $ans->status == 2 ? 'checked' : '' }}>
                                                                    <label for="khob">خوب</label><br>
                                                                    <input type="radio" id="motevaset" name="score"
                                                                        value="3"
                                                                        {{ $ans->status == 3 ? 'checked' : '' }}>
                                                                    <label for="motevaset">متوسط</label><br>
                                                                    <input type="radio" id="bad" name="score" value="4"
                                                                        {{ $ans->status == 4 ? 'checked' : '' }}>
                                                                    <label for="bad">ضعیف</label><br>

                                                                </div>
                                                                <div class="form-group @if ($errors->has('ans')) has-error @endif">
                                                                    <label>نظر</label>
                                                                    <div class="input-group mb-3">
                                                                        <div class="col-lg-12">
                                                                            <textarea class="form-control btn-square"
                                                                                name="comment" id="comment"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <span class="text-danger" id="comment"
                                                                        style="color: red;">{{ $errors->first('ans') }}</span>
                                                                </div>
                                                                <div class="card-footer">
                                                                    <button class="btn btn-primary" type="submit">
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

                            {{-- end ea --}}
                        </div>
                        <div class="tab-pane fade" id="eo" role="tabpanel" aria-labelledby="pills-profile-tab2">

                            {{-- eo cont --}}
                            @foreach ($ex_answers as $ans)
                                @if ($ans->status == '1' || $ans->status == '2')

                                    <div class="card col-12">
                                        <div class="card-header">
                                            <div class="row">
                                                <h6>جلسه {{ $ans->session->number }}
                                                    : {{ $ans->session->name }}</h6>
                                            </div>
                                            <div class="row">
                                                <h6>سوال: {!! $ans->exercise->text !!}</h6>
                                            </div>
                                            <div class="row">
                                                <h5>پاسخ:{!! $ans->answer !!}</h5>
                                                @if ($ans->file)
                                                    <a href="{{ URL::to('/files/answer' . $ans->file) }}"
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
                                                        @if (Laratrust::hasRole('teacher'))
                                                            <div class=" col-md-12">
                                                                <form method="post"
                                                                    action="{{ '/dashboard/exercise/scoring?answer_id=' . $ans->id }}"
                                                                    enctype="multipart/form-data">
                                                                    @csrf
                                                                    <label>امتیاز</label>
                                                                    <div class="col">

                                                                        <input type="radio" id="awli" name="score" value="1"
                                                                            {{ $ans->status == 1 ? 'checked' : '' }}
                                                                            required>
                                                                        <label for="awli">عالی</label><br>
                                                                        <input type="radio" id="khob" name="score" value="2"
                                                                            {{ $ans->status == 2 ? 'checked' : '' }}>
                                                                        <label for="khob">خوب</label><br>
                                                                        <input type="radio" id="motevaset" name="score"
                                                                            value="3"
                                                                            {{ $ans->status == 3 ? 'checked' : '' }}>
                                                                        <label for="motevaset">متوسط</label><br>
                                                                        <input type="radio" id="bad" name="score" value="4"
                                                                            {{ $ans->status == 4 ? 'checked' : '' }}>
                                                                        <label for="bad">ضعیف</label><br>

                                                                    </div>
                                                                    <div class="form-group @if ($errors->has('ans')) has-error @endif">
                                                                        <label>نظر</label>
                                                                        <div class="input-group mb-3">
                                                                            <div class="col-lg-12">
                                                                                <textarea class="form-control btn-square"
                                                                                    name="comment" id="comment"></textarea>
                                                                            </div>
                                                                        </div>
                                                                        <span class="text-danger" id="comment"
                                                                            style="color: red;">{{ $errors->first('ans') }}</span>
                                                                    </div>
                                                                    <div class="card-footer">
                                                                        <button class="btn btn-primary" type="submit">
                                                                            ثبت
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        @endif
                                                        @if ($ans->comment)
                                                            <div class="row"
                                                                style="color: red;  margin-bottom: 10px">
                                                                نظر استاد.{{ $ans->comment }}
                                                            </div>
                                                        @endif

                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                @endif
                            @endforeach

                            {{-- eo end --}}
                        </div>
                        <div class="tab-pane fade" id="db" role="tabpanel" aria-labelledby="pills-profile-tab">
                            {{-- eb cont --}}
                            @foreach ($ex_answers as $ans)
                                @if ($ans->status == '3' || $ans->status == '4')

                                    <div class="card col-12">
                                        <div class="card-header">
                                            <div class="row">
                                                <h6>جلسه {{ $ans->session->number }}
                                                    : {{ $ans->session->name }}</h6>
                                            </div>
                                            <div class="row">
                                                <h6>سوال: {!! $ans->exercise->text !!}</h6>
                                            </div>
                                            <div class="row">
                                                <h5>پاسخ:{!! $ans->answer !!}</h5>
                                                @if ($ans->file)
                                                    <a href="{{ URL::to('/files/answer' . $ans->file) }}"
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
                                                        @if (Laratrust::hasRole('teacher'))
                                                            <div class=" col-md-12">
                                                                <form method="post"
                                                                    action="{{ '/dashboard/exercise/scoring?answer_id=' . $ans->id }}"
                                                                    enctype="multipart/form-data">
                                                                    @csrf
                                                                    <label>امتیاز</label>
                                                                    <div class="col">

                                                                        <input type="radio" id="awli" name="score" value="1"
                                                                            {{ $ans->status == 1 ? 'checked' : '' }}
                                                                            required>
                                                                        <label for="awli">عالی</label><br>
                                                                        <input type="radio" id="khob" name="score" value="2"
                                                                            {{ $ans->status == 2 ? 'checked' : '' }}>
                                                                        <label for="khob">خوب</label><br>
                                                                        <input type="radio" id="motevaset" name="score"
                                                                            value="3"
                                                                            {{ $ans->status == 3 ? 'checked' : '' }}>
                                                                        <label for="motevaset">متوسط</label><br>
                                                                        <input type="radio" id="bad" name="score" value="4"
                                                                            {{ $ans->status == 4 ? 'checked' : '' }}>
                                                                        <label for="bad">ضعیف</label><br>

                                                                    </div>
                                                                    <div class="form-group @if ($errors->has('ans')) has-error @endif">
                                                                        <label>نظر</label>
                                                                        <div class="input-group mb-3">
                                                                            <div class="col-lg-12">
                                                                                <textarea class="form-control btn-square"
                                                                                    name="comment" id="comment"></textarea>
                                                                            </div>
                                                                        </div>
                                                                        <span class="text-danger" id="comment"
                                                                            style="color: red;">{{ $errors->first('ans') }}</span>
                                                                    </div>
                                                                    <div class="card-footer">
                                                                        <button class="btn btn-primary" type="submit">
                                                                            ثبت
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        @endif
                                                        @if ($ans->comment)
                                                            <div class="row"
                                                                style="color: red;  margin-bottom: 10px">
                                                                نظر استاد.{{ $ans->comment }}
                                                            </div>
                                                        @endif

                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                @endif
                            @endforeach

                            {{-- end eb --}}
                        </div>
                    @endif

                </div>
                {{--  --}}


            </div>
            {{-- r content --}}
            <div class="tab-pane fade" id="r" role="tabpanel" aria-labelledby="animated-underline-profile-tab">
                <div class="media">

                    {{--  --}}
                </div>
            </div>
            {{-- e content --}}
            <div class="tab-pane fade" id="e" role="tabpanel" aria-labelledby="animated-underline-contact-tab">

                {{--  --}}
            </div>
        </div>


    @endif
    </div>
    </div>


    </div>

    </div>
    </div>
    @include('dashboard2.layout.footer')
    </div>


@endsection

@section('end')

    <script src="{{ '/style/assets/js/scrollspyNav.js' }}"></script>


    {{--  --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.5.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script>
        $("ul.nav-tabs a").click(function(e) {
            e.preventDefault();
            $(this).tab('show');
        });
    </script>
    {{--  --}}

    <script src="{{ '/style/assets/js/widgets/modules-widgets.js' }}"></script>



@endsection
