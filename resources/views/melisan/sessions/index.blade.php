@extends('melisan.layout.master')
@section('add-styles')

    <style>
        /**{*/
        /*font-size:1vw !important;*/
        /*}*/
        *{
            scroll-behavior: smooth;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/pages/page-account-settings.min.css') }}">
@endsection
@section('title', 'مدیریت درس')
@section('main-content')
    @if($member==0)
        <div class="row">

            <form action="/dashboard/courses/join" method="post">
                @CSRF
                <input name="code" value="{{$course->code}} " style="display:none">

                <button type="submit" class="chip gradient-45deg-purple-deep-orange gradient-shadow white-text"  >
                    <div class="col s12 m4" style=" ">
                        <div class="chip gradient-45deg-purple-deep-orange gradient-shadow white-text"
                             style="width:75vw">
                            <img src="../../../app-assets/images/icon/true.png" alt="Materialize">
                            عضویت
                        </div>
                    </div>
                </button>

            </form>
        </div>
    @endif
    <!-- @if($member==1)
        @if($course->private==1)
            @if($paid==0)

                <div class="row">

                    <a
                        href="#">
                        <div class="col s12 m4" style=" ">
                            <div class="chip gradient-45deg-purple-deep-orange gradient-shadow white-text"
                                 style="width:75vw">
                                <img src="../../../app-assets/images/icon/dollar.png" alt="Materialize">
                                برای مشاهده جلسات چهارم به بعد باید هزینه دوره را پرداخت کنید
                            </div>
                        </div>
                    </a>
                </div>
            @endif
        @endif
    @endif -->

    @if($member==1)

        <div class="row">
            <div class="col 12 s12">
                @if ($user->hasRole('teacher'))
                    <!--<a href="{{ route('course.delete', $course->id) }}"-->
                    <!--   onclick="return confirm('با حذف این درس کلیه جلسات مربوط به آن و فعالیت دانشجویان حذف شده و قابل برگشت نیست.آیا با حذف این درس کاملا موافق هستید؟  ')"-->
                    <!--   class="mb-6 btn-floating waves-effect waves-light gradient-45deg-purple-deep-orange gradient-shadow tooltipped"-->
                    <!--   data-position="top" data-tooltip="حذف درس">-->
                    <!--    <i class="material-icons">clear</i>-->
                    <!--    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg> --}}-->
                    <!--    <i data-feather="trash"></i>-->

                    <!--</a>-->
                    <!--<a href="{{ route('course.edit', $course->id) }}"-->
                    <!--   class="mb-6 btn-floating waves-effect waves-light gradient-45deg-light-blue-cyan gradient-shadow tooltipped"-->
                    <!--   data-position="bottom" data-tooltip="ویرایش درس">-->
                    <!--    <i class="material-icons dp48">edit</i>-->
                    <!--    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg> --}}-->
                    <!--    <i data-feather="edit"></i>-->


                    <!--</a>-->

                    <!--<a onclick="share()"-->
                    <!--   class="mb-6 btn-floating waves-effect waves-light gradient-45deg-amber-amber gradient-shadow tooltipped"-->
                    <!--   data-position="top" data-tooltip="اشتراک گذاری درس">-->
                    <!--    <i class="material-icons dp48">share</i>-->
                    <!--    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg> --}}-->
                    <!--    <i data-feather="share-2"></i>-->


                    <!--</a>-->
                    <!--<a href="/dashboard/courses/create?copy={{$course->id}}"-->
                    <!--   class="mb-6 btn-floating waves-effect waves-light gradient-45deg-amber-amber gradient-shadow tooltipped"-->
                    <!--   data-position="top" data-tooltip="کپی درس">-->
                    <!--    <i class="material-icons dp48">content_copy</i>-->
                    <!--    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg> --}}-->
                    <!--    <i data-feather="content_copy"></i>-->


                    <!--</a>-->
                    <div class="col s12" style="width: fit-content; padding: 0 5px">
                        <a onclick="onHelpClick()"
                           class="mb-6 btn-floating waves-effect waves-light gradient-45deg-amber-amber gradient-shadow tooltipped"
                           data-position="bottom" data-tooltip="میخوام راهنماییت کنم">
                            <i class="material-icons dp48">help</i>
                        </a>
                    </div>
                  {{--  <div class="col s12" style="width: fit-content; padding: 0 5px">
                        <a onclick="showDetail()"
                           class="mb-6 btn-floating waves-effect waves-light gradient-45deg-amber-amber gradient-shadow tooltipped"
                           data-position="bottom" data-tooltip="نمایش جزئیات">
                            <i class="material-icons dp48">settings</i>
                        </a>
                    </div>
                    --}}
                    @include('management.layout.components.btn-back.btn-back')
                    
                @endif
                <!-- علامت تنظیمات  -->
                <div class="col-md-12" style="width: fit-content; padding: 0 5px">
                        <a onclick="showDetail()"
                           class="mb-6 btn-floating waves-effect waves-light gradient-45deg-amber-amber gradient-shadow tooltipped"
                           data-position="bottom" data-tooltip="نمایش جزئیات">
                            <i class="material-icons dp48">settings</i>
                        </a>
                    </div>
                                    <!-- پایان علامت تنظیمات  -->

            </div>
        </div>

        <div id="colla" style="display: none">
        <div class="row">

            @if ($user->hasRole('teacher'))
                <a href="#">
                    <div class="col s6 m4" style="">
                        <div class="chip gradient-45deg-purple-deep-orange gradient-shadow white-text"
                             style="width:200px">
                            <img src="../../../app-assets/images/icon/true.png" alt="Materialize">
                            اعتراضات(غیر فعال)
                        </div>
                    </div>
                </a>
            @endif
            @if ($user->hasRole('teacher'))
                <a href="/dashboard/courses/students?course_id={{ $course->id }}">
                    <div class="col s6 m4" style="">
                        <div class="chip gradient-45deg-purple-deep-orange gradient-shadow white-text"
                             style="width:200px">
                            <img src="../../../app-assets/images/icon/true.png" alt="Materialize">{{ $course->count }}
                            نفر
                            دانشجو
                        </div>
                    </div>
                </a>
            @endif
            @if ($course->davari == 1 && $isJudment)
                @if ($user->hasRole('student'))
                    <a href="/dashboard/referee/foo/?course_id={{ $course->id }}">
                        <div class="col-md-6 m4  ">

                            <div class="chip gradient-45deg-purple-deep-orange gradient-shadow white-text"
                                 style="width:200px">
                                <img src="../../../app-assets/images/icon/true.png" alt="Materialize">
                                داوری دوستان
                            </div>
                        </div>
                    </a>
                @endif
            @endif
            @if ($user->hasRole('teacher'))
                <a href="/dashboard/allprogress?course_id={{ $course->id }}">
                    <div class="col-md-6 m4">

                        <div class="chip gradient-45deg-purple-deep-orange gradient-shadow white-text"
                             style="width:200px">
                            <img src="../../../app-assets/images/icon/true.png" alt="Materialize">
                            رصد دانشجویان
                        </div>
                    </div>
                </a>
            @endif
            @if ($course->faaliat == 1 || $user->hasRole('teacher'))
                <a href="/dashboard/evaluation?course_id={{ $course->id }}">
                    <div class="col s6 m4">
                        <div class="chip gradient-45deg-purple-deep-orange gradient-shadow white-text"
                             style="width:200px">
                            <img src="../../../app-assets/images/icon/true.png" alt="Materialize">
                            @if ($user->hasRole('teacher'))
                                پایش و ارزیابی
                            @elseif($user->hasRole('student'))
                                فعالیتهای من
                            @endif
                        </div>
                    </div>
                </a>
            @endif
            @if ($user->hasRole('teacher'))
                <a href="/dashboard/courses/setting?course_id={{ $course->id }}">
                    <div class="col s6 m4">
                        <div class="chip gradient-45deg-purple-deep-orange gradient-shadow white-text"
                             style="width:200px">
                            <img src="../../../app-assets/images/icon/true.png" alt="Materialize">
                            تنظیمات
                        </div>
                    </div>
                </a>
            @endif
            @if ($user->hasRole('teacher'))
                <a href="/dashboard/courses/bank?course_id={{ $course->id }}">
                    <div class="col s6 m4">
                        <div class="chip gradient-45deg-purple-deep-orange gradient-shadow white-text"
                             style="width:200px">
                            <img src="../../../app-assets/images/icon/true.png" alt="Materialize">
                            بانک سوالات
                        </div>
                    </div>
                </a>
            @endif
            @if ($user->hasRole('teacher'))
                <a href="/dashboard/azmon?id={{ $course->id }}">
                    <div class="col s6 m4">
                        <div class="chip gradient-45deg-purple-deep-orange gradient-shadow white-text"
                             style="width:200px">
                            <img src="../../../app-assets/images/icon/true.png" alt="Materialize">
                            تعریف آزمون
                        </div>
                    </div>
                </a>
            @endif
            <!--@if ($user->hasRole('teacher') && \Illuminate\Support\Facades\Auth::user()->id == 3)-->
            <!--    <a onclick="let foo = prompt('کد آزمون را وارد کنید...');-->
            <!--                let dars = document.getElementById('course_id').innerText;-->
            <!--                 window.open('/dashboard/azmon/azmon?cd='+foo+'&course_id='+ dars ,'_self'); ">-->
            <!--        <div class="col s12 m2 l2">-->
            <!--            <div class="chip gradient-45deg-purple-deep-orange gradient-shadow white-text" style="width: 200px">-->
            <!--                <img src="../../../app-assets/images/icon/true.png" alt="Materialize">-->
            <!--                آزمون ها-->
            <!--            </div>-->
            <!--        </div>-->
            <!--    </a>-->
            <!--@endif-->
            @if ($user->hasRole('teacher'))
                <a href="/dashboard/survey?course_id={{ $course->id }}">
                    <div class="col s6 m4">
                        <div class="chip gradient-45deg-purple-deep-orange gradient-shadow white-text"
                             style="width:200px">
                            <img src="../../../app-assets/images/icon/true.png" alt="Materialize">
                            نظرسنجی
                        </div>
                    </div>
                </a>
            @endif
            @if ($user->hasRole('teacher'))
                <a href="/dashboard/kholaseha?course_id={{ $course->id }}">
                    <div class="col s6 m4">
                        <div class="chip gradient-45deg-purple-deep-orange gradient-shadow white-text"
                             style="width:200px">
                            <img src="../../../app-assets/images/icon/true.png" alt="Materialize">
                            لیست گزارش دانشجویان
                        </div>
                    </div>
                </a>
            @endif
            @if ($course->quiz == 1)
                @if ($user->hasRole('student'))
                    @if ($course->sessions()->count() > 0 && $course->quizCount($course) == false && $khodazmaii == 1)
                        <a @if ($course->sessions()->count() > 0 && $course->quizCount($course) == false)
                               href="/dashboard/quiz?course_id={{ $course->id }}"
                           @else disabled
                            @endif>
                            <div class="col s6 m4">
                                <div class="chip gradient-45deg-purple-deep-orange gradient-shadow white-text"
                                     style="width:200px"
                                >
                                    <img src="../../../app-assets/images/icon/true.png" alt="Materialize">
                                    خودآزمایی
                                </div>
                            </div>
                        </a>
                    @endif
                @endif
            @endif
            @if ($course->pishraft == 1)
                @if ($user->hasRole('student'))
                    <a
                        href="/dashboard/progress?course_id={{ $course->id }}&user={{ \Illuminate\Support\Facades\Auth::user()->id }}">
                        <div class="col s6 m4" style=" ">
                            <div class="chip gradient-45deg-purple-deep-orange gradient-shadow white-text"
                                 style="width:200px">
                                <img src="../../../app-assets/images/icon/true.png" alt="Materialize">
                                پیشرفت درسی
                            </div>
                        </div>
                    </a>
                @endif
            @endif
            <!--@if ($user->hasRole('student'))-->
            <!--    <span id="course_id" hidden data-name="{{ $course->id }}">{{ $course->id }}</span>-->
            <!--    <a href="#"-->
            <!--       onclick="                                                                                                                                                                                                                                                                   ">-->
            <!--        <div class="col s12 m2 l2">-->
            <!--            <div class="chip gradient-45deg-purple-deep-orange gradient-shadow white-text" style="width: 200px">-->
            <!--                <img src="../../../app-assets/images/icon/true.png" alt="Materialize">-->
            <!--                انجام آزمون-->
            <!--            </div>-->
            <!--        </div>-->
            <!--    </a>-->
            <!--    @endif-->
        </div>

    @endif
    @if ($user->hasRole('teacher'))
        <div class="row">
            <div class="col s12">
                <div id="checkboxes" class="card card-tabs">
                    <div class="card-content">
                        <div class="card-title">
                            <div class="row">
                                <div class="col s12 m6 l10">
                                    <h6 class=" ">وضعیت درس</h4>
                                </div>
                            </div>
                            <!--</div>-->
                            <!--                            <div class="card-body">-->

                            <div id="view-checkboxes" class="row">
                                <p>مدرس گرامی ! شما میتوانید تنظیمات بیشتر درس خوردا در باکس زیر کنترل نمایید .
                                    <code class=" language-markup">فعال بودن</code>
                                    به معنای وجود دسترسی و
                                    <code class=" language-markup">غیر فعال بودن</code>
                                    به معنای نبود دسترسی میباشد .
                                </p>

                                <p class=" col s12 m4 mb-1">
                                    <label>
                                        <input type="checkbox" @if ($course->active == 1) checked @endif
                                        onchange="window.location.href='{{ route('course.active', $course->id) }}'">
                                        <span>در حال برگزاری</span>
                                        <span class="slider round"></span>
                                    </label>
                                </p>
                                <p class="col s12 m4 mb-1">
                                    <label>
                                        <input type="checkbox" @if ($course->archieve == 1) checked @endif
                                        onchange="window.location.href='{{ route('course.arch.post', $course->id) }}'">
                                        <span> ارشیو  </span>
                                        <span class="slider round"></span>
                                    </label>
                                </p>
                                @if ($course->active == 1)
                                    <p class="col s12 m4 mb-1">
                                        <label>
                                            <input type="checkbox" @if ($course->private == 1) checked @endif
                                            onchange="window.location.href='{{ route('course.private', $course->id) }}'">
                                            <span>انتشار به صورت دوره</span>
                                            <span class="slider round"></span>
                                        </label>
                                    </p>
                                    @if($course->private == 1)
                                        <form class="col s12"
                                              action="/dashboard/courses/period/{{$course->id}}"
                                              method="post" enctype="multipart/form-data">
                                            @csrf

                                            <div class="input-field">
                                                <i class="material-icons dp48 prefix">beenhere</i>
                                                <textarea name="desc" id="desc">{{$course->desc}}</textarea>

                                                <label class="contact-input" for="desc">
                                                    توضیحات
                                                </label>
                                            </div>

                                            <div class="input-field">
                                                <i class="material-icons dp48 prefix">format_list_numbered</i>
                                                <input name="days" id="days" type="number" required
                                                       class="validate"
                                                       value="{{$course->period}}">
                                                <label class="contact-input" for="days">بازه زمانی فعال شدن هر
                                                    درس به روز</label>
                                            </div>


                                            <div class="input-field">
                                                <i class="material-icons dp48 prefix">attach_money</i>
                                                <input name="price" id="price" type="number" required
                                                       class="validate"
                                                       value="{{$course->price}}">
                                                <label class="contact-input" for="price">
                                                    هزینه(تومان)
                                                </label>
                                            </div>

                                            <div class="input-field">
                                                <i class="material-icons dp48 prefix">av_timer</i>
                                                <input name="length" id="length" type="number" required
                                                       class="validate"
                                                       value="{{$course->length}}">
                                                <label class="contact-input" for="length">
                                                    طول دوره (روز)
                                                </label>
                                            </div>


                                            <div class="input-field">
                                                <i class="material-icons dp48 prefix">check</i>
                                                <input name="sessions" id="sessions" type="number" required
                                                       class="validate"
                                                       value="{{$course->sessions_length}}">
                                                <label class="contact-input" for="sessions">
                                                    تعداد جلسات
                                                </label>
                                            </div>



                                        <div class="input-field col s12">
                                            <select class="form-control" id="type" name="type" required
                                                >
                                                <option value="" disabled selected>گروه درس را انتخاب کنید</option>
                                                    <option value="1" @if($course->type==1) selected @endif>آموزش زبان
                                                    </option>
                                                    <option value="2" @if($course->type==2) selected @endif>مهارت
                                                        آموزی
                                                    </option>
                                                    <option value="3" @if($course->type==3) selected @endif>آزمون های
                                                        بسندگی
                                                    </option>
                                                    <option value="4" @if($course->type==4) selected @endif>هنرآموزی
                                                    </option>
                                                    <option value="5" @if($course->type==5) selected @endif>اموزش های
                                                        عمومی
                                                    </option>
                                               
                                               
                                            </select>
                                            <label for="type">
                                                گروه درس
                                                </label>
                                        </div>


 

                                            <input type="submit"
                                                   class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 float-right"
                                                   value="ثبت ">
                                        </form>
                                    @endif
                                    <p class=" col s12 m4 mb-1">
                                        <label>
                                            <input type="checkbox" @if ($course->status == 1) checked @endif
                                            onchange="window.location.href='{{ route('course.status', $course->id) }}'">
                                            <span>نمایش جلسات درس</span>
                                            <span class="slider round"></span>
                                        </label>
                                    </p>
                                    <p class="col s12 m4 mb-1">
                                        <label>
                                            <input type="checkbox" @if ($course->davari == 1) checked @endif
                                            onchange="window.location.href='{{ route('course.davari', $course->id) }}'">
                                            <span>امکان انجام داوری</span>
                                            <span class="slider round"></span>
                                        </label>
                                    </p>
                                    <p class=" col s12 m4 mb-1">
                                        <label>
                                            <input type="checkbox" @if ($course->quiz == 1) checked @endif
                                            onchange="window.location.href='{{ route('course.quiz', $course->id) }}'">
                                            <span>
                                                شرکت در خود آزمایی
                                            </span>
                                            <span class="slider round"></span>
                                        </label>
                                    </p>
                                    <p class="col s12 m4 mb-1">
                                        <label>
                                            <input type="checkbox" @if ($course->faaliat == 1) checked @endif
                                            onchange="window.location.href='{{ route('course.faaliat', $course->id) }}'">
                                            <span>مشاهده فعالیت ها
                                            </span>
                                            <span class="slider round"></span>
                                        </label>
                                    </p>
                                    <p class="col s12 m4 mb-1">
                                        <label>
                                            <input type="checkbox" @if ($course->pishraft == 1) checked @endif
                                            onchange="window.location.href='{{ route('course.pishraft', $course->id) }}'">
                                            <span>مشاهده پیشرفت درسی
                                            </span>
                                            <span class="slider round"></span>
                                        </label>
                                    </p>
                                @endif

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

        </div>

    <!--<h6 style="color:red"  >با انتخاب جلسه ، محتوای جلسه در پایین قابل مشاهده است</h6>-->
    <section class="tabs-vertical mt-1 section">
        <div class="row">
            <div id="student" hidden>{{ $student }}</div>
            <div class="col s12 m4">
                <!-- tabs  -->
                <div class="card-panel user-list-box">
                    @if ($user->hasRole('teacher'))
                        @include('management.layout.components.btn-loader.btn-loader' ,
                        ['url' => '/dashboard/courses/sessions/create?course_id='. $course->id ,
                        'icon' => "<i class='material-icons dp48'>add_circle_outline</i>",
                        'pos' => 'top' ,
                        'text' => 'جلسه جدید'
                        ])
                    @endif
                    <ul class="tabs" onclick=" ">
                        <!--@foreach ($sessions as $key=>$session)-->
                        <!--    @if($member==1 || $session->number==1)-->


                        <li class="tab    " >


                            <a href="#general{{ $session->id }}" class="person" onclick="fun1()" >
                                <small>(جلسه {{ $session->number }})</small>
                                <i class="material-icons"
                                   style="@if($session->active==1) color:green @else color:red @endif">@if($session->active==1)
                                        check
                                    @else
                                        clear
                                    @endif</i>
                                <span>{{ $session->name }}</span>
                            </a>

                        </li>
                        <!--    @endif-->
                        <!--@endforeach-->
                        <li class="indicator" style="left: 0px; right: 0px;"></li>
                    </ul>
                </div>
            </div>
            <div id="mohtava" class="col s12 m8">
                <!-- tabs content -->
                @if($course->status==1 || $user->hasRole('teacher') )
                    @foreach ($sessions as $session)
                        <!--@if($member==1 || $session->number==1)
                            -->

                            <div id="general{{ $session->id }}" style="display: block;" class="active">
                                <div class="card-panel">
                                    <div class="row">
                                     <span class="user-id" id="user-id" hidden
                                           data-name="{{ $session->id }}">{{ $session->id }}</span>
                                        <span id="taklif_last" hidden
                                              data-name="{{ $session->id }}">{{ $session->taklif_last }}</span>
                                        <span id="gozaresh_last" hidden
                                              data-name="{{ $session->id }}">{{ $session->gozaresh_last }}</span>
                                        <span id="soal_last" hidden
                                              data-name="{{ $session->id }}">{{ $session->soal_last }}</span>

                                        <span id="user-ex"
                                              data-name="{{ $session->ex_count }}"
                                              hidden>{{ $session->ex_count }}</span>


                                        {{--                                    <h5>دسترسی های {{ $session->name }}</h5>--}}
                                        <div class="card">
                                            <h5>جلسه {{ $session->number }} : {{ $session->name }}</h5>
                                        </div>
                                        @if($course->private==1 || $session->soal_last>0)
                                            {{--                                    <div class="col  mt-1" style="display: flex; align-items: center">--}}
                                            {{--                                        <i class="material-icons dp48">keyboard_hide</i>--}}
                                            {{--                                        <a href="/dashboard/question/show?session_id={{ $session->id }}" id="questions"--}}
                                            {{--                                           class="btn ml-6 waves-effect waves-light gradient-45deg-red-pink"--}}
                                            {{--                                           style="width: 136px">--}}
                                            {{--                                            طرح سوال</a>--}}
                                            <a href="/dashboard/question/show?session_id={{ $session->id }}"
                                               id="questions"
                                               class="mb-6 btn-floating waves-effect waves-light gradient-45deg-light-blue-cyan gradient-shadow tooltipped"
                                               data-position="bottom" data-tooltip="طرح سوال">
                                                <i class="material-icons dp48">help_outline</i>
                                            </a>
                                            {{--                                    </div>--}}
                                        @endif
                                        @if ($user->hasRole('teacher'))
                                            {{--                                        <div class="col mt-1" style="display: flex; align-items: center">--}}
                                            {{--                                            <i class="material-icons dp48">keyboard_hide</i>--}}
                                            {{--                                            <a id="homework_teacher"--}}
                                            {{--                                               href="/dashboard/exercise/show/{{ $session->id }}"--}}
                                            {{--                                               class="btn ml-6 waves-effect waves-light gradient-45deg-red-pink"--}}
                                            {{--                                               style="width: 136px">دادن تکلیف</a>--}}
                                            <a id="homework_teacher"
                                               href="/dashboard/exercise/show/{{ $session->id }}"
                                               class="mb-6 btn-floating waves-effect waves-light gradient-45deg-light-blue-cyan gradient-shadow tooltipped"
                                               data-position="bottom" data-tooltip="دادن تکلیف">
                                                <i class="material-icons dp48">format_textdirection_r_to_l</i>
                                            </a>
                                            {{--                                        </div>--}}
                                        @endif
                                        @if ($user->hasRole('teacher'))
                                            {{--                                        <div class="col s12 mt-1" style="display: flex; align-items: center">--}}
                                            {{--                                            <i class="material-icons dp48">keyboard_hide</i>--}}
                                            {{--                                            <a id="active"--}}
                                            {{--                                            href="/dashboard/courses/sessions/active/{{ $session->id }}"--}}

                                            {{--                                            class="btn ml-6 waves-effect waves-light gradient-45deg-red-pink"--}}
                                            {{--                                               style="width: 150px">@if($session->active==1)غیرفعال کردن@else فعال کردن   @endif</a>--}}
                                            {{--                                        </div>--}}
                                            <a id="active"
                                               href="/dashboard/courses/sessions/active/{{ $session->id }}"
                                               class="mb-6 btn-floating waves-effect waves-light gradient-45deg-light-blue-cyan gradient-shadow tooltipped"
                                               data-position="bottom"
                                               data-tooltip="@if($session->active==1)غیرفعال کردن@else فعال کردن   @endif">
                                                <i class="material-icons dp48">done</i>
                                            </a>
                                        @endif
                                        @if(($course->private==1 && $session->ex_count>0)|| ($session->ex_count>0 && $session->taklif_last>0))
                                            {{--                                    <div class="col s12 mt-1" id="homework"  style=" align-items: center;">--}}
                                            {{--                                        <i class="material-icons dp48">keyboard_hide</i>--}}
                                            {{--                                        <a  style="width: 136px"--}}
                                            {{--                                           class="btn ml-6 waves-effect waves-light gradient-45deg-red-pink"--}}
                                            {{--                                           @if ($user->hasRole('teacher')) hidden @endif--}}
                                            {{--                                           href="{{ route('exercise.show', $session->id) }}" >تکلیف</a>--}}
                                            {{--                                    </div>--}}
                                            <a id="homework"
                                               href="{{ route('exercise.show', $session->id) }}"
                                               class="mb-6 btn-floating waves-effect waves-light gradient-45deg-light-blue-cyan gradient-shadow tooltipped"
                                               data-position="bottom" data-tooltip="تکلیف">
                                                <i class="material-icons dp48">format_textdirection_r_to_l</i>
                                            </a>
                                        @endif
                                        @if ($user->hasRole('teacher'))
                                            {{--                                        <div class="col s12 mt-1" style=" align-items: center">--}}
                                            {{--                                            <i class="material-icons dp48">keyboard_hide</i>--}}
                                            {{--                                            <a id="edit"--}}
                                            {{--                                            href="/dashboard/courses/sessions/edit/{{ $session->id }}"--}}
                                            {{--                                            class="btn ml-6 waves-effect waves-light gradient-45deg-red-pink"--}}
                                            {{--                                               style="width: 136px">ویرایش</a>--}}
                                            {{--                                        </div>--}}
                                            <a id="edit"
                                               href="/dashboard/courses/sessions/edit/{{ $session->id }}"
                                               class="mb-6 btn-floating waves-effect waves-light gradient-45deg-light-blue-cyan gradient-shadow tooltipped"
                                               data-position="bottom" data-tooltip="ویرایش">
                                                <i class="material-icons dp48">edit</i>
                                            </a>
                                        @endif
                                        @if ($user->hasRole('teacher'))
                                            {{--                                        <div class="col s12 mt-1" style=" align-items: center">--}}
                                            {{--                                            <i class="material-icons dp48">keyboard_hide</i>--}}
                                            {{--                                            <a id="edit"--}}
                                            {{--                                            href="/dashboard/courses/sessions/edit/{{ $session->id }}"--}}
                                            {{--                                            class="btn ml-6 waves-effect waves-light gradient-45deg-red-pink"--}}
                                            {{--                                               style="width: 136px">ویرایش</a>--}}
                                            {{--                                        </div>--}}
                                            <a id="edit"
                                               href="/dashboard/courses/sessions/prof-ex/{{ $session->id }}"
                                               class="mb-6 btn-floating waves-effect waves-light gradient-45deg-light-blue-cyan gradient-shadow tooltipped"
                                               data-position="bottom" data-tooltip="تکلیفها">
                                                <i class="material-icons dp48">format_textdirection_r_to_l</i>
                                            </a>
                                        @endif
                                        @if ($user->hasRole('student'))
                                            @if($course->private==1 ||  $session->gozaresh_last )
                                                {{--                                    <div class="col s12 mt-1" style="align-items: center">--}}
                                                {{--                                        <i class="material-icons dp48">keyboard_hide</i>--}}
                                                {{--                                        <a href="{{ route('disc.show', $session->id) }}" id="disc"--}}
                                                {{--                                           class="btn ml-6 waves-effect waves-light gradient-45deg-red-pink"--}}
                                                {{--                                           style="width: 136px">گزارش</a>--}}
                                                {{--                                    </div>--}}
                                                <a href="{{ route('disc.show', $session->id) }}" id="disc"
                                                   class="mb-6 btn-floating waves-effect waves-light gradient-45deg-light-blue-cyan gradient-shadow tooltipped"
                                                   data-position="bottom" data-tooltip="گزارش">
                                                    <i class="material-icons dp48">drafts</i>
                                                </a>
                                            @endif
                                        @endif


 @isset($session->text)
                                            <!--<p>{!! $session->text !!}</p>-->
                                            <div class="row">
                                                <div class="col s12">
                                                    <ul class="collapsible" data-collapsible="accordion">
                                                        <li class="active">
                                                            <div class="collapsible-header custom_header_of_collapsible"
                                                                 tabindex="0">
                                                                <a class="btn btn-floating  custom_floating_header_collapsible">
                                                                    <i class="material-icons dp48">notifications_active</i>
                                                                </a> طرح درس یا محتوای درس
                                                            </div>
                                                            <div class="collapsible-body" style="display: block;">
                                                                <p>{!! $session->text !!}</p>

                                                            </div>
                                                            
                                                            
                                                            
                                                            
                                                            
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        @endisset
                                        @if (isset($session->file))
                                        @if(explode('.', $session->file)[1]!='pdf')

                                            <div class="col s12 display-flex justify-content-end form-action">
                                                <a href="{{ URL::to('/files/session' . $session->file) }}"
                                                   target="_blank"
                                                   class="btn indigo waves-effect waves-light mr-1 iransans">دانلود فایل
                                                    پیوست</a>
                                            </div>
                                        @endif
                                        @endif
                                        @if (isset($session->link))
                                            @if (($session->link))
                                                <div class="col s12 display-flex justify-content-end form-action">
                                                    <a href="{{ URL::to('http://' . $session->link) }}" target="_blank"
                                                       class="btn indigo waves-effect waves-light mr-1 iransans">
                                                        محتوای درس
                                                    </a>
                                                </div>
                                            @endif
                                        @endif
                                        @if (isset($session->majazi))
                                            @if (($session->majazi))
                                                <div class="col s12 display-flex justify-content-end form-action">
                                                    <a href="{{ URL::to('http://' . $session->majazi) }}"
                                                       target="_blank"
                                                       class="btn indigo waves-effect waves-light mr-1 iransans">
                                                        فیلم ضبط شده کلاس
                                                    </a>
                                                </div>
                                            @endif
                                        @endif
                                                                                               @isset($session->aparat)

                                                                                    <div class="row mt-2">
                                                <div class="col s12">

                                        
{!!$session->aparat!!}

