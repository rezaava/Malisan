@extends('dashboard2.layout.app')

@section('start')

    <link href="{{("/style/plugins/drag-and-drop/dragula/dragula.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{("/style/plugins/drag-and-drop/dragula/example.css")}}" rel="stylesheet" type="text/css"/>

@endsection
@section('main')

    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            @include('dashboard.layout.message')
            @if ($message = Session::get('create'))
                <input value="{{$message}}" id="myInput" >
                <script >
                        /* Get the text field */
                        var copyText = document.getElementById("myInput");
                        // copyText="adsdas";
                        /* Select the text field */
                        copyText.select();
                        copyText.setSelectionRange(0, 99999);
                        /* For mobile devices */

                        /* Copy the text inside the text field */
                        document.execCommand("copy");

                        /* Alert the copied text */
                        copyText.style.display="none";
                        alert("متن زیر در حافظه کپی شد:\nبرای دعوت دانشجویان خود به کلاس می توانید آنرا از طریق شبکه های اجتماعی یا پیامک برایشان ارسال کنید.\n " + copyText.value);

                // }
                </script>
            @endif

            @if(Laratrust::hasRole("student"))
                <div class="row">

                    <div class="page-header">
                        <div class="page-title">
                            <h3>عضویت در کلاس</h3>
                        </div>
                    </div>
                    <div class="col-lg-12 col-12  layout-spacing">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <form method="post"
                                                      action="/dashboard/courses/join"
                                                      enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group m-form__group @if ($errors->has('name')) has-error @endif">
                                                        <label>شناسه کلاس</label>
                                                        <div class="input-group mb-3">
                                                            <input class="form-control" name="code" type="text" required
                                                                   placeholder="شناسه کلاس">
                                                        </div>
                                                    </div>

                                                    <div class="card-footer">
                                                        <button class="btn btn-primary" type="submit" id="upload_btn"
                                                                onclick="deactive('upload_btn')">
                                                            عضویت
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>


                </div>
            @endif


            <div class="row" id="cancel-row">

                <div class="col-lg-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <div class="row">
                                        <h4>لیست دروس</h4>
                                        @if(Laratrust::hasRole('teacher'))
                                            <a
                                                    href="/dashboard/courses/create"
                                                    class="btn btn-success mb-2 mr-2">
                                                {{--<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>--}}
                                                <i data-feather="plus"></i>
                                                ایجاد درس
                                            </a>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="widget-content widget-content-area">

                            <div class='parent ex-5'>
                                <div class='row'>

                                    @foreach($courses as $key=>$course)
                                        @if($key%2==0)
                                            <div class="col-md-6">
                                                <div id='left-lovehandles' class='dragula'>

                                                    <div class="media  d-block d-xl-flex">
                                                        <ul class="list-inline people-liked-img text-center text-sm-left">
                                                            {{--<li class="list-inline-item badge-notify mr-0">--}}
                                                            {{--<div class="notification">--}}
                                                            {{--<span class="badge badge-danger">5</span>--}}
                                                            {{--</div>--}}
                                                            {{--</li>--}}
                                                            @if(Laratrust::hasRole("student"))
                                                                <li class="list-inline-item chat-online-usr">
                                                                    <img alt="avatar"
                                                                         @if($course->user->image)
                                                                         src="{{asset('/files/user').$course->user->image}}"
                                                                         @else
                                                                         src="{{asset('/files/user/avatar.png')}}"
                                                                         @endif
                                                                         @if($key==0) class="" @endif>
                                                                </li>
                                                            @endif
                                                            {{--@if(Laratrust::hasRole("teacher"))--}}
                                                                {{--@foreach($course->students as $key=>$student)--}}
                                                                    {{--<li class="list-inline-item chat-online-usr">--}}
                                                                        {{--<img alt="avatar"--}}
{{--                                                                             @if($student->image)--}}
{{--                                                                             src="{{asset('/files/user').$student->image}}"--}}
                                                                             {{--@else--}}
                                                                             {{--src="{{asset('/files/user/avatar.png')}}"--}}
                                                                             {{--@endif--}}
                                                                             {{--@if($key==0) class="" @endif>--}}
                                                                    {{--</li>--}}
                                                                {{--@endforeach--}}
                                                            {{--@endif--}}

                                                        </ul>
                                                        <div class="media-body">
                                                            <div class="d-sm-flex d-block justify-content-between text-sm-left text-center">
                                                                <div class="">
                                                                    <h5 class="">{{$course->name}} ({{$course->code}}
                                                                        )</h5>
                                                                </div>
                                                                @if($course->majazi)
                                                                    <div>
                                                                        <a href="http://{{$course->majazi}}" target="_blank"
                                                                           class="btn btn-info-gradien btn-sm" >کلاس
                                                                        </a>
                                                                    </div>
                                                                @endif
                                                                <div>
                                                                    <a href="/dashboard/courses/sessions?course_id={{$course->id}}"
                                                                       class="btn btn-primary btn-sm">مشاهده
                                                                    </a>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                        @else
                                            <div class="col-md-6">
                                                <div id='right-lovehandles' class='dragula'>

                                                    <div class="media d-block d-xl-flex">
                                                        <ul class="list-inline people-liked-img text-center text-sm-left">
                                                            {{--<li class="list-inline-item badge-notify mr-0">--}}
                                                            {{--<div class="notification">--}}
                                                            {{--<span class="badge badge-danger">9</span>--}}
                                                            {{--</div>--}}
                                                            {{--</li>--}}
                                                            @if(Laratrust::hasRole("student"))
                                                                <li class="list-inline-item chat-online-usr">
                                                                    <img alt="avatar"
                                                                         {{--@if($course->user->image)--}}
                                                                         {{--src="{{asset('/files/user').$course->user->image}}"--}}
                                                                         {{--@else--}}
                                                                         src="{{asset('/files/user/avatar.png')}}"
                                                                         {{--@endif--}}
                                                                         class="">
                                                                </li>
                                                            @endif
                                                            {{--@if(Laratrust::hasRole("teacher"))--}}
                                                                {{--@foreach($course->students as $key=>$student)--}}
                                                                    {{--<li class="list-inline-item chat-online-usr">--}}
                                                                        {{--<img alt="avatar"--}}
                                                                             {{--src="{{asset('/files/user').$student->image}}"--}}
                                                                             {{--@if($student->image)--}}
                                                                             {{--src="{{asset('/files/user').$student->image}}"--}}
                                                                             {{--@else--}}
                                                                             {{--src="{{asset('/files/user/avatar.png')}}"--}}
                                                                             {{--@endif--}}
{{----}}
                                                                             {{--@if($key==0) class="" @endif>--}}
                                                                    {{--</li>--}}
                                                                {{--@endforeach--}}
                                                            {{--@endif--}}
                                                        </ul>
                                                        <div class="media-body">
                                                            <div class="d-sm-flex d-block justify-content-between text-sm-left text-center">
                                                                <div class="">
                                                                    <h5 class="">{{$course->name}} ({{$course->code}}
                                                                        )</h5>
                                                                </div>
                                                                @if($course->majazi)
                                                                    <div>
                                                                        <a href="http://{{$course->majazi}}"
                                                                           class="btn btn-info-gradien btn-sm" target="_blank">کلاس
                                                                        </a>
                                                                    </div>
                                                                @endif
                                                                <div>
                                                                    <a href="/dashboard/courses/sessions?course_id={{$course->id}}"
                                                                       class="btn btn-primary btn-sm">مشاهده
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        @endif
                                    @endforeach

                                </div>
                            </div>

                        </div>
                    </div>
                </div>


            </div>


        </div>
 
    </div>

@endsection

@section('end')

    <script src="{{("/style/plugins/drag-and-drop/dragula/dragula.min.js")}}"></script>
    <script src="{{("/style/plugins/drag-and-drop/dragula/custom-dragula.js")}}"></script>

    <script src="{{("/style/assets/js/widgets/modules-widgets.js")}}"></script>

    <script src="{{("/style/assets/js/scrollspyNav.js")}}"></script>

@endsection
