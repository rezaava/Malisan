@extends('management.layout.master')
@section('styles')
@endsection
@section('title', 'تکلیف')
@section('main-content')
    <div class="row">
        <div class="col s12">
            <div class="row">
                <div class="container-fluid">
                    <div class="page-header">
                    </div>
                </div>
                {{-- @if (isset($meeting->file)) --}}

                @foreach ($questions as $key => $question)

                    <div class="card col s12">
                        <div class="card-header">
                            <div class="row">

                                <h5>{{ $question->exercise }}</h5>

                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col s12">
                                        <form method="post" action="{{ route('exercise.answer') }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input hidden name="exercise_id" value={{ $question->id }}>
                                            <div class="form-group @if ($errors->has('text')) has-error @endif">

                                                <h6>{!! $question->text !!}</h6>

                                                @if (isset($question->file))

                                                    <a class="btn btn-primary"
                                                        href="{{ URL::to('/files/exer' . $question->file) }}"
                                                        target="_blank">
                                                        <h6>دانلود فایل پیوست <img class="img-fluid"
                                                                src="{{ asset('/files/icons/attach.png') }}" alt=""
                                                                style="height: 30px"></h6>
                                                    </a>
                                                @endif
                                                @if (Laratrust::hasRole('teacher'))
                                                    <a class="btn btn-success"
                                                        href="{{ '/dashboard/exercise/edit?ex=' . $question->id }}">
                                                        ویرایش
                                                    </a>
                                                    <a class="btn btn-danger"
                                                        href="{{ '/dashboard/exercise/delete?ex=' . $question->id }}">
                                                        حذف
                                                    </a>
                                                @endif
                                                @if (Laratrust::hasRole('student'))
                                                    <label>پاسخ</label>
                                                    <div class="input-group mb-3">
                                                        <div class="col-lg-12">
                                                            <textarea class="form-control btn-square editor" name="text"
                                                                id="description{{ $key }}"
                                                                id="ans">@if (isset($question->answer)){{ $question->answer->answer }}@endif</textarea>

                                                            {{-- <textarea class="form-control btn-square" name="text" --}}
                                                            {{-- id="description">@if ($question->answer){{$question->answer->answer}}@endif</textarea> --}}
                                                        </div>
                                                    </div>
                                                    <span class="text-danger" id="ans"
                                                        style="color: red;">{{ $errors->first('$session') }}</span>
                                                    <div class="form-group input-group-square ">
                                                        <label>فایل</label>
                                                        <div class="input-group mb-3">
                                                            <input class="form-control" type="file" name="file"
                                                                placeholder="فایل">

                                                        </div>
                                                        <span class="text-danger" id="file"
                                                            style="color: red;">{{ $errors->first('file') }}</span>
                                                    </div>
                                                @endif
                                                @if ($question->answer)
                                                    @if ($question->answer->file)
                                                        <a class="mb-6 btn waves-effect waves-light gradient-45deg-amber-amber gradient-shadow"
                                                            href="{{ URL::to('/files/answer' . $question->answer->file) }}"
                                                            target="_blank">
                                                            دانلود
                                                        </a>
                                                    @endif
                                                @endif
                                            </div>


                                            {{-- <div class="form-group input-group-square @if ($errors->has('file')) has-error @endif"> --}}
                                            {{-- <label>فایل</label> --}}
                                            {{-- <div class="input-group mb-3"> --}}
                                            {{-- <input class="form-control" type="file" name="file" placeholder="فایل" > --}}
                                            {{-- @if ($question->file) --}}
                                            {{-- <label>فایل پیوست وجود داشته است</label> --}}
                                            {{-- @endif --}}
                                            {{-- </div> --}}
                                            {{-- <span class="text-danger" id="file" --}}
                                            {{-- style="color: red;">{{$errors->first('file')}}</span> --}}
                                            {{-- </div> --}}
                                            @if (Laratrust::hasRole('student'))
                                                @if ($question->answer)
                                                    @if (!$question->answer->status)
                                                        <div class="card-footer">
                                                            <button
                                                                class="mb-6 btn waves-effect waves-light gradient-45deg-amber-amber gradient-shadow"
                                                                type="submit" onclick="this.style.display = 'none'">
                                                                بروزرسانی
                                                            </button>
                                                        </div>
                                                    @endif
                                                @endif
                                                @if (!$question->answer)
                                                    <div class="card-footer">
                                                        <button
                                                            class="mb-6 btn waves-effect waves-light gradient-45deg-green-teal gradient-shadow"
                                                            type="submit" onclick="this.style.display = 'none'">
                                                            ارسال
                                                        </button>
                                                    </div>
                                                @endif
                                            @endif
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            @if (Laratrust::hasRole('teacher'))
                <div class="col-md-12">
                    <div class="row">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <form method="post"
                                        action={{ '/dashboard/exercise/create?session_id=' . $meeting->id }}
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group @if ($errors->has('question')) has-error @endif">
                                            <div class="row">
                                                <label>طرح سوال یا مساله به عنوان تکلیف برای دانشجو<span style="color: red">
                                                        (در صورتیکه بیش از یک تکلیف میخواهید به
                                                        دانشجو بدهید هر تکلیف را به صورت جداگانه ثبت
                                                        کنید)</span></label>
                                            </div>
                                            <div class="input-group mb-3">
                                                <div class="col-lg-12">
                                                    <textarea class="form-control btn-square editor" name="exercise"
                                                        minlength="5" required
                                                        id="description0">@if (isset($question)){{ $question->exercise }}@endif</textarea>

                                                </div>
                                            </div>

                                            <span class="text-danger" id="description"
                                                style="color: red;">{{ $errors->first('$question') }}</span>
                                        </div>

                                        <div class="form-group input-group-square ">
                                            <label>فایل</label>
                                            <div class="input-group mb-3">
                                                <input class="form-control" type="file" name="file" placeholder="فایل">

                                            </div>
                                            <span class="text-danger" id="file"
                                                style="color: red;">{{ $errors->first('file') }}</span>
                                        </div>


                                        <div class="card-footer">
                                            <button class="btn btn-primary" type="submit"
                                                onclick="this.style.display = 'none'">
                                                ثبت تکلیف
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
@endsection
@section('js')
    <script src="{{ asset('/cuba-style/assets/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('/cuba-style/assets/js/select2/select2.full.min.js') }}"></script>
    <script>
        var allEditors = document.querySelectorAll('.editor');
        for (var i = 0; i < allEditors.length; i++) {
            // ClassicEditor.create(allEditors[i]);
            CKEDITOR.replace('description' + i
                , {
                filebrowserUploadUrl: '/admin/panel/upload-image',
                filebrowserImageUploadUrl: '/admin/panel/upload-image'
                }
            );
            CKEDITOR.config.toolbar = [
                ['Styles', 'Format', 'Font', 'FontSize','UploadImage'],
                '/',
                ['Bold', 'Italic', 'Underline', 'StrikeThrough', '-', 'Undo', 'Redo', '-', 'Cut', 'Copy', 'Paste',
                    'Find', 'Replace', '-', 'Outdent', 'Indent', '-', 'Print'
                ],
                '/',
                ['NumberedList', 'BulletedList', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
                ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-',
                    'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl',
                    'Language'
                ],
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
        }
    </script>
@endsection
