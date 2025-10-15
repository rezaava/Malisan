<header class="main-nav">
    <div class="logo-wrapper"><a href="/dashboard/courses/list"><img class="img-fluid"
                                                                     src="{{asset('/files/icons/logo.png')}}"
                                                                     {{--                                               src="{{asset('/cuba-style/assets/images/logo.png')}}"--}}
                                                                     alt=""></a></div>
    @if(\Illuminate\Support\Facades\Auth::check())
        <div class="row">
            <div class="col-auto" style="margin-top: 10px">
                @if(Laratrust::hasRole('teacher'))
                    <img src="{{asset('/cuba-style/assets/images/teacher.png')}}" style="margin-right: 10px"
                         alt="teacher"
                         width=45px>
                @else
                    <img src="{{asset('/cuba-style/assets/images/professor.png')}}" style="margin-right: 10px"
                         alt="student"
                         width=45px>
                @endif
            </div>

            <div class="col-auto" style="margin-top: 17px">
                <a href="/dashboard/user/{{auth()->user()->id}}">
                    @if(isset(auth()->user()->image))
                        <img class="img-fluid"
                             src="{{asset('/files/user').auth()->user()->image}}"
                             alt=""
                             style="height: 45px">
                    @endif
                    <h4>{{auth()->user()->name}} {{auth()->user()->family}} <span
                                style="font-size: 12px">(پروفایل)</span></h4>

                </a>

            </div>
        </div>
        <div class="logo-icon-wrapper"><a href="/"><img class="img-fluid"
                                                        {{--                                                             src="{{asset('/cuba-style/assets/images/logo.png')}}"--}}
                                                        alt=""></a></div>
        <nav>
            <div class="main-navbar">
                <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
                <div id="mainnav">
                    <ul class="nav-menu custom-scrollbar">
                        <li class="back-btn">
                            <div class="mobile-back text-right"><span>Back</span><i class="fa fa-angle-right pl-2"
                                                                                    aria-hidden="true"></i></div>
                        </li>
                        <li class="" style="margin-bottom: 5px"><a class="nav-link " href="/dashboard/courses/list">
                                <i data-feather="airplay"></i><span>میز کار</span></a>
                        </li>
                        <li class="" style="margin-bottom: 5px"><a class="nav-link " href="/dashboard/survey">
                                <i data-feather="airplay"></i><span>نظر سنجی</span></a>
                        </li>
                        @if(Laratrust::hasRole('admin'))
                            <li class="dropdown"><a class="nav-link menu-title" href="#"><i
                                            data-feather="home"></i><span>کاربران</span></a>
                                <ul class="nav-submenu menu-content">
                                    <li><a href='/dashboard/user'>لیست</a></li>
                                </ul>
                            </li>
                        @endif

                        <li class="dropdown"><a class="nav-link menu-title" href="#">
                                <i data-feather="airplay"></i><span>درس</span></a>
                            <ul class="nav-submenu menu-content">
                                @if(Laratrust::hasRole('teacher'))
                                    <li><a href='/dashboard/courses/create'>ایجاد درس</a></li>
                                @endif
                                <li><a href='/dashboard/courses/list'>لیست دروس</a></li>

                            </ul>
                        </li>
                        <li class="" style="margin-bottom: 5px"><a class="nav-link " href="{{'/logout'}}">
                                <i data-feather="log-out"> </i><span>خروج</span></a>
                        </li>

                    </ul>
                </div>
                <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
            </div>
        </nav>
    @endif
</header>
