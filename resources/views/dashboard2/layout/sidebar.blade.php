<!--  BEGIN SIDEBAR  -->
<div class="sidebar-wrapper sidebar-theme">

    <nav id="sidebar">
        <div class="shadow-bottom"></div>
        @if(Route::current()->getName() != 'login')

            <ul class="list-unstyled menu-categories" id="accordionExample">
                <li class="menu">
                    <a href="#course" data-active="true" data-toggle="collapse" aria-expanded="true"
                       class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-home">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg>
                            <span>درس</span>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-chevron-right">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </div>
                    </a>
                    <ul class="collapse submenu list-unstyled show" id="course" data-parent="#accordionExample">
                        <li class="active">
                            <a href="/dashboard/courses/list"> لیست دروس </a>
                        </li>
                        @if(Laratrust::hasRole('teacher'))
                            <li>
                                <a href="/dashboard/courses/create">ایجاد درس</a>
                            </li>
                        @endif
                    </ul>
                </li>


                {{--@if(!Laratrust::hasRole('student'))--}}
                    {{--<li class="menu">--}}
                        {{--<a href="/dashboard/survey" aria-expanded="false" class="dropdown-toggle">--}}
                            {{--<div class="">--}}
                                {{--<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"--}}
                                     {{--fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"--}}
                                     {{--stroke-linejoin="round" class="feather feather-target">--}}
                                    {{--<circle cx="12" cy="12" r="10"></circle>--}}
                                    {{--<circle cx="12" cy="12" r="6"></circle>--}}
                                    {{--<circle cx="12" cy="12" r="2"></circle>--}}
                                {{--</svg>--}}
                                {{--<span>نظرسنجی</span>--}}
                            {{--</div>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                {{--@endif--}}
                @if(!Laratrust::hasRole('student'))
                    <li class="menu">
                        <a href="/dashboard/survey/cats" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-target">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <circle cx="12" cy="12" r="6"></circle>
                                    <circle cx="12" cy="12" r="2"></circle>
                                </svg>
                                <span> نظرسنجی</span>
                            </div>
                        </a>
                    </li>
                @endif
                @if(Laratrust::hasRole('admin'))
                    <li class="menu">
                        <a href="/dashboard/user" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-target">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <circle cx="12" cy="12" r="6"></circle>
                                    <circle cx="12" cy="12" r="2"></circle>
                                </svg>
                                <span> کاربران</span>
                            </div>
                        </a>
                    </li>
                @endif

                @if(Laratrust::hasRole('admin') || \App\Coworker::where('user_id',\Illuminate\Support\Facades\Auth::user()->id)->first())
                    <li class="menu">
                        <a href="#konkor"  data-toggle="collapse" aria-expanded="true"
                           class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-home">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                </svg>
                                <span>تولید محتوا</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-chevron-right">
                                    <polyline points="9 18 15 12 9 6"></polyline>
                                </svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled show" id="konkor" data-parent="#accordionExample">
                                <li>
                                    <a href="/dashboard/konkor">محتوای امادگی کنکور</a>
                                </li>
                        </ul>
                    </li>

                @endif

            </ul>
            <!-- <div class="shadow-bottom"></div> -->
        @endif
    </nav>

</div>
<!--  END SIDEBAR  -->