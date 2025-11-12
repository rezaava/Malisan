<div class="container-dushbord" id="" style="  padding-right: 5%;">
    <div class="row">

        <div class="col-md-5  ">
            <h5 class="">
                @if ($user->hasRole('teacher')) استاد
                @elseif($user->hasRole('student')) دانشجو
                @elseif($user->hasRole('admin')) مدیر محترم
                @endif
                {{$user->name . ' ' . $user->family }} عزیز خوش آمدید
            </h5>
        </div>
        <div class="col-md-5">
            <ol class="custom-list-dushbord">

                @if(Route::current()->getName() == 'course.create')

                    <li class="breadcrumb-item"><a href="/dashboard">
                        </a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>ایجاد درس</span></li>

                    <!-- <li class="breadcrumb-item"><a href="javascript:void(0);">داشبورد</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span>فروش ها</span></li>
                                <li class="breadcrumb-item active" aria-current="page"><span></span></li> -->
                @elseif(Route::current()->getName() == 'course.list')
                    <li class="breadcrumb-item">
                        <a href="/dashboard">
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page"><span>لیست دروس</span></li>
                @elseif(Route::current()->getName() == 'progress')
                    <li class="breadcrumb-item">
                        <a href="/dashboard">
                        </a>
                    </li>
                    <li class="breadcrumb-item " aria-current="page">
                        <a href="/dashboard/courses/sessions?course_id={{$course->id}}">
                            <span>درس {{$course->name}}</span>
                        </a>
                    </li>
                    <li class="breadcrumb-item " aria-current="page">
                        <a href="/dashboard/courses/students?course_id={{$course->id}}">
                            <span>دانشجویان</span>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <span>پیشرفت درسی دانشجو {{$user->name}} {{$user->family}}</span>
                    </li>
                @elseif(Route::current()->getName() == 'course.students')
                    <li class="breadcrumb-item">
                        <a href="/dashboard">
                        </a>
                    </li>
                    <li class="breadcrumb-item " aria-current="page"><a
                            href="/dashboard/courses/sessions?course_id={{$course->id}}">
                            <span>درس {{$course->name}}</span></a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>دانشجویان</span></li>
                @elseif(Route::current()->getName() == 'exercise.show')
                    <li class="breadcrumb-item"><a href="/dashboard">


                        </a></li>
                    <li class="breadcrumb-item " aria-current="page"><a
                            href="/dashboard/courses/sessions?course_id={{$course->id}}">
                            <span>درس {{$course->name}}</span></a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <span>تکلیف جلسه {{$meeting->number}}</span>
                    </li>
                @elseif(Route::current()->getName() == 'exercise.edit')
                    <li class="breadcrumb-item"><a href="/dashboard">


                        </a></li>
                    <li class="breadcrumb-item " aria-current="page"><a
                            href="/dashboard/courses/sessions?course_id={{$course->id}}">
                            <span>درس {{$course->name}}</span></a></li>
                    <li class="breadcrumb-item " aria-current="page">
                        <a href="/dashboard/exercise/show?session_id={{$meeting->id}}">
                            <span>تکلیف جلسه {{$meeting->number}}</span></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <span>ویرایش تکلیف جلسه {{$meeting->number}}</span>
                    </li>
                @elseif(Route::current()->getName() == 'question.show')
                    <li class="breadcrumb-item"><a href="/dashboard">


                        </a></li>
                    <li class="breadcrumb-item " aria-current="page"><a
                            href="/dashboard/courses/sessions?course_id={{$course->id}}">
                            <span>درس {{$course->name}}</span></a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>سوالات</span></li>
                @elseif(Route::current()->getName() == 'users.list')
                    <li class="breadcrumb-item"><a href="/dashboard">


                        </a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>لیست کاربران</span></li>
                @elseif(Route::current()->getName() == 'bank')
                    <li class="breadcrumb-item"><a href="/dashboard">


                        </a></li>
                    <li class="breadcrumb-item " aria-current="page"><a
                            href="/dashboard/courses/sessions?course_id={{$course->id}}">
                            <span>درس {{$course->name}}</span></a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>بانک سوالات</span></li>
                @elseif(Route::current()->getName() == 'quiz.list')
                    <li class="breadcrumb-item"><a href="/dashboard">


                        </a></li>
                    <li class="breadcrumb-item " aria-current="page"><a
                            href="/dashboard/courses/sessions?course_id={{$course->id}}">
                            <span>درس {{$course->name}}</span></a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <span>لیست خود آزمایی ها دانشجو {{$user->name}} {{$user->family}}</span>
                    </li>
                @elseif(Route::current()->getName() == 'quiz.view')
                    <li class="breadcrumb-item"><a href="/dashboard">


                        </a></li>
                    <li class="breadcrumb-item " aria-current="page"><a
                            href="/dashboard/courses/sessions?course_id={{$course->id}}">
                            <span>درس {{$course->name}}</span></a></li>
                    <li class="breadcrumb-item " aria-current="page">
                        <a href="/dashboard/quiz/list?course_id={{$course->id}}&user={{$user->id}}">
                            <span>لیست خود آزمایی ها دانشجو {{$user->name}} {{$user->family}}</span></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page"><span> خود آزمایی </span></li>
                @elseif(Route::current()->getName() == 'session.create')
                    <li class="breadcrumb-item"><a href="/dashboard">


                        </a></li>
                    <li class="breadcrumb-item " aria-current="page"><a
                            href="/dashboard/courses/sessions?course_id={{$course->id}}">
                            <span>درس {{$course->name}}</span></a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>
                            @if(isset($meeting))
                                ویرایش جلسه
                            @else
                                ایجاد جلسه
                            @endif
                        </span></li>
                @elseif(Route::current()->getName() == 'session.list')
                    <li class="breadcrumb-item"><a href="/dashboard">


                        </a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <span>درس {{$course->name}} </span>
                    </li>

                @elseif(Route::current()->getName() == 'disc.show')
                    <li class="breadcrumb-item"><a href="/dashboard">


                    
                        </a></li>
                    <li class="breadcrumb-item " aria-current="page"><a
                            href="/dashboard/courses/sessions?course_id={{$course->id}}">
                            <span>درس {{$course->name}}</span></a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>خلاصه جلسه</span></li>



                @elseif(Route::current()->getName() == 'survey.cat')
                    <li class="breadcrumb-item"><a href="/dashboard">


                        </a></li>
                    @if($user->hasRole('admin'))
                        <li class="breadcrumb-item active" aria-current="page"><span>دسته بندی های نظرسنجی</span></li>
                    @elseif($user->hasRole('teacher'))
                        <li class="breadcrumb-item active" aria-current="page"><span>دروس برای نظرسنجی</span></li>
                    @endif
                @elseif(Route::current()->getName() == 'survey.list')
                    <li class="breadcrumb-item"><a href="/dashboard">


                        </a></li>
                    <li class="breadcrumb-item " aria-current="page"><a href="/dashboard/survey/cats">
                            <span>نظر سنجی </span></a></li>

                    @if($user->hasRole('admin'))
                        <li class="breadcrumb-item active" aria-current="page"><span>دسته بندی {{$cat_obj->name}}</span>
                        </li>
                    @elseif($user->hasRole('teacher'))
                        <li class="breadcrumb-item active" aria-current="page"><span>درس {{$course->name}}</span></li>
                    @endif


                @elseif(Route::current()->getName() == 'setting')
                    <li class="breadcrumb-item"><a href="/dashboard">


                        </a></li>
                    <li class="breadcrumb-item " aria-current="page"><a
                            href="/dashboard/courses/sessions?course_id={{$course->id}}">
                            <span>درس {{$course->name}}</span></a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>تنظیمات</span></li>
                @elseif(Route::current()->getName() == 'referee')
                    <li class="breadcrumb-item"><a href="/dashboard">

                        </a></li>
                    <li class="breadcrumb-item " aria-current="page"><a
                            href="/dashboard/courses/sessions?course_id={{$course->id}}">
                            <span>درس {{$course->name}}</span></a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <span>داوری فعالیت ها در درس {{$course->name}}</span>
                    </li>
                @elseif(Route::current()->getName() == 'eva')
                    <li class="breadcrumb-item"><a href="/dashboard">

                        </a></li>
                    <li class="breadcrumb-item " aria-current="page"><a
                            href="/dashboard/courses/sessions?course_id={{$course->id}}">
                            <span>درس {{$course->name}}</span></a></li>
                    @if($user->hasRole('teacher'))
                        <li class="breadcrumb-item active" aria-current="page">
                            <span>ارزیابی فعالیت های درس {{$course->name}}</span>
                        </li>
                    @elseif($user->hasRole('student'))
                        <li class="breadcrumb-item active" aria-current="page">
                            <span>فعالیت های من در درس {{$course->name}}</span>
                        </li>
                    @endif
                @else
                    <li class="breadcrumb-item"><a href="/dashboard">
                        </a></li>

                @endif
                <li class="breadcrumb-item active">{{ isset($pageName) ? $pageName : '' }}
                </li>
            </ol>

        </div>

    </div>

</div>