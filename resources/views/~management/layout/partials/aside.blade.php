<aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-light sidenav-active-square">
    <div class="brand-sidebar">
        <h1 class="logo-wrapper">
            <a class="brand-logo darken-1" href="index-2.html"><img class="hide-on-med-and-down"
                    src="{{ asset('files/main.png') }}" alt="ملیسان" /><img
                    class="show-on-medium-and-down hide-on-med-and-up"
                    src="{{ asset('app-assets/images/logo/materialize-logo.png') }}" alt="materialize logo" /><span
                    class="logo-text hide-on-med-and-down">ملیسان</span></a><a class="navbar-toggler" href="#"><i
                    class="material-icons">radio_button_checked</i></a>
        </h1>
    </div>

    <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out"
        data-menu="menu-navigation" data-collapsible="menu-accordion">
        <li class="bold"><a class="waves-effect waves-cyan " href="{{ route('dashboard') }}"
                target="_blank">
                <i class="material-icons">settings_input_svideo</i>
                <span class="menu-title" data-i18n="Support">داشبورد</span></a>
        </li>
        <li class="bold"><a class="collapsible-header waves-effect waves-cyan" href="Javascript:void(0)"> <i
                    class="material-icons dp48">phonelink</i><span class="menu-title" data-i18n="Dashboard">مدیریت
                    دروس</span></a>
            <div class="collapsible-body">
                <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <li><a href="{{ route('course.list') }}"><i class="material-icons">radio_button_unchecked</i><span
                                data-i18n="Modern">لیست درس ها</span></a>
                    </li>
                    <li><a href="/dashboard/courses/join"><i class="material-icons">radio_button_unchecked</i><span
                                data-i18n="eCommerce">عضویت در کلاس</span></a>
                    </li>
                </ul>
            </div>
        </li>
        @role('teacher')
            <li class="bold"><a class="waves-effect waves-cyan " href="{{ route('survey.cat') }}">
                    <i class="material-icons">settings_input_svideo</i>
                    <span class="menu-title" data-i18n="Support">مدیریت نظرسنجی
                    </span>
            </li>
        @endrole
    </ul>
    <div class="navigation-background"></div>
    <a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only"
        href="#" data-target="slide-out"><i class="material-icons">menu</i></a>
</aside>
