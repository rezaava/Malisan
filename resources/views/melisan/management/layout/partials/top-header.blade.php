
<header class="page-topbar" id="header">
    <div class="navbar navbar-fixed">
        <nav class="navbar-main navbar-color nav-collapsible sideNav-lock navbar-dark gradient-45deg-purple-deep-orange gradient-shadow">
            <div class="nav-wrapper">
                {{--                <div class="header-search-wrapper hide-on-med-and-down"><i class="material-icons">search</i>--}}
                {{--                    <input class="header-search-input z-depth-2 iransans" type="text" name="Search" placeholder="جست و جو..." data-search="template-list">--}}
                {{--                    <ul class="search-list collection display-none"></ul>--}}
                {{--                </div>--}}
                <ul class="navbar-list right">


                    <li class="hide-on-large-only search-input-wrapper"><a
                            class="waves-effect waves-block waves-light search-button" href="javascript:void(0);"><i
                                class="material-icons">search</i></a></li>
                    <li><a class="waves-effect waves-block waves-light sidenav-trigger"
                           @if($user->hasRole('teacher'))
                               href="{{asset('/files/help.pdf')}}"
                           @elseif($user->hasRole('student'))
                               href="{{asset('/files/help2.pdf')}}"
                           @endif
                           data-target=""><i
                                class="material-icons">help_outline</i></a></li>

{{--                    <li><a class="waves-effect waves-block waves-light profile-button" href="/dashboard/user/{{auth()->user()->id}}"--}}
{{--                           ><span class="avatar-status avatar-online"><img--}}
{{--                                    src="{{ asset('/files/user/' . Auth::user()->image) }}" alt="avatar"><i></i></span></a>--}}
{{--                    </li>--}}
                    <li><a class="waves-effect waves-block waves-light sidenav-trigger" href="/dashboard/user/{{auth()->user()->id}}"
                           ><span class="avatar-status avatar-online"><img
                                    src="{{ asset('/files/user/' . Auth::user()->image) }}" alt="avatar"><i></i></span></a></li>
                    <li><a class="waves-effect waves-block waves-light sidenav-trigger" href="/dashboard/chat"
                           ><i class="material-icons">chat_bubble_outline</i></a></li>


                </ul>


            </div>
            <nav class="display-none search-sm">
                <div class="nav-wrapper">
                    <form id="navbarForm">
                        <div class="input-field search-input-sm">
                            <input class="search-box-sm" type="search" required="" id="search"
                                   placeholder="Explore Materialize" data-search="template-list">
                            <label class="label-icon" for="search"><i
                                    class="material-icons search-sm-icon">search</i></label><i
                                class="material-icons search-sm-close">close</i>
                            <ul class="search-list collection search-list-sm display-none"></ul>
                        </div>
                    </form>
                </div>
            </nav>
        </nav>
    </div>
</header>
