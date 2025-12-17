<!-- دکمه موبایل -->
<button class="btnMenuIcon d-lg-none" id="mobileMenuBtn">
    <span class="menu-icon">☰</span>
    <span class="close-icon" style="display: none;">✕</span>
</button>
<!-- منوی واحد -->
<div class="menu-container" id="mainMenu">
  
    <ul class="nav flex-column">
        <li></li>
        <li class="nav-item {{ request()->routeIs('dashboard') ? 'nav_active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class='bx bx-desktop fs-4 text-primary'></i>میزکار </a>
        </li>
        @if( Session::get('user')->hasRole('student'))
            <li class="nav-item {{ request()->routeIs('course.list') ? 'nav_active' : '' }}">
                <a class="nav-link" href="{{ route('course.list') }}">
                    <i class='bx bx-book fs-4 text-primary'></i>درس های من </a>
            </li>
        @endif
        <li class="nav-item {{ request()->routeIs('publics') ? 'nav_active' : '' }}">
            <a class="nav-link" href="{{ route('publics') }}">
                <i class='bx bx-video fs-4 text-success'></i>دوره های ملیسان
            </a>
        </li>
        <li class="nav-item {{ request()->routeIs('konkors') ? 'nav_active' : '' }}">
            <a class="nav-link" href="{{ route('konkors') }}">
                <i class='bx bx-task fs-4 text-warning'></i>
                آزمون ها</a>
        </li>
        <!-- منو بر اساس نقش کاربر -->
        @if(Session::get('user')->hasRole('admin'))
            <!-- منوی ادمین -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('baroms') }}">
                    <i class="material-icons">border_all</i>
                    بارم بندی
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('angizesh') }}">
                    <i class="material-icons">receipt</i>
                    پیام انگیزشی
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/dashboard/konkor">
                    <i class="material-icons">content_paste</i>
                    تولید محتوا
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/dashboard/user">
                    <i class="material-icons">person_outline</i>
                    کاربران
                </a>
            </li>
        @elseif(Session::get('user')->hasRole('touradmin'))
            <!-- منوی ادمین مسابقات -->
            <li class="nav-item">
                <a class="nav-link" href="/dashboard/tour/create">
                    <i class="material-icons">border_all</i>
                    ساخت مسابقه</a>
            </li>
        @elseif(Session::get('user')->hasRole('teacher'))
            <!-- منوی استاد -->
            @if( Session::get('content'))
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard/konkor">
                        <i class="material-icons">content_paste</i>
                        تولید محتوا
                    </a>
                </li>
            @endif

        @elseif( Session::get('user')->hasRole('content'))
            <!-- منوی محتوا -->
            <li class="nav-item">
                <a class="nav-link" href="/dashboard/survey/cats">
                    <i class="material-icons">import_contacts</i>
                    نظر سنجی
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('survey.cat') }}">
                    <i class='bx bx-poll fs-4 text-info'></i>
                    نظرسنجی
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/dashboard/chat">
                    <i class='bx bx-message fs-4 text-secondary'></i>
                    مکالمات
                </a>
            </li>
        @endif

        <!-- منوی مسابقات برای شرایط خاص -->
        @if( Session::get('mosabeghat') > 0 || Session::get('user')->hasRole('touradmin'))
            <li class="nav-item">
                <a class="nav-link" href="/dashboard/tour">
                    <i class="material-icons">border_all</i>
                    مسابقات </a>
            </li>
        @endif

        <!-- قابلیت تغییر پنل -->
        @if(Session::get('user2'))
            @if( Session::get('user')->hasRole('teacher'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('change') }}">
                        <i class='bx bx-refresh fs-4'></i>
                        انتقال به پنل دانشجو
                    </a>
                </li>
            @elseif(Session::get('user')->hasRole('student'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('change') }}">
                        <i class='bx bx-refresh fs-4'></i>
                        انتقال به پنل استاد
                    </a>
                </li>
            @endif
        @endif

        <li class="nav-item ">
            <a class="nav-link" href="{{ route('logout') }}">
                <i class='bx bx-log-out fs-4'></i>
                خروج از حساب
            </a>
        </li>

    </ul>

</div>

<!-- محتوای اصلی -->
<div class="main-content">
    <!-- <h1 class="text-white">سلام!</h1> -->

</div>
<script>
    const mobileBtn = document.getElementById('mobileMenuBtn');
    const mainMenu = document.getElementById('mainMenu'); // منوی تو

    mobileBtn.addEventListener('click', function() {
        // ۱. تغییر آیکون
        this.classList.toggle('active');
        
        // ۲. نمایش/مخفی منو
        if (mainMenu) {
            mainMenu.classList.toggle('show');
        }
        
        // ۳. برای دسترسی‌پذیری (اختیاری)
        const isOpen = this.classList.contains('active');
        this.setAttribute('aria-expanded', isOpen);
    });
    
    // بستن منو با کلیک خارج (اختیاری)
    document.addEventListener('click', function(e) {
        if (mainMenu && 
            !mainMenu.contains(e.target) && 
            !mobileBtn.contains(e.target)) {
            mainMenu.classList.remove('show');
            mobileBtn.classList.remove('active');
            mobileBtn.setAttribute('aria-expanded', 'false');
        }
    });
</script>