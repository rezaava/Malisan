<nav class="navbar " id="menu">
    <div class="nav-container">
        <!-- سمت راست - لوگو و نام سایت -->

        <div class="logo-section">
            <a href="#" class="logo">
                <img src="{{ asset('files/main.png') }}" alt="" class="logo-icon">
                <div class="logo-text">
                    <div class="logo-main">ملیسان </div>

                </div>
            </a>
        </div>

        <!-- سمت چپ - پروفایل و آیکون‌ها -->
        <div class="user-section">
            <ul class="navbar-list ">
                <li>
                    <!-- آیکون سوالات -->
                    <a class="" @if( $user->hasRole('teacher')) href="{{asset('/files/help.pdf')}}"
                    @elseif($user->hasRole('student')) href="{{asset('/files/help2.pdf')}}" @endif data-target=""
                        style="font-size: 20px;">❓
                    </a>
                </li>
                <!-- آیکون پیام‌ها -->
                <li>
                    <a class="" href="/dashboard/chat" style="font-size: 20px;">💬</a>
                </li>
                <li>

                    <!-- پروفایل به صورت آیکون -->
                    <a class="" href="/dashboard/user/{{ $user->id}}">
                        <span class="avatar-status avatar-online">
                            <img src="{{ asset($user->image) }}" alt="profile">
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>