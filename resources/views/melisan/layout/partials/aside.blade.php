
  <!-- Toggle -->
  <div class="menu-toggle-menu2" id="menuToggle"></div>

  <!-- Overlay -->
  <div class="overlay-menu2" id="overlay"></div>

  <!-- Sidebar -->
  <div class="sidebar-menu2" id="sidebar">
    <div class="profile-menu2">
        <img src="{{ asset($user->image) }}" alt="profile" id="profile_menu2">
{{ $user->name }} {{ $user->family }}
    <span class="user_role_menu2">
         @if ($user->hasRole('teacher'))
                    استاد
                @elseif($user->hasRole('teacher'))
                        دانشجو
                    @endif
                </span>
    </div>

    <div class="menu-menu2">


    
                    <a class=" menu_link_menu2 active_menu2" href="{{ route('dashboard') }}">
                        <i class="fas fa-home"></i>داشبورد </a>
               
                @if($user->hasRole('student'))
             
                        <a class="menu_link_menu2" href="{{ route('course.list') }}">
                            <i class="fas fa-book"></i>درس های من </a>
                
                @endif

                    <a class="menu_link_menu2" href="{{ route('publics') }}">
                        <i class="fas fa-book"></i>دوره های ملیسان
                    </a>
         
                    <a class="menu_link_menu2" href="{{ route('konkors') }}">
                        <i class='bx bx-task fs-4 text-warning'></i>
                        آزمون ها</a>
            

                <!-- منو بر اساس نقش کاربر -->
                @if($user->hasRole('admin'))
                    <!-- منوی ادمین -->
                
                        <a class="menu_link_menu2" href="{{ route('baroms') }}">
                            <i class="material-icons">border_all</i>
                            بارم بندی
                        </a>
 
                        <a class="menu_link_menu2" href="{{ route('angizesh') }}">
                            <i class="material-icons">receipt</i>
                            پیام انگیزشی
                        </a>
                  
                        <a class="menu_link_menu2" href="/dashboard/konkor">
                            <i class="material-icons">content_paste</i>
                            تولید محتوا
                        </a>
     
                        <a class="menu_link_menu2" href="/dashboard/user">
                            <i class="material-icons">person_outline</i>
                            کاربران
                        </a>
                
                @elseif($user->hasRole('touradmin'))
                    <!-- منوی ادمین مسابقات -->
  
                        <a class="menu_link_menu2" href="/dashboard/tour/create">
                            <i class="material-icons">border_all</i>
                            ساخت مسابقه</a>
              
                @elseif($user->hasRole('teacher'))
                    <!-- منوی استاد -->
                    @if($content)
                 
                            <a class="menu_link_menu2" href="/dashboard/konkor">
                                <i class="material-icons">content_paste</i>
                                تولید محتوا
                            </a>
                     
                    @endif

                @elseif($user->hasRole('content'))
                    <!-- منوی محتوا -->
                   
                        <a class="menu_link_menu2" href="/dashboard/survey/cats">
                            <i class="material-icons">import_contacts</i>
                            نظر سنجی
                        </a>
            
                        <a class="menu_link_menu2" href="{{ route('survey.cat') }}">
                            <i class='bx bx-poll fs-4 text-info'></i>
                            نظرسنجی
                        </a>
              
                        <a class="menu_link_menu2" href="/dashboard/chat">
                            <i class='bx bx-message fs-4 text-secondary'></i>
                            مکالمات
                        </a>
                  
                @endif

                <!-- منوی مسابقات برای شرایط خاص -->
                @if($mosabeghat > 0 || $user->hasRole('touradmin'))
               
                        <a class="menu_link_menu2" href="/dashboard/tour">
                            <i class="material-icons">border_all</i>
                            مسابقات </a>
                   
                @endif

                <!-- قابلیت تغییر پنل -->
                @if($user2)
                    @if($user->hasRole('teacher'))
                
                            <a class="menu_link_menu2" href="{{ route('change') }}">
                                <i class='bx bx-refresh fs-4'></i>
                                انتقال به پنل دانشجو
                            </a>
                     
                    @elseif($user->hasRole('student'))
                     
                            <a class="menu_link_menu2" href="{{ route('change') }}">
                                <i class='bx bx-refresh fs-4'></i>
                                انتقال به پنل استاد
                            </a>
                     
                    @endif
                @endif

       
                    <a class="menu_link_menu2" href="{{ route('logout') }}">
                        <i class='bx bx-log-out fs-4'></i>
                        خروج از حساب
                    </a>
             
     
    </div>

    <div class="logout_menu2">
<a class="menu_link_menu2" href="{{ route('logout') }}">
                        <i class='bx bx-log-out fs-4'></i>
                        خروج از حساب
                    </a>
    </div>
  </div>

  <script>
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    const toggleBtn = document.getElementById('menuToggle');

    function toggleMenu() {
      sidebar.classList.toggle('active');
      overlay.classList.toggle('active');
      toggleBtn.classList.toggle('active'); // تغییر آیکون
    }

    toggleBtn.addEventListener('click', toggleMenu);
    overlay.addEventListener('click', toggleMenu);
  </script>









