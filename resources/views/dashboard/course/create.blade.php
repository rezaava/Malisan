@extends('dashboard.layout.app')
@if(isset($course))
    @section('title','صفحه ویرایش درس')
@else
    @section('title','صفحه ایجاد درس')
@endif
@section('content')
    <div class="col-sm-12">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-6">
                        @if(isset($course))
                            <h3>ویرایش درس</h3>
                        @else
                            <h3>ایجاد درس</h3>

                        @endif
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
                            <li class="breadcrumb-item">درس</li>
                            @if(isset($course))
                                <li class="breadcrumb-item">ویرایش درس</li>
                            @else
                                <li class="breadcrumb-item">ایجاد درس</li>
                            @endif
                        </ol>
                    </div>
                    <div class="col-lg-6">
                        <!-- Bookmark Start-->
                        <div class="bookmark pull-right">
                            <ul>
                                <li><a href="/dashboard/courses/list" data-container="body" data-toggle="popover" data-placement="top" title="" data-original-title="بازگشت"><img src="{{asset('/cuba-style/assets/images/arrow-left.svg')}}"></a></li>

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
                            @if(isset($course))
                                <h5>ویرایش درس</h5>
                            @else
                                <h5>ایجاد درس</h5>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <form method="post"
                                          action="@if(isset($course)){{'/dashboard/courses/edit/'.$course->id}}@else{{'/dashboard/courses/create'}}@endif"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group m-form__group @if ($errors->has('name')) has-error @endif">
                                            <label>عنوان درس</label>
                                            <div class="input-group mb-3">
                                                <input class="form-control" type="text" placeholder="عنوان درس"
                                                       value="@if(isset($course)){{$course->name}}@endif" name="name">
                                            </div>
                                            <span class="text-danger" id="name"
                                                  style="color: red;">{{$errors->first('name')}}</span>

                                        </div>
                                        <div class="form-group m-form__group @if ($errors->has('max_session')) has-error @endif">
                                            <label>پیشبینی شما برای حداکثر جلسات</label>
                                            <div class="input-group mb-3">
                                                <input class="form-control" type="text" placeholder="حداکثر جلسات"
                                                       value="@if(isset($course)){{$course->max_session}}@endif" name="max_session">
                                            </div>
                                            <span class="text-danger" id="name"
                                                  style="color: red;">{{$errors->first('max_session')}}</span>

                                        </div>
                                        {{--<div class="form-group m-form__group @if ($errors->has('code')) has-error @endif">--}}
                                            {{--<label>کد درس</label>--}}
                                            {{--<div class="input-group mb-3">--}}
                                                {{--<input class="form-control" type="text" placeholder="کد درس"--}}
                                                       {{--value="@if(isset($course)){{$course->code}}@endif" name="code">--}}
                                            {{--</div>--}}
                                            {{--<span class="text-danger" id="code"--}}
                                                  {{--style="color: red;">{{$errors->first('code')}}</span>--}}

                                        {{--</div>--}}



                                        <div class="card-footer">
                                            <button class="btn btn-primary" type="submit">
                                                @if(isset($course))
                                                    بروزرسانی
                                                @else
                                                    ایجاد درس
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
    <script src="{{asset('assets/ckeditor/ckeditor.js')}}"></script>
    <script>
        CKEDITOR.replace('description', {
            filebrowserUploadUrl: '/admin/panel/upload-image',
            filebrowserImageUploadUrl: '/admin/panel/upload-image'
        });
    </script>
    <script>
        CKEDITOR.replace('text', {
            filebrowserUploadUrl: '/admin/panel/upload-image',
            filebrowserImageUploadUrl: '/admin/panel/upload-image'
        });
    </script>
@endpush
