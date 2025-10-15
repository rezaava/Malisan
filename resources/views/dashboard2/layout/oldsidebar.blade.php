<div class="sidebar-wrapper sidebar-theme">

    <nav id="compactSidebar">
        <ul class="menu-categories">
            <li class="menu">
                <a href="#dars" data-active="true" class="menu-toggle">
                    <div class="base-menu">
                        <div class="base-icons">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                        </div>
                        <span>درس</span>
                    </div>
                </a>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left"><polyline points="15 18 9 12 15 6"></polyline></svg>
            </li>

            {{--nazarsanji--}}
            @if(Laratrust::hasRole('teacher'))
            <li class="menu">
                <a href="#nazar" data-active="true" class="menu-toggle">
                    <div class="base-menu">
                        <div class="base-icons">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                        </div>
                        <span>نظر سنجی</span>
                    </div>
                </a>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left"><polyline points="15 18 9 12 15 6"></polyline></svg>
            </li>
            @endif
 {{--karbaran admin--}}
            @if(Laratrust::hasRole('teacher'))
            <li class="menu">
                <a href="#users" data-active="true" class="menu-toggle">
                    <div class="base-menu">
                        <div class="base-icons">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                        </div>
                        <span> کاربران</span>
                    </div>
                </a>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left"><polyline points="15 18 9 12 15 6"></polyline></svg>
            </li>
            @endif
 {{--dars--}}


        </ul>
    </nav>

    <div id="compact_submenuSidebar" class="submenu-sidebar">

        <div class="submenu" id="dars">
            <ul class="submenu-list" data-parent-element="#uiKit">
                @if(Laratrust::hasRole('teacher'))
                <li>
                    <a href="/dashboard/courses/create"> <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg></span>
                        ایجاد درس </a>
                </li>
                @endif

                <li>
                    <a href="/dashboard/courses/list"> <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg></span> لیست دروس
                    </a>
                </li>
            </ul>
        </div>
        <div class="submenu" id="nazar">
            <ul class="submenu-list" data-parent-element="#uiKit">
                @if(Laratrust::hasRole('teacher'))
                <li>
                    <a href="/dashboard/survey"> <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg></span>
                        لیست نظر سنجی ها </a>
                </li>
                @endif

            </ul>
        </div>
        <div class="submenu" id="users">
            <ul class="submenu-list" data-parent-element="#uiKit">
                @if(Laratrust::hasRole('teacher'))
                <li>
                    <a href="/dashboard/user"> <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg></span>
                        لیست کاربران </a>
                </li>
                @endif

                <li>
                    <a href="/dashboard/courses/list"> <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg></span> لیست دروس
                    </a>
                </li>
            </ul>
        </div>

    </div>

</div>
