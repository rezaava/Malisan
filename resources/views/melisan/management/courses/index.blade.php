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
                    <div class="col-md-6">
                        <a href="/dashboard/courses/join" class="add-btn-list" aria-label="افزودن درس">
                            <span class="icon-list">+</span>
                            <span class="text-list">افزودن درس</span>
                        </a>

                    </div>
                    <div class="col-md-6">
                        <div class=" right-align ">
                            <a href="/dashboard/courses/list" class=" btn  box-shadow-none border-round ">
                                لیست درس ها
                            </a>
                        </div>
                    </div>
                @endif
            @endif
        </div>
        <div class="row">
            <div class="col-md-12 ">
                <div class="row">
                    @foreach ($courses as $course)
                        <div class=" col-md-3 mt-3">
                            <div class="card border-radius-7 " style='    max-height: 97vh;
                                height: 57vh;' @if($course->active == 0) style="background-color: #d3d3d3" @endif>
                                <!-- کارت درس 3 -->
                                <!-- <div class="col-md-3">
                                                                                        <div class="card h-100"> -->
                                <a href="/dashboard/courses/sessions?course_id={{ $course->id }}">

                                    <img src="{{ asset('/files/icons/' . $course->header . '.jpg') }}" class="card-img-top"
                                        alt="درس ">
                                    @if ($user->hasRole('teacher'))
                                        <div class="row">
                                            <a href="{{ route('course.delete', $course->id) }}"
                                                onclick="return confirm('با حذف این درس کلیه جلسات مربوط به آن و فعالیت دانشجویان حذف شده و قابل برگشت نیست.آیا با حذف این درس کاملا موافق هستید؟  ')"
                                                class="mb-6 btn-floating-list waves-effect waves-light gradient-45deg-purple-deep-orange gradient-shadow tooltipped"
                                                data-position="top" data-tooltip="حذف درس">
                                                <i class="material-icons">clear</i>
                                                {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity">
                                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                                    <polyline points="7 10 12 15 17 10"></polyline>
                                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                                </svg> --}}
                                                <i data-feather="trash"></i>

                                            </a>
                                            <a href="{{ route('course.edit', $course->id) }}"
                                                class="mb-6 btn-floating-list waves-effect waves-light gradient-45deg-light-blue-cyan gradient-shadow tooltipped"
                                                data-position="bottom" data-tooltip="ویرایش درس">
                                                <i class="material-icons dp48">edit</i>
                                                {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity">
                                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                                    <polyline points="7 10 12 15 17 10"></polyline>
                                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                                </svg> --}}
                                                <i data-feather="edit"></i>


                                            </a>

                                            <a onclick="share()"
                                                class="mb-6 btn-floating-list waves-effect waves-light gradient-45deg-amber-amber gradient-shadow tooltipped"
                                                data-position="top" data-tooltip="اشتراک گذاری درس">
                                                <i class="material-icons dp48">share</i>
                                                {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity">
                                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                                    <polyline points="7 10 12 15 17 10"></polyline>
                                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                                </svg> --}}
                                                <i data-feather="share-2"></i>


                                            </a>
                                            <script>
                                                function share() {
                                                    /* Get the text field */
                                                    var copyText = document.getElementById("myInput{{$course->id}}");
                                                    console.log(copyText)
                                                    /* Select the text field */
                                                    copyText.select();
                                                    copyText.setSelectionRange(0, 99999);
                                                    /* For mobile devices */

                                                    /* Copy the text inside the text field */
                                                    document.execCommand("copy");

                                                    /* Alert the copied text */
                                                    alert("متن زیر در حافظه کپی شد:\nبرای دعوت دانشجویان خود به کلاس می توانید آنرا از طریق شبکه های اجتماعی یا پیامک برایشان ارسال کنید.\n " +
                                                        copyText.value);
                                                }
                                            </script>
                                            <a href="/dashboard/courses/create?copy={{$course->id}}"
                                                class="mb-6 btn-floating-list waves-effect waves-light gradient-45deg-amber-amber gradient-shadow tooltipped"
                                                data-position="top" data-tooltip="کپی درس">
                                                <i class="material-icons dp48" style="">content_copy</i>
                                                {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity">
                                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                                    <polyline points="7 10 12 15 17 10"></polyline>
                                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                                </svg> --}}
                                                <i data-feather="content_copy"></i>


                                            </a>
                                        </div>
                                    @endif
                                    <div class="card-body d-flex flex-column text-end">
                                        <span class="" style="    font-size: medium;"> {{$course->name}}</span>
                                        <br>
                                        <span class="ml-1 vertical-align-top" style="    color: black;
                                font-size: 12px;">کد درس :{{ $course->code }}</span>
                                        <!-- <p class="card-text "> -->
                                        <!-- <a href="/dashboard/courses/sessions?course_id={{ $course->id }}"><i
                                                                                class="material-icons">settings_ethernet</i></a> -->

                                        <!-- <input type="text"
                                                                            value="دانشجوی عزیز، برای دسترسی به درس {{ $course->name }} ابتدا
                                                                                            از طریق سایت WWW.MALISAN.IR در سامانه آموزشی ملیسان با هویت واقعی ثبت نام کنید،
                                                                                            سپس با استفاده از شناسه {{ $course->code }} در درس ذکر شده عضو شوید."
                                                                            id="myInput{{$course->id}}" style="height: 0px;background: transparent;"> -->
                                        <!-- </p> -->
                             
                                    </div>
                                    <div class="card-footer">
                                            
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