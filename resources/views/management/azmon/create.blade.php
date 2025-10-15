@extends('management.layout.master')

@section('add-styles')


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js" integrity="sha512-WNLxfP/8cVYL9sj8Jnp6et0BkubLP31jhTG9vhL/F5uEZmg5wEzKoXp1kJslzPQWwPT1eyMiSxlKCgzHLOTOTQ==" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://unpkg.com/persian-datepicker@latest/dist/css/persian-datepicker.css">
    <script src="https://unpkg.com/persian-date@latest/dist/persian-date.js"></script>
    <script src="https://unpkg.com/persian-datepicker@latest/dist/js/persian-datepicker.js"></script>


@endsection
@section('main-content')

    <div id="content" class="main-content">
        {{--<div class="container">--}}

        <div class="row layout-top-spacing">

            @include('dashboard.layout.message')

        </div>
        <div class="row">


            <div class="col-lg-12 col-12  layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>
                                    @if(isset($azmon))
                                        ویرایش آزمون
                                    @else
                                        ایجاد آزمون
                                    @endif
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        <form method="post"
                              action="@if(isset($azmon)){{'/dashboard/azmon/edit/'.$azmon->id}}@else{{'/dashboard/azmon/create'}}@endif"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="form-group ">
                                <input type="text" class="form-control" id="formGroupExampleInput"
                                       value="{{$course->id}}" name="id"
                                       required
                                       hidden
                                >
                            </div>
                            <div class="form-group ">
                                <label for="formGroupExampleInput">کد آزمون</label>
                                <input type="text" class="form-control" id="formGroupExampleInput" disabled
                                       value="@if(isset($azmon)){{$azmon->code}} @else {{$code}} @endif"
                                >
                            </div>

                            <div class="form-group " hidden>
                                <label for="formGroupExampleInput">کد آزمون</label>
                                <input type="text" class="form-control" id="formGroupExampleInput" hidden
                                       value="@if(isset($azmon)){{$azmon->code}} @else {{$code}} @endif" name="code"
                                       required
                                >
                            </div>

                            <div class="form-group ">
                                <label for="formGroupExampleInput">عنوان آزمون</label>
                                <input type="text" class="form-control" id="formGroupExampleInput"
                                       placeholder="مثال : ریاضی"
                                       value="@if(isset($azmon)){{$azmon->title}}@endif" name="title"
                                       required
                                >
                            </div>
                            <div class="form-group @if ($errors->has('text')) has-error @endif">
                                <label>توضیحات (اختیاری )</label>
                                <div class="input-group mb-3">
                                    <div class="col-lg-12">
                                                        <textarea class="form-control btn-square" name="description"
                                                                  id="description">@if(isset($azmon)){!! $azmon->description !!}@endif</textarea>
                                    </div>
                                </div>
                                <span class="text-danger" id="description"
                                      style="color: red;">{{$errors->first('$session')}}</span>
                            </div>

                            <div class="form-group">
                                <label>سطح سوالات</label>
                                <div class="input-group">
                                    <div class="form-check">
                                        <select class="" title="یک گزینه را انتخاب کنید" name="sath">
                                            <option selected value="3">عالی و خوب</option>
                                            <option @if(isset($azmon)) @if($azmon->sath==2) selected
                                                    @endif @endif value="2">خوب
                                            </option>
                                            <option @if(isset($azmon)) @if($azmon->sath==3) selected
                                                    @endif @endif value="1">عالی
                                            </option>
                                            <option @if(isset($azmon)) @if($azmon->sath==4) selected
                                                    @endif @endif value="4">سوالات ستاره دار شده
                                            </option>
                                            <option @if(isset($azmon)) @if($azmon->sath==5) selected
                                                    @endif @endif value="5">فقط سوالات استاد
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label>جلسات</label>

                                <div class="input-group">
                                    <div class="form-check">
                                        <select name="sessions[]" class="" multiple data-actions-box="true"
                                                required  selectOptions >

                                            @foreach($sessions as $session)
                                            
                                                <option value="{{$session->id}}" class="options"  
                                                
                                                        @if(isset($ss[$session->id])) selected @endif >{{$session->name}}</option>

                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label>تعداد سوالات</label>
                                <div class="input-group">
                                    <input
                                            required
                                            type="number"
                                            name="num"
                                            class="form-control rtl"
                                            @if(isset($azmon)) value="{{$azmon->num}}" @else value="10" @endif
                                    >
                                </div>
                            </div>


                            <div class="form-group">
                                <label>زمان بندی</label>
                            </div>
                             <div class="form-group">
                                <label>زمان امتحان به دقیقه</label>
                                <div class="input-group">
                                    <input
                                            required
                                            type="number"
                                            name="time"
                                            class="form-control rtl"
                                            @if(isset($azmon)) value="{{$azmon->time}}" @else value="60" @endif
                                    >
                                </div>
                            </div>
                            {{--//start--}}
                            <div class="form-group">

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">شروع(بصورت مثال 1402/01/01 21:50)</span>
                                    </div>
                                    <input
                                            placeholder="زمان شروع را مشخص کنید" name="start"
                                            {{--@if(!$edit) disabled @endif--}}
                                            class="normal-example form-control example1"
                                            pattern="1402/[0-9]{2}/[0-9]{2} [0-2]{1}[0-9]{1}:[0-5]{1}[0-9]{1}"
                                            value=@if(isset($azmon)) @if($azmon->start) {{$azmon->start}}  @endif @endif
                                    >
                                </div>
                                @if ($errors->any()&& $errors->first('birthdate'))
                                    <p class="mt-2 text-danger mr-1">{{$errors->first('birthdate')}}</p>
                            @endif
                            <!-- /.input group -->
                            </div>
                            {{--//end--}}
                            <div class="form-group">

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> 
                                        پایان(بصورت مثال 1402/01/01 21:50)
                                        </span>
                                    </div>
                                    <input
                                            placeholder="زمان پایان را مشخص کنید" name="end"
                                            {{--@if(!$edit) disabled @endif--}}
                                                                                        pattern="1402/[0-9]{2}/[0-9]{2} [0-2]{1}[0-9]{1}:[0-5]{1}[0-9]{1}"

                                            class="normal-example form-control example1"
                                            value=@if(isset($azmon)) @if($azmon->end) {{$azmon->end}}  @endif @endif
                                    >
                                </div>
                                @if ($errors->any()&& $errors->first('birthdate'))
                                    <p class="mt-2 text-danger mr-1">{{$errors->first('birthdate')}}</p>
                            @endif
                            <!-- /.input group -->
                            </div>


                           


                            <div class="form-group">
                                <label>شیوه دسترسی</label>
                                {{--<div class="input-group">--}}
                                {{--<div class="form-check">--}}
                                {{--<select class="selectpicker" title="یک گزینه را انتخاب کنید" name="sath">--}}
                                {{--<option selected value="1">عالی</option>--}}
                                {{--<option @if(0) selected @endif value="1">عالی</option>--}}
                                {{--<option @if(0) selected @endif value="2">خوب</option>--}}
                                {{--<option @if(0) selected @endif value="3">عالی و خوب</option>--}}
                                {{--<option @if(0) selected @endif value="4">سوالات ستاره دار شده</option>--}}
                                {{--<option @if(0) selected @endif value="5">فقط سوالات استاد</option>--}}
                                {{--</select>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                            </div>

 <label>
                                        <input type="checkbox" name="show_nomre"
                                               class=""
                                               id="exampleCheck1"
                                               @if(isset($azmon)) @if($azmon->show_nomre==1) checked @endif @endif
                                        >
                                    <span>
                                        نمره آزمون به دانشجو نشان داده شود.
                                    </span>
                                     </label>
                                    
  
                                                               <br>
                           <label>
                                        <input type="checkbox" name="show_ans"
                                               id="exampleCheck1"
                                               @if(isset($azmon)) @if($azmon->show_ans==1) checked @endif @endif
                                        >

                                    
                                    <span>پاسخ سوالات به دانشجو نشان داده شود.</span>
                                </label>
                               <br>
                          <label>
                                        <input type="checkbox" name="changeable"
                                               id="exampleCheck1"
                                               @if(isset($azmon)) @if($azmon->changeable==1) checked @endif @endif
                                        >

                                   
                                    <span>دانشجو امکان اینکه پاسخش را تغییر دهد داشته باشد</span>
                              </label>
                               <br>
                          <label>
                                        <input type="checkbox" name="show_remain"
                                               id="exampleCheck1"
                                               @if(isset($azmon)) @if($azmon->show_remain==1) checked @endif @endif
                                        >

                                    <span>نمایش زمان باقیمانده آزمون به دانشجو</span>
                               </label>
                               <br>
                            <label>
                                        <input type="checkbox" name="show_state"
                                               id="exampleCheck1"
                                               @if(isset($azmon)) @if($azmon->show_state==1) checked @endif @endif
                                        >

                                   
                                    <span>نمایش موقعیت سوال درحال پاسخگویی به دانشجو</span>
                               </label>

<br>

                            <input type="submit"
                                   value=" @if(isset($azmon))بروزرسانی@elseایجاد@endif"
                                   class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 float-right">
                            @if(isset($azmon))
                                <a href="{{'/dashboard/azmon/delete/'.$azmon->id}}" class="btn waves-effect waves-light">
                                حذف آزمون
                                </a>
                            @endif
                        </form>
                    </div>
                </div>
            </div>


        </div>


    </div>


@endsection

@section('js')
    <script>
        $('#selectAll').click(function() {
            options=document.getElementsByClassName('options');
            for(i=0;i<options.length;i++){
                // options[i].setAttribute('selected', true)
                options[i].click()
                document.getElementById('deselectAll').click()
            }
    // $('#selectBox option').attr("selected","selected");
});   
$('#deselectAll').click(function() {
    alert('no')
     options=document.getElementsByClassName('options');
            for(i=0;i<options.length;i++){
                options[i].setAttribute('selected', false)
            }
    // $('#selectBox option').removeAttr("selected");
});
    </script>

    <script src="{{("/style/assets/js/scrollspyNav.js")}}"></script>

    <script src="{{asset('/cuba-style/assets/ckeditor/ckeditor.js')}}"></script>
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

    <script src="{{("/style/plugins/bootstrap-select/bootstrap-select.min.js")}}"></script>
    <script src="{{("/style/assets/js/components/ui-accordions.js")}}"></script>




    {{--<script type="text/javascript">--}}
    {{--$(document).ready(function () {--}}
    {{--$(".datapicker").pDatepicker({--}}
    {{--format: 'YYYY/MM/DD ',--}}
    {{--});--}}
    {{--$("#form").submit(function () {--}}
    {{--$("#factories").prop('disabled', true);--}}
    {{--return true;--}}
    {{--});--}}
    {{--});--}}

    {{--</script>--}}
    <script type="text/javascript">
        $(document).ready(function () {
            $(".example1").persianDatepicker({
                    format: 'YYYY/MM/DD HH:mm',
                    responsive: true,
                    timePicker: {
                        enabled: true,
                        meridiem: {
                            enabled: true
                        }
                    },
                    toolbox: {
                        submitButton: {
                            enabled: true
                        }
                    }
                }
            );
        });
    </script>
@endsection
