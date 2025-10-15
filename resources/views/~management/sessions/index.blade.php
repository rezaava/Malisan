@extends('management.layout.master')
@section('add-styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/pages/page-account-settings.min.css') }}">
@endsection
@section('title', 'مدیریت درس')
@section('main-content')
    <div class="row">
        <div class="col 12 s12">
            @if (Laratrust::hasRole('teacher'))
                <a href="{{ route('course.delete', $course->id) }}"
                   onclick="return confirm('با حذف این درس کلیه جلسات مربوط به آن و فعالیت دانشجویان حذف شده و قابل برگشت نیست.آیا با حذف این درس کاملا موافق هستید؟  ')"
                   class="mb-6 btn-floating waves-effect waves-light gradient-45deg-purple-deep-orange gradient-shadow tooltipped"
                   data-position="top" data-tooltip="حذف جلسه">
                    <i class="material-icons">clear</i>
                    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg> --}}
                    <i data-feather="trash"></i>

                </a>
                <a href="{{ route('course.edit', $course->id) }}"
                   class="mb-6 btn-floating waves-effect waves-light gradient-45deg-light-blue-cyan gradient-shadow tooltipped"
                   data-position="bottom" data-tooltip="ویرایش جلسه">
                    <i class="material-icons dp48">edit</i>
                    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg> --}}
                    <i data-feather="edit"></i>


                </a>

                <a onclick="share()"
                   class="mb-6 btn-floating waves-effect waves-light gradient-45deg-amber-amber gradient-shadow tooltipped"
                   data-position="top" data-tooltip="اشتراک گذاری جلسه">
                    <i class="material-icons dp48">share</i>
                    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg> --}}
                    <i data-feather="share-2"></i>


                </a>
                <div class="col s12" style="width: fit-content; padding: 0 5px">
                    <a onclick="onHelpClick()"
                       class="mb-6 btn-floating waves-effect waves-light gradient-45deg-amber-amber gradient-shadow tooltipped"
                       data-position="bottom" data-tooltip="میخوام راهنماییت کنم">
                        <i class="material-icons dp48">help</i>
                    </a>
                </div>
                @include('management.layout.components.btn-back.btn-back')
            @endif
        </div>
    </div>
    @if (Laratrust::hasRole('teacher'))
        <a href="/dashboard/courses/students?course_id={{ $course->id }}">
            <div class="col s12 m2 l2">
                <div class="chip gradient-45deg-purple-deep-orange gradient-shadow white-text" style="width: 200px">
                    <img src="../../../app-assets/images/avatar/avatar-3.png" alt="Materialize">{{ $course->count }} نفر
                    دانشجو
                </div>
            </div>
        </a>
    @endif
    @if ($course->davari == 1 && $isJudment)
        @if (Laratrust::hasRole('student'))
            <a href="/dashboard/referee?course_id={{ $course->id }}">
                <div class="col s12 m2 l2">
                    <div class="chip gradient-45deg-purple-deep-orange gradient-shadow white-text" style="width: 200px">
                        <img src="../../../app-assets/images/avatar/avatar-3.png" alt="Materialize">
                        داوری دوستان
                    </div>
                </div>
            </a>
        @endif
    @endif
    @if ($course->faaliat == 1 || Laratrust::hasRole('teacher'))
        <a href="/dashboard/evaluation?course_id={{ $course->id }}">
            <div class="col s12 m2 l2">
                <div class="chip gradient-45deg-purple-deep-orange gradient-shadow white-text" style="width: 200px">
                    <img src="../../../app-assets/images/avatar/avatar-3.png" alt="Materialize">
                    @if (Laratrust::hasRole('teacher'))
                        ارزیابی فعالیت
                    @elseif(Laratrust::hasRole('student'))
                        فعالیتهای من
                    @endif
                </div>
            </div>
        </a>
    @endif
    @if (Laratrust::hasRole('teacher'))
        <a href="/dashboard/courses/setting?course_id={{ $course->id }}">
            <div class="col s12 m2 l2">
                <div class="chip gradient-45deg-purple-deep-orange gradient-shadow white-text" style="width: 200px">
                    <img src="../../../app-assets/images/avatar/avatar-3.png" alt="Materialize">
                    تنظیمات
                </div>
            </div>
        </a>
    @endif
    @if (Laratrust::hasRole('teacher'))
        <a href="/dashboard/courses/bank?course_id={{ $course->id }}">
            <div class="col s12 m2 l2">
                <div class="chip gradient-45deg-purple-deep-orange gradient-shadow white-text" style="width: 200px">
                    <img src="../../../app-assets/images/avatar/avatar-3.png" alt="Materialize">
                    بانک سوالات
                </div>
            </div>
        </a>
    @endif
    @if (Laratrust::hasRole('teacher') && \Illuminate\Support\Facades\Auth::user()->id == 3)
        <a href="/dashboard/azmon?id={{ $course->id }}">
            <div class="col s12 m2 l2">
                <div class="chip gradient-45deg-purple-deep-orange gradient-shadow white-text" style="width: 200px">
                    <img src="../../../app-assets/images/avatar/avatar-3.png" alt="Materialize">
                    آزمون ها
                </div>
            </div>
        </a>
    @endif
    @if (Laratrust::hasRole('teacher'))
        <a href="/dashboard/survey?course_id={{ $course->id }}">
            <div class="col s12 m2 l2">
                <div class="chip gradient-45deg-purple-deep-orange gradient-shadow white-text" style="width: 200px">
                    <img src="../../../app-assets/images/avatar/avatar-3.png" alt="Materialize">
                    نظرسنجی
                </div>
            </div>
        </a>
    @endif
    @if ($course->quiz == 1)
        @if (Laratrust::hasRole('student'))
            @if ($course->sessions()->count() > 0 && $course->quizCount($course) == false && $khodazmaii == 1)
                <a @if ($course->sessions()->count() > 0 && $course->quizCount($course) == false)
                   href="/dashboard/quiz?course_id={{ $course->id }}"
                   @else disabled
                    @endif>
                    <div class="col s12 m2 l2">
                        <div class="chip gradient-45deg-purple-deep-orange gradient-shadow white-text" style="width: 200px">
                            <img src="../../../app-assets/images/avatar/avatar-3.png" alt="Materialize">
                            خودآزمایی
                        </div>
                    </div>
                </a>
            @endif
        @endif
    @endif
    @if ($course->pishraft == 1)
        @if (Laratrust::hasRole('student'))
            <a
                href="/dashboard/progress?course_id={{ $course->id }}&user={{ \Illuminate\Support\Facades\Auth::user()->id }}">
                <div class="col s12 m2 l2">
                    <div class="chip gradient-45deg-purple-deep-orange gradient-shadow white-text" style="width: 200px">
                        <img src="../../../app-assets/images/avatar/avatar-3.png" alt="Materialize">
                        پیشرفت درسی
                    </div>
                </div>
            </a>
        @endif
    @endif
    @if (Laratrust::hasRole('student'))
        <span id="course_id" hidden data-name="{{ $course->id }}">{{ $course->id }}</span>
        <a href="#"
           onclick="
                                                                                                                                                                                                                                                                                                let foo = prompt('کد آزمون را وارد کنید...');
                                                                                                                                                                                                                                                                                                let dars = document.getElementById('course_id').innerText;

                                                                                                                                                                                                                                                                                                window.open('/dashboard/azmon/azmon?cd='+foo+'&course_id='+ dars ,'_self');
                                                                                                                                                                                                                                                                                                ">
            <div class="col s12 m2 l2">
                <div class="chip gradient-45deg-purple-deep-orange gradient-shadow white-text" style="width: 200px">
                    <img src="../../../app-assets/images/avatar/avatar-3.png" alt="Materialize">
                    انجام آزمون
                </div>
            </div>
        </a>
        @endif
        </div>
        @if (Laratrust::hasRole('teacher'))
            <div class="row">
                <div class="col s12">
                    <div id="checkboxes" class="card card-tabs">
                        <div class="card-content">
                            <div class="card-title">
                                <div class="row">
                                    <div class="col s12 m6 l10">
                                        <h4 class="card-title">وضعیت درس</h4>
                                    </div>
                                </div>
                            </div>
                            <div id="view-checkboxes" class="active">
                                <p>مدرس گرامی ! شما میتوانید تنظیمات بیشتر درس خوردا در باکس زیر کنترل نمایید .
                                    <code class=" language-markup">فعال بودن</code>
                                    به معنای وجود دسترسی و
                                    <code class=" language-markup">غیر فعال بودن</code>
                                    به معنای نبود دسترسی میباشد .
                                </p>
                                <form action="#" class="mt-1">
                                    <p class="mb-1">
                                        <label>
                                            <input type="checkbox" @if ($course->active == 1) checked @endif
                                            onchange="window.location.href='{{ route('course.active', $course->id) }}'">
                                            <span>در حال برگزاری</span>
                                            <span class="slider round"></span>
                                        </label>
                                    </p>
                                    @if ($course->active == 1)
                                        <p class="mb-1">
                                            <label>
                                                <input type="checkbox" @if ($course->status == 1) checked @endif
                                                onchange="window.location.href='{{ route('course.status', $course->id) }}'">
                                                <span>نمایش جلسات درس</span>
                                                <span class="slider round"></span>
                                            </label>
                                        </p>
                                        <p class="mb-1">
                                            <label>
                                                <input type="checkbox" @if ($course->davari == 1) checked @endif
                                                onchange="window.location.href='{{ route('course.davari', $course->id) }}'">
                                                <span>امکان انجام داوری</span>
                                                <span class="slider round"></span>
                                            </label>
                                        </p>
                                        <p class="mb-1">
                                            <label>
                                                <input type="checkbox" @if ($course->quiz == 1) checked @endif
                                                onchange="window.location.href='{{ route('course.quiz', $course->id) }}'">
                                                <span>امکان شرکت در آزمون های خود
                                            </span>
                                                <span class="slider round"></span>
                                            </label>
                                        </p>
                                        <p class="mb-1">
                                            <label>
                                                <input type="checkbox" @if ($course->faaliat == 1) checked @endif
                                                onchange="window.location.href='{{ route('course.faaliat', $course->id) }}'">
                                                <span>مشاهده فعالیت ها
                                            </span>
                                                <span class="slider round"></span>
                                            </label>
                                        </p>
                                        <p class="mb-1">
                                            <label>
                                                <input type="checkbox" @if ($course->pishraft == 1) checked @endif
                                                onchange="window.location.href='{{ route('course.pishraft', $course->id) }}'">
                                                <span>مشاهده پیشرفت درسی
                                            </span>
                                                <span class="slider round"></span>
                                            </label>
                                        </p>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if (Laratrust::hasRole('teacher'))
            @include('management.layout.components.btn-loader.btn-loader' ,
            ['url' => '/dashboard/courses/sessions/create?course_id='. $course->id ,
            'icon' => "<i class='material-icons dp48'>notifications_active</i>",
            'pos' => 'top' ,
            'text' => 'جلسه جدید'
            ])
        @endif
        <section class="tabs-vertical mt-1 section">
            <div class="row">
                <div class="col l4 s12">
                    <!-- tabs  -->
                    <div class="card-panel user-list-box">
                        <ul class="tabs">
                            @foreach ($sessions as $session)
                                <li class="tab">
                                    <a href="#general{{ $session->id }}" class="person">
                                        <i class="material-icons">brightness_low</i>
                                        <span>{{ $session->name }}</span>
                                    </a>
                                </li>
                            @endforeach
                            <li class="indicator" style="left: 0px; right: 0px;"></li>
                        </ul>
                    </div>
                </div>
                <div class="col l8 s12">
                    <!-- tabs content -->
                    @foreach ($sessions as $session)
                        <div id="general{{ $session->id }}" style="display: block;" class="active">
                            <div class="card-panel">
                                <div class="row">
                                    <h5>دسترسی های {{ $session->name }}</h5>
                                    <div class="col s12 mt-1" style="display: flex; align-items: center">
                                        <i class="material-icons dp48">keyboard_hide</i>
                                        <a href="/dashboard/question/show?session_id={{ $session->id }}" id="questions"
                                           class="btn ml-6 waves-effect waves-light gradient-45deg-red-pink"
                                           style="width: 136px">طرح سوال</a>
                                    </div>
                                    @if (Laratrust::hasRole('teacher'))
                                        <div class="col s12 mt-1" style="display: flex; align-items: center">
                                            <i class="material-icons dp48">keyboard_hide</i>
                                            <a id="homework_teacher"
                                               class="btn ml-6 waves-effect waves-light gradient-45deg-red-pink"
                                               style="width: 136px">دادن تکلیف</a>
                                        </div>
                                    @endif
                                    @if (Laratrust::hasRole('teacher'))
                                        <div class="col s12 mt-1" style="display: flex; align-items: center">
                                            <i class="material-icons dp48">keyboard_hide</i>
                                            <a id="active"
                                               class="btn ml-6 waves-effect waves-light gradient-45deg-red-pink"
                                               style="width: 136px">تغیر وضعیت انتشار</a>
                                        </div>

                                    @endif
                                    <div class="col s12 mt-1" style="display: flex; align-items: center">
                                        <i class="material-icons dp48">keyboard_hide</i>
                                        <a id="homework" style="width: 136px"
                                           class="btn ml-6 waves-effect waves-light gradient-45deg-red-pink"
                                           @if (Laratrust::hasRole('teacher')) hidden @endif
                                           href="{{ route('exercise.show', $session->id) }}">تکلیف</a>
                                    </div>
                                    @if (Laratrust::hasRole('teacher'))
                                        <div class="col s12 mt-1" style="display: flex; align-items: center">
                                            <i class="material-icons dp48">keyboard_hide</i>
                                            <a id="edit"
                                               class="btn ml-6 waves-effect waves-light gradient-45deg-red-pink"
                                               style="width: 136px">ویرایش</a>
                                        </div>
                                    @endif
                                    <div class="col s12 mt-1" style="display: flex; align-items: center">
                                        <i class="material-icons dp48">keyboard_hide</i>
                                        <a href="{{ route('disc.show', $session->id) }}" id="disc"
                                           class="btn ml-6 waves-effect waves-light gradient-45deg-red-pink"
                                           style="width: 136px">گزارش</a>
                                    </div>

                                    @if (isset($session->file))
                                        <div class="col s12 display-flex justify-content-end form-action">
                                            <a href="{{ URL::to('/files/session' . $session->file) }}" target="_blank"
                                               class="btn indigo waves-effect waves-light mr-1 iransans">دانلود فایل
                                                پیوست</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <input type="text"
               value={{-- "دانشجوی عزیز،برای دسترسی به درس {{$course->name}} ابتدا از طریق WWW.MALISAN.IR در سامانه آموزشی مالیسان با هویت واقعی ثبت نام کنید سپس با استفاده از کد {{$course->code}} وارد کلاس شوید." --}} "            دانشجوی عزیز، برای دسترسی به درس {{ $course->name }} ابتدا از طریق سایت WWW.MALISAN.IR در سامانه آموزشی ملیسان با هویت واقعی ثبت نام کنید، سپس با استفاده از شناسه {{ $course->code }} در درس ذکر شده عضو شوید."
               id="myInput" style="height: 0px;background: transparent;">
        <div class="col s12">
            <div class="fixed-action-btn" id="help_container" style="bottom: 45px; right: 24px;">
                <a id="menu" class="btn btn-floating btn-large cyan">
                    <i class="material-icons">menu</i>
                </a>
            </div>
            <div class="tap-target cyan" data-target="menu">
                <div class="tap-target-content white-text">
                    <h5 class="white-text">
                        @if (Laratrust::hasRole('teacher'))
                            درود مدرس گرامی !
                        @elseif(Laratrust::hasRole('student'))
                            دانشجو گرامی !
                        @endif
                    </h5>
                    <p class="white-text">
                        @if (Laratrust::hasRole('teacher'))
                            دکمه های بالا دکمه های مدیریتی برای شماست و در باکس پایین اطلاعات مربوط به هر جلسه نمایش
                            داده
                            شده است
                        @elseif(Laratrust::hasRole('student'))
                            دکمه های بالا دکمه های مدیریتی برای شماست و در باکس پایین اطلاعات مربوط به هر جلسه نمایش
                            داده
                            شده است
                        @endif
                    </p>
                </div>
            </div>
        </div>
        @isset($session->text)
            <div class="row">
                <div class="col s12">
                    <ul class="collapsible" data-collapsible="accordion">
                        <li class="active">
                            <div class="collapsible-header custom_header_of_collapsible" tabindex="0">
                                <a class="btn btn-floating pulse custom_floating_header_collapsible">
                                    <i class="material-icons dp48">notifications_active</i>
                                </a>متن استاد
                            </div>
                            <div class="collapsible-body" style="display: block;">
                                <p>{{ strip_tags($session->text) }}.</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        @endisset
@endsection
@section('js')
    <script src="{{ asset('app-assets/js/scripts/page-account-settings.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/css-transition.js') }}"></script>
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
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{ asset('app-assets/js/scripts/advance-ui-feature-discovery.min.js') }}"></script>
@endsection
