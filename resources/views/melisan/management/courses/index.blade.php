@extends('melisan.layout.master')

@section('title', 'صفحه اصلی')
@section('main-content')

    <div class="container">
        <div class="row">
            @if(isset($courses))
                @if ($user->hasRole('teacher'))
                    <div class=" col-md-6">
                        <a href="/dashboard/courses/create" class="add-btn-list" aria-label="افزودن درس">
                            <span class="icon-list">+</span>
                            <span class="text-list">افزودن درس</span>
                        </a>
                    </div>
                    <div class=" col-md-6">
                        <div class=" s7 mt-1 right-align ">
                            <a href="{{ route('course.arch') }}"
                                class="waves-effect waves-light card-width btn  gradient-45deg-green-teal  box-shadow-none border-round mr-1 mb-1">
                                ارشیو
                                شده
                            </a>
                        </div>
                    </div>
                @elseif ($user->hasRole('student'))
                    <div class="col-md-12">
                        <a href="/dashboard/courses/join" class="add-btn-list" aria-label="افزودن درس">
                            <span class="icon-list">+</span>
                            <span class="text-list">افزودن درس</span>
                        </a>

                    </div>
                    <!-- <div class="col-md-6">
                                                                                                                        <div class=" right-align ">
                                                                                                                            <a href="/dashboard/courses/list" class=" btn  box-shadow-none border-round ">
                                                                                                                                لیست درس ها
                                                                                                                            </a>
                                                                                                                        </div>
                                                                                                                    </div> -->
                @endif
            @endif
        </div>
        <div class="row">
            <div class="col-md-12 ">
                <div class="row">
                    @foreach ($courses as $course)
                        <div class=" col-md-3 mt-3">
                            <div class="card border-radius-7 " style='max-height: 97vh;  height: 57vh;'>
                                <a href="/dashboard/courses/sessions?course_id={{ $course->id }}">
                                    <img src="{{ asset('/files/icons/' . $course->header . '.jpg') }}" class="card-img-top"
                                        alt="درس ">
                                    <div class="card-body d-flex flex-column text-end">
                                        <span class="" style="    font-size: medium;"> {{$course->name}}</span>
                                        <br>
                                        <span class="ml-1 vertical-align-top" style="color: black;  font-size: 12px;">کد درس
                                            :{{ $course->code }}</span>


                                                <div class="dropdown">
                                <button class="btn btn-sm rounded-circle menu-btn" data-bs-toggle="dropdown">
                                    &#8942;
                                </button>

                                <ul class="dropdown-menu rounded-4 shadow">
                                    <li>
                                        <a class="dropdown-item" href="#">✏️ ویرایش</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('course.edit', $course->id) }}" class="menu-option-3nogte">
                                            <i class="material-icons dp48">edit</i> ویرایش درس
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/dashboard/courses/create?copy={{ $course->id }}"
                                            class="menu-option-3nogte">
                                            <i class="material-icons dp48">content_copy</i> کپی درس
                                        </a>
                                    </li>
                                    <li>
                                        <a onclick="shareCourse({{ $course->id }})" class="menu-option-3nogte">
                                            <i class="material-icons dp48">share</i> اشتراک گذاری
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('course.delete', $course->id) }}"
                                            onclick="return confirmDeleteCourse()"
                                            class="menu-option-3nogte delete-option-3nogte">
                                            <i class="material-icons">clear</i> حذف درس
                                        </a>
                                    </li>
                                    <li>
                                        <button class="dropdown-item text-danger" onclick="confirm('حذف شود؟')">
                                            🗑 حذف
                                        </button>
                                    </li>
                                </ul>
                            </div>
                                    </div>


                                    <div class="card-footer">
                                        @if ($user->hasRole('teacher'))
                                          



                                            <script>
                                                // تابع اشتراک‌گذاری
                                                function shareCourse(courseId) {
                                                    const shareLink = document.getElementById(`share-link-${courseId}`).value;

                                                    navigator.clipboard.writeText(shareLink).then(() => {
                                                        alert(`لینک دعوت به کلاس کپی شد:\n${shareLink}\n\nمی‌توانید آن را برای دانشجویان ارسال کنید.`);
                                                    }).catch(err => {
                                                        // Fallback برای مرورگرهای قدیمی
                                                        const tempInput = document.createElement('input');
                                                        tempInput.value = shareLink;
                                                        document.body.appendChild(tempInput);
                                                        tempInput.select();
                                                        document.execCommand('copy');
                                                        document.body.removeChild(tempInput);

                                                        alert(`لینک دعوت به کلاس کپی شد:\n${shareLink}\n\nمی‌توانید آن را برای دانشجویان ارسال کنید.`);
                                                    });
                                                }

                                                // تابع تأیید حذف
                                                function confirmDeleteCourse() {
                                                    return confirm('با حذف این درس کلیه جلسات مربوط به آن و فعالیت دانشجویان حذف شده و قابل برگشت نیست.\nآیا با حذف این درس کاملا موافق هستید؟');
                                                }

                                                // مدیریت منوهای سه نقطه
                                                document.addEventListener('click', function (event) {
                                                    const menus = document.querySelectorAll('.menu-options-3nogte');
                                                    const dotsButtons = document.querySelectorAll('.three-dots-btn-3nogte');

                                                    let isMenuClick = false;
                                                    let isDotsButtonClick = false;

                                                    menus.forEach(menu => {
                                                        if (menu.contains(event.target)) isMenuClick = true;
                                                    });

                                                    dotsButtons.forEach(button => {
                                                        if (button.contains(event.target)) isDotsButtonClick = true;
                                                    });

                                                    if (!isMenuClick && !isDotsButtonClick) {
                                                        menus.forEach(menu => {
                                                            menu.classList.remove('show-3nogte');
                                                        });
                                                    }
                                                });

                                                // تابع نمایش/بستن منو
                                                function toggleMenu3nogte(menuId) {
                                                    const menu = document.getElementById(menuId);
                                                    const allMenus = document.querySelectorAll('.menu-options-3nogte');

                                                    allMenus.forEach(m => {
                                                        if (m.id !== menuId) {
                                                            m.classList.remove('show-3nogte');
                                                        }
                                                    });

                                                    menu.classList.toggle('show-3nogte');
                                                }

                                                // بستن منو با کلید Esc
                                                document.addEventListener('keydown', function (event) {
                                                    if (event.key === 'Escape') {
                                                        document.querySelectorAll('.menu-options-3nogte').forEach(menu => {
                                                            menu.classList.remove('show-3nogte');
                                                        });
                                                    }
                                                });
                                            </script>
                                        @endif
                                        <a href="/dashboard/courses/sessions?course_id={{ $course->id }}"
                                            class="btn btn-view-list mt-2">مشاهده درس</a>
                                    </div>
                                </a>
                                <!-- </div>
                                                                                                                                            </div> -->



                            </div>
                        </div>




                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection