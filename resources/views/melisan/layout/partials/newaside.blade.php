<aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-light navbar-full sidenav-active-rounded">
    <div class="brand-sidebar">
        <h1 class="logo-wrapper">
            <a class="brand-logo darken-1" href=""><img src="{{ asset('files/main.png') }}"    alt="materialize logo"/><span
                    class="logo-text hide-on-med-and-down">ملیسان</span></a><a class="navbar-toggler" href="#"></a>
        </h1>
    </div>
    <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out"
        data-menu="menu-navigation" data-collapsible="menu-accordion">
        <li class="bold"><a class="waves-effect waves-cyan active mt-5" href="{{ route('dashboard') }}"><i
                    class="material-icons">settings_input_svideo</i><span class="menu-title"
                                                                          data-i18n="Mail">میزکار</span></a>
        </li>
        @if(!$user->hasRole('content') )
            <li class="bold"><a class="waves-effect waves-cyan " href="{{ route('course.list') }}"><i class="material-icons">format_list_bulleted</i><span
                        class="menu-title" data-i18n="Chat">درس های من</span></a>
            </li>
            @endif
            </li>
             
            </li>
            @if(!$user()->hasRole('content') )

                <li class="bold"><a class="waves-effect waves-cyan " href="/dashboard/survey/cats"><i class="material-icons">import_contacts</i><span
                            class="menu-title" data-i18n="File Manager"> نظر سنجی</span></a>
                </li>
            @endif
        
            
            @php
            $user=\Illuminate\Support\Facades\Auth::user();
              $content=Coworker::where('user_id',$user->id)->first();
            @endphp
            @if($user->hasRole('teacher') || $content)
            

            <li class="bold"><a class="waves-effect waves-cyan " href="/dashboard/konkor"><i class="material-icons">content_paste</i><span
                        class="menu-title" data-i18n="File Manager"> تولید محتوا</span></a>
            </li>
            @endif
            @role('admin')

            <li class="bold"><a class="waves-effect waves-cyan " href="{{ route('baroms') }}"><i class="material-icons">border_all</i><span
                        class="menu-title" data-i18n="File Manager"> بارم بندی</span></a>
            </li>
            <li class="bold"><a class="waves-effect waves-cyan " href="{{ route('angizesh') }}"><i class="material-icons">receipt</i>
                    <span
                        class="menu-title" data-i18n="File Manager"> پیام انگیزشی</span></a>
            </li>
            <li class="bold"><a class="waves-effect waves-cyan " href="/dashboard/konkor"><i class="material-icons">content_paste</i><span
                        class="menu-title" data-i18n="File Manager"> تولید محتوا</span></a>
            </li>
            <li class="bold"><a class="waves-effect waves-cyan " href="/dashboard/user"><i class="material-icons">person_outline</i>
                    <span
                        class="menu-title" data-i18n="File Manager"> کاربران</span></a>
            </li>

            @endrole
              @if($user->hasRole('touradmin'))

            <li class="bold"><a class="waves-effect waves-cyan " href="/dashboard/tour/create"><i class="material-icons">border_all</i><span
                        class="menu-title" data-i18n="File Manager"> ساخت مسابقه</span></a>
            </li> 
 
            @endif
            @php
                $mosabeghat=\App\Touradmin::where('user_id',$user->id)->count();
            @endphp
            @if($mosabeghat>0 || $user->hasRole('touradmin'))
            
            
            @endif
            @role('content')

            <li class="bold"><a class="waves-effect waves-cyan " href="{{ route('survey.cat') }}"><i class="material-icons">content_paste</i><span
                        class="menu-title" data-i18n="File Manager"> نظرسنجی</span></a>
            </li>
            @endrole
             
            @if(\Illuminate\Support\Facades\Auth::user()->hasRole('teacher') )
                @php
                    $user2=\App\User::where('national',\Illuminate\Support\Facades\Auth::user()->national)->where('role',2)->first();
                @endphp
                @if($user2)
                    <li class="bold"><a class="waves-effect waves-cyan " href="{{ route('change') }}"><i
                                class="material-icons dp48">exit_to_app</i><span class="menu-title"
                                                                                 data-i18n="File Manager"> انتقال به پنل دانشجو</span></a>
                    </li>
                @endif
            @endif
            @if(\Illuminate\Support\Facades\Auth::user()->hasRole('student') )
                @php
                    $user2=\App\User::where('national',\Illuminate\Support\Facades\Auth::user()->national)->where('role',1)->first();
                @endphp
                @if($user2)
                    <li class="bold"><a class="waves-effect waves-cyan " href="{{ route('change') }}"><i
                                class="material-icons dp48">exit_to_app</i><span class="menu-title"
                                                                                 data-i18n="File Manager"> انتقال به پنل استاد</span></a>
                    </li>
                @endif
            @endif

            <li class="bold"><a class="waves-effect waves-cyan " href="{{ route('logout') }}"><i class="material-icons">keyboard_tab</i><span
                        class="menu-title" data-i18n="File Manager"> خروج از حساب</span></a>
            </li>
    </ul>
    <div class="navigation-background"></div>
    <a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only"
       href="#" data-target="slide-out"><i class="material-icons">menu</i></a>
</aside>