</div>
</div>
                                        @endif

                                        
                                        @if(isset($session->file))
                                        
                                        @if(explode('.', $session->file)[1]=='pdf')
                                        

                                         <object data="{{ URL::to('/files/session' . $session->file) }}" type="application/pdf" width="100%" height="500px">
     <object width="100%" height="500" data="https://docs.google.com/gview?embedded=true&url={{ URL::to('/files/session' . $session->file) }}"></object>
    </object>
    @endif
    @endif
 
                                        
                                       

                                    </div>
                                </div>
                            </div>
                            <!--@endif-->
                            @endforeach
                        @endif
            </div>
        </div>
    </section>
    <input type="text"
           value={{-- "دانشجوی عزیز،برای دسترسی به درس {{$course->name}} ابتدا از طریق WWW.MALISAN.IR در سامانه آموزشی مالیسان با هویت واقعی ثبت نام کنید سپس با استفاده از کد {{$course->code}} وارد کلاس شوید." --}} "            دانشجوی عزیز، برای دسترسی به درس {{ $course->name }} ابتدا از طریق سایت WWW.MALISAN.IR در سامانه آموزشی ملیسان با هویت واقعی ثبت نام کنید، سپس با استفاده از شناسه {{ $course->code }} در درس ذکر شده عضو شوید."
           id="myInput" style="height: 0px;background: transparent;">
    <div class="col s12">
        <!--<div class="fixed-action-btn" id="help_container" style="bottom: 45px; right: 24px;">-->
        <!--    <a id="menu" class="btn btn-floating btn-large cyan">-->
        <!--        <i class="material-icons">menu</i>-->
        <!--    </a>-->
        <!--</div>-->
        <div class="tap-target cyan" data-target="menu">
            <div class="tap-target-content white-text">
                <h5 class="white-text">
                    @if ($user->hasRole('teacher'))
                        درود مدرس گرامی !
                    @elseif($user->hasRole('student'))
                        دانشجو گرامی !
                    @endif
                </h5>
                <p class="white-text">
                    @if ($user->hasRole('teacher'))
                        دکمه های بالا دکمه های مدیریتی برای شماست و در باکس پایین اطلاعات مربوط به هر جلسه نمایش
                        داده
                        شده است
                    @elseif($user->hasRole('student'))
                        دکمه های بالا دکمه های مدیریتی برای شماست و در باکس پایین اطلاعات مربوط به هر جلسه نمایش
                        داده
                        شده است
                    @endif
                </p>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script>
        function fun1(){
                    document.getElementById('mohtava').scrollIntoView();

        }
    </script>
    
    <script src="{{ asset('app-assets/js/scripts/page-account-settings.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/css-transition.js') }}"></script>
    <script>
        $(' .person').on('click', function (event) {
            $idd = document.getElementById('user-id').innerHTML;
            $taklif_last = document.getElementById('taklif_last').innerHTML;
            $gozaresh_last = document.getElementById('gozaresh_last').innerHTML;
            $soal_last = document.getElementById('soal_last').innerHTML;
            $ex_c = document.getElementById('user-ex').innerHTML;
            $xx = document.getElementById("student").innerHTML;
            // if (document.getElementById("student").innerHTML == 1) {
            //
            //     $work = document.getElementById("homework");
            //     if ($work) {
            //
            //         if ($ex_c == 0) {
            //             document.getElementById("homework").hidden = true;
            //         }
            //         else
            //             document.getElementById("homework").hidden = false;
            //
            //         if ($taklif_last == 0)
            //             document.getElementById("homework").hidden = true;
            //
            //         document.getElementById("homework").href = '/dashboard/exercise/show?session_id=' + $idd;
            //
            //     }
            // }
            // $work_teacher = document.getElementById("homework_teacher");
            // if ($work_teacher) {
            //     alert("As");
            //     alert($idd);
            //     link=document.getElementById("homework_teacher");
            //     text='/dashboard/exercise/show?session_id=' + $idd;
            //     link.setAttribute('href', text);
            //
            //     alert("Aaa");
            // }
            $edit = document.getElementById("edit");
            if ($edit) {
                document.getElementById("edit").href = '/dashboard/courses/sessions/edit/' + $idd;
            }

            $q = document.getElementById("questions");
            // if ($q) {
            //     if ($soal_last != 1) {
            //         if (document.getElementById("student").innerHTML == 1)
            //             document.getElementById("questions").hidden = true;
            //         else
            //             document.getElementById("questions").hidden = false;
            //     } else
            //         document.getElementById("questions").hidden = false;
            //     document.getElementById("questions").href = '/dashboard/question/show?session_id=' + $idd;
            // } else
            //     document.getElementById("questions").hidden = false;

            // if (document.getElementById("student").innerHTML == 1) {
            //     $disc = document.getElementById("disc");
            //     if ($gozaresh_last == 1)
            //         document.getElementById("disc").hidden = false;
            //     else
            //         document.getElementById("disc").hidden = true;
            //     if ($disc) {
            //         document.getElementById("disc").href = '/dashboard/discussion/create/' + $idd;
            //     }
            //
            //
            // }
            if (document.getElementById("student").innerHTML == 0) {
                $active = document.getElementById("active");
                if ($active) {
                    // $active.classList.add("btn-success");
                    document.getElementById("active").href = '/dashboard/courses/sessions/active/' + $idd;
                }
                // else {
                //     $active.classList.add("btn-danger");
                // }
            }
        });
    </script>

    <script>
        $('.ajaxLink').click(function (e) {
            e.preventDefault(); // Prevents default link action
            $.ajax({
                url: $(this).attr('href'),
                success: function (data) {
                    // Do something
                    $text = document.getElementById("statuss").innerText;
                    if ($text == "جلسه برای دانشجویان قابل مشاهده می باشد")
                        document.getElementById("statuss").innerHTML =
                            " <h6>\n" +
                            "                                                                            <span style=\"color: red\">\n" +
                            "                                                                جلسه برای دانشجویان قابل مشاهده نمی باشد\n" +
                            "                                                                    </span>\n" +
                            "                                                            </h6>"

                    else
                        document.getElementById("statuss").innerHTML =
                            " <h6>\n" +
                            "                                                                    <span style=\"color: green\">\n" +
                            "                                                            جلسه برای دانشجویان قابل مشاهده می باشد\n" +
                            "                                                                    </span>\n" +
                            "                                                            </h6>"

                }
            });
        });
    </script>
    <script>
        function share() {
            /* Get the text field */
            var copyText = document.getElementById("myInput");
            console.log(copyText)
            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            /* For mobile devices */

            /* Copy the text inside the text field */
            document.execCommand("copy");

            /* Alert the copied text */
            alert("متن زیر در حافظه کپی شد:\nبرای دعوت دانشجویان خود به کلاس می توانید آنرا از طریق شبکه های اجتماعی یا پیامک برایشان ارسال کنید.\n " +
                copyText.value);
        }
    </script>
    <script>
        function onHelpClick() {
            $('.tap-target').tapTarget('open');
        }
    </script>
    <script>

        function showDetail() {
            colla = document.getElementById('colla')
            if (colla.style.display == 'none') {
                colla.style.display = 'block';
            } else {
                colla.style.display = 'none';
            }
        }
        
    </script>
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{ asset('app-assets/js/scripts/advance-ui-feature-discovery.min.js') }}"></script>
    
    
    
    
    
@endsection
