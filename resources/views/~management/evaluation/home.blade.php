@extends('management.layout.master')
@section('add-styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/pages/page-account-settings.min.css') }}">
@endsection
@section('title', 'ارزیابی')
@section('main-content')
    <div class="row">
        <div class="col s12 m12 l12">
            <div id="swipeable-tabs" class="card card card-default scrollspy">
                <div class="card-content">
                    <h4 class="header">میخوام یه آمار از عملکردت بهت بدم</h4>
                    <section class="tabs-vertical mt-1 section">
                        <div class="col l3 s12 mt-3">
                            <!-- tabs  -->
                            <div class="card-panel">
                                <ul class="tabs">
                                    <li class="tab">
                                        <a href="#general" class="custom-main-tab-link"
                                            onclick="handleActuality('questions', {{ $course->id }})">
                                            <i class="material-icons dp48">question_answer</i>
                                            @if (Laratrust::hasRole('teacher'))
                                                <span
                                                    onclick="handleActuality('questions')">سوالات({{ $q_not }})</span>
                                            @else
                                                <span onclick="handleActuality('questions')">سوالات</span>
                                            @endif
                                        </a>
                                    </li>
                                    <li class="tab">
                                        <a class="custom-main-tab-link" href="#"
                                            onclick="handleActuality('reports', {{ $course->id }})">
                                            <i class="material-icons dp48">record_voice_over</i>
                                            @if (Laratrust::hasRole('teacher'))
                                                <span onclick="handleActuality('reports')">گزارش({{ $d_not }})</span>
                                            @else
                                                <span onclick="handleActuality('reports')">گزارش</span>
                                            @endif
                                        </a>
                                    </li>
                                    <li class="tab">
                                        <a href="#test-swipe-3" class="active custom-main-tab-link"
                                            onclick="handleActuality('home work', {{ $course->id }})">
                                            <i class="material-icons dp48">work</i>
                                            @if (Laratrust::hasRole('teacher'))
                                                <span onclick="handleActuality('home')">تکلیف({{ $e_not }})</span>
                                            @else
                                                <span onclick="handleActuality('home')">تکلیف</span>
                                            @endif
                                        </a>
                                    </li>
                                    <li class="indicator" style="left: 0px; right: 0px;"></li>
                                </ul>
                            </div>
                        </div>
                    </section>
                    <div class="row d-flex">
                        <div class="col s12">
                            <ul id="tabs-swipe-demo" class="tabs">
                                <li class="tab col m4 custom_active_tabes">
                                    <a href="#test-swipe-1" class="active custom-main-tab-link custom_actuality_tab"> بررسی
                                        نشده({{ $e_not }})
                                    </a>
                                </li>
                                @if (Laratrust::hasRole('student') && Route::current()->getName() != 'referee')
                                    <li class="tab col m4 custom_active_tabes">
                                        <a class="custom-main-tab-link custom_actuality_tab" href="#test-swipe-2">همه</a>
                                    </li>
                                    <li class="tab col m4 custom_active_tabes">
                                        <a class="custom-main-tab-link custom_actuality_tab" href="#test-swipe-3">تایید
                                            شده</a>
                                    </li>
                                    <li class="tab col m4 custom_active_tabes">
                                        <a class="custom-main-tab-link custom_actuality_tab" href="#test-swipe-4">تایید
                                            نشده</a>
                                    </li>
                                    <li class="tab col m4 custom_active_tabes">
                                        <a class="custom-main-tab-link custom_actuality_tab" href="#test-swipe-5">نیازمند
                                            اصلاح</a>
                                    </li>
                                @endif
                                <li class="indicator" style="left: 15px; right: 1039px;"></li>
                            </ul>
                            <div class="tabs-content carousel carousel-slider">
                                <div id="test-swipe-1" class="col s12 carousel carousel-item"
                                    style="z-index: -1; opacity: 0.058505; visibility: visible; transform: translateX(0px) translateX(-2257.6px) translateZ(0px);">
                                    <div class="quetion_container z-depth-5"></div>
                                    <div class="col s12 mt-1 custom_question_wrapper">
                                        @foreach ($ex_answers as $ans)
                                            @if (!$ans->status)
                                                <small class="question_title">جلسه {{ $ans->session->number }}
                                                    : {{ $ans->session->name }}</small>
                                                <h6>{!! $ans->exercise->text !!}</h6>
                                                <div class="row">
                                                    <label
                                                        style="size: 13px;line-height:20px">پاسخ:{!! $ans->answer !!}</label>
                                                    @if ($ans->file)
                                                        <a href="{{ URL::to('/files/answer' . $ans->file) }}"
                                                            target="_blank">
                                                            دانلود
                                                        </a>
                                                    @endif
                                                </div>
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
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div id="test-swipe-2" class="col s12 carousel carousel-item"
                                    style="transform: translateX(0px) translateX(-1535px) translateZ(0px); z-index: -1; opacity: 1; visibility: visible;">
                                    <div class="quetion_container z-depth-5"></div>
                                    <div class="col s12 mt-1 custom_question_wrapper">
                                        @foreach ($ex_answers as $ans)
                                            <small class="question_title">جلسه {{ $ans->session->number }}
                                                : {{ $ans->session->name }}</small>
                                            <h6>{!! $ans->exercise->text !!}</h6>
                                            <div class="row">
                                                <h5>پاسخ:{!! $ans->answer !!}</h5>
                                                @if ($ans->file)
                                                    <a href="{{ URL::to('/files/answer' . $ans->file) }}"
                                                        target="_blank">
                                                        دانلود
                                                    </a>
                                                @endif
                                            </div>
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
                                                                    {{ $ans->status == 1 ? 'checked' : '' }} required>
                                                                <label for="awli">عالی</label><br>
                                                                <input type="radio" id="khob" name="score" value="2"
                                                                    {{ $ans->status == 2 ? 'checked' : '' }}>
                                                                <label for="khob">خوب</label><br>
                                                                <input type="radio" id="motevaset" name="score" value="3"
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
                                        @endforeach
                                    </div>
                                </div>
                                <div id="test-swipe-3" class="col s12 carousel carousel-item active"
                                    style="transform: translateX(0px) translateX(0px) translateX(0px) translateZ(0px); z-index: 0; opacity: 1; visibility: visible;">
                                    <div class="quetion_container z-depth-5"></div>
                                    <div class="col s12 mt-1 custom_question_wrapper">
                                        @foreach ($ex_answers as $ans)
                                            @if ($ans->status == '1' || $ans->status == '2')
                                                <small class="question_title">جلسه {{ $ans->session->number }}
                                                    : {{ $ans->session->name }}</small>
                                                <h6>{!! $ans->exercise->text !!}</h6>
                                                <div class="row">
                                                    <h5>پاسخ:{!! $ans->answer !!}</h5>
                                                    @if ($ans->file)
                                                        <a href="{{ URL::to('/files/answer' . $ans->file) }}"
                                                            target="_blank">
                                                            دانلود
                                                        </a>
                                                    @endif
                                                </div>
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
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div id="test-swipe-4" class="col s12 carousel carousel-item  active"
                                    style="transform: translateX(0px) translateX(0px) translateX(0px) translateZ(0px); z-index: 0; opacity: 1; visibility: visible;">
                                    <div class="quetion_container z-depth-5"></div>
                                    <div class="col s12 mt-1 custom_question_wrapper">
                                        @foreach ($ex_answers as $ans)
                                            @if ($ans->status == '3' || $ans->status == '4')
                                                <small class="question_title">جلسه {{ $ans->session->number }}
                                                    : {{ $ans->session->name }}</small>
                                                <h6>سوال: {!! $ans->exercise->text !!}</h6>
                                                <div class="row">
                                                    <h5>پاسخ:{!! $ans->answer !!}</h5>
                                                    @if ($ans->file)
                                                        <a href="{{ URL::to('/files/answer' . $ans->file) }}"
                                                            target="_blank">
                                                            دانلود
                                                        </a>
                                                    @endif
                                                </div>
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
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div id="test-swipe-5" class="col s12 carousel carousel-item  active"
                                    style="transform: translateX(0px) translateX(0px) translateX(0px) translateZ(0px); z-index: 0; opacity: 1; visibility: visible;">
                                    <div class="quetion_container z-depth-5"></div>
                                    <div class="col s12 mt-1 custom_question_wrapper">
                                        @foreach ($questions_ret as $question)
                                            <small class="question_title">جلسه {{ $question->session->number }}
                                                : {{ $question->session->name }}</small>
                                            <h6>{!! $question->question !!}</h6>
                                            <P class="custom_actuality_answers"
                                                style="@if ($question->answer == 1)color: forestgreen; @endif margin-bottom: 10px">
                                                1.{{ $question->answer1 }}
                                            </p>
                                            <P class="custom_actuality_answers"
                                                style="@if ($question->answer == 2)color: forestgreen; @endif margin-bottom: 10px">
                                                2.{{ $question->answer2 }}
                                            </p>
                                            <P class="custom_actuality_answers"
                                                style="@if ($question->answer == 3)color: forestgreen; @endif margin-bottom: 10px ">
                                                3.{{ $question->answer3 }}
                                            </p>
                                            <P class="custom_actuality_answers"
                                                style="@if ($question->answer == 4)color: forestgreen; @endif margin-bottom: 10px">
                                                4.{{ $question->answer4 }}
                                            </p>
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
                                                            @elseif($nazar->score == 2)
                                                                گزینه
                                                                ها به هم ریخته
                                                                است

                                                            @elseif($nazar->score == 4)
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
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    function handleActuality(page) {
        window.location.search += `&&page=${page}`;
    }
</script>
@section('js')
    <script src="{{ asset('app-assets/js/scripts/page-account-settings.min.js') }}"></script>
@endsection
