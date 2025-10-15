@extends('dashboard2.layout.app')

@section('start')

    <link href="{{("/style/assets/css/scrollspyNav.css")}}" rel="stylesheet" type="text/css" />

@endsection
@section('main')

    <div id="content" class="main-content">
        {{--<div class="container">--}}

        <div class="row layout-top-spacing">

            @include('dashboard.layout.message')
            {{--<div id="breadcrumbDefault" class="col-xl-12 col-lg-12 layout-spacing" >--}}
                {{--<div class="statbox widget box box-shadow">--}}
                    {{--<div class="widget-content widget-content-area" style="background-color:whitesmoke">--}}

                        {{--<nav class="breadcrumb-one" aria-label="breadcrumb" >--}}
                            {{--<ol class="breadcrumb">--}}
                                {{--<li class="breadcrumb-item"><a href="/dashboard"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>--}}
                                {{--<li class="breadcrumb-item active" aria-current="page"><span>ایجاد درس</span></li>--}}
                            {{--</ol>--}}
                        {{--</nav>--}}


                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

        </div>
                <div class="row">


                    <div class="col-lg-12 col-12  layout-spacing">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4>
                                            @if(isset($course))
                                                ویرایش درس
                                            @else
                                                ایجاد درس
                                            @endif
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content widget-content-area">
                                <form method="post"
                                      action="@if(isset($course)){{'/dashboard/courses/edit/'.$course->id}}@else{{'/dashboard/courses/create'}}@endif"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group mb-4">
                                        <label for="formGroupExampleInput">عنوان درس</label>
                                        <input type="text" class="form-control" id="formGroupExampleInput" placeholder="مثال : ریاضی"
                                               value="@if(isset($course)){{$course->name}}@endif" name="name"
                                               required
                                        >
                                    </div>
                                    {{--<div class="form-group mb-4">--}}
                                        {{--<label for="formGroupExampleInput2">پیشبینی شما برای حداکثر جلسات</label>--}}
                                        {{--<input type="text" class="form-control" id="formGroupExampleInput2" placeholder="مثال : 16"--}}
                                               {{--value="@if(isset($course)){{$course->max_session}}@else 16 @endif" name="max_session"--}}
                                               {{--required--}}
                                        {{-->--}}
                                    {{--</div>--}}
                                    <div class="form-group m-form__group @if ($errors->has('majazi')) has-error @endif">
                                        <label>لینک کلاس مجازی(اختیاری)</label>
                                        <div class="input-group mb-3">
                                            <input class="form-control" name="majazi" type="text"   value="@if(isset($course)){{$course->majazi}}@endif" placeholder="لینک کلاس مجازی">
                                        </div>
                                        <span class="text-danger" id="title"
                                              style="color: red;">{{$errors->first('link')}}</span>
                                    </div>
                                    <input type="submit"
                                           value= " @if(isset($course))
بروزرسانی
                                           @else
                                           ایجاد درس
                                           @endif"
                                           name="time" class="btn btn-primary">
                                </form>
                            </div>
                        </div>
                    </div>


                </div>

        {{--</div>--}}
        @include('dashboard2.layout.footer')

    </div>


@endsection

@section('end')

    <script src="{{("/style/assets/js/scrollspyNav.js")}}"></script>

@endsection
