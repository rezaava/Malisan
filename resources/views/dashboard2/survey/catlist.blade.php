@extends('dashboard2.layout.app')

@section('start')

    <link href="{{("/style/plugins/drag-and-drop/dragula/dragula.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{("/style/plugins/drag-and-drop/dragula/example.css")}}" rel="stylesheet" type="text/css"/>

@endsection
@section('main')

    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            @include('dashboard.layout.message')

            @if(Laratrust::hasRole("admin"))
                <div class="row">

                    <div class="col-lg-12 col-12  layout-spacing">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <form method="post"
                                                      action="/dashboard/survey/cat"
                                                      enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group m-form__group @if ($errors->has('name')) has-error @endif">
                                                        <label>نام دسته بندی</label>
                                                        <div class="input-group mb-3">
                                                            <input class="form-control" name="name" type="text" required
                                                                   placeholder="نام دسته بندی">
                                                        </div>
                                                    </div>

                                                    <div class="card-footer">
                                                        <button class="btn btn-primary" type="submit" id="upload_btn"
                                                                onclick="deactive('upload_btn')">
                                                            ایجاد
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

            @if(Laratrust::hasRole("admin"))

            <div class="row" id="cancel-row">

                <div class="col-lg-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <div class="row">
                                        <h4>لیست دسته بندی ها</h4>
                                            {{--<a--}}
                                                    {{--href="/dashboard/courses/create"--}}
                                                    {{--class="btn btn-success mb-2 mr-2">--}}
                                                {{--<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>--}}
                                                {{--<i data-feather="plus"></i>--}}
                                                {{--ایجاد درس--}}
                                            {{--</a>--}}
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="widget-content widget-content-area">

                            <div class='parent ex-5'>
                                <div class='row'>

                                    @foreach($cats as $key=>$cat)
                                        @if($key%2==0)
                                            <div class="col-md-6">
                                                <div id='left-lovehandles' class='dragula'>

                                                    <div class="media  d-block d-xl-flex">
                                                        <div class="media-body">
                                                            <div class="d-sm-flex d-block justify-content-between text-sm-left text-center">
                                                                <div class="">
                                                                    <h5 class="">{{$cat->name}}</h5>
                                                                </div>
                                                                    {{--<div>--}}
                                                                        {{--<a href="http://" target="_blank"--}}
                                                                           {{--class="btn btn-info-gradien btn-sm" >ویرایش--}}
                                                                        {{--</a>--}}
                                                                    {{--</div>--}}
                                                                @if(Laratrust::hasRole('admin'))
                                                                <div>
                                                                    <a href="/dashboard/survey/delcat?cat_id={{$cat->id}}"
                                                                       class="btn btn-danger btn-sm">حذف
                                                                    </a>
                                                                </div>
                                                                @endif
                                                                <div>
                                                                    <a href="/dashboard/survey?cat_id={{$cat->id}}"
                                                                       class="btn btn-primary btn-sm">نظرسنجی
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
                                                        <div class="media-body">
                                                            <div class="d-sm-flex d-block justify-content-between text-sm-left text-center">
                                                                <div class="">
                                                                    <h5 class="">{{$cat->name}} </h5>
                                                                </div>
                                                                    {{--<div>--}}
                                                                        {{--<a href="http://"--}}
                                                                           {{--class="btn btn-info-gradien btn-sm" target="_blank">ویرایش--}}
                                                                        {{--</a>--}}
                                                                    {{--</div>--}}
                                                                @if(Laratrust::hasRole('admin'))
                                                                <div>
                                                                    <a href="/dashboard/survey/delcat?cat_id={{$cat->id}}"
                                                                       class="btn btn-danger btn-sm">حذف
                                                                    </a>
                                                                </div>
                                                                @endif
                                                                <div>
                                                                    <a href="/dashboard/survey?cat_id={{$cat->id}}"
                                                                       class="btn btn-primary btn-sm">نظرسنجی
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
@endif

            @if(Laratrust::hasRole("teacher"))

            <div class="row" id="cancel-row">

                <div class="col-lg-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <div class="row">
                                        <h4>لیست دروس برای نظرسنجی</h4>
                                            {{--<a--}}
                                                    {{--href="/dashboard/courses/create"--}}
                                                    {{--class="btn btn-success mb-2 mr-2">--}}
                                                {{--<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>--}}
                                                {{--<i data-feather="plus"></i>--}}
                                                {{--ایجاد درس--}}
                                            {{--</a>--}}
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="widget-content widget-content-area">

                            <div class='parent ex-5'>
                                <div class='row'>

                                    @foreach($courses as $key=>$cat)
                                        @if($key%2==0)
                                            <div class="col-md-6">
                                                <div id='left-lovehandles' class='dragula'>

                                                    <div class="media  d-block d-xl-flex">
                                                        <div class="media-body">
                                                            <div class="d-sm-flex d-block justify-content-between text-sm-left text-center">
                                                                <div class="">
                                                                    <h5 class="">{{$cat->name}}</h5>
                                                                </div>
                                                                    {{--<div>--}}
                                                                        {{--<a href="http://" target="_blank"--}}
                                                                           {{--class="btn btn-info-gradien btn-sm" >ویرایش--}}
                                                                        {{--</a>--}}
                                                                    {{--</div>--}}

                                                                <div>
                                                                    <a href="/dashboard/survey?course_id={{$cat->id}}"
                                                                       class="btn btn-primary btn-sm">نظرسنجی
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
                                                        <div class="media-body">
                                                            <div class="d-sm-flex d-block justify-content-between text-sm-left text-center">
                                                                <div class="">
                                                                    <h5 class="">{{$cat->name}} </h5>
                                                                </div>
                                                                    {{--<div>--}}
                                                                        {{--<a href="http://"--}}
                                                                           {{--class="btn btn-info-gradien btn-sm" target="_blank">ویرایش--}}
                                                                        {{--</a>--}}
                                                                    {{--</div>--}}

                                                                <div>
                                                                    <a href="/dashboard/survey?course_id={{$cat->id}}"
                                                                       class="btn btn-primary btn-sm">نظرسنجی
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
@endif

        </div>
        @include('dashboard2.layout.footer')

    </div>

@endsection

@section('end')

    <script src="{{("/style/plugins/drag-and-drop/dragula/dragula.min.js")}}"></script>
    <script src="{{("/style/plugins/drag-and-drop/dragula/custom-dragula.js")}}"></script>

@endsection
