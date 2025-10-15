@extends('dashboard2.layout.app')

@section('start')

@endsection
@section('main')

    <div id="content" class="main-content">

        @include('dashboard.layout.message')

        <div class="layout-px-spacing" style="margin-bottom: -300px">


            <div class="row">
                <div class="col-sm-12">
                    @if(Laratrust::hasRole('teacher'))
                        <div class="col-md-12">
                            <div class="row">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <form method="post"
                                                  action={{"/dashboard/exercise/edit?exer=".$exer->id}}
                                                          enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group @if ($errors->has('question')) has-error @endif">
                                                    <div class="row">
                                                        <label>طرح سوال یا مساله به عنوان تکلیف برای دانشجو<span
                                                                    style="color: red"> (در صورتیکه بیش از یک تکلیف میخواهید به دانشجو بدهید هر تکلیف را به صورت جداگانه ثبت کنید)</span></label>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <div class="col-lg-12">
                                            <textarea class="form-control btn-square editor" name="exercise"
                                                      minlength="5"
                                                      required
                                                      id="description0">{{$exer->text}}</textarea>

                                                        </div>
                                                    </div>

                                                    <span class="text-danger" id="description"
                                                          style="color: red;">{{$errors->first('$question')}}</span>
                                                </div>

                                                <div class="form-group input-group-square ">
                                                    <label>فایل</label>
                                                    <div class="input-group mb-3">
                                                        <input class="form-control" type="file" name="file"
                                                               placeholder="فایل">

                                                    </div>
                                                    <span class="text-danger" id="file"
                                                          style="color: red;">{{$errors->first('file')}}</span>
                                                </div>


                                                <div class="card-footer">
                                                    <button class="btn btn-primary" type="submit"
                                                            onclick="this.style.display = 'none'"
                                                    >
                                                        ویرایش تکلیف
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endif


                </div>
            </div>

        </div>
        {{--@include('dashboard2.layout.footer')--}}

    </div>


@endsection

@section('end')
    <script src="{{asset('/cuba-style/assets/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('/cuba-style/assets/js/select2/select2.full.min.js')}}"></script>
    <script>
        var allEditors = document.querySelectorAll('.editor');
        for (var i = 0; i < allEditors.length; i++) {
            // ClassicEditor.create(allEditors[i]);
            CKEDITOR.replace('description' + i
                // , {
                // filebrowserUploadUrl: '/admin/panel/upload-image',
                // filebrowserImageUploadUrl: '/admin/panel/upload-image'
                // }
            );
            CKEDITOR.config.toolbar = [
                ['Styles', 'Format', 'Font', 'FontSize'],
                '/',
                ['Bold', 'Italic', 'Underline', 'StrikeThrough', '-', 'Undo', 'Redo', '-', 'Cut', 'Copy', 'Paste', 'Find', 'Replace', '-', 'Outdent', 'Indent', '-', 'Print'],
                '/',
                ['NumberedList', 'BulletedList', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
                ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language'],
                ['Table', '-', 'Link', 'Smiley', 'TextColor', 'BGColor']
            ];
            CKEDITOR.config.contentsLangDirection = 'rtl';

            // CKEDITOR.replace('text', {
            //     filebrowserUploadUrl: '/admin/panel/upload-image',
            //     filebrowserImageUploadUrl: '/admin/panel/upload-image'
            // });
            $(document).ready(function () {
                $('#categories').select2();
            });
            $(document).ready(function () {
                $('#tags').select2();
            });
        }
    </script>
@endsection
