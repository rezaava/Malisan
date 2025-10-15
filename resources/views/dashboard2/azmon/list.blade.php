@extends('management.layout.master')

@section('start')

    <link href="{{("/style/plugins/drag-and-drop/dragula/dragula.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{("/style/plugins/drag-and-drop/dragula/example.css")}}" rel="stylesheet" type="text/css"/>

@endsection
@section('main-content')

    <div id="content" class="main-content">
        <div class="layout-px-spacing">

            <div class="row">
                <div class="col-lg-12 col-12  layout-spacing">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="card-footer">
                                                <a href="/dashboard/azmon/create?id={{$course->id}}"
                                                   class="btn btn-primary" type="submit" id="upload_btn"
                                                >
                                                    آزمون جدید
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>


            </div>


            <div class="row" style="margin-right:15px" id="cancel-row">

                <div class="col-lg-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <div class="row">
                                        <h4>لیست آزمون ها</h4>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="widget-content widget-content-area">

                            <div class='parent ex-5'>
                                <div class='row'>

                                    @foreach($azmons as $key=>$azmon)

                                        @if($key%2==0)
                                            <div class="col-md-6">
                                                <div id='left-lovehandles' class='dragula'>

                                                    <div class="media  d-block d-xl-flex">

                                                        <div class="media-body">
                                                            <div class="d-sm-flex d-block justify-content-between text-sm-left text-center">
                                                                <div class="">
                                                                    <h5 class="">{{$azmon->title}}</h5>
                                                                </div>
                                                                <input type="text" value=
                                                                {{--"دانشجوی عزیز،برای دسترسی به درس {{$course->name}} ابتدا از طریق WWW.MALISAN.IR در سامانه آموزشی مالیسان با هویت واقعی ثبت نام کنید سپس با استفاده از کد {{$course->code}} وارد کلاس شوید."--}}
                                                                        "دانشجوی عزیز در سامانه ملیسان با رفتن به بخش آزمون ها در آزمون درس  {{$course->name}} شرکت کنید.کد ورود به آزمون : {{$azmon->code}}"
                                                                       id="myInput{{$key}}" style="z-index: -100;height: 0px;background: transparent;">

                                                                <div>
                                                                    @if($azmon->expire==0)
                                                                    <a href="/dashboard/azmon/edit?id={{$azmon->id}}"
                                                                       class="btn btn-primary btn-sm">ویرایش
                                                                    </a>

                                                                    @endif
                                                                    <a onclick="share({{$key}})"
                                                                       class="btn btn-primary btn-sm">انتشار
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
                                                            <li class="list-inline-item badge-notify mr-0">
                                                                <div class="notification">
                                                                    {{--<span class="badge badge-danger">9</span>--}}
                                                                </div>
                                                            </li>
                                                        </ul>
                                                        <div class="media-body">
                                                            <div class="d-sm-flex d-block justify-content-between text-sm-left text-center">
                                                                <div class="">
                                                                    <h5 class="">{{$azmon->title}} </h5>
                                                                </div>
                                                                <input type="text" value=
                                                                        "دانشجوی عزیز در سامانه ملیسان با رفتن به بخش آزمون ها در آزمون درس  {{$course->name}} شرکت کنید.کد ورود به آزمون : {{$azmon->code}}"
                                                                       id="myInput{{$key}}" style="z-index: -100;height: 0px;background: transparent;">

                                                                <div>
                                                                    @if($azmon->expire==0)
                                                                        <a href="/dashboard/azmon/edit?id={{$azmon->id}}"
                                                                           class="btn btn-primary btn-sm">ویرایش
                                                                        </a>

                                                                    @endif
                                                                    <a onclick="share({{$key}})"
                                                                       class="btn btn-primary btn-sm">انتشار
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

@section('js')

    <script src="{{("/style/plugins/drag-and-drop/dragula/dragula.min.js")}}"></script>
    <script src="{{("/style/plugins/drag-and-drop/dragula/custom-dragula.js")}}"></script>


    <script>
        function share($k) {
            /* Get the text field */
            var copyText = document.getElementById("myInput"+$k);

            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            /* For mobile devices */

            /* Copy the text inside the text field */
            document.execCommand("copy");

            /* Alert the copied text */
            alert(" برای ورود دانشجو به آزمون متن زیر را که در حافظه کپی شده است از طریق شبکه های اجتماعی، ادوبی کانکت یا پیامک برای دانشجویان خود ارسال کنید. \n" + copyText.value);
        }
    </script>
@endsection
