@extends('management.layout.master')
@section('add-styles')
<script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>

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
                                  method="post" enctype="multipart/form-data"
{{--                                  onkeypress="return event.keyCode != 13;"--}}
                            >
                                @csrf
                                @if(isset($meeting))
                                <div class="row" style="text-align: center">
                                    <h5>محتوای جلسه {{$meeting->number}}</h5>
                                </div>
                                @else
                                <div class="row" style="text-align: center">
                                    <h5>محتوای جلسه{{$session}}</h5>
                                </div>
                                @endif
                                <div class="row">
                                    <div class="input-field" hidden>
                                        <i class="material-icons dp48 prefix">format_list_numbered</i>
                                        <input readonly name="number" id="number" type="number" required
                                               class="validate"
                                               value="@if(isset($meeting)){{$meeting->number}}@else{{$session}}@endif">
                                        <label class="contact-input" for="number">شماره جلسه</label>
                                    </div>
                                    <div class="input-field col s12">
                                        <i class="material-icons dp48 prefix">short_text</i>
                                        <input id="name" name="name" type="text" required class="validate"
                                               value="@if(isset($meeting)){{$meeting->name}}@endif">
                                        <label class="contact-input" for="name">عنوان (موضوع درس در جلسه جاری)</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <i class="material-icons dp48 prefix">insert_link</i>
                                        <input id="link" name="link" type="text" class="validate"
                                               value="@if(isset($meeting)){{$meeting->link}}@endif">
                                        <label class="contact-input" for="link">
                                            لینک درس اگر در جای دیگر بارگذاری شده است (اختیاری)
                                        </label>
                                    </div>
                                    <div class="input-field col s6">
                                        <i class="material-icons dp48 prefix">phonelink</i>
                                        <input id="majazi" name="majazi" type="text" class="validate"
                                               value="@if(isset($meeting)){{$meeting->majazi}}@endif">
                                        <label class="contact-input" for="majazi">
                                            لینک فیلم ضبط شده کلاس(اختیاری)
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
                                                            <h4 class="card-title">
                                                                 طرح درس یا محتوای درس (اختیاری)
                                                            </h4>
                                                            <textarea name="text" id="editor">@if(isset($meeting)){!!$meeting->text!!}@endif</textarea>
                      <!--                                      <div class="row">-->
                      <!--                                          <div class="col s12">-->
                      <!--                                              <div id="snow-wrapper">-->
                      <!--                                                  <div id="snow-container">-->
                      <!--                                                      <div class="quill-toolbar">-->
                      <!--                                          <span class="ql-formats">-->
                      <!--  <select class="ql-header browser-default iransans">-->
                      <!--    <option value="1">سرفصل</option>-->
                      <!--    <option value="2">زیر عنوان</option>-->
                      <!--    <option selected>معمولی</option>-->
                      <!--  </select>-->
                      <!--  <select class="ql-font browser-default">-->
                      <!--    <option selected>Sailec Light</option>-->
                      <!--    <option value="sofia">Sofia Pro</option>-->
                      <!--    <option value="slabo">Slabo 27px</option>-->
                      <!--    <option value="roboto">Roboto Slab</option>-->
                      <!--    <option value="inconsolata">Inconsolata</option>-->
                      <!--    <option value="ubuntu">Ubuntu Mono</option>-->
                      <!--  </select>-->
                      <!--</span>-->
                      <!--                                                          <span class="ql-formats">-->
                      <!--  <button class="ql-bold"></button>-->
                      <!--  <button class="ql-italic"></button>-->
                      <!--  <button class="ql-underline"></button>-->
                      <!--</span>-->
                      <!--                                                          <span class="ql-formats">-->
                      <!--  <button class="ql-list" value="ordered"></button>-->
                      <!--  <button class="ql-list" value="bullet"></button>-->
                      <!--</span>-->
                      <!--                                                          <span class="ql-formats">-->
                      <!--  <button class="ql-link"></button>-->
                      <!--  <button class="ql-image"></button>-->
                      <!--  <button class="ql-video"></button>-->
                      <!--</span>-->
                      <!--                                                          <span class="ql-formats">-->
                      <!--  <button class="ql-formula"></button>-->
                      <!--  <button class="ql-code-block"></button>-->
                      <!--</span>-->
                      <!--                                                          <span class="ql-formats">-->
                      <!--  <button class="ql-clean"></button>-->
                      <!--</span>-->
                      <!--                                                      </div>-->
                      <!--                                                      <textarea class="editor" id="editor" name="text" >@if(isset($meeting)){{$meeting->text}}@endif</textarea>-->
                      <!--                                                  </div>-->
                      <!--                                              </div>-->
                      <!--                                          </div>-->
                      <!--                                      </div>-->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                                <!--@if(isset($meeting))-->
                                <!--<div class="row">-->
                                <!--        <h5>طرح درس قبل</h5>-->
                                <!--        <p>-->
                                <!--            {{$meeting->text}}-->
                                <!--        </p>-->
                                <!--    </div>-->
                                <!--    <hr>-->
                                <!--    @endif-->
                                    <div class="row">

                                    @if(isset($meeting))
                                        @if(($meeting->file))
                                            <div class="input-group mb-3">
                                                <label style="color: red;">
                                                    جلسه حاوی پیوست است
                                                    <a href="/dashboard/courses/sessions/delete-item?session_id={{ $meeting->id }}"
                   class="mb-6 btn-floating waves-effect waves-light gradient-45deg-light-blue-cyan gradient-shadow tooltipped"
                   data-position="bottom" data-tooltip="حذف">
                    <i class="material-icons dp48">clear</i>
                    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg> --}}
                    <i data-feather="trash"></i>


                </a>

                <a  href="{{ URL::to('/files/session' . $meeting->file) }}"
                   class="mb-6 btn-floating waves-effect waves-light gradient-45deg-amber-amber gradient-shadow tooltipped"
                   data-position="top" data-tooltip="مشاهده">
                    <i class="material-icons dp48">remove_red_eye</i>
                    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg> --}}
                    <i data-feather="share-2"></i>


                </a>
                                                </label>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                                @if(!isset($meeting) || !($meeting->file))


                                    <div id="file-upload" class="section">
                                    <!--Default version-->
                                    <div class="row section justify-content-center">
                                        <div class="col s12 m4 l3">
                                            <p>
                                                بارگذاری محتوای درس(اختیاری)
                                            </p>
                                        </div>
                                        <div class="col s12 m8 l9">
                                            <input type="file" id="input-file-now" class="dropify" name="file"
                                                   data-default-file="">
                                                    <!--@if(isset($meeting))-->
                                                    <!--    value="{!! $meeting->text !!}"-->
                                                    <!--@endif-->
                                                            
                                        </div>
                                    </div>
                                </div>
                                    @endif

                                <div class="row mt-1 mb-1">
                                    <div class="input-field col s6">
                                        <label>
                                            <input type="checkbox" @if(!isset($meeting))
                                            checked
                                                   @elseif($meeting->active=='1')
                                                    checked

                                                   @endif name="active" id="active">
                                            <span>درس به دانشجو نشان داده شود؟</span>
                                        </label>
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
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>


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
            theme: 'snow',
            
        });



    </script>
@endsection
