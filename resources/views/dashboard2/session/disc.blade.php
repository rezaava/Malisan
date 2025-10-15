@extends('dashboard2.layout.app')

@section('start')

    <link href="{{("/style/assets/css/scrollspyNav.css")}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{("/style/plugins/editors/markdown/simplemde.min.css")}}">
    <link rel="stylesheet" href="{{asset('/cuba-style/assets/css/select2.css')}}" />

    <script>

    </script>
@endsection
@section('main')


    <div id="content" class="main-content">

        @include('dashboard.layout.message')
        {{--<div id="breadcrumbDefault" class="col-xl-12 col-lg-12 layout-spacing">--}}
            {{--<div class="statbox widget box box-shadow">--}}
                {{--<div class="widget-content widget-content-area">--}}

                    {{--<nav class="breadcrumb-one" aria-label="breadcrumb">--}}
                        {{--<ol class="breadcrumb">--}}
                            {{--<li class="breadcrumb-item"><a href="/dashboard"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>--}}
                            {{--<li class="breadcrumb-item " aria-current="page"><a href="/dashboard/courses/sessions?course_id={{$course->id}}"> <span>درس {{$course->name}}</span></a></li>--}}
                            {{--<li class="breadcrumb-item active" aria-current="page"><span>خلاصه جلسه</span></li>--}}
                        {{--</ol>--}}
                    {{--</nav>--}}


                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                            <h5>ارائه خلاصه ای از محتوای درس
                            </h5>
                        @if($setting->ersal_gozaresh_desc)
                        <h6 style="color: red">
                            {{$setting->ersal_gozaresh_desc}}
                            </h6>
@endif
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <form method="post"
                                      action={{"/dashboard/discussion/create?session_id=".$session->id}}
                                              enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group @if ($errors->has('text')) has-error @endif">
                                        <label>خلاصه</label>
                                        <div class="input-group mb-3">
                                            <div class="col-lg-12">
                                                <textarea class="form-control btn-square" name="text" id="description" maxlength="350">@if($discussion){!! $discussion->text !!}@endif</textarea>
                                            </div>
                                        </div>

                                    </div>



                                    <div class="card-footer">
                                        <button class="btn btn-primary" type="submit" id="upload_btn" onclick="deactive('upload_btn')">
                                                ارسال
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        @include('dashboard2.layout.footer')

    </div>


@endsection

@section('end')
    <script src="{{asset('/cuba-style/assets/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('/cuba-style/assets/js/select2/select2.full.min.js')}}"></script>
    <script>
        CKEDITOR.replace('description' ,{
            filebrowserUploadUrl : '/admin/panel/upload-image',
            filebrowserImageUploadUrl :  '/admin/panel/upload-image'
        });

        CKEDITOR.config.toolbar = [
            ['Styles','Format','Font','FontSize'],
            '/',
            ['Bold','Italic','Underline','StrikeThrough','-','Undo','Redo','-','Cut','Copy','Paste','Find','Replace','-','Outdent','Indent','-','Print'],
            '/',
            ['NumberedList','BulletedList','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
            ['Table','-','Link','Smiley','TextColor','BGColor']
        ] ;

        CKEDITOR.config.contentsLangDirection = 'rtl';

        CKEDITOR.replace('text' ,{
            filebrowserUploadUrl : '/admin/panel/upload-image',
            filebrowserImageUploadUrl :  '/admin/panel/upload-image'
        });
        $(document).ready(function() {
            $('#categories').select2();
        });
        $(document).ready(function() {
            $('#tags').select2();
        });
    </script>
    <script>
        function deactive(name) {

            document.getElementById(name).style.display = "none";
        }
    </script>
    <script>

    </script>
@endsection
