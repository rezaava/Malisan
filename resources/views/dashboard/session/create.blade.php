@extends('dashboard.layout.app')
@if(isset($meeting))
@section('title','صفحه ویرایش جلسه')
@else
@section('title','صفحه ایجاد جلسه')
@endif
@push('css')
    <link rel="stylesheet" href="{{asset('/cuba-style/assets/css/select2.css')}}" />

@endpush
@section('content')
    <div class="col-sm-12">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-6">
                         @if(isset($meeting))
                            <h3>ویرایش جلسه</h3>
                        @else
                            <h3>ایجاد جلسه</h3>

                        @endif
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
                            <li class="breadcrumb-item">جلسه</li>
                           @if(isset($meeting))
                            <li class="breadcrumb-item">ویرایش جلسه</li>
                            @else
                             <li class="breadcrumb-item">ایجاد جلسه</li>
                             @endif
                        </ol>
                    </div>
                    <div class="col-lg-6">
                        <!-- Bookmark Start-->
                        <div class="bookmark pull-right">
                            <ul>
                                <div class="bookmark pull-right">
                                    <ul>
                                        <li><a href="{{ url()->previous()}}" data-container="body" data-toggle="popover" data-placement="top" title="" data-original-title="بازگشت"><img src="{{asset('/cuba-style/assets/images/arrow-left.svg')}}"></a></li>

                                    </ul>
                                </div>
                            </ul>
                        </div>
                        <!-- Bookmark Ends-->
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                           @if(isset($meeting))
                                <h5>ویرایش جلسه</h5>
                            @else
                                <h5>ایجاد جلسه</h5>
                            @endif
                        </div>
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
                                                <input class="form-control" name="number" type="number"  required value="@if(isset($meeting)){{$meeting->number}}@endif" placeholder="شماره جلسه">
                                            </div>
                                             <span class="text-danger" id="title"
                                                  style="color: red;">{{$errors->first('number')}}</span>
                                        </div>
                                       <div class="form-group m-form__group @if ($errors->has('name')) has-error @endif">
                                            <label>نام جلسه</label>
                                            <div class="input-group mb-3">
                                                <input class="form-control" name="name" type="text"  required value="@if(isset($meeting)){{$meeting->name}}@endif" placeholder="نام جلسه">
                                            </div>
                                             <span class="text-danger" id="title"
                                                  style="color: red;">{{$errors->first('name')}}</span>
                                        </div>

                                        <div class="form-group @if ($errors->has('text')) has-error @endif">
                                            <label>محتوای درس (اختیاری )</label>
                                            <div class="input-group mb-3">
                                                <div class="col-lg-12">
                                                    <textarea class="form-control btn-square" name="text" id="description">@if(isset($meeting)){{$meeting->text}}@endif</textarea>
                                                </div>
                                            </div>
                                             <span class="text-danger" id="description"
                                                  style="color: red;">{{$errors->first('$session')}}</span>
                                        </div>


                                       <div class="form-group input-group-square @if ($errors->has('file')) has-error @endif">
                                            <label>بارگذاری فایل پیوست (اختیاری)</label>
                                            <div class="input-group mb-3">
                                                <input class="form-control" type="file" name="file" placeholder="فایل" >
                                                @if(isset($meeting))
                                                <label>این جلسه دارای پیوست نیز می باشد</label>
                                                @endif
                                            </div>
                                             <span class="text-danger" id="file"
                                                  style="color: red;">{{$errors->first('file')}}</span>
                                        </div>

                                          <div class="card-footer">
                                            <button class="btn btn-primary" type="submit" id="upload_btn" onclick="deactive('upload_btn')">
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
        <!-- Container-fluid Ends-->
    </div>
@endsection

@push('scripts')
    <script src="{{asset('/cuba-style/assets/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('/cuba-style/assets/js/select2/select2.full.min.js')}}"></script>
    <script>
        CKEDITOR.replace('description' ,{
            filebrowserUploadUrl : '/admin/panel/upload-image',
            filebrowserImageUploadUrl :  '/admin/panel/upload-image'
        });

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
@endpush
