<!--  BEGIN NAVBAR  -->
<div class="header-container fixed-top">
    <header class="header navbar navbar-expand-sm">

        <ul class="navbar-item theme-brand flex-row  text-center">
            <li class="nav-item theme-logo">
                <a href="/dashboard/courses/list">
                    <img src="{{asset('/files/icons/minilogo.png')}}" class="navbar-logo" alt="logo">
                </a>
            </li>
            <li class="nav-item theme-text">
                <a href="/dashboard/user/{{auth()->user()->id}}" class="nav-link">
                    <h5>    @if(Laratrust::hasRole('teacher'))
                            استاد
                        @else
                            دانشجو
                        @endif
                        {{\Illuminate\Support\Facades\Auth::user()->name."  "  . \Illuminate\Support\Facades\Auth::user()->family}}
                    </h5>

                </a>
            </li>
        </ul>

        <ul class="navbar-item flex-row ml-md-auto">
            <a
                    @if(Laratrust::hasRole('teacher'))
                    href="{{asset('/files/help.pdf')}}"
                    @elseif(Laratrust::hasRole('student'))
                    href="{{asset('/files/help2.pdf')}}"
                    @endif
                    target="_blank"
                    {{--onclick="return confirm('با حذف این درس کلیه جلسات مربوط به آن و فعالیت دانشجویان حذف شده و قابل برگشت نیست.آیا با حذف این درس کاملا موافق هستید؟  ')"--}}
                    class="btn btn-info mb-2 mr-2">
                {{--<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>--}}
                <i data-feather="help-circle"></i>

            </a>

            {{--notif--}}
            @if(Laratrust::hasRole('student'))
                <li class="nav-item dropdown notification-dropdown">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="notificationDropdown"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-bell" style="color: yellow">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg>
                        @if(isset($all))
                            @if($all>0)
                                <span class="badge badge-danger"></span>
                            @endif
                        @endif
                    </a>
                    <div class="dropdown-menu position-absolute" aria-labelledby="notificationDropdown">
                        <div class="notification-scroll">

                            {{--q alert--}}
                            @if(isset($q_returns) )
                                @if(count($q_returns)==0)
                                    <div class="dropdown-item">
                                        <div class="media">
                                            {{--<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"--}}
                                            {{--fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"--}}
                                            {{--stroke-linejoin="round" class="feather feather-check-square">--}}
                                            {{--<path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>--}}
                                            {{--</svg>--}}
                                            <i data-feather="check-square" style="color: yellow"></i>

                                            <div class="media-body">
                                                <div class="notification-para">
                                                    هیچ سوالی نیاز به اصلاح ندارد
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                @else
                                    @foreach( $q_returns_courses as $item)
                                        <div class="dropdown-item">
                                            <div class="media">
                                                {{--<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"--}}
                                                {{--fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"--}}
                                                {{--stroke-linejoin="round" class="feather feather-check-square">--}}
                                                {{--<path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>--}}
                                                {{--</svg>--}}
                                                <i data-feather="check-square" style="color: yellow"></i>

                                                <div class="media-body">
                                                    <a href="/dashboard/evaluation?course_id={{$item->id}}">
                                                        <div class="notification-para"> سوال شما در درس<span
                                                                    class="user-name">{{$item->name}}</span> نیاز به
                                                            اصلاح دارد
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                @endif
                            @endif

                            {{--d alert--}}
                            @if(isset($d_returns) )
                                @if(count($d_returns)==0)
                                    <div class="dropdown-item">
                                        <div class="media">
                                            {{--<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"--}}
                                            {{--fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"--}}
                                            {{--stroke-linejoin="round" class="feather feather-check-square">--}}
                                            {{--<path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>--}}
                                            {{--</svg>--}}
                                            <i data-feather="check-square" style="color: yellow"></i>

                                            <div class="media-body">
                                                <div class="notification-para">
                                                    هیچ گزارشی نیاز به اصلاح ندارد
                                                </div>
                                            </div>
                                        </div>
                                    </div>




                                @else
                                    @foreach( $d_returns_courses as $item)
                                        <div class="dropdown-item">
                                            <div class="media">
                                                {{--<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"--}}
                                                {{--fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"--}}
                                                {{--stroke-linejoin="round" class="feather feather-check-square">--}}
                                                {{--<path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>--}}
                                                {{--</svg>--}}
                                                <i data-feather="check-square" style="color: yellow"></i>

                                                <div class="media-body">
                                                    <a href="/dashboard/evaluation?course_id={{$item->id}}">
                                                        <div class="notification-para"> گزارش شما در درس<span
                                                                    class="user-name">{{$item->name}}</span> نیاز به
                                                            اصلاح دارد
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                @endif
                                @endif
                        </div>
                    </div>
                </li>
            @endif

            {{--chat--}}
            <li class="nav-item dropdown notification-dropdown">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="notificationDropdown"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                    <i data-feather="message-circle"
                       @if(isset($newchat))
                       @if($newchat>0)
                       style="color: red"
                    @else
                       style="color: white"
@endif
@endif
                    >
                    </i>
                    @if(isset($newchat))
                        @if($newchat>0)
                            <span class="badge badge-danger"></span>
                        @endif
                    @endif
                    {{--@if(isset($all))--}}
                    {{--@if($all>0)--}}
                    {{--<span class="badge badge-danger"></span>--}}
                    {{--@endif--}}
                    {{--@endif--}}
                </a>
                <div class="dropdown-menu position-absolute" aria-labelledby="notificationDropdown">
                    <div class="notification-scroll">
                        <div class="dropdown-item">
                            <a href="/dashboard/chat">


                                <div class="media">
                                    <i data-feather="plus-square" style="color: yellow"></i>

                                    <div class="media-body">
                                        <div class="notification-para btn btn-primary">

                                            لیست مکالمات
                                        </div>
                                    </div>
                                </div>
                            </a>

                        </div>

                        {{--q alert--}}</div>
                </div>
            </li>

            {{--profile--}}
            <li class="nav-item dropdown user-profile-dropdown">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    @if(\Illuminate\Support\Facades\Auth::user()->image)
                        <img src="{{asset('/files/user').\Illuminate\Support\Facades\Auth::user()->image}}"
                             alt="admin-profile" class="img-fluid">
                    @else
                        <img src="{{asset('/files/user/avatar.png')}}" alt="admin-profile" class="img-fluid">
                    @endif                </a>
                <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                    <div class="">
                        <div class="dropdown-item">
                            <a href="/dashboard/user/{{auth()->user()->id}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-user">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                پروفایل من</a>
                        </div>

                        <div class="dropdown-item">
                            <a href="/logout">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-log-out">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                    <polyline points="16 17 21 12 16 7"></polyline>
                                    <line x1="21" y1="12" x2="9" y2="12"></line>
                                </svg>
                                خروج</a>
                        </div>
                    </div>
                </div>
            </li>

        </ul>
    </header>
</div>
<!--  END NAVBAR  -->

<!--  BEGIN scrum  -->
<div class="sub-header-container">
    <header class="header navbar navbar-expand-sm">
        <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 class="feather feather-menu">
                <line x1="3" y1="12" x2="21" y2="12"></line>
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <line x1="3" y1="18" x2="21" y2="18"></line>
            </svg>
        </a>

        <ul class="navbar-nav flex-row">
            <li>
                <div class="page-header">

                    <nav class="breadcrumb-one" aria-label="breadcrumb">

                        <ol class="breadcrumb">

                            @if(Route::current()->getName() == 'course.create')
                                <li class="breadcrumb-item"><a href="/dashboard">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                             stroke-linecap="round" stroke-linejoin="round"
                                             class="feather feather-home">
                                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                        </svg>
                                    </a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span>ایجاد درس</span></li>

                                {{--<li class="breadcrumb-item"><a href="javascript:void(0);">داشبورد</a></li>--}}
                                {{--<li class="breadcrumb-item active" aria-current="page"><span>فروش ها</span></li>--}}
                                {{--<li class="breadcrumb-item active" aria-current="page"><span></span></li>--}}
                            @elseif(Route::current()->getName() == 'course.list')
                                <li class="breadcrumb-item"><a href="/dashboard">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                             stroke-linecap="round" stroke-linejoin="round"
                                             class="feather feather-home">
                                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                        </svg>
                                    </a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span>لیست دروس</span></li>
                            @elseif(Route::current()->getName() == 'progress')
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
                                <li class="breadcrumb-item " aria-current="page"><a
                                            href="/dashboard/courses/students?course_id={{$course->id}}"><span>دانشجویان</span></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <span>پیشرفت درسی دانشجو {{$user->name}} {{$user->family}}</span></li>
                            @elseif(Route::current()->getName() == 'course.students')
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
                                <li class="breadcrumb-item active" aria-current="page"><span>دانشجویان</span></li>
                            @elseif(Route::current()->getName() == 'exercise.show')
                                <li class="breadcrumb-item"><a href="/dashboard">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24"
                                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                             stroke-linejoin="round" class="feather feather-home">
                                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                        </svg>
                                    </a></li>
                                <li class="breadcrumb-item " aria-current="page"><a
                                            href="/dashboard/courses/sessions?course_id={{$course->id}}">
                                        <span>درس {{$course->name}}</span></a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <span>تکلیف جلسه {{$meeting->number}}</span></li>
                            @elseif(Route::current()->getName() == 'exercise.edit')
                                <li class="breadcrumb-item"><a href="/dashboard">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24"
                                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                             stroke-linejoin="round" class="feather feather-home">
                                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                        </svg>
                                    </a></li>
                                <li class="breadcrumb-item " aria-current="page"><a
                                            href="/dashboard/courses/sessions?course_id={{$course->id}}">
                                        <span>درس {{$course->name}}</span></a></li>
                                <li class="breadcrumb-item " aria-current="page">
                                    <a
                                            href="/dashboard/exercise/show?session_id={{$meeting->id}}">
                                        <span>تکلیف جلسه {{$meeting->number}}</span></a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <span>ویرایش تکلیف جلسه {{$meeting->number}}</span></li>
                            @elseif(Route::current()->getName() == 'question.show')
                                <li class="breadcrumb-item"><a href="/dashboard">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24"
                                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                             stroke-linejoin="round" class="feather feather-home">
                                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                        </svg>
                                    </a></li>
                                <li class="breadcrumb-item " aria-current="page"><a
                                            href="/dashboard/courses/sessions?course_id={{$course->id}}">
                                        <span>درس {{$course->name}}</span></a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span>سوالات</span></li>
                            @elseif(Route::current()->getName() == 'users.list')
                                <li class="breadcrumb-item"><a href="/dashboard">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24"
                                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                             stroke-linejoin="round" class="feather feather-home">
                                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                        </svg>
                                    </a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span>لیست کاربران</span></li>
                            @elseif(Route::current()->getName() == 'bank')
                                <li class="breadcrumb-item"><a href="/dashboard">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24"
                                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                             stroke-linejoin="round" class="feather feather-home">
                                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                        </svg>
                                    </a></li>
                                <li class="breadcrumb-item " aria-current="page"><a
                                            href="/dashboard/courses/sessions?course_id={{$course->id}}">
                                        <span>درس {{$course->name}}</span></a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span>بانک سوالات</span></li>
                            @elseif(Route::current()->getName() == 'quiz.list')
                                <li class="breadcrumb-item"><a href="/dashboard">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24"
                                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                             stroke-linejoin="round" class="feather feather-home">
                                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                        </svg>
                                    </a></li>
                                <li class="breadcrumb-item " aria-current="page"><a
                                            href="/dashboard/courses/sessions?course_id={{$course->id}}">
                                        <span>درس {{$course->name}}</span></a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <span>لیست خود آزمایی ها دانشجو {{$user->name}} {{$user->family}}</span></li>
                            @elseif(Route::current()->getName() == 'quiz.view')
                                <li class="breadcrumb-item"><a href="/dashboard">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24"
                                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                             stroke-linejoin="round" class="feather feather-home">
                                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                        </svg>
                                    </a></li>
                                <li class="breadcrumb-item " aria-current="page"><a
                                            href="/dashboard/courses/sessions?course_id={{$course->id}}">
                                        <span>درس {{$course->name}}</span></a></li>
                                <li class="breadcrumb-item " aria-current="page">
                                    <a href="/dashboard/quiz/list?course_id={{$course->id}}&user={{$user->id}}">
                                        <span>لیست خود آزمایی ها دانشجو {{$user->name}} {{$user->family}}</span></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page"><span> خود آزمایی   </span></li>
                            @elseif(Route::current()->getName() == 'session.create')
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
                                <li class="breadcrumb-item active" aria-current="page"><span>
                                                                                @if(isset($meeting))
                                            ویرایش جلسه
                                        @else
                                            ایجاد جلسه
                                        @endif
                                    </span></li>
                            @elseif(Route::current()->getName() == 'session.list')
                                <li class="breadcrumb-item"><a href="/dashboard">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24"
                                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                             stroke-linejoin="round" class="feather feather-home">
                                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                        </svg>
                                    </a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <span>درس {{$course->name}} </span>
                                </li>

                            @elseif(Route::current()->getName() == 'disc.show')
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
                                <li class="breadcrumb-item active" aria-current="page"><span>خلاصه جلسه</span></li>



                            @elseif(Route::current()->getName() == 'survey.cat')
                                <li class="breadcrumb-item"><a href="/dashboard">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                             stroke-linecap="round" stroke-linejoin="round"
                                             class="feather feather-home">
                                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                        </svg>
                                    </a></li>
                                @if(Laratrust::hasRole('admin'))
                                    <li class="breadcrumb-item active" aria-current="page"><span>دسته بندی های نظرسنجی</span></li>
                                @elseif(Laratrust::hasRole('teacher'))
                                    <li class="breadcrumb-item active" aria-current="page"><span>دروس برای نظرسنجی</span></li>
                                @endif
                            @elseif(Route::current()->getName() == 'survey.list')
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
                                            href="/dashboard/survey/cats">
                                        <span>نظر سنجی </span></a></li>

                                @if(Laratrust::hasRole('admin'))
                                    <li class="breadcrumb-item active" aria-current="page"><span>دسته بندی {{$cat_obj->name}}</span></li>
                                @elseif(Laratrust::hasRole('teacher'))
                                    <li class="breadcrumb-item active" aria-current="page"><span>درس {{$course->name}}</span></li>
                                @endif


                            @elseif(Route::current()->getName() == 'setting')
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
                                <li class="breadcrumb-item active" aria-current="page"><span>تنظیمات</span></li>
                            @elseif(Route::current()->getName() == 'referee')
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
                                <li class="breadcrumb-item active" aria-current="page">
                                    <span>داوری فعالیت ها در درس {{$course->name}}</span></li>
                            @elseif(Route::current()->getName() == 'eva')
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
                                @if(Laratrust::hasRole('teacher'))
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <span>ارزیابی فعالیت های درس {{$course->name}}</span></li>
                                @elseif(Laratrust::hasRole('student'))
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <span>فعالیت های من در درس {{$course->name}}</span></li>
                                @endif
                            @else
                                <li class="breadcrumb-item"><a href="/dashboard">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                             stroke-linecap="round" stroke-linejoin="round"
                                             class="feather feather-home">
                                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                        </svg>
                                    </a></li>

                            @endif
                        </ol>

                    </nav>

                </div>
            </li>
        </ul>
    </header>
</div>
<!--  END scrum  -->

