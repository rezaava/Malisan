@extends('melisan.layout.master')

@section('title', 'صفحه اصلی')
@section('main-content')

    <div class="container-fluid">
        <div class="row">
            @if(isset($courses))
                    @if ($user->hasRole('teacher'))
                        <div class=" col-md-12">
                
                                <a href="{{ route('course.arch') }}" class="  add-btn-list">
                                    <i class="material-icons icon-list">archive</i>
                                       <span class="text-list"> آرشیو</span>
                                </a>
                        
                            <a href="/dashboard/courses/create" class="add-btn-list" aria-label="افزودن درس">
                        <i class="material-icons icon-list">add</i>
                                <!-- <span class="icon-list">+</span> -->
                                <span class="text-list">افزودن درس</span>
                            </a>

                           
                        </div>
                    @elseif ($user->hasRole('student'))
                        <div class="col-md-12">
                            <a href="/dashboard/courses/join" class="add-btn-list" aria-label="افزودن درس">
                                <span class="icon-list">+</span>
                                <span class="text-list">افزودن درس</span>
                            </a>

<<<<<<< HEAD
                    </div>
                    <!-- <div class="col-md-6">
                                                                                                                                                                                                <div class=" right-align ">
                                                                                                                                                                                                    <a href="/dashboard/courses/list" class=" btn  box-shadow-none border-round ">
                                                                                                                                                                                                        لیست درس ها
                                                                                                                                                                                                    </a>
                                                                                                                                                                                                </div>
                                                                                                                                                                                            </div> -->
                @endif
            </div>
            <div class="row">
                <div class="col-md-12 ">
                    <div class="row">
                        @foreach ($courses as $course)
                            <div class=" col-md-3 mt-3">
                                <div class="card border-radius-7 " style='max-height: 53vh;  height: 53vh;       background: rgba(255, 255, 255, 0.07);
                                                                  backdrop-filter: blur(20px);'>
                                    <!-- <a href="/dashboard/courses/sessions?course_id={{ $course->id }}"> -->
                                    <img src="{{ asset('/files/icons/' . $course->header . '.jpg') }}" class="card-img-top"
                                        alt="درس ">
                                    <div class="card-body d-flex flex-column text-end">
                                        <!-- TITLE + MENU -->
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span style="font-size: medium;">{{ $course->name }}</span>

                                            @if($user->hasRole('teacher'))
                                       
                                                <div class="dropdown">
                                                    <button class="btn btn-sm rounded-circle " type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        &#8942;
                                                    </button>
                                                     <ul class="dropdown-menu dropdown-menu-start rounded-4 shadow">
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="{{ route('course.edit', $course->id) }}">✏️ ویرایش</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="{{ route('course.delete', $course->id) }}"
                                                                onclick="return confirmDeleteCourse()">🗑 حذف</a>
                                                                
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="/dashboard/courses/create?copy={{ $course->id }}">📄 کپی
                                                                درس</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="#"
                                                                onclick="shareCourse({{ $course->id }})">🔗 اشتراک گذاری</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- COURSE INFO -->
                                        <span class="ms-1 align-top text-muted" style="color: black; font-size: 12px;">
                                            کد درس: {{ $course->code }}
                                        </span>

          <a  href="{{ route('session.list', ['course_id' => $course->id]) }}"
                                    
                                            class="btn btn-view-list mt-auto">مشاهده درس</a>
                                            
                                        <script>
                                            // اشتراک گذاری لینک
                                            function shareCourse(courseId) {
                                                const shareLink = `{{ url('/course/share') }}/${courseId}`; // لینک اشتراک گذاری واقعی
                                                navigator.clipboard.writeText(shareLink).then(() => {
                                                    alert(`لینک دوره کپی شد:\n${shareLink}`);
                                                });
                                            }

                                            // تأیید حذف
                                            function confirmDeleteCourse() {
                                                return confirm('با حذف این درس، تمام جلسات و فعالیت دانشجویان حذف می‌شوند. آیا مطمئن هستید؟');
                                            }
                                        </script>

                                    </div>


                                <!-- </a> -->
                                <!-- </div>
                                                                                                                                                                                            </div> -->



                            </div>
=======
>>>>>>> 0ff5ca98f2ba6443038989feade4d8b576d03a14
                        </div>
                        <!-- <div class="col-md-6">
                                                                                                                                                                                                                <div class=" right-align ">
                                                                                                                                                                                                                    <a href="/dashboard/courses/list" class=" btn  box-shadow-none border-round ">
                                                                                                                                                                                                                        لیست درس ها
                                                                                                                                                                                                                    </a>
                                                                                                                                                                                                                </div>
                                                                                                                                                                                                            </div> -->
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="row">
                            @foreach ($courses as $course)
                                <div class=" col-md-3 mt-3">
                                    <div class="card border-radius-7 " style='max-height: 53vh;  height: 53vh;       background: rgba(255, 255, 255, 0.07);
                                                                                  backdrop-filter: blur(20px);'>
                                        <!-- <a href="/dashboard/courses/sessions?course_id={{ $course->id }}"> -->
                                        <img src="{{ asset('/files/icons/' . $course->header . '.jpg') }}" class="card-img-top"
                                            alt="درس ">
                                        <div class="card-body d-flex flex-column text-end">
                                            <!-- TITLE + MENU -->
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <span style="font-size: medium;">{{ $course->name }}</span>

                                                @if($user->hasRole('teacher'))

                                                    <div class="dropdown">
                                                        <button class="btn btn-sm rounded-circle " type="button" data-bs-toggle="dropdown"
                                                            aria-expanded="false">
                                                            &#8942;
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-start rounded-4 shadow">
                                                            <li>
                                                                <a class="dropdown-item" href="{{ route('course.edit', $course->id) }}">✏️
                                                                    ویرایش</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item" href="{{ route('course.delete', $course->id) }}"
                                                                    onclick="return confirmDeleteCourse()">🗑 حذف</a>

                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item"
                                                                    href="/dashboard/courses/create?copy={{ $course->id }}">📄 کپی
                                                                    درس</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item" href="#"
                                                                    onclick="shareCourse({{ $course->id }})">🔗 اشتراک گذاری</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- COURSE INFO -->
                                            <span class="ms-1 align-top text-muted" style="color: black; font-size: 12px;">
                                                کد درس: {{ $course->code }}
                                            </span>

                                            <a href="{{ route('session.list', ['course_id' => $course->id]) }}"
                                                class="btn btn-view-list mt-auto">مشاهده درس</a>

                                            <script>
                                                // اشتراک گذاری لینک
                                                function shareCourse(courseId) {
                                                    const shareLink = `{{ url('/course/share') }}/${courseId}`; // لینک اشتراک گذاری واقعی
                                                    navigator.clipboard.writeText(shareLink).then(() => {
                                                        alert(`لینک دوره کپی شد:\n${shareLink}`);
                                                    });
                                                }

                                                // تأیید حذف
                                                function confirmDeleteCourse() {
                                                    return confirm('با حذف این درس، تمام جلسات و فعالیت دانشجویان حذف می‌شوند. آیا مطمئن هستید؟');
                                                }
                                            </script>

                                        </div>
                                        <!-- </a> -->
                                        <!-- </div>
                                             </div> -->
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
            @endif
        </div>
    </div>

@endsection