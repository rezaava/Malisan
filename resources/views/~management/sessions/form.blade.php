@extends('management.layout.master')
@section('add-styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/quill/quill.snow.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/quill/quill.bubble.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/dropify/css/dropify.min.css') }}">
@endsection
@section('title' , 'ویرایش جلسه')
@section('main-content')
    <div class="row">
        <div class="col s12">
            <div id="icon-prefixes" class="card card-tabs">
                <div class="card-content">
                    <div id="view-icon-prefixes" class="active">
                        <div class="row">
                            <form class="col s12"
                                  action="@if(isset($meeting)){{route('session.edit',$meeting->id)}}@else{{route('session.create', ["course_id" => $course->id])}}@endif"
                                  method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="input-field col s6">
                                        <i class="material-icons dp48 prefix">format_list_numbered</i>
                                        <input name="number" id="number" type="number" required class="validate"
                                               value="@if(isset($meeting)){{$meeting->number}}@else{{$session}}@endif">
                                        <label class="contact-input" for="number">جلسه شماره چنده؟</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <i class="material-icons dp48 prefix">short_text</i>
                                        <input id="name" name="name" type="text" required class="validate"
                                               value="@if(isset($meeting)){{$meeting->name}}@endif">
                                        <label class="contact-input" for="name">عنوان جلسه رو چی بذارم؟</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <i class="material-icons dp48 prefix">insert_link</i>
                                        <input id="link" name="link" type="text" class="validate"
                                               value="@if(isset($meeting)){{$meeting->link}}@endif">
                                        <label class="contact-input" for="link">لینک اختیاریه اگه هست چی باشه؟</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <i class="material-icons dp48 prefix">phonelink</i>
                                        <input id="majazi" name="majazi" type="text" class="validate"
                                               value="@if(isset($meeting)){{$meeting->majazi}}@endif">
                                        <label class="contact-input" for="majazi">لینک کلاس مجازی هم اختیاریه اگه هست چی
                                            باشه؟</label>
                                    </div>
                                </div>
                                <div class="row mt-1 mb-1">
                                    <div class="input-field col s6">
                                        <label>
                                            <input type="checkbox" @if(!isset($meeting))
                                            checked
                                                   @elseif($meeting->active=='1') checked

                                                   @endif name="active" id="active">
                                            <span>محتوا درس رو به دانشجو نشون بدم؟</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <section class="snow-editor">
                                            <div class="row">
                                                <div class="col s12">
                                                    <div class="card">
                                                        <div class="card-content">
                                                            <h4 class="card-title">محتوا درس اختیاریه اگه هست اینجا
                                                                بنویس</h4>
                                                            <div class="row">
                                                                <div class="col s12">
                                                                    <div id="snow-wrapper">
                                                                        <div id="snow-container">
                                                                            <div class="quill-toolbar">
                                                                <span class="ql-formats">
                        <select class="ql-header browser-default iransans">
                          <option value="1">سرفصل</option>
                          <option value="2">زیر عنوان</option>
                          <option selected>معمولی</option>
                        </select>
                        <select class="ql-font browser-default">
                          <option selected>Sailec Light</option>
                          <option value="sofia">Sofia Pro</option>
                          <option value="slabo">Slabo 27px</option>
                          <option value="roboto">Roboto Slab</option>
                          <option value="inconsolata">Inconsolata</option>
                          <option value="ubuntu">Ubuntu Mono</option>
                        </select>
                      </span>
                                                                                <span class="ql-formats">
                        <button class="ql-bold"></button>
                        <button class="ql-italic"></button>
                        <button class="ql-underline"></button>
                      </span>
                                                                                <span class="ql-formats">
                        <button class="ql-list" value="ordered"></button>
                        <button class="ql-list" value="bullet"></button>
                      </span>
                                                                                <span class="ql-formats">
                        <button class="ql-link"></button>
                        <button class="ql-image"></button>
                        <button class="ql-video"></button>
                      </span>
                                                                                <span class="ql-formats">
                        <button class="ql-formula"></button>
                        <button class="ql-code-block"></button>
                      </span>
                                                                                <span class="ql-formats">
                        <button class="ql-clean"></button>
                      </span>
                                                                            </div>
                                                                            <div class="editor">

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                                <div class="row">
                                    @if(isset($meeting))
                                        @if(($meeting->file))
                                            <div class="input-group mb-3">
                                                <label style="color: red;">این جلسه دارای پیوست نیز می
                                                    باشد</label>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                                <div id="file-upload" class="section">
                                    <!--Default version-->
                                    <div class="row section justify-content-center">
                                        <div class="col s12 m4 l3">
                                            <p>
                                                جلسه فایل پیوست داره ؟ ( PDF )
                                            </p>
                                        </div>
                                        <div class="col s12 m8 l9">
                                            <input type="file" id="input-file-now" class="dropify" data-default-file="" />
                                        </div>
                                    </div>
                                </div>
                                <input type="submit"
                                       class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 float-right"
                                       value="ثبت اطلاعات">
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('app-assets/vendors/quill/katex.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/quill/highlight.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/quill/quill.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/form-editor.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('app-assets/js-rtl/scripts/form-file-uploads-rtl.min.js') }}"></script>
    <script>
        var quill = new Quill('#editor', {
            modules: {
                toolbar: '#toolbar'
            },
            theme: 'snow'
        });
    </script>
@endsection
