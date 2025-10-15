@extends('dashboard.layout.app')
@section('title','صفحه نمایش دوره')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('/cuba-style/assets/css/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/cuba-style/assets/css/owlcarousel.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/cuba-style/assets/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/cuba-style/assets/css/responsive.css')}}">
@endpush
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-3">

                                <h3>نظرسنجی</h3>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#"><i data-feather="home"></i></a></li>
                                    <li class="breadcrumb-item">نظرسنجی</li>
                                </ol>
                            </div>
                            <div class="col-lg-3">
                                <a href="/dashboard/export-survey" class="btn btn-primary btn-sm">خروجی اکسل</a>

                            </div>
                            <div class="col-lg-3">
                                <a href="/dashboard/export-survey-teacher" class="btn btn-primary btn-sm">خروجی استاد</a>

                            </div>
                            <div class="col-lg-3">
                                <!-- Bookmark Start-->
                                <div class="bookmark pull-right">
                                    <ul>
                                        <div class="bookmark pull-right">
                                            <ul>
                                                <li><a
                                                            href="/dashboard/courses/list"
                                                            data-container="body" data-toggle="popover"
                                                            data-placement="top"
                                                            title="" data-original-title="بازگشت"><img
                                                                src="{{asset('/cuba-style/assets/images/arrow-left.svg')}}"></a>
                                                </li>

                                            </ul>
                                        </div>
                                    </ul>
                                </div>
                                <!-- Bookmark Ends-->
                            </div>
                        </div>
                    </div>
                </div>
                {{--@if(isset($meeting->file))--}}

                <hr>
                <div class="col-md-12">
                    <div class="row">

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form method="post"
                                          @if(isset($serv))
                                          action="/dashboard/survey/edit/{{$serv->id}}"
                                          @else
                                          action="/dashboard/survey/create"
                                          @endif
                                          enctype="multipart/form-data"
                                          onsubmit="return submit(this);">
                                        @csrf
                                        <div class="form-group ">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="row">
                                                        <label>سوال</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                        پاسخ دهندگان</span>
                                                                </div>
                                                                <select name="group" id="group"
                                                                        class="form-control rtl" onchange="msg(this);">
                                                                    <option value="0" selected>
                                                                        همه دانشجویان
                                                                    </option>

                                                                    @foreach($courses as $course)
                                                                        <option value="{{$course->id}}"
                                                                                @if(isset($serv)) selected @endif>
                                                                            {{$course->name}}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            @if ($errors->any()&& $errors->first('martial'))
                                                                <p class="mt-2 text-danger mr-1">{{$errors->first('martial')}}</p>
                                                        @endif
                                                        <!-- /.input group -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="input-group mb-3">
                                                <div class="col-lg-12">
                                            <textarea class="form-control btn-square" name="question" minlength="5"
                                                      required
                                                      id="description">@if(isset($serv)){{$serv->text}}@endif</textarea>
                                                </div>
                                            </div>
                                            <span class="text-danger" id="description"
                                                  style="color: red;">{{$errors->first('$question')}}</span>
                                        </div>

                                        <div class="row">
                                            <label>نوع پاسخ گویی</label>
                                        </div>
                                        <div class="row">

                                            <div class="col-md-4">

                                                <div class="form-group @if ($errors->has('answer1')) has-error @endif">
                                                    <div class="row">
                                                        <input type="radio"
                                                               @if(isset($serv)) @if($serv->type==1) checked
                                                               @endif @endif name="answer" value="1" id="answer1"
                                                               onchange="change()">
                                                        <label for="answer1">پاسخ کوتاه</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">

                                                <div class="form-group @if ($errors->has('answer1')) has-error @endif">
                                                    <div class="row">
                                                        <input type="radio" checked name="answer" value="2" id="answer2"
                                                               @if(isset($serv)) @if($serv->type==2) checked @endif @endif
                                                        >
                                                        <label for="answer2">چند گزینه ای (تنها انتخاب یک پاسخ)</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">

                                                <div class="form-group @if ($errors->has('answer1')) has-error @endif">
                                                    <div class="row">
                                                        <input type="radio" name="answer" value="3" id="answer3"
                                                               @if(isset($serv)) @if($serv->type==3) checked
                                                               @endif @else checked @endif
                                                        >
                                                        <label for="answer3">چند گزینه ای (امکان انتخاب بیشتر از یک
                                                            پاسخ)</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div name="add" id="add">
                                            <div class="fadeit" id="fadeit"></div>
                                            @if(isset($serv))

                                                @foreach($serv->options  as $key => $item)
                                                    <textarea
                                                            class="form-control"
                                                            name="option[{{$key}}]">{{$item->option}}</textarea>
                                                    {{--<a href="javascript:;" onclick="removeElement('fadeit','fadeit')"--}}
                                                    {{--class='btn btn-danger'--}}
                                                    {{--style='color: whitesmoke;margin: 10px'>Remove</a>";--}}
                                                @endforeach
                                            @endif
                                            <p></p>
                                            @if(!isset($serv))
                                                <textarea class="form-control" name="option[0]"
                                                          id="option[0]"></textarea>

                                                <a data-count="1" onclick="addElement('fadeit',event);"
                                                   class="btn btn-primary" style="color: whitesmoke;margin-left: 50px">گزینه
                                                    جدید</a></p>

                                                <div class="row " style="margin-bottom: 10px">
                                                    <input type="checkbox"
                                                           id="desc_add" name="desc_add">
                                                    {{--<label for="answer1" style="margin-right: 5px"> {{$key+1}} : </label>--}}
                                                    &nbsp;&nbsp;کادر توضیحات به نظر سنجی اضافه شود.
                                                </div>
                                            @endif
                                        </div>

                                        <div class="row">
                                            <input type="checkbox"
                                                   id="desc_add" name="active">
                                            &nbsp;&nbsp;نظرسنجی ایجاد شده منتشر شود.
                                            {{--<label>وضعیت انتشار</label>--}}
                                        </div>
                                        {{--<div class="row">--}}

                                        {{--<div class="col-md-4">--}}

                                        {{--<div class="form-group @if ($errors->has('active')) has-error @endif">--}}
                                        {{--<div class="row">--}}
                                        {{--<input type="radio" checked name="active" value="1" id="active"--}}
                                        {{-->--}}
                                        {{--<label for="active">فعال</label>--}}
                                        {{--</div>--}}
                                        {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="col-md-4">--}}

                                        {{--<div class="form-group @if ($errors->has('active')) has-error @endif">--}}
                                        {{--<div class="row">--}}
                                        {{--<input type="radio" name="active" value="0" id="deactive"--}}
                                        {{--@if(isset($serv)) @if($serv->active=='0') checked @endif @endif--}}
                                        {{-->--}}
                                        {{--<label for="deactive">غیر فعال</label>--}}
                                        {{--</div>--}}
                                        {{--</div>--}}
                                        {{--</div>--}}
                                        {{--</div>--}}
                                        <div class="card-footer">
                                            <button class="btn input-block-level form-control btn-primary"
                                                    {{--type="submit"--}}
                                                    onclick="return subMsg()"
                                            >
                                                {{--onclick= "return confirm('سوالی که مطرح کرده اید برای ارسال خواهد شد.آیا دانشجویان هدف درست انتخاب شده اند؟')">--}}
                                                ثبت سوال
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if(!isset($serv))
                    @foreach($serveys as $servey)
                        <div class="card col-12">
                            <div class="card-header">
                                <div class="row">
                                    <h5>
                                        <a href="/dashboard/survey/edit/{{$servey->id}}">{!! $servey->text !!}</a>
                                        <a onclick="hide({{$servey->id}})"><span
                                                    style="font-size: 10px">(نمایش/ مخفی)</span></a>
                                        <a href="/dashboard/survey/edit/{{$servey->id}}">
                                            <span
                                                    style="font-size: 10px">(ویرایش)</span></a>
                                        <a href="/dashboard/survey/remove/{{$servey->id}}"
                                           onclick="return confirm('با حذف این سوال کلیه پاسخ هایی که به آن داده شده است نیز حذف خواهد شد.آیا با حذف سوال موافق هستید؟')"> <span
                                                    style="font-size: 10px;color: red">(حذف)</span></a>
                                        <a href="/dashboard/survey/active/{{$servey->id}}"> <span
                                                    style="font-size: 10px;color: green">
                                                @if($servey->active==0)
                                                    (انتشار)
                                                @else
                                                    (توقف انتشار)
                                                @endif
                                            </span></a></h5>

                                </div>
                                <div class="card-body" id="{{$servey->id}}" style="display: none">
                                    <p>گیرندگان : {{$servey->rec}}</p>
                                    <p>نوع : {{$servey->type_name}}</p>
                                    @if(count($servey->options)>0)
                                        <p> گزینه ها :</p>
                                        @foreach($servey->options as $option)
                                            <p> {{$option->option}}</p>
                                        @endforeach
                                    @endif
                                    <p>وضعیت : {{$servey->active_name}}</p>


                                </div>
                            </div>
                        </div>

                    @endforeach
                @endif

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{asset('/cuba-style/assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/cuba-style/assets/js/rating/jquery.barrating.js')}}"></script>
    <script src="{{asset('/cuba-style/assets/js/owlcarousel/owl.carousel.js')}}"></script>
    <script src="{{asset('/cuba-style/assets/js/ecommerce.js')}}"></script>
    <script src="{{asset('/cuba-style/assets/js/product-list-custom.js')}}"></script>
    <script src="{{asset('/cuba-style/assets/js/tooltip-init.js')}}"></script>

    <script src="{{asset('/cuba-style/assets/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('/cuba-style/assets/js/select2/select2.full.min.js')}}"></script>
    <script>
        CKEDITOR.replace('description', {
            filebrowserUploadUrl: '/admin/panel/upload-image',
            filebrowserImageUploadUrl: '/admin/panel/upload-image'
        });

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

    <script>
        $(document).on("change", "input[type=radio]", function () {
            var type = $('[name="answer"]:checked').val();
            if (type == 1) {
                document.getElementById("add").style.display = "none";
                document.getElementById("desc_add").style.display = "none";
            } else
                document.getElementById("add").style.display = "block";
            document.getElementById("desc_add").style.display = "block";
        });
    </script>

    <script>
        function hide(name) {
            // var dd = $('[name="answer"]:checked').val();
            if (document.getElementById(name).style.display = "none") {
                document.getElementById(name).style.display = "block";
            }
            else {
                document.getElementById(name).style.display = "none";

            }
        }
    </script>
    <script>
        function addElement(elId, e) {
            var holder = document.getElementById(elId),
                num = e.currentTarget.dataset.count++,
                divIdName = elId + num,
                newdiv = document.createElement('div');

            newdiv.setAttribute("id", divIdName);
            newdiv.innerHTML = "<textarea class=\"form-control\" name=\"option[" + num + "]\" id=\"option[" + num + "]\"></textarea><a href=\"javascript:;\" onclick=\"removeElement(\'" + divIdName + "\',\'" + elId + "\')\" class='btn btn-danger' style='color: whitesmoke;margin: 10px'>حذف</a>";


            holder.appendChild(newdiv);
            setTimeout(function () {
                newdiv.className += "show";
            }, 10);
            document.getElementById('option[' + num + ']').focus();

        }
    </script>
    <script>
        function removeElement(divNum, elId) {
            var holder = document.getElementById(elId);
            var olddiv = document.getElementById(divNum);
            olddiv.className = "";

            setTimeout(function () {
                holder.removeChild(olddiv);
            }, 600);

        }
    </script>
    <script>
        function msg(sel) {
            $select_group = 'دانشجویان درس ' + sel.options[sel.selectedIndex].text;

        }

        function subMsg() {

            $r = confirm('سوالی که مطرح کرده اید برای ' + $select_group + ' ارسال خواهد شد.آیا دانشجویان هدف درست انتخاب شده اند؟');
            if ($r)
                this.form.submit();
            else {
                return false;
            }
        }
    </script>
    <script>
        $(window).on('load', function () {
            var v = document.getElementById('group');
            document.getElementById('description').focus();
            var selected = v.options[v.selectedIndex].value;
            var selected_text = v.options[v.selectedIndex].text;

            if (selected == '0')
                $select_group = "همه دانشجویان"
            else
                $select_group = 'دانشجویان درس ' + selected_text;
        })
    </script>
@endpush
