@extends('management.layout.master')
@section('title', 'نظرسنجی')
@section('add-styles')
@endsection
@section('main-content')
    <div class=" row">
        <div class="col 12 s12">
            <a href="/dashboard/export-survey"
                class="mb-6 btn-floating waves-effect waves-light gradient-45deg-purple-deep-orange gradient-shadow tooltipped"
                data-position="top" data-tooltip="خروجی اکسل">
                <i class="material-icons">move_to_inbox</i>
                <i data-feather="trash"></i>
            </a>
            <a href="/dashboard/export-survey-teacher"
                class="mb-6 btn-floating waves-effect waves-light gradient-45deg-light-blue-cyan gradient-shadow tooltipped"
                data-position="bottom" data-tooltip="خروجی استاد">
                <i class="material-icons dp48">person_pin</i>
                <i data-feather="edit"></i>
            </a>
            <a class="mb-6 btn-floating waves-effect waves-light gradient-45deg-purple-deep-orange gradient-shadow tooltipped float-right"
                data-position="bottom" data-tooltip="بریم به عقب" onclick="handleBackUrl()">
                <i class="material-icons dp48">arrow_back</i>
            </a>
            <script>
                function handleBackUrl() {
                    history.back()
                }
            </script>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <div id="input-fields" class="card card-tabs">
                <div class="card-content">
                    <div class="card-title">
                        <div class="row">
                            <div class="col s12 m6 l10">
                                <h4 class="card-title">فرم مدیریت نظرسنجی</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div id="view-input-fields" class="active">
                            <div class="col s12">
                                <p>
                                    مدرس گرامی ! ابتدا فرم زیررا جهت درج نظرسنجی تمکمیل نموده سپس در باکس نوع سوال یکی
                                    از گزینه های
                                    <code class=" language-markup">پاسخ کوتاه</code>
                                    <code class=" language-markup">چندگزینه ( انتخاب یک گزینه )</code> و
                                    <code class=" language-markup">چندگزینه ( انتخاب چند گزینه )</code>
                                </p>
                                <p>را انتخاب نماببد
                                </p>
                                <br>
                                <form class="row" method="post" @if (isset($serv))
                                    action="/dashboard/survey/edit/{{ $serv->id }}"
                                @else
                                    action="/dashboard/survey/create"
                                    @endif
                                    enctype="multipart/form-data"
                                    onsubmit="return submit(this);">
                                    @csrf>
                                    <div class="col s12">
                                        <div class="input-field col s12">
                                            <textarea id="textarea2" name="question"
                                                class="materialize-textarea">@if (isset($serv)){{ $serv->text }}@endif</textarea>
                                            <label for="first_name1" class="active">عنوان سوال</label>
                                        </div>
                                        @if (isset($serv))
                                            @foreach ($serv->options as $key => $item)
                                                <div class="input-field col s12">
                                                    <textarea id="textarea2" name="option[{{ $key }}]"
                                                        class="materialize-textarea"
                                                        @if (isset($serv)) disabled @endif>{{ $item->option }}</textarea>
                                                    <label for="last_name">گزینه ها ( گزینه هارا با Enter از هم جدا کنید
                                                        ) </label>
                                                </div>
                                            @endforeach
                                        @endif
                                        @if (!isset($serv))
                                            <div class="input-field col s12">
                                                <textarea id="textarea2" name="options"
                                                    class="materialize-textarea"></textarea>
                                                <label for="last_name">گزینه ها ( گزینه هارا با Enter از هم جدا کنید
                                                    ) </label>
                                            </div>
                                        @endif
                                        <div class="input-field col s12">
                                            <select class="form-control" id="sel1" name="answer"
                                                onchange="changetype(this)">
                                                <option @if (isset($serv))
                                                    @if ($serv->type == 1) selected
                                                        @endif @endif value="1">پاسخ کوتاه
                                                </option>
                                                <option @if (isset($serv))
                                                    @if ($serv->type == 2) selected
                                                        @endif @endif value="2">چند گزینه ای (تنها انتخاب یک
                                                        گزینه)
                                                </option>
                                                <option @if (isset($serv))
                                                    @if ($serv->type == 3) selected
                                                        @endif @else selected @endif value="3">چند گزینه ای
                                                        (امکان انتخاب بیشتر از یک
                                                        گزینه)
                                                </option>
                                            </select>
                                            <label for="last_name">نوع پاسخ دهی</label>
                                        </div>
                                        <div class="input-field col s12">
                                            <input type="submit" value="ثبت"
                                                class="mb-6 btn waves-effect waves-light gradient-45deg-amber-amber gradient-shadow">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col s12 m12 l12">
            <div id="highlight-table" class="card card card-default scrollspy">
                <div class="card-content">
                    <h4 class="card-title">نظرسنجی های ثبت شده</h4>
                    <p class="mb-2">مدرس عزیز در ستون<code class="  language-markup"> عملیات </code>مدیریت نظرسنجی
                        ها در
                        اختیار شماست
                    </p>
                    <div class="row">
                        <div class="col s12">
                        </div>
                        <div class="col s12">
                            <table class="highlight">
                                <thead>
                                    <tr>
                                        <th>ردیف</th>
                                        <th>عنوان سوال</th>
                                        <th>نوع سوال</th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!isset($serv))
                                        @foreach ($serveys as $servey)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <a
                                                        href="/dashboard/survey/edit/{{ $servey->id }}">{!! $servey->text !!}</a>
                                                </td>
                                                <td>{{ $servey->type_name }}</td>
                                                <td>
                                                    <a class="mb-6 btn-floating waves-effect waves-light gradient-45deg-light-blue-cyan gradient-shadow tooltipped"
                                                        data-position="bottom" data-tooltip="مشاهده / مخفی"
                                                        onclick="hide({{ $servey->id }})">
                                                        <i class="material-icons dp48">remove_red_eye</i>
                                                        <i data-feather="edit"></i>
                                                    </a>
                                                    <div class="card-body" id="{{ $servey->id }}"
                                                        style="display: none">
                                                        <p>گیرندگان : {{ $servey->rec }}</p>
                                                        <p>نوع : {{ $servey->type_name }}</p>
                                                        @if (count($servey->options) > 0)
                                                            <p> گزینه ها :</p>
                                                            @foreach ($servey->options as $option)
                                                                <p> {{ $option->option }}</p>
                                                            @endforeach
                                                        @endif
                                                        <p>وضعیت : {{ $servey->active_name }}</p>


                                                    </div>
                                                    <a href="/dashboard/survey/edit/{{ $servey->id }}"
                                                        class="mb-6 btn-floating waves-effect waves-light gradient-45deg-light-blue-cyan gradient-shadow tooltipped"
                                                        data-position="top" data-tooltip="ویرایش">
                                                        <i class="material-icons dp48">mode_edit</i>
                                                        <i data-feather="edit"></i>
                                                    </a>
                                                    <a href="/dashboard/survey/remove/{{ $servey->id }}"
                                                        class="mb-6 btn-floating waves-effect waves-light gradient-45deg-light-blue-cyan gradient-shadow tooltipped"
                                                        data-position="bottom" data-tooltip="حذفش کنم؟"
                                                        onclick="return confirm('با حذف این سوال کلیه پاسخ هایی که به آن داده شده است نیز حذف خواهد شد.آیا با حذف سوال موافق هستید؟')">
                                                        <i class="material-icons dp48">delete</i>
                                                        <i data-feather="edit"></i>
                                                    </a>
                                                    <a href="/dashboard/survey/active/{{ $servey->id }}"
                                                        class="mb-6 btn-floating waves-effect waves-light gradient-45deg-light-blue-cyan gradient-shadow tooltipped"
                                                        data-position="top"
                                                        data-tooltip="{{ $servey->active == 0 ? 'انتشار' : 'توقف انتشار' }}">
                                                        <i class="material-icons dp48">publish</i>
                                                        <i data-feather="edit"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('js')
    <script>
        function changetype(x) {
            type = x.value;
            if (type == 1) {
                document.getElementById("add").style.display = "none";
                document.getElementById("desc_add").style.display = "none";
            } else {
                document.getElementById("add").style.display = "block";
                // document.getElementById("desc_add").style.display = "block";
            }
        }
    </script>
    <script>
        function hide(name) {
            // var dd = $('[name="answer"]:checked').val();
            if (document.getElementById(name).style.display == "none") {
                document.getElementById(name).style.display = "block";
            } else {
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
            newdiv.innerHTML = "<textarea class=\"form-control\" name=\"option[" + num + "]\" id=\"option[" + num +
                "]\"></textarea><a href=\"javascript:;\" onclick=\"removeElement(\'" + divIdName + "\',\'" + elId +
                "\')\" class='btn btn-danger' style='color: whitesmoke;margin: 10px'>حذف</a>";


            holder.appendChild(newdiv);
            setTimeout(function() {
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

            setTimeout(function() {
                holder.removeChild(olddiv);
            }, 600);

        }
    </script>
    <script>
        function msg(sel) {
            $select_group = 'دانشجویان درس ' + sel.options[sel.selectedIndex].text;

        }

        function subMsg() {

            $r = confirm('سوالی که مطرح کرده اید برای ' + $select_group +
                ' ارسال خواهد شد.آیا دانشجویان هدف درست انتخاب شده اند؟');
            if ($r)
                this.form.submit();
            else {
                return false;
            }
        }
    </script>
    <script>
        $(window).on('load', function() {
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
@endsection
