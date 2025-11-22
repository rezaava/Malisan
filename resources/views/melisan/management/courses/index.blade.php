@extends('melisan.layout.master')

@section('title', 'صفحه اصلی')
@section('main-content')

    @if(isset($courses))
    
    <div class="row">
        <div class="col 12 s12">

            @if ($user->hasRole('teacher'))
                @include('management.layout.components.btn-loader.btn-loader' ,
                ['url' => '/dashboard/courses/create' ,
                'icon' => "<i class='material-icons dp48'>add_circle_outline</i>" ,
                'pos' => 'top' ,
                'text' => 'درس جدید'
                ])
            @elseif ($user->hasRole('student'))
                    @include('management.layout.components.btn-loader.btn-loader' ,
                    ['url' => '/dashboard/courses/join' ,
                    'icon' => "<i class='material-icons dp48'>add_circle_outline</i>" ,
                    'pos' => 'top' ,
                    'text' => 'درس جدید'
                    ])
                @endif
        </div>
    </div>


    <div class="container">
    </div>

    <div class="row" style="margin-right:10px">
        @if($user->hasRole('teacher'))
        @if(Route::current()->getName() != 'course.arch')
        <div class="row mt-4">
            <div class=" s7 mt-1 right-align ">
                <a
                    href="{{ route('course.arch') }}"
                    class="waves-effect waves-light card-width btn btn gradient-45deg-green-teal  box-shadow-none border-round mr-1 mb-1">ارشیو شده
                </a>
            </div>
        </div>
        @else
            <div class="row mt-4">
                <div class=" s7 mt-1 right-align ">
                    <a
                        href="/dashboard/courses/list"
                    class="waves-effect waves-light card-width btn btn gradient-45deg-green-teal  box-shadow-none border-round mr-1 mb-1">لیست درس ها

                    </a>
                </div>
            </div>
            @endif
        @endif
        @foreach ($courses as $course)
            
            <div class="col s12 m6 l4 ">
                <div class="card-panel border-radius-6 mt-10 card-animation-1"
                     @if($course->active==0)
                     style="background-color: #d3d3d3"
                @endif
                >
                    <a href="/dashboard/courses/sessions?course_id={{ $course->id }}"> <img class="responsive-img border-radius-8 z-depth-4 image-n-margin" src="{{ asset('/files/icons/' . $course->header.'.jpg') }}" alt="images" /></a>
                                    @if ($user->hasRole('teacher'))

                    <div class="row">
                        <a href="{{ route('course.delete', $course->id) }}"
                       onclick="return confirm('با حذف این درس کلیه جلسات مربوط به آن و فعالیت دانشجویان حذف شده و قابل برگشت نیست.آیا با حذف این درس کاملا موافق هستید؟  ')"
                       class="mb-6 btn-floating waves-effect waves-light gradient-45deg-purple-deep-orange gradient-shadow tooltipped"
                       data-position="top" data-tooltip="حذف درس">
                        <i class="material-icons" >clear</i>
                        {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg> --}}
                        <i data-feather="trash"></i>

                    </a>
                    <a href="{{ route('course.edit', $course->id) }}"
                       class="mb-6 btn-floating waves-effect waves-light gradient-45deg-light-blue-cyan gradient-shadow tooltipped"
                       data-position="bottom" data-tooltip="ویرایش درس">
                        <i class="material-icons dp48">edit</i>
                        {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg> --}}
                        <i data-feather="edit"></i>


                    </a>

                    <a onclick="share()"
                       class="mb-6 btn-floating waves-effect waves-light gradient-45deg-amber-amber gradient-shadow tooltipped"
                       data-position="top" data-tooltip="اشتراک گذاری درس">
                        <i class="material-icons dp48">share</i>
                        {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg> --}}
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
                       class="mb-6 btn-floating waves-effect waves-light gradient-45deg-amber-amber gradient-shadow tooltipped"
                       data-position="top" data-tooltip="کپی درس">
                        <i class="material-icons dp48" style="">content_copy</i>
                        {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg> --}}
                        <i data-feather="content_copy"></i>


                    </a>
                    </div>
                    @endif
                    <h6><a href="/dashboard/courses/sessions?course_id={{ $course->id }}" class="mt-5">{{$course->name}}</a></h6>
{{--                    <p>این یک توضیح درباره درس است--}}
{{--                    </p>--}}
                    <div class="col s7 p-0 mt-1">
                        <a href="/dashboard/courses/sessions?course_id={{ $course->id }}"><i class="material-icons">settings_ethernet</i></a>
                        <span class="ml-1 vertical-align-top">{{ $course->code }}</span>
                        <input type="text"
           value={{-- "دانشجوی عزیز،برای دسترسی به درس {{$course->name}} ابتدا از طریق WWW.MALISAN.IR در سامانه آموزشی مالیسان با هویت واقعی ثبت نام کنید سپس با استفاده از کد {{$course->code}} وارد کلاس شوید." --}} "            دانشجوی عزیز، برای دسترسی به درس {{ $course->name }} ابتدا از طریق سایت WWW.MALISAN.IR در سامانه آموزشی ملیسان با هویت واقعی ثبت نام کنید، سپس با استفاده از شناسه {{ $course->code }} در درس ذکر شده عضو شوید."
           id="myInput{{$course->id}}" style="height: 0px;background: transparent;">

                    </div>
                    <div class="row mt-4">
                        <div class=" s7 mt-1 center-align ">
                            <a class="waves-effect waves-light card-width btn gradient-45deg-light-blue-cyan box-shadow-none border-round mr-1 mb-1" href="/dashboard/courses/sessions?course_id={{ $course->id }}">
                                مشاهده </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @elseif(!$user->mobile)
        <div class="row">
{{--            <form class="col s12" action="/dashboard/courses/list" method="get">--}}
{{--                @csrf--}}

                <p>
                   جهت تائید حساب وارد <a href="/dashboard/user/{{$user->id}}"> پروفایل </a>شوید و موبایل را وارد کنید
                </p>
{{--                <div class="row">--}}
{{--                    <div class="input-field col s12">--}}
{{--                        <input id="code" name="code" type="text" class="validate">--}}
{{--                        <label class="contact-input" for="code">کد تائیدیه</label>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <!--<input type="submit" class="btn btn-primary btn-block" value="تائید">-->
{{--            </form>--}}
        </div>
    @else
        <div class="row">
            <form class="col s12" action="/dashboard/courses/list" method="get">
                @csrf

                <p>
                    کد تائیدیه sms شده را وارد کنید
                </p>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="code" name="code" type="text" class="validate">
                        <label class="contact-input" for="code">کد تائیدیه</label>
                    </div>
                </div>
                <input type="submit" class="btn btn-primary btn-block" value="تائید">
            </form>
        </div>
    @endif
@endsection

