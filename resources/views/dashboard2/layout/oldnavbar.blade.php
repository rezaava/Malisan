<!-- Navbar -->

<!--  BEGIN NAVBAR  -->
<div class="header-container fixed-top">
    <header class="header navbar navbar-expand-sm">
        <ul class="navbar-item flex-row">
            <li class="nav-item theme-logo">
                <a href="/dashboard/courses/list">
                    <img src="{{asset('/files/icons/minilogo.png')}}" class="navbar-logo" alt="logo">
                </a>
            </li>
        </ul>

        <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 class="feather feather-list">
                <line x1="8" y1="6" x2="21" y2="6"></line>
                <line x1="8" y1="12" x2="21" y2="12"></line>
                <line x1="8" y1="18" x2="21" y2="18"></line>
                <line x1="3" y1="6" x2="3" y2="6"></line>
                <line x1="3" y1="12" x2="3" y2="12"></line>
                <line x1="3" y1="18" x2="3" y2="18"></line>
            </svg>
        </a>

        <ul class="navbar-item flex-row search-ul">
        </ul>
        <ul class="navbar-item flex-row navbar-dropdown">
            {{--<li class="nav-item dropdown language-dropdown more-dropdown">--}}
            {{--<div class="dropdown  custom-dropdown-icon">--}}
            {{--<a class="dropdown-toggle btn" href="#" role="button" id="customDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="new-style/assets/img/ca.png" class="flag-width" alt="flag"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></a>--}}

            {{--<div class="dropdown-menu dropdown-menu-right animated fadeInUp" aria-labelledby="customDropdown">--}}
            {{--<a class="dropdown-item" data-img-value="de" data-value="German" href="javascript:void(0);"><img src="new-style/assets/img/de.png" class="flag-width" alt="flag"> German</a>--}}
            {{--<a class="dropdown-item" data-img-value="jp" data-value="Japanese" href="javascript:void(0);"><img src="new-style/assets/img/jp.png" class="flag-width" alt="flag"> Japanese</a>--}}
            {{--<a class="dropdown-item" data-img-value="fr" data-value="French" href="javascript:void(0);"><img src="new-style/assets/img/fr.png" class="flag-width" alt="flag"> French</a>--}}
            {{--<a class="dropdown-item" data-img-value="ca" data-value="English" href="javascript:void(0);"><img src="new-style/assets/img/ca.png" class="flag-width" alt="flag"> English</a>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</li>--}}

            @if(Laratrust::hasRole('teacher'))
                <a
                                            href="{{asset('/files/help.pdf')}}" target="_blank"
                        {{--onclick="return confirm('با حذف این درس کلیه جلسات مربوط به آن و فعالیت دانشجویان حذف شده و قابل برگشت نیست.آیا با حذف این درس کاملا موافق هستید؟  ')"--}}
                        class="btn btn-info mb-2 mr-2">
                    {{--<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>--}}
                    <i data-feather="help-circle"></i>

                </a>
            @endif
            <li class="nav-item dropdown user-profile-dropdown  order-lg-0 order-1">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown"
                   data-toggle="dropdown" aria-haspopup="true" aria-expaHnded="false">
                    @if(\Illuminate\Support\Facades\Auth::user()->image)
                        <img src="{{asset('/files/user').\Illuminate\Support\Facades\Auth::user()->image}}"
                             alt="admin-profile" class="img-fluid">
                    @else
                        <img src="{{asset('/files/user/avatar.png')}}" alt="admin-profile" class="img-fluid">
                    @endif
                </a>
                <div class="dropdown-menu position-absolute animated fadeInUp" aria-labelledby="userProfileDropdown">
                    <div class="user-profile-section">
                        <div class="media mx-auto">
                            {{--<img src="{{asset('/files/icons/logo.png')}}" class="img-fluid mr-2" alt="avatar">--}}
                            <div class="media-body">
                                <a href="/dashboard/user/{{auth()->user()->id}}">
                                    <h5>{{\Illuminate\Support\Facades\Auth::user()->name."  "  . \Illuminate\Support\Facades\Auth::user()->family}}</h5>
                                    <p>
                                        @if(Laratrust::hasRole('teacher'))
                                            استاد
                                        @else
                                            دانشجو
                                        @endif
                                    </p>
                                </a>
                            </div>
                        </div>
                    </div>
                    {{--logout--}}
                    <div class="dropdown-item">
                        <a href="/logout">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 class="feather feather-log-out">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4">
                                </path>
                                <polyline points="16 17 21 12 16 7"></polyline>
                                <line x1="21" y1="12" x2="9" y2="12"></line>
                            </svg>
                            <span style="color: red">خروج</span>
                        </a>
                    </div>
                </div>
            </li>
        </ul>
    </header>
</div>
<!--  END NAVBAR  -->

<!-- /.navbar -->
