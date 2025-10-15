@extends('management.layout.master')
@section('add-styles')

    <!--<link href="{{ '/style/assets/css/scrollspyNav.css' }}" rel="stylesheet" type="text/css" />-->
    <link rel="stylesheet" href="{{ '/style/plugins/editors/markdown/simplemde.min.css' }}">
    <link rel="stylesheet" href="{{ asset('/cuba-style/assets/css/select2.css') }}" />
@endsection
@section('title', 'خلاصه درس')
@section('main-content')
    <div class="row">
        <form method="post" action={{ '/dashboard/discussion/create?session_id=' . $session->id }}
            enctype="multipart/form-data">
            @csrf
            <div class="form-group @if ($errors->has('text')) has-error @endif">
                <label>خلاصه</label>
                <div class="input-group mb-3">
                    <div class="col-lg-12">
                        <textarea class="form-control btn-square" name="text" id="description"
                            maxlength="350">@if ($discussion){!! $discussion->text !!}@endif</textarea>
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
@endsection
@section('js')
    <script src="{{ asset('/cuba-style/assets/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('/cuba-style/assets/js/select2/select2.full.min.js') }}"></script>
    <script>
        CKEDITOR.replace('description', {
            filebrowserUploadUrl: '/admin/panel/upload-image',
            filebrowserImageUploadUrl: '/admin/panel/upload-image'
        });

        CKEDITOR.config.toolbar = [
            ['Styles', 'Format', 'Font', 'FontSize'],
            '/',
            ['Bold', 'Italic', 'Underline', 'StrikeThrough', '-', 'Undo', 'Redo', '-', 'Cut', 'Copy', 'Paste', 'Find',
                'Replace', '-', 'Outdent', 'Indent', '-', 'Print'
            ],
            '/',
            ['NumberedList', 'BulletedList', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
            ['Table', '-', 'Link', 'Smiley', 'TextColor', 'BGColor']
        ];

        CKEDITOR.config.contentsLangDirection = 'rtl';

        CKEDITOR.replace('text', {
            filebrowserUploadUrl: '/admin/panel/upload-image',
            filebrowserImageUploadUrl: '/admin/panel/upload-image'
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
@endsection
