@extends('melisan.layout.master')

@section('add-styles')
    <style>
        span {
            color: #d3d2d2ff;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/pages/page-account-settings.min.css') }}">
@endsection

@section('title', 'مدیریت درس')

@section('main-content')
    @if($user->hasRole('student'))
        <div class="row">
            <form action="/dashboard/courses/join" method="post">
                @csrf
                <input name="code" value="{{ $course->code }}" style="display:none">
                <button type="submit" class="chip gradient-45deg-purple-deep-orange gradient-shadow white-text">
                    <div class="col s12 m4" style=" ">
                        <div class="chip gradient-45deg-purple-deep-orange gradient-shadow white-text" style="width:55vw">
                            <img src="../../../app-assets/images/icon/true.png" alt="Materialize">
                            عضویت
                        </div>
                    </div>
                </button>
            </form>
        </div>
    @endif

    @if($member == 1)
        <div class="row">
            <div class="col 12 s12">
                @if ($user->hasRole('teacher'))
                    <div class="col s12" style="width: fit-content; padding: 0 5px">
                        <a onclick="onHelpClick()"
                           class="mb-6 btn-floating waves-effect waves-light gradient-45deg-amber-amber gradient-shadow tooltipped"
                           data-position="bottom" data-tooltip="میخوام راهنماییت کنم">
                            <i class="material-icons dp48">help</i>
                        </a>
                    </div>
                    
                    @include('management.layout.components.btn-back.btn-back')
                @endif
                
                <!-- علامت تنظیمات -->
                <div class="col-md-12" style="width: fit-content; padding: 0 5px">
                    <a onclick="showDetail()"
                       class="mb-6 btn-floating waves-effect waves-light gradient-45deg-amber-amber gradient-shadow tooltipped"
                       data-position="bottom" data-tooltip="نمایش جزئیات">
                        <i class="material-icons dp48">settings</i>
                    </a>
                </div>
                <!-- پایان علامت تنظیمات -->
            </div>
        </div>

        <div id="colla" style="display: none">
            <div class="row">
                @if ($user->hasRole('teacher'))
                    <a href="#">
                        <div class="col s6 m4" style="">
                            <div class="chip gradient-45deg-purple-deep-orange gradient-shadow white-text" style="width:200px">
                                <img src="../../../app-assets/images/icon/true.png" alt="Materialize">
                                اعتراضات(غیر فعال)
                            </div>
                        </div>
                    </a>
                @endif
                
                @if ($user->hasRole('teacher'))
                    <a href="/dashboard/courses/students?course_id={{ $course->id }}">
                        <div class="col s6 m4" style="">
                            <div class="chip gradient-45deg-purple-deep-orange gradient-shadow white-text" style="width:200px">
                                <img src="../../../app-assets/images/icon/true.png" alt="Materialize">{{ $course->count }} نفر دانشجو
                            </div>
                        </div>
                    </a>
                @endif
                
                @if ($course->davari == 1 && $isJudment)
                    @if ($user->hasRole('student'))
                        <a href="/dashboard/referee/foo/?course_id={{ $course->id }}">
                            <div class="col-md-6 m4">
                                <div class="chip gradient-45deg-purple-deep-orange gradient-shadow white-text" style="width:200px">
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
                            <div class="chip gradient-45deg-purple-deep-orange gradient-shadow white-text" style="width:200px">
                                <img src="../../../app-assets/images/icon/true.png" alt="Materialize">
                                رصد دانشجویان
                            </div>
                        </div>
                    </a>
                @endif
                
                @if ($course->faaliat == 1 || $user->hasRole('teacher'))
                    <a href="/dashboard/evaluation?course_id={{ $course->id }}">
                        <div class="col s6 m4">
                            <div class="chip gradient-45deg-purple-deep-orange gradient-shadow white-text" style="width:200px">
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
                            <div class="chip gradient-45deg-purple-deep-orange gradient-shadow white-text" style="width:200px">
                                <img src="../../../app-assets/images/icon/true.png" alt="Materialize">
                                تنظیمات
                            </div>
                        </div>
                    </a>
                @endif
                
                @if ($user->hasRole('teacher'))
                    <a href="/dashboard/courses/bank?course_id={{ $course->id }}">
                        <div class="col s6 m4">
                            <div class="chip gradient-45deg-purple-deep-orange gradient-shadow white-text" style="width:200px">
                                <img src="../../../app-assets/images/icon/true.png" alt="Materialize">
                                بانک سوالات
                            </div>
                        </div>
                    </a>
                @endif
                
                @if ($user->hasRole('teacher'))
                    <a href="/dashboard/azmon?id={{ $course->id }}">
                        <div class="col s6 m4">
                            <div class="chip gradient-45deg-purple-deep-orange gradient-shadow white-text" style="width:200px">
                                <img src="../../../app-assets/images/icon/true.png" alt="Materialize">
                                تعریف آزمون
                            </div>
                        </div>
                    </a>
                @endif
                
                @if ($user->hasRole('teacher'))
                    <a href="/dashboard/survey?course_id={{ $course->id }}">
                        <div class="col s6 m4">
                            <div class="chip gradient-45deg-purple-deep-orange gradient-shadow white-text" style="width:200px">
                                <img src="../../../app-assets/images/icon/true.png" alt="Materialize">
                                نظرسنجی
                            </div>
                        </div>
                    </a>
                @endif
                
                @if ($user->hasRole('teacher'))
                    <a href="/dashboard/kholaseha?course_id={{ $course->id }}">
                        <div class="col s6 m4">
                            <div class="chip gradient-45deg-purple-deep-orange gradient-shadow white-text" style="width:200px">
                                <img src="../../../app-assets/images/icon/true.png" alt="Materialize">
                                لیست گزارش دانشجویان
                            </div>
                        </div>
                    </a>
                @endif
                
                @if ($course->quiz == 1)
                    @if ($user->hasRole('student'))
                        @if ($course->sessions()->count() > 0 && $course->quizCount($course) == false && $khodazmaii == 1)
                            <a @if($course->sessions()->count() > 0 && $course->quizCount($course) == false) href="/dashboard/quiz?course_id={{ $course->id }}" @else disabled @endif>
                                <div class="col s6 m4">
                                    <div class="chip gradient-45deg-purple-deep-orange gradient-shadow white-text" style="width:200px">
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
                        <a href="/dashboard/progress?course_id={{ $course->id }}&user={{ \Illuminate\Support\Facades\Auth::user()->id }}">
                            <div class="col s6 m4" style=" ">
                                <div class="chip gradient-45deg-purple-deep-orange gradient-shadow white-text" style="width:200px">
                                    <img src="../../../app-assets/images/icon/true.png" alt="Materialize">
                                    پیشرفت درسی
                                </div>
                            </div>
                        </a>
                    @endif
                @endif
            </div>
        </div>
    @endif

    @if ($user->hasRole('teacher'))
        <div class="row">
            <div class="col-md-12">
                <div id="checkboxes" class="card card-tabs bg-card" style="padding: 30px; background: rgba(255, 255, 255, 0.07); backdrop-filter: blur(20px);">
                    <div class="">
                        <h5 class=" ">وضعیت درس</h5>
                        <div id="view-checkboxes" class="row">
                            <p style="font-size: medium;">
                                مدرس گرامی ! شما می‌توانید تنظیمات بیشتر درس خود را در باکس زیر کنترل نمایید .
                                <code class="language-markup">فعال بودن</code>
                                به معنای وجود دسترسی و
                                <code class="language-markup">غیر فعال بودن</code>
                                به معنای نبود دسترسی می‌باشد .
                            </p>

                            <p class="col-md-3 ">
                                <label>
                                    <input type="checkbox" @if ($course->active == 1) checked @endif
                                           onchange="window.location.href='{{ route('course.active', $course->id) }}'">
                                    <span style="color: #d3d2d2ff;">در حال برگزاری</span>
                                    <span class="slider round"></span>
                                </label>
                            </p>
                            
                            <p class="col-md-3 ">
                                <label>
                                    <input type="checkbox" @if ($course->archieve == 1) checked @endif
                                           onchange="window.location.href='{{ route('course.arch.post', $course->id) }}'">
                                    <span style="color: #d3d2d2ff;"> ارشیو </span>
                                    <span class="slider round"></span>
                                </label>
                            </p>
                            
                            @if ($course->active == 1)
                                <p class="col-md-3">
                                    <label>
                                        <input type="checkbox" @if ($course->private == 1) checked @endif
                                               onchange="window.location.href='{{ route('course.private', $course->id) }}'">
                                        <span style="color: #d3d2d2ff;">انتشار به صورت دوره</span>
                                        <span class="slider round"></span>
                                    </label>
                                </p>
                                
                                <p class="col-md-3 ">
                                    <label>
                                        <input type="checkbox" @if ($course->status == 1) checked @endif
                                               onchange="window.location.href='{{ route('course.status', $course->id) }}'">
                                        <span style="color: #d3d2d2ff;">نمایش جلسات درس</span>
                                        <span class="slider round"></span>
                                    </label>
                                </p>
                                
                                <p class="col-md-3 ">
                                    <label>
                                        <input type="checkbox" @if ($course->davari == 1) checked @endif
                                               onchange="window.location.href='{{ route('course.davari', $course->id) }}'">
                                        <span style="color: #d3d2d2ff;">امکان انجام داوری</span>
                                        <span class="slider round"></span>
                                    </label>
                                </p>
                                
                                <p class="col-md-3 ">
                                    <label>
                                        <input type="checkbox" @if ($course->quiz == 1) checked @endif
                                               onchange="window.location.href='{{ route('course.quiz', $course->id) }}'">
                                        <span style="color: #d3d2d2ff;">شرکت در خود آزمایی</span>
                                        <span class="slider round"></span>
                                    </label>
                                </p>
                                
                                <p class="col-md-3 m4 mb-1">
                                    <label>
                                        <input type="checkbox" @if ($course->faaliat == 1) checked @endif
                                               onchange="window.location.href='{{ route('course.faaliat', $course->id) }}'">
                                        <span style="color: #d3d2d2ff;">مشاهده فعالیت ها</span>
                                        <span class="slider round"></span>
                                    </label>
                                </p>
                                
                                <p class="col-md-3 ">
                                    <label>
                                        <input type="checkbox" @if ($course->pishraft == 1) checked @endif
                                               onchange="window.location.href='{{ route('course.pishraft', $course->id) }}'">
                                        <span style="color: #d3d2d2ff;">مشاهده پیشرفت درسی</span>
                                        <span class="slider round"></span>
                                    </label>
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <section class="tabs-vertical mt-1 section">
        <div class="row">
            <div id="student" hidden>{{ $student }}</div>

            <div class="col-md-5 ">
                <!-- tabs -->
                <div class="card-panel user-list-box bg-card x">
                    @if ($user->hasRole('teacher'))
                        @include('melisan.layout.btn.btn-loader' , [
                            'url' => '/dashboard/courses/sessions/create?course_id='. $course->id,
                            'icon' => "<i class='material-icons dp48'>add_circle_outline</i>",
                            'pos' => 'top',
                            'text' => 'جلسه جدید'
                        ])
                    @endif
                    
                    <ul class="tabs" onclick=" ">
                        @foreach ($sessions as $session)
                            @if($member == 1 || $session->number == 1)
                                <li class="tab">
                                    <a href="#general{{ $session->id }}" class="person" onclick="fun1()">
                                        (جلسه {{ $session->number }})
                                        <i class="material-icons" style="@if($session->active==1) color:green @else color:red @endif">
                                            @if($session->active==1)
                                                check
                                            @else
                                                clear
                                            @endif
                                        </i>
                                        <span>{{ $session->name }}</span>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                        <li class="indicator" style="left: 0px; right: 0px;"></li>
                    </ul>
                </div>
            </div>
            
            <div id="mohtava" class="col-md-7 bg-card ">
                <!-- tabs content -->
                @if($course->status == 1 || $user->hasRole('teacher'))
                    @foreach ($sessions as $session)
                        @if($member == 1 || $session->number == 1)
                            <div id="general{{ $session->id }}" style="display: block;" class="active mt-1">
                                <div class="mt-4">
                                    <div class="row">
                                        <span class="user-id" id="user-id" hidden data-name="{{ $session->id }}">{{ $session->id }}</span>
                                        <span id="taklif_last" hidden data-name="{{ $session->id }}">{{ $session->taklif_last }}</span>
                                        <span id="gozaresh_last" hidden data-name="{{ $session->id }}">{{ $session->gozaresh_last }}</span>
                                        <span id="soal_last" hidden data-name="{{ $session->id }}">{{ $session->soal_last }}</span>
                                        <span id="user-ex" data-name="{{ $session->ex_count }}" hidden>{{ $session->ex_count }}</span>

                                        <h5 mt-3>جلسه {{ $session->number }} : {{ $session->name }}</h5>
                                        
                                        @if($course->private == 1 || $session->soal_last > 0)
                                            <a href="/dashboard/question/show?session_id={{ $session->id }}" id="questions"
                                               class=" m-1 btn-floating tooltipped"
                                               data-position="bottom" data-tooltip="طرح سوال">
                                       <i class="material-icons dp48">help_outline</i>
                                            </a>
                                        @endif
                                        
                                        @if ($user->hasRole('teacher'))
                                            <a id="homework_teacher"
                                               href="/dashboard/exercise/show/{{ $session->id }}"
                                               class="m-1 btn-floating tooltipped"
                                               data-position="bottom" data-tooltip="دادن تکلیف">
                                            <i class="material-icons dp48">assignment_add</i>
                                            </a>
                             
                                            <a id="active"
                                               href="/dashboard/courses/sessions/active/{{ $session->id }}"
                                               class="m-1 btn-floating tooltipped"
                                               data-position="bottom"
                                               data-tooltip="@if($session->active==1)غیرفعال کردن@else فعال کردن @endif">
                                               <i class="material-icons dp48">@if($session->active==1)toggle_on @else toggle_off @endif</i> 
                                            </a>
                                    
                                            <a id="edit"
                                               href="/dashboard/courses/sessions/edit/{{ $session->id }}"
                                               class="m-1 btn-floating tooltipped"
                                               data-position="bottom" data-tooltip="ویرایش">
                                             <i class="material-icons dp48">edit</i>
                                            </a>
                                            
                                            <a id="edit"
                                               href="/dashboard/courses/sessions/prof-ex/{{ $session->id }}"
                                               class="m-1 btn-floating tooltipped"
                                               data-position="bottom" data-tooltip="تکلیفها">
                                               <i class="material-icons dp48">list_alt</i>
                                            </a>
                                        @endif
                                        
                                        @if(($course->private==1 && $session->ex_count>0)|| ($session->ex_count>0 && $session->taklif_last>0))
                                            <a id="homework"
                                               href="{{ route('exercise.show', $session->id) }}"
                                               class="m-1 btn-floating tooltipped"
                                               data-position="bottom" data-tooltip="تکلیف">
                                              <i class="material-icons dp48">assignment</i>
                                            </a>
                                        @endif
                                        
                                   
                                        
                                        @if ($user->hasRole('student'))
                                            @if($course->private==1 || $session->gozaresh_last)
                                                <a href="{{ route('disc.show', $session->id) }}" id="disc"
                                                   class="m-1 btn-floating tooltipped"
                                                   data-position="bottom" data-tooltip="گزارش">
                                                     <i class="material-icons dp48">assessment</i>
                                                </a>
                                            @endif
                                        @endif

                                        @isset($session->text)
                                            <div class="row">
                                                <div class="col s12">
                                                    <ul class="collapsible" data-collapsible="accordion">
                                                        <li class="active">
                                                            <div class="collapsible-header custom_header_of_collapsible" tabindex="0">
                                                                <a class="btn btn-floating custom_floating_header_collapsible">
                                                         <i class="material-icons">menu_book</i>    </a>
                                                                        <p >        طرح درس یا محتوای درس</p>
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
                                            @if(explode('.', $session->file)[1] != 'pdf')
                                                <div class="col s12 display-flex justify-content-end form-action">
                                                    <a href="{{ URL::to('/files/session' . $session->file) }}" target="_blank"
                                                       class="btn indigo waves-effect waves-light mr-1 iransans">دانلود فایل پیوست</a>
                                                </div>
                                            @endif
                                        @endif
                                        
                                        @if (isset($session->link))
                                            @if ($session->link)
                                                <div class="col s12 display-flex justify-content-end form-action">
                                                    <a href="{{ URL::to('http://' . $session->link) }}" target="_blank"
                                                       class="btn indigo waves-effect waves-light mr-1 iransans">
                                                        محتوای درس
                                                    </a>
                                                </div>
                                            @endif
                                        @endif
                                        
                                        @if (isset($session->majazi))
                                            @if ($session->majazi)
                                                <div class="col s12 display-flex justify-content-end form-action">
                                                    <a href="{{ URL::to('http://' . $session->majazi) }}" target="_blank"
                                                       class="btn indigo waves-effect waves-light mr-1 iransans">
                                                        فیلم ضبط شده کلاس
                                                    </a>
                                                </div>
                                            @endif
                                        @endif
                                        
                                        @isset($session->aparat)
                                            <div class="row mt-2">
                                                <div class="col s12">
                                                    {!! $session->aparat !!}
                                                </div>
                                            </div>
                                        @endisset
                                        
                                        @if(isset($session->file))
                                            @if(explode('.', $session->file)[1] == 'pdf')
                                                <object data="{{ URL::to('/files/session' . $session->file) }}" type="application/pdf" width="100%" height="500px">
                                                    <object width="100%" height="500" data="https://docs.google.com/gview?embedded=true&url={{ URL::to('/files/session' . $session->file) }}"></object>
                                                </object>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    
    <!-- <input type="text" value="دانشجوی عزیز، برای دسترسی به درس {{ $course->name }} ابتدا از طریق سایت WWW.MALISAN.IR در سامانه آموزشی ملیسان با هویت واقعی ثبت نام کنید، سپس با استفاده از شناسه
     {{ $course->code }} در درس ذکر شده عضو شوید." id="myInput" style="height: 0px;background: transparent;"> -->
    
    <div class="col s12">
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
                        دکمه های بالا دکمه های مدیریتی برای شماست و در باکس پایین اطلاعات مربوط به هر جلسه نمایش داده شده است
                    @elseif($user->hasRole('student'))
                        دکمه های بالا دکمه های مدیریتی برای شماست و در باکس پایین اطلاعات مربوط به هر جلسه نمایش داده شده است
                    @endif
                </p>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function fun1() {
            document.getElementById('mohtava').scrollIntoView();
        }
    </script>
    
    <script src="{{ asset('app-assets/js/scripts/page-account-settings.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/css-transition.js') }}"></script>
    
    <script>
        $('.person').on('click', function (event) {
            $idd = document.getElementById('user-id').innerHTML;
            $taklif_last = document.getElementById('taklif_last').innerHTML;
            $gozaresh_last = document.getElementById('gozaresh_last').innerHTML;
            $soal_last = document.getElementById('soal_last').innerHTML;
            $ex_c = document.getElementById('user-ex').innerHTML;
            $xx = document.getElementById("student").innerHTML;
            
            $edit = document.getElementById("edit");
            if ($edit) {
                document.getElementById("edit").href = '/dashboard/courses/sessions/edit/' + $idd;
            }
        });
    </script>
    
    <script>
        $('.ajaxLink').click(function (e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('href'),
                success: function (data) {
                    $text = document.getElementById("statuss").innerText;
                    if ($text == "جلسه برای دانشجویان قابل مشاهده می باشد")
                        document.getElementById("statuss").innerHTML =
                            " <h6>\n" +
                            "  <span style=\"color: red\">\n" +
                            "    جلسه برای دانشجویان قابل مشاهده نمی باشد\n" +
                            "  </span>\n" +
                            "</h6>"
                    else
                        document.getElementById("statuss").innerHTML =
                            " <h6>\n" +
                            "  <span style=\"color: green\">\n" +
                            "    جلسه برای دانشجویان قابل مشاهده می باشد\n" +
                            "  </span>\n" +
                            "</h6>"
                }
            });
        });
    </script>
    
    <script>
        function share() {
            var copyText = document.getElementById("myInput");
            console.log(copyText)
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            document.execCommand("copy");
            
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // این خط tooltip‌ها را فعال می‌کند
    var elems = document.querySelectorAll('.tooltipped');
    var instances = M.Tooltip.init(elems);
});
</script>
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{ asset('app-assets/js/scripts/advance-ui-feature-discovery.min.js') }}"></script>
@endsection