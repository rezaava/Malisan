@extends('dashboard2.layout.app')

@section('start')

    <link href="{{("/style/assets/css/scrollspyNav.css")}}" rel="stylesheet" type="text/css"/>

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
        {{--<li class="breadcrumb-item active" aria-current="page"><span>ایجاد جلسه</span></li>--}}
        {{--</ol>--}}
        {{--</nav>--}}


        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}

        {{--<div class="container">--}}


        <div class="row">


            <div class="col-lg-12 col-12  layout-spacing">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            {{--<div class="card-header">--}}
                            {{--@if(isset($meeting))--}}
                            {{--<h5>ویرایش جلسه</h5>--}}
                            {{--@else--}}
                            {{--<h5>ایجاد جلسه</h5>--}}
                            {{--@endif--}}
                            {{--</div>--}}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <form method="post"
                                              action="@if(isset($meeting)){{route('session.edit',$meeting->id)}}@else{{route('session.create', ["course_id" => $course->id])}}@endif"

                                              enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group m-form__group @if ($errors->has('number')) has-error @endif">
                                                <label>شماره جلسه</label>
                                                <div class="input-group mb-3">
                                                    <input class="form-control" name="number" type="number" required
                                                           value="@if(isset($meeting)){{$meeting->number}}@else{{$session}}@endif"
                                                           placeholder="شماره جلسه">
                                                </div>
                                                <span class="text-danger" id="title"
                                                      style="color: red;">{{$errors->first('number')}}</span>
                                            </div>
                                            <div class="form-group m-form__group @if ($errors->has('name')) has-error @endif">
                                                <label>نام جلسه</label>
                                                <div class="input-group mb-3">
                                                    <input class="form-control" id="name" name="name" type="text"
                                                           required value="@if(isset($meeting)){{$meeting->name}}@endif"
                                                           placeholder="نام جلسه">
                                                </div>
                                                <span class="text-danger" id="title"
                                                      style="color: red;">{{$errors->first('name')}}</span>
                                            </div>
                                            <div class="form-group m-form__group @if ($errors->has('link')) has-error @endif">
                                                <label>لینک(اختیاری)</label>
                                                <div class="input-group mb-3">
                                                    <input class="form-control" name="link" type="text"
                                                           value="@if(isset($meeting)){{$meeting->link}}@endif"
                                                           placeholder="link">
                                                </div>
                                                <span class="text-danger" id="title"
                                                      style="color: red;">{{$errors->first('link')}}</span>
                                            </div>
                                            <div class="form-group m-form__group @if ($errors->has('majazi')) has-error @endif">
                                                <label>لینک کلاس مجازی(اختیاری)</label>
                                                <div class="input-group mb-3">
                                                    <input class="form-control" name="majazi" type="text"
                                                           value="@if(isset($meeting)){{$meeting->majazi}}@endif"
                                                           placeholder="لینک کلاس مجازی">
                                                </div>
                                                <span class="text-danger" id="title"
                                                      style="color: red;">{{$errors->first('link')}}</span>
                                            </div>

                                            <div class="form-group @if ($errors->has('text')) has-error @endif">
                                                <label>محتوای درس (اختیاری )</label>
                                                <div class="input-group mb-3">
                                                    <div class="col-lg-12">
                                                        <textarea class="form-control btn-square" name="text"
                                                                  id="description">@if(isset($meeting)){{$meeting->text}}@endif</textarea>
                                                    </div>
                                                </div>
                                                <span class="text-danger" id="description"
                                                      style="color: red;">{{$errors->first('$session')}}</span>
                                            </div>


                                            <div class="form-group input-group-square @if ($errors->has('file')) has-error @endif">
                                                <label>بارگذاری فایل پیوست pdf (اختیاری)</label>
                                                <div class="input-group mb-3">
                                                    <input class="form-control" type="file" name="file"
                                                           placeholder="فایل">
                                                </div>
                                                @if(isset($meeting))
                                                    @if(($meeting->file))
                                                        <div class="input-group mb-3">
                                                            <label style="color: red;">این جلسه دارای پیوست نیز می
                                                                باشد</label>
                                                        </div>
                                                    @endif
                                                @endif
                                                <span class="text-danger" id="file"
                                                      style="color: red;">{{$errors->first('file')}}</span>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="form-check">
                                                        <input type="checkbox" name="active"

                                                               @if(!isset($meeting))
                                                               checked
                                                               @elseif($meeting->active=='1') checked

                                                               @endif

                                                               class="form-check-input"
                                                               id="exampleCheck1">
                                                        <label for="exampleCheck1">محتوای جلسه به دانشجو نمایش داده
                                                            شود</label>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card-footer">
                                                <button class="btn btn-primary"
                                                        {{--onclick="this.style.display = 'none'"--}}
                                                        type="submit" id="upload_btn"
                                                        onclick="
                                                                if((document.getElementById('name').value!='')) this.style.display = 'none'
// alert(document.getElementById('name').value)
">
                                                    @if(isset($meeting))
                                                        بروزرسانی
                                                    @else
                                                        ارسال
                                                    @endif
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

        {{--</div>--}}

        @include('dashboard2.layout.footer')


    </div>


@endsection

@section('end')

    <script src="{{("/style/assets/js/scrollspyNav.js")}}"></script>


    <script src="{{asset('/cuba-style/assets/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('/cuba-style/assets/js/select2/select2.full.min.js')}}"></script>
    <script>
        CKEDITOR.replace('description', {
            filebrowserUploadUrl: '/admin/panel/upload-image',
            filebrowserImageUploadUrl: '/admin/panel/upload-image'
        });
        CKEDITOR.config.toolbar = [
            ['Styles', 'Format', 'Font', 'FontSize'],
            '/',
            ['Bold', 'Italic', 'Underline', 'StrikeThrough', '-', 'Undo', 'Redo', '-', 'Cut', 'Copy', 'Paste', 'Find', 'Replace', '-', 'Outdent', 'Indent', '-', 'Print'],
            '/',
            ['NumberedList', 'BulletedList', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
            ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language'],
            ['Table', '-', 'Link', 'Smiley', 'TextColor', 'BGColor']
        ];
        // CKEDITOR.config.setDirectionMarker('rtl');
        CKEDITOR.config.contentsLangDirection = 'rtl';

        CKEDITOR.replace('text', {
            filebrowserUploadUrl: '/admin/panel/upload-image',
            filebrowserImageUploadUrl: '/admin/panel/upload-image'
        });

        $(document).ready(function () {
            $('#categories').select2();
        });
        $(document).ready(function () {
            $('#tags').select2();
        });
    </script>
@endsection
