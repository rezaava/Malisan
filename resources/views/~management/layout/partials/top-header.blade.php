<header class="page-topbar" id="header">
    <div class="navbar navbar-fixed">
        <nav
            class="navbar-main navbar-color nav-collapsible sideNav-lock navbar-dark gradient-45deg-indigo-purple no-shadow">
            <div class="nav-wrapper">
                <ul class="navbar-list right" style="display: flex;align-items:center">
                    <strong style="margin-left: 2rem">
                        <h6 style="color: #fff">
                            @if (Auth::user()->hasRole('teacher')) استاد @elseif(Auth::user()->hasRole('student')) دانشجو @elseif(Auth::user()->hasRole('admin')) مدیر محترم @endif {{ Auth::user()->name . ' ' . Auth::user()->family }}
                        </h6>
                    </strong>
                    <li>
                        <a
                            class="waves-effect waves-block waves-light tooltipped"
                            data-position="bottom"
                            data-tooltip="کمک میخوای ؟"
                            @if(Laratrust::hasRole('teacher'))
                            href="{{asset('/files/help.pdf')}}"
                            @elseif(Laratrust::hasRole('student'))
                            href="{{asset('/files/help2.pdf')}}"
                            @endif
                            target="_blank">
                            <i class="material-icons">live_help</i></a>
                    </li>
                    <li>
                        <a class="waves-effect waves-block waves-light profile-button" href="javascript:void(0);"
                            data-target="profile-dropdown"><span class="avatar-status avatar-online">
                                <img src="{{ asset('/files/user/' . Auth::user()->image) }}" alt="avatar"
                                    class="auth_avatar_img"><i></i></span></a>
                        <ul class="dropdown-content" id="profile-dropdown" tabindex="0">
                            <li tabindex="0"><a class="grey-text text-darken-1" href="/dashboard/user/{{auth()->user()->id}}"><i
                                        class="material-icons">person_outline</i> مشخصات</a></li>
                            <li tabindex="0"><a class="grey-text text-darken-1" href="app-chat.html"><i
                                        class="material-icons">chat_bubble_outline</i> چت</a></li>
                            <li tabindex="0"><a class="grey-text text-darken-1" href="page-faq.html"><i
                                        class="material-icons">help_outline</i> راهنمایی</a></li>
                            <li class="divider" tabindex="0"></li>
                            <li tabindex="0"><a class="grey-text text-darken-1" href="user-lock-screen.html"><i
                                        class="material-icons">lock_outline</i> قفل کردن</a></li>
                            <li tabindex="0"><a class="grey-text text-darken-1" href="{{ route('logout') }}"><i
                                        class="material-icons">keyboard_tab</i> خروج</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <nav class="display-none search-sm" style="display: none;">
                <div class="nav-wrapper">
                    <form id="navbarForm">
                        <div class="input-field search-input-sm">
                            <input class="search-box-sm" type="search" required="" id="search"
                                placeholder="Explore Materialize" data-search="template-list">
                            <label class="label-icon active" for="search"><i
                                    class="material-icons search-sm-icon">search</i></label><i
                                class="material-icons search-sm-close">close</i>
                            <ul class="search-list collection search-list-sm display-none ps">
                                <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                    <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                </div>
                                <div class="ps__rail-y" style="top: 0px; right: 0px;">
                                    <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                                </div>
                            </ul>
                        </div>
                    </form>
                </div>
            </nav>
        </nav>
    </div>
</header>
