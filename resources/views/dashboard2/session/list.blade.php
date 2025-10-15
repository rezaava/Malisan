@extends('dashboard2.layout.app')

@section('start')

    <link href="{{ '/style/assets/css/apps/mailing-chat.css' }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="{{ '/style/assets/css/widgets/modules-widgets.css' }}">

    <link href="{{ '/style/assets/css/scrollspyNav.css' }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="{{ '/style/assets/css/forms/switches.css' }}">

    <script>
        $ex_c = 0;
    </script>

@endsection
@section('main')

    <div id="content" class="main-content">

        @include('dashboard.layout.message')


        <div class="layout-px-spacing">

            <div {{-- class="layout-px-spacing" --}} class="">

                <div class="page-header">
                    <div class="page-title">
                        <div class="row">
                            <h3 style="margin-right: 50px;margin-left: 15px">
                                {{ $course->name }}
                            </h3>
                            @if (Laratrust::hasRole('teacher'))
                                <a href="{{ route('course.delete', $course->id) }}"
                                   onclick="return confirm('با حذف این درس کلیه جلسات مربوط به آن و فعالیت دانشجویان حذف شده و قابل برگشت نیست.آیا با حذف این درس کاملا موافق هستید؟  ')"
                                   class="btn btn-danger mb-2 mr-2">
                                    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg> --}}
                                    <i data-feather="trash"></i>

                                </a>
                                <a href="{{ route('course.edit', $course->id) }}" class="btn btn-info mb-2 mr-2">
                                    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg> --}}
                                    <i data-feather="edit"></i>


                                </a>

                                <a onclick="share()" class="btn btn-primary mb-2 mr-2">
                                    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg> --}}
                                    <i data-feather="share-2"></i>


                                </a>

                            @endif


                        </div>
                        {{-- <div class="row" style="margin-right: 100px "> --}}
                        {{-- <h6 style="color: #0a6aa1;margin-right: 100px">{{$course->code}}</h6> --}}
                        {{-- </div> --}}
                    </div>
                </div>
                <div class="row">
                    <div id="student" hidden>{{ $student }}</div>

                    {{-- sessions --}}
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 layout-spacing">
                        <div class="widget widget-card-four">
                            <div class="widget-content">
                                <div class="w-content">
                                    <div class="w-info">
                                        <h6 class="value">لیست جلسات درس</h6>
                                        <p class=""></p>
                                    </div>
                                    <a href="#sessions">

                                        <div class="">
                                            <div class="w-icon">
                                                {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" --}}
                                                {{-- viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" --}}
                                                {{-- stroke-linecap="round" stroke-linejoin="round" --}}
                                                {{-- class="feather feather-home"> --}}
                                                {{-- <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path> --}}
                                                {{-- <polyline points="9 22 9 12 15 12 15 22"></polyline> --}}
                                                {{-- </svg> --}}
                                                <i data-feather="users"></i>

                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- students --}}
                    @if (Laratrust::hasRole('teacher'))
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 layout-spacing">
                            <div class="widget widget-card-four">
                                <div class="widget-content">
                                    <div class="w-content">
                                        <div class="w-info">
                                            <h6 class="value">دانشجویان</h6>
                                            <p class="">{{ $course->count }} نفر </p>
                                        </div>
                                        <a href="/dashboard/courses/students?course_id={{ $course->id }}">

                                            <div class="">
                                                <div class="w-icon">
                                                    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" --}}
                                                    {{-- viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" --}}
                                                    {{-- stroke-linecap="round" stroke-linejoin="round" --}}
                                                    {{-- class="feather feather-home"> --}}
                                                    {{-- <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path> --}}
                                                    {{-- <polyline points="9 22 9 12 15 12 15 22"></polyline> --}}
                                                    {{-- </svg> --}}
                                                    <i data-feather="users"></i>

                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    {{-- davari --}}
                    @if ($course->davari == 1)
                        @if (Laratrust::hasRole('student'))
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 layout-spacing">
                                <div class="widget widget-card-four">
                                    <div class="widget-content">
                                        <div class="w-content">
                                            <div class="w-info">
                                                <h6 class="value">
                                                    داوری دوستان
                                                </h6>
                                                <p class="">روی آیکن کلیک کنید</p>
                                            </div>
                                            <a href="/dashboard/referee?course_id={{ $course->id }}">
                                                <div class="">
                                                    <div class="w-icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                             stroke-width="2" stroke-linecap="round"
                                                             stroke-linejoin="round"
                                                             class="feather feather-search">
                                                            <path
                                                                d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                    {{-- arzyabi o faaliat man --}}
                    @if ($course->faaliat == 1 || Laratrust::hasRole('teacher'))
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 layout-spacing">
                            <div class="widget widget-card-four">
                                <div class="widget-content">
                                    <div class="w-content">
                                        <div class="w-info">
                                            <h6 class="value">
                                                @if (Laratrust::hasRole('teacher'))
                                                    ارزیابی فعالیت
                                                @elseif(Laratrust::hasRole('student'))
                                                    فعالیتهای من
                                                @endif
                                            </h6>
                                            <p class="">روی آیکن کلیک کنید</p>
                                        </div>
                                        <a href="/dashboard/evaluation?course_id={{ $course->id }}">
                                            <div class="">
                                                <div class="w-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-home">
                                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                                    </svg>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    {{-- setting --}}
                    @if (Laratrust::hasRole('teacher'))
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 layout-spacing">
                            <div class="widget widget-card-four">
                                <div class="widget-content">
                                    <div class="w-content">
                                        <div class="w-info">
                                            <h6 class="value">تنظیمات</h6>
                                            <p class="">روی آیکن کلیک کنید</p>
                                        </div>
                                        <a href="/dashboard/courses/setting?course_id={{ $course->id }}">

                                            <div class="">
                                                <div class="w-icon">
                                                    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" --}}
                                                    {{-- viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" --}}
                                                    {{-- stroke-linecap="round" stroke-linejoin="round" --}}
                                                    {{-- class="feather feather-home"> --}}
                                                    {{-- <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path> --}}
                                                    {{-- <polyline points="9 22 9 12 15 12 15 22"></polyline> --}}
                                                    {{-- </svg> --}}
                                                    <i data-feather="settings"></i>

                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- bank --}}
                    @if (Laratrust::hasRole('teacher'))
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 layout-spacing">
                            <div class="widget widget-card-four">
                                <div class="widget-content">
                                    <div class="w-content">
                                        <div class="w-info">
                                            <h6 class="value">بانک سوالات</h6>
                                            <p class="">روی آیکن کلیک کنید</p>
                                        </div>
                                        <a href="/dashboard/courses/bank?course_id={{ $course->id }}">
                                            <div class="">
                                                <div class="w-icon">
                                                    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" --}}
                                                    {{-- viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" --}}
                                                    {{-- stroke-linecap="round" stroke-linejoin="round" --}}
                                                    {{-- class="feather feather-home"> --}}
                                                    <i data-feather="database"></i>

                                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                                    </svg>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- azmoon teacher --}}
                    @if (Laratrust::hasRole('teacher') && \Illuminate\Support\Facades\Auth::user()->id == 3)
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 layout-spacing">
                            <div class="widget widget-card-four">
                                <div class="widget-content">
                                    <div class="w-content">
                                        <div class="w-info">
                                            <h6 class="value">آزمون ها</h6>
                                            <p class="">روی آیکن کلیک کنید</p>
                                        </div>
                                        <a href="/dashboard/azmon?id={{ $course->id }}">
                                            <div class="">
                                                <div class="w-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-home">
                                                        <i data-feather="database"></i>

                                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                                    </svg>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- survey --}}
                    @if (Laratrust::hasRole('teacher'))
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 layout-spacing">
                            <div class="widget widget-card-four">
                                <div class="widget-content">
                                    <div class="w-content">
                                        <div class="w-info">
                                            <h6 class="value">نظرسنجی</h6>
                                            <p class="">روی آیکن کلیک کنید</p>
                                        </div>
                                        <a href="/dashboard/survey?course_id={{ $course->id }}">
                                            <div class="">
                                                <div class="w-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-home">
                                                        <i data-feather="database"></i>

                                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                                    </svg>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- emtehan --}}
                    @if ($course->quiz == 1)
                        @if (Laratrust::hasRole('student'))
                            @if ($course->sessions()->count() > 0 && $course->quizCount($course) == false && $khodazmaii == 1)
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 layout-spacing">
                                    <div class="widget widget-card-four">
                                        <div class="widget-content">
                                            <div class="w-content">
                                                <div class="w-info">
                                                    <h6 class="value">خود آزمایی</h6>
                                                    <p class="">روی آیکن کلیک کنید</p>
                                                </div>
                                                <a @if ($course->sessions()->count() > 0 && $course->quizCount($course) == false)
                                                   href="/dashboard/quiz?course_id={{ $course->id }}"
                                                   {{-- <a @if ($course->sessions()->count() > 0 && $course->quizCount($course) == false)  href="/dashboard/quiz?course_id={{$course->id}}" --}}
                                                   @else disabled
                                                    @endif >
                                                    <div class="">
                                                        <div class="w-icon">
                                                            {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" --}}
                                                            {{-- viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" --}}
                                                            {{-- stroke-linecap="round" stroke-linejoin="round" --}}
                                                            {{-- class="feather feather-home"> --}}
                                                            {{-- <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path> --}}
                                                            {{-- <polyline points="9 22 9 12 15 12 15 22"></polyline> --}}
                                                            {{-- </svg> --}}
                                                            <i data-feather="settings"></i>

                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif
                    @endif
                    {{-- pishraft --}}
                    @if ($course->pishraft == 1)
                        @if (Laratrust::hasRole('student'))
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 layout-spacing">
                                <div class="widget widget-card-four">
                                    <div class="widget-content">
                                        <div class="w-content">
                                            <div class="w-info">
                                                <h6 class="value">پیشرفت درسی</h6>
                                                <p class="">روی آیکن کلیک کنید</p>
                                            </div>
                                            <a
                                                href="/dashboard/progress?course_id={{ $course->id }}&user={{ \Illuminate\Support\Facades\Auth::user()->id }}">
                                                <div class="">
                                                    <div class="w-icon">
                                                        {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" --}}
                                                        {{-- viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" --}}
                                                        {{-- stroke-linecap="round" stroke-linejoin="round" --}}
                                                        {{-- class="feather feather-home"> --}}
                                                        {{-- <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path> --}}
                                                        {{-- <polyline points="9 22 9 12 15 12 15 22"></polyline> --}}
                                                        {{-- </svg> --}}
                                                        <i data-feather="pie-chart"></i>

                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                    {{-- azmon student --}}
                    <span id="course_id" hidden data-name="{{ $course->id }}">{{ $course->id }}</span>

                    @if (Laratrust::hasRole('student'))
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 layout-spacing">
                            <div class="widget widget-card-four">
                                <div class="widget-content">
                                    <div class="w-content">
                                        <div class="w-info">
                                            <h6 class="value">انجام آزمون</h6>
                                            <p class="">روی آیکن کلیک کنید</p>
                                        </div>
                                        <a onclick="
                                                    let foo = prompt('کد آزمون را وارد کنید...');
                                                    let dars = document.getElementById('course_id').innerText;

                                                    window.open('/dashboard/azmon/azmon?cd='+foo+'&course_id='+ dars ,'_self');
                                                    ">
                                            <div class="">
                                                <div class="w-icon">
                                                    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" --}}
                                                    {{-- viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" --}}
                                                    {{-- stroke-linecap="round" stroke-linejoin="round" --}}
                                                    {{-- class="feather feather-home"> --}}
                                                    {{-- <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path> --}}
                                                    {{-- <polyline points="9 22 9 12 15 12 15 22"></polyline> --}}
                                                    {{-- </svg> --}}
                                                    <i data-feather="pie-chart"></i>

                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif


                </div>

            </div>

            {{-- vaziat --}}
            @if (Laratrust::hasRole('teacher'))
                <div class="row layout-top-spacing">
                    <div class="col-lg-12 col-12 layout-spacing">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4>وضعیت درس</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content widget-content-area text-center">
                                <div class="row justify-content-center">

                                    <div class="col-lg-4 col-md-4 col-sm-4 col-6">
                                        <div class="row">
                                            <label style="padding-left: 5px">در حال برگزاری</label>
                                            <label class="switch s-icons s-outline  s-outline-primary  mb-4 mr-2">
                                                {{-- <a href="{{route('course.active',$course->id)}}"> --}}
                                                <input type="checkbox" @if ($course->active == 1) checked @endif
                                                onchange="window.location.href='{{ route('course.active', $course->id) }}'">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>

                                    @if ($course->active == 1)
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-6">
                                            <div class="row">
                                                <label style="padding-left: 5px"> نمایش جلسات درس</label>
                                                <label class="switch s-icons s-outline  s-outline-primary  mb-4 mr-2">
                                                    <input type="checkbox" @if ($course->status == 1) checked @endif
                                                    onchange="window.location.href='{{ route('course.status', $course->id) }}'">
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-6">
                                            <div class="row">
                                                <label style="padding-left: 5px">امکان انجام داوری</label>
                                                <label class="switch s-icons s-outline  s-outline-primary  mb-4 mr-2">
                                                    <input type="checkbox" @if ($course->davari == 1) checked @endif
                                                    onchange="window.location.href='{{ route('course.davari', $course->id) }}'">
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-6">
                                            <div class="row">
                                                <label style="padding-left: 5px">امکان شرکت در آزمون های خود
                                                    آزمایی</label>
                                                <label class="switch s-icons s-outline  s-outline-primary  mb-4 mr-2">
                                                    <input type="checkbox" @if ($course->quiz == 1) checked @endif
                                                    onchange="window.location.href='{{ route('course.quiz', $course->id) }}'">
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-6">
                                            <div class="row">
                                                <label style="padding-left: 5px">مشاهده فعالیت ها</label>
                                                <label class="switch s-icons s-outline  s-outline-primary  mb-4 mr-2">
                                                    <input type="checkbox" @if ($course->faaliat == 1) checked @endif
                                                    onchange="window.location.href='{{ route('course.faaliat', $course->id) }}'">
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-6">
                                            <div class="row">
                                                <label style="padding-left: 5px">مشاهده پیشرفت درسی</label>
                                                <label class="switch s-icons s-outline  s-outline-primary  mb-4 mr-2">
                                                    <input type="checkbox" @if ($course->pishraft == 1) checked @endif
                                                    onchange="window.location.href='{{ route('course.pishraft', $course->id) }}'">
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- session --}}
            <div class="layout-px-spacing" id="sessions">

                <div class="page-header">
                    <div class="page-title">
                        <h3>جلسات ({{ $course->sessions }})</h3>
                    </div>
                    {{-- @if (Laratrust::hasRole('teacher')) --}}
                    {{-- <a style="margin-right: 10px" --}}
                    {{-- href="/dashboard/courses/sessions/create?course_id={{$course->id}}" --}}
                    {{-- class="btn btn-primary mb-2 mr-2"> --}}
                    {{--  --}}{{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg> --}}
                    {{-- <i data-feather="plus"></i> --}}
                    {{-- ایجاد جلسه جدید --}}

                    {{-- </a> --}}
                    {{-- @endif --}}
                </div>

                <div class="chat-section layout-top-spacing">
                    <div class="row">

                        <div class="col-xl-12 col-lg-12 col-md-12">

                            <div class="chat-system">
                                <div class="hamburger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none"
                                         stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round"
                                         class="feather feather-menu mail-menu d-lg-none">
                                        <line x1="3" y1="12" x2="21" y2="12"></line>
                                        <line x1="3" y1="6" x2="21" y2="6"></line>
                                        <line x1="3" y1="18" x2="21" y2="18"></line>
                                    </svg>
                                </div>
                                <div class="user-list-box">
                                    <div class="search">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24"
                                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                             stroke-linejoin="round" class="feather feather-search">
                                            <circle cx="11" cy="11" r="8"></circle>
                                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                        </svg>
                                        <input type="text" class="form-control" placeholder="جستجو..."/>
                                    </div>
                                    <div class="people">
                                        @if (Laratrust::hasRole('teacher'))
                                            <a style=""
                                               href="/dashboard/courses/sessions/create?course_id={{ $course->id }}"
                                               class="btn btn-primary btn-block">
                                                {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg> --}}
                                                <i data-feather="plus"></i>
                                                ایجاد جلسه جدید

                                            </a>


                                            {{-- <div class="person " data-chat="person{{$session->id}}"> --}}
                                            {{-- <div class="user-info "> --}}
                                            {{--  --}}
                                            {{-- </div> --}}
                                            {{-- </div> --}}

                                        @endif


                                        @if ($course->status == 1 || Laratrust::hasRole('teacher'))
                                            @foreach ($sessions as $session)
                                                <div class="person" data-chat="person{{ $session->id }}">
                                                    <div class="user-info ">
                                                        {{-- <div class="f-head"> --}}
                                                        {{-- <img src="assets/img/90x90.jpg" alt="avatar"> --}}
                                                        {{-- </div> --}}
                                                        <div class="f-body">
                                                            <div class="meta-info">
                                                                {{-- <a href="/dashboard/courses/sessions?course_id={{$course->id}}&meeting_id={{$session->id}}"> --}}
                                                                <span class="user-name"
                                                                      data-name="{{ $session->id }}">{{ $session->name }}</span>
                                                                <span hidden class="user-id"
                                                                      data-name="{{ $session->id }}">{{ $session->id }}</span>
                                                                <span class="taklif_last" hidden
                                                                      data-name="{{ $session->id }}">{{ $session->taklif_last }}</span>
                                                                <span class="gozaresh_last" hidden
                                                                      data-name="{{ $session->id }}">{{ $session->gozaresh_last }}</span>
                                                                <span class="soal_last" hidden
                                                                      data-name="{{ $session->id }}">{{ $session->soal_last }}</span>


                                                                <span class="user-ex"
                                                                      data-name="{{ $session->ex_count }}"
                                                                      hidden>{{ $session->ex_count }}</span>

                                                                <span
                                                                    class="user-meta-time">{{ $session->number }}</span>


                                                                {{-- </a> --}}
                                                            </div>
                                                            {{-- <span class="preview">چطوری؟</span> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="chat-box">

                                    <div class="chat-not-selected">
                                        <p>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24"
                                                 fill="none" stroke="currentColor" stroke-width="2"
                                                 stroke-linecap="round"
                                                 stroke-linejoin="round" class="feather feather-message-square">
                                                <path
                                                    d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                            </svg>
                                            @if (Laratrust::hasRole('teacher') && count($sessions) == 0)
                                                اولین جلسه درس خود را با استفاده از "+ ایجاد جلسه جدید" برای دانشجو
                                                ایجاد
                                                کنید.
                                            @else
                                                برای مشاهده محتوای هر جلسه درس آنرا از لیست سمت راست انتخاب کنید.
                                            @endif
                                        </p>
                                    </div>

                                    <div class="chat-box-inner ">
                                        <div class="chat-meta-user active active-chat">
                                            <div class="current-chat-user-name"><span><span class="name"></span></span>
                                            </div>

                                            <div class="chat-action-btn align-self-center">
                                                {{-- icons --}}
                                                <a id="questions" href="" class="btn btn-primary">
                                                    طرح سوال
                                                    {{-- <i data-feather="help-circle"></i> --}}
                                                </a>

                                                @if (Laratrust::hasRole('teacher'))
                                                    <a id="homework_teacher" href="" class="btn btn-success">
                                                        دادن تکلیف
                                                        {{-- <img class="img-fluid" --}}
                                                        {{-- src="{{asset('/files/icons/homework.png')}}" --}}
                                                        {{-- alt="" --}}
                                                        {{-- style="height: 30px"> --}}
                                                    </a>
                                                @endif
                                                @if (Laratrust::hasRole('teacher'))
                                                    <a id="active" href="" class="btn btn-info-gradien ajaxLink">
                                                        تغییر وضعیت انتشار
                                                    </a>
                                                @endif
                                                <a id="homework" class="btn btn-info"
                                                   @if (Laratrust::hasRole('teacher'))
                                                   {{-- style="visibility: hidden" --}}
                                                   hidden
                                                   @endif
                                                   href="">
                                                    تکلیف

                                                    {{-- <img class="img-fluid" --}}
                                                    {{-- src="{{asset('/files/icons/homework.png')}}" --}}
                                                    {{-- alt="" --}}
                                                    {{-- style="height: 30px"> --}}
                                                </a>

                                                @if (Laratrust::hasRole('teacher'))
                                                    <a id="edit" href="" class="btn btn-danger">
                                                        ویرایش
                                                        {{-- <img class="img-fluid" --}}
                                                        {{-- src="{{asset('/files/icons/homework.png')}}" --}}
                                                        {{-- alt="" --}}
                                                        {{-- style="height: 30px"> --}}
                                                    </a>
                                                @endif

                                                <a id="disc" hidden href="" class="btn btn-success">
                                                    گزارش
                                                    {{-- <img class="img-fluid" --}}
                                                    {{-- src="{{asset('/files/icons/question.png')}}" --}}
                                                    {{-- alt="" --}}
                                                    {{-- style="height: 30px"> --}}
                                                </a>

                                            </div>
                                        </div>


                                        <div class="chat-conversation-box">
                                            <div id="chat-conversation-box-scroll" class="chat-conversation-box-scroll">
                                                @foreach ($sessions as $session)
                                                    <div class="chat" data-chat="person{{ $session->id }}">

                                                        @if (Laratrust::hasRole('teacher'))
                                                            <div class="bubble you " id="statuss">

                                                                <h6>
                                                                    @if ($session->active)
                                                                        <span style="color: green">
                                                                    جلسه برای دانشجویان قابل مشاهده می باشد
                                                                @else
                                                                                <span style="color: red">
                                                                        جلسه برای دانشجویان قابل مشاهده نمی باشد
                                                            @endif
                                                            </span>
                                                                </h6>
                                                            </div>
                                                        @endif

                                                        <div class="bubble you">

                                                            <h6>
                                                                جلسه {{ $session->number }}
                                                            </h6>
                                                        </div>
                                                        @if ($session->link)
                                                            <div class="bubble me">
                                                                <h6>
                                                            <span style="color: blue">
                                                                <a href="http://{{ $session->link }}" target="_blank">
                                                                    لینک جهت دانلود</a>
                                                            </span>
                                                                </h6>
                                                            </div>
                                                        @endif
                                                        @if ($session->majazi)
                                                            <div class="bubble me">
                                                                <h6>
                                                            <span style="color: green">
                                                                <a href="http://{{ $session->majazi }}" target="_blank">
                                                                    لینک کلاس مجازی</a>
                                                            </span>
                                                                </h6>
                                                            </div>
                                                        @endif
                                                        @if (isset($session->file))
                                                            <div class="bubble me">
                                                                <a href="{{ URL::to('/files/session' . $session->file) }}"
                                                                   target="_blank">
                                                                    <h6>پیوست <img class="img-fluid"
                                                                                   src="{{ asset('/files/icons/attach.png') }}"
                                                                                   alt=""
                                                                                   style="height: 30px"></h6>
                                                                </a>

                                                            </div>
                                                        @endif
                                                        @if (isset($session->text))
                                                            <div class="bubble me">
                                                                <h6>
                                                                    {!! $session->text !!}
                                                                </h6>
                                                            </div>
                                                        @endif
                                                    </div>
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

            @include('dashboard2.layout.footer')
            <input type="text"
                   value={{-- "دانشجوی عزیز،برای دسترسی به درس {{$course->name}} ابتدا از طریق WWW.MALISAN.IR در سامانه آموزشی مالیسان با هویت واقعی ثبت نام کنید سپس با استفاده از کد {{$course->code}} وارد کلاس شوید." --}} "            دانشجوی عزیز، برای دسترسی به درس {{ $course->name }} ابتدا از طریق سایت WWW.MALISAN.IR در سامانه آموزشی ملیسان با هویت واقعی ثبت نام کنید، سپس با استفاده از شناسه {{ $course->code }} در درس ذکر شده عضو شوید."
                   id="myInput" style="height: 0px;background: transparent;">

        </div>
    </div>


@endsection

@section('end')

    <script src="{{ '/style/assets/js/apps/mailbox-chat.js' }}"></script>

    <script src="{{ '/style/assets/js/widgets/modules-widgets.js' }}"></script>

    <script src="{{ '/style/assets/js/scrollspyNav.js' }}"></script>
    <script>
        $('.user-list-box .person').on('click', function (event) {
            $idd = $(this).find('.user-id').text();
            $taklif_last = $(this).find('.taklif_last').text();
            $gozaresh_last = $(this).find('.gozaresh_last').text();
            $soal_last = $(this).find('.soal_last').text();
            $ex_c = $(this).find('.user-ex').text();

            if (document.getElementById("student").innerHTML == 1) {
                $work = document.getElementById("homework");
                if ($work) {
                    if ($ex_c == 0)
                        document.getElementById("homework").hidden = true;
                    else
                        document.getElementById("homework").hidden = false;

                    if ($taklif_last == 0)
                        document.getElementById("homework").hidden = true;

                    document.getElementById("homework").href = '/dashboard/exercise/show?session_id=' + $idd;

                }
            }
            $work_teacher = document.getElementById("homework_teacher");
            if ($work_teacher) {
                document.getElementById("homework_teacher").href = '/dashboard/exercise/show?session_id=' + $idd;
            }
            $edit = document.getElementById("edit");
            if ($edit) {
                document.getElementById("edit").href = '/dashboard/courses/sessions/edit/' + $idd;
            }

            $q = document.getElementById("questions");
            if ($q) {
                if ($soal_last != 1) {
                    if (document.getElementById("student").innerHTML == 1)
                        document.getElementById("questions").hidden = true;
                    else
                        document.getElementById("questions").hidden = false;
                } else
                    document.getElementById("questions").hidden = false;
                document.getElementById("questions").href = '/dashboard/question/show?session_id=' + $idd;
            } else
                document.getElementById("questions").hidden = false;

            if (document.getElementById("student").innerHTML == 1) {
                $disc = document.getElementById("disc");
                if ($gozaresh_last == 1)
                    document.getElementById("disc").hidden = false;
                else
                    document.getElementById("disc").hidden = true;
                if ($disc) {
                    document.getElementById("disc").href = '/dashboard/discussion/create/' + $idd;
                }


            }
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


@endsection
