@extends('melisan.layout.master')
@section('add-styles')
<meta name="viewport" content="width=device-width, initial-scale=1">

<style>
    @media (max-width: 600px) {
        * {
            font-size: 3vw !important;
        }
    }

    span {
        color: #fff;
    }

    textarea {
        color: #fff;
    }
</style>
@endsection
@section('title', 'نظرسنجی')
@section('main-content')




<div class="">
    <form method="post"
        @if(\Route::current()->getName() == 'editQ')
        action={{"/dashboard/question/edit?question_id=".$edit->id}}
        @elseif(\Route::current()->getName() != 'bank')
        action={{"/dashboard/question/create?session_id=".$meeting->id}}
        @endif
        enctype="multipart/form-data">
        @csrf
        @if(isset($old))
        <input name="old_route" value={{$old}} hidden>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div id="icon-prefixes-two" class="card card-tabs">
                    <div class="card-content">
                        <div class="card-title">
                            <div class="row">
                                <h6 style="color: #fff;">{{$questions->count()}} سوال</h6>

                                {{-- <div class="col-sm-12 col-md-6 col-lg-10">--}}
                                {{-- <h4 class="card-title">پیشوندهای آیکون</h4>--}}
                                {{-- </div>--}}
                            </div>
                        </div>
                        <div id="view-icon-prefixes-two" class="active">
                            {{-- <p>برای واضح تر شدن برچسب ورودی فرم می توانید یک پیشوند آیکون اضافه کنید. فقط یک کلاس با یک--}}
                            {{-- نماد--}}
                            {{-- <code class="language-markup">prefix</code> قبل از ورودی و برچسب اضافه کنید .</p>--}}
                            <br>
                            <!--
                            <div class="row">
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">mode_edit</i>
                                        <textarea id="icon_prefix2"
                                                  class="materialize-textarea" id="description" name="question"
                                                  minlength="5">@if (\Route::current()->getName() == 'editQ')
                                {{$edit->answer1}}
                            @endif</textarea>
                                        <label class="contact-input" for="icon_prefix2">پیام</label>
                                    </div>
                                </div>
                            </div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="content" class="main-content2 mt-5" style="margin-right: 0;">
                    @if (\Route::current()->getName() == 'bank')
                    <div class="row layout-top-spacing">
                        <div class="layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">
                                    <div class="row">
                                        <!-- <div class="col"> -->
                                        <h4>فیلتر سطح سوالات</h4>
                                        <!-- </div> -->
                                    </div>
                                </div>

                                <div class="widget-content widget-content-area text-center">
                                    <form method="get"
                                        action="/dashboard/courses/bank"
                                        enctype="multipart/form-data">

                                        <input name="course_id" value="{{$course->id}}" hidden>
                                        <div class="row justify-content-center">

                                            <div style="margin-right: 10px" class="col">
                                                <div class="row">
                                                    <div class="input-group mb-4">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <div class="n-chk align-self-end">
                                                                    <label
                                                                        class="new-control new-checkbox checkbox-success"
                                                                        style="height: 21px; margin-bottom: 0; margin-right: 0">
                                                                        <input type="checkbox"
                                                                            class="new-control-input"
                                                                            name="non"
                                                                            @if($filter['6']=='1' ) checked @endif>
                                                                        <span class="new-control-indicator"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <label class="form-control"
                                                            aria-label="checkbox">داوری ناتمام</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="margin-right: 10px" class="col">
                                                <div class="row">
                                                    <div class="input-group mb-4">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <div class="n-chk align-self-end">
                                                                    <label
                                                                        class="new-control new-checkbox checkbox-success"
                                                                        style="height: 21px; margin-bottom: 0; margin-right: 0">
                                                                        <input type="checkbox"
                                                                            class="new-control-input"
                                                                            name="ex"
                                                                            @if($filter['1']=='1' ) checked @endif>
                                                                        <span class="new-control-indicator"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <label class="form-control"
                                                            aria-label="checkbox">عالی</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="margin-right: 10px" class="col">
                                                <div class="row">
                                                    <div class="input-group mb-4">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <div class="n-chk align-self-end">
                                                                    <label
                                                                        class="new-control new-checkbox checkbox-success"
                                                                        style="height: 21px; margin-bottom: 0; margin-right: 0">
                                                                        <input type="checkbox"
                                                                            class="new-control-input"
                                                                            name="go"
                                                                            @if($filter['2']=='1' ) checked @endif>
                                                                        <span class="new-control-indicator"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <label class="form-control"
                                                            aria-label="checkbox">خوب</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="margin-right: 10px" class="col">
                                                <div class="row">
                                                    <div class="input-group mb-4">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <div class="n-chk align-self-end">
                                                                    <label
                                                                        class="new-control new-checkbox checkbox-success"
                                                                        style="height: 21px; margin-bottom: 0; margin-right: 0">
                                                                        <input type="checkbox"
                                                                            class="new-control-input"
                                                                            name="med"
                                                                            @if($filter['3']=='1' ) checked @endif>
                                                                        <span class="new-control-indicator"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <label class="form-control"
                                                            aria-label="checkbox">متوسط</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="margin-right: 10px" class="col">
                                                <div class="row">
                                                    <div class="input-group mb-4">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <div class="n-chk align-self-end">
                                                                    <label
                                                                        class="new-control new-checkbox checkbox-success"
                                                                        style="height: 21px; margin-bottom: 0; margin-right: 0">
                                                                        <input type="checkbox"
                                                                            class="new-control-input"
                                                                            name="ba"
                                                                            @if($filter['4']=='1' ) checked @endif>
                                                                        <span class="new-control-indicator"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <label class="form-control"
                                                            aria-label="checkbox">ضعیف</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="margin-right: 10px" class="col">
                                                <div class="row">
                                                    <div class="input-group mb-4">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <div class="n-chk align-self-end">
                                                                    <label
                                                                        class="new-control new-checkbox checkbox-success"
                                                                        style="height: 21px; margin-bottom: 0; margin-right: 0">
                                                                        <input type="checkbox"
                                                                            class="new-control-input"
                                                                            name="os"
                                                                            @if($filter['5']=='1' ) checked @endif>
                                                                        <span class="new-control-indicator"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <label class="form-control" aria-label="checkbox">
                                                            استاد</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row justify-content-center">

                                            <div style="margin-right: 10px" class="col">
                                                <div class="input-group mb-4">
                                                    {{--<button--}}
                                                    {{--class="btn btn-success" type="submit"--}}
                                                    {{--onclick="this.style.display = 'none'"--}}
                                                    {{-->--}}
                                                    {{--اعمال فیلتر--}}
                                                    {{--</button> --}}

                                                    <button
                                                        class="btn btn-success" type="submit"
                                                        name="action"
                                                        onclick="this.style.display = 'none'">
                                                        اعمال فیلتر
                                                    </button>
                                                </div>
                                            </div>
                                            <div style="margin-right: 10px" class="col">

                                                <div class="input-group mb-4">
                                                    {{--<button--}}
                                                    {{--class="btn btn-success" type="submit"--}}
                                                    {{--onclick="this.style.display = 'none'"--}}
                                                    {{-->--}}
                                                    {{--اعمال فیلتر--}}
                                                    {{--</button> --}}
                                                    <button
                                                        class="btn btn-success" type="submit"
                                                        {{--onclick="this.style.display = 'none'"--}}
                                                        name="action" value="excel">
                                                        دانلود اکسل
                                                    </button>
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                                <div class="widget-content widget-content-area text-center">
                                    <a class="btn btn-primary" onclick="hide()" id="texthide"
                                        style="cursor: pointer">مخفی
                                        کردن گزینه های کلیه سوالات</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if ( \Route::current()->getName() == 'editQ' || ( (\Route::current()->getName() != 'bank') && $limit=='0') )

                    <div id="icon-prefixes" class="card card-tabs">
                        <div class="card-content">
                            <textarea id="textarea2"
                                class="materialize-textarea" id="change2"
                                name="question" placeholder="سوال را وارد کنید">@if (\Route::current()->getName() == 'editQ'){{$edit->question}}@endif</textarea>
                            <div class="card-title">
                                <div class="row">


                                </div>
                            </div>
                            <div id="view-icon-prefixes" class="active">

                                <br>
                                <div class="row" style="margin-right:30px">
                                    <div class="row">
                                        <p class="mb-1">
                                            <label>
                                                <input name="answer" type="radio" checked name="answer"
                                                    value="1"
                                                    id="answer1"
                                                    onclick="firstAnswer()">
                                                <span id="lbl_1">پاسخ صحیح</span>
                                            </label>
                                            <textarea id="textarea2" style="color: #B4E50D;border-color: #B4E50D;"
                                                class="materialize-textarea" id="change2"
                                                name="answer1">@if (\Route::current()->getName() == 'editQ'){{$edit->answer1}}@endif</textarea>
                                        </p>
                                        <p class="mb-1">
                                            <label>
                                                <input name="answer" type="radio" id="answer2" name="answer"
                                                    value="2"
                                                    onclick="secondAnswer()">
                                                <span id="lbl_2"> پاسخ غلط</span>
                                            </label>
                                            <textarea
                                                class="materialize-textarea" name="answer2"
                                                id="description">@if (\Route::current()->getName() == 'editQ'){{$edit->answer2}}@endif</textarea>
                                        </p>
                                    </div>
                                    <div class="row">
                                        <p class="mb-1">
                                            <label>
                                                <input name="answer" type="radio" id="answer3" name="answer"
                                                    value="3"
                                                    onclick="thirdAnswer()">
                                                <span id="lbl_3">پاسخ غلط</span>
                                            </label>
                                            <textarea id="textarea2"
                                                class="materialize-textarea" name="answer3"
                                                id="description">@if (\Route::current()->getName() == 'editQ'){{$edit->answer3}}@endif</textarea>
                                        </p>
                                        <p class="mb-1">
                                            <label>
                                                <input name="answer" type="radio" id="answer4" name="answer"
                                                    value="4"
                                                    onclick="forthAnswer()">
                                                <span id="lbl_4">پاسخ غلط</span>
                                            </label>
                                            <textarea id="textarea2"
                                                class="materialize-textarea" name="answer4"
                                                id="description">@if (\Route::current()->getName() == 'editQ'){{$edit->answer4}}@endif</textarea>
                                        </p>
                                    </div>
                                    <div class="card-footer2">
                                        <button class="btn-view-list" type="submit" style="width: 100%;padding: 10px;border: none;">
                                            @if(\Route::current()->getName() == 'editQ')
                                            ویرایش سوال
                                            @else
                                            ثبت سوال
                                            @endif
                                        </button>

                                    </div>
    </form>

</div>
</div>
</div>
</div>

@endif

</div>
</div>
</form>
</div>




{{-- @endif--}}
</div>




@if(\Route::current()->getName() != 'editQ')
@foreach($questions as $key => $question)

@if (\Route::current()->getName() != 'bank' || $question->status)

<div class="row justify-content-center mt-5">
    <div class="col-md-12">
        <div class="card blur_q">
            <div class="card-header" style="padding: 20px;font-size: x-large;">
                <h5 style="color: #fff;text-align: center;">
                    @if (\Route::current()->getName() == 'bank' )
                    <a href="/dashboard/question/star?question_id={{$question->id}}"
                        class="ajaxStar">
                        <i id="star{{$question->id}}" data-feather="star"
                            @if($question->star==0)
                            style="color: gray"
                            @else
                            style="color: yellow"
                            @endif
                            ></i>
                    </a>
                    @endif
                    {{$question->question}}
                </h5>
                <span
                    style="font-size:10px"> ({{$question->user}}
                    ) </span>
                <a onclick="hideone({{$key}})"><span
                        style="font-size: 10px">(نمایش/ مخفی جزئیات)</span></a>
            </div>

            @if(isset($question->status))
            @if($question->status =='1' ||$question->status =='2')

            <label style="text-align: center;margin-top: 8px;">سطح سوال : {{$question->level}} <span style="color: #B4E50D">از این سوال در آزمون ها استفاده شده است</span>
            </label>
            @else
            <label style="text-align: center;margin-top: 8px;">سطح سوال : {{$question->level}} <span style="color: red">از این سوال در آزمون ها استفاده نشده است</span>
            </label>
            @endif
            @endif



            <div class="answers" id="answer{{$key}}">


                <div class="card-body">


                    <div class="row">


                        <div class="col-md-6"
                            style="@if($question->answer==1)color: #B4E50D; @else color: #fff; @endif margin-bottom: 10px;font-size: larger;">
                            1.{{$question->answer1}}
                        </div>
                        <div class="col-md-6"
                            style="@if($question->answer==2)color: #B4E50D; @else color: #fff; @endif margin-bottom: 10px;font-size: larger;">
                            2.{{$question->answer2}}
                        </div>
                        <div class="col-md-6"
                            style="@if($question->answer==3)color: #B4E50D; @else color: #fff; @endif margin-bottom: 10px;font-size: larger;">
                            3.{{$question->answer3}}
                        </div>
                        <div class="col-md-6"
                            style="@if($question->answer==4)color: #B4E50D; @else color: #fff; @endif margin-bottom: 10px;font-size: larger;">
                            4.{{$question->answer4}}
                        </div>
                        @if(Route::current()->getName() == 'bank')


                        @if(count($question['nazar'])>0)
                        <span class="row">
                            <p>داوران:</p>
                            @foreach($question['nazar'] as $key=>$nazar)
                            <span
                                style=" margin-bottom: 10px;
                                                                @if($nazar->score==1)
                                                                    color:green;
                                                                @elseif($nazar->score==2)
                                                                    color:red;
                                                                @endif">

                                @if($nazar->comment)
                                ({{$nazar->comment}})
                                @endif
                            </span>
                            @endforeach

                            @endif
                            @endif




                            @if (\Route::current()->getName() == 'bank')
                            <div class=" col-md-3">
                                <form method="post"
                                    action="{{"/dashboard/question/scoring?question_id=".$question->id}}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <label>امتیاز</label>
                                    <div class="row">
                                        <label
                                            class="new-control new-checkbox checkbox-success"
                                            style="height: 21px; margin-bottom: 0; margin-right: 0">
                                            <input type="radio" class="new-control-input"
                                                name="score"
                                                value="1" {{$question->status == 1 ? "checked":''}}>
                                            <span class="new-control-indicator">عالی</span>
                                        </label>

                                        <label
                                            class="new-control new-checkbox checkbox-success"
                                            style="height: 21px; margin-bottom: 0; margin-right: 0">
                                            <input type="radio" class="new-control-input"
                                                name="score"
                                                value="2" {{$question->status == 2 ? "checked":''}}>
                                            <span class="new-control-indicator">خوب</span>
                                        </label>

                                        <label
                                            class="new-control new-checkbox checkbox-success"
                                            style="height: 21px; margin-bottom: 0; margin-right: 0">
                                            <input type="radio" class="new-control-input"
                                                name="score"
                                                value="3" {{$question->status == 3 ? "checked":''}}>
                                            <span class="new-control-indicator">متوسط</span>
                                        </label>

                                        <label
                                            class="new-control new-checkbox checkbox-success"
                                            style="height: 21px; margin-bottom: 0; margin-right: 0">
                                            <input type="radio" class="new-control-input"
                                                name="score"
                                                value="4" {{$question->status == 4 ? "checked":''}}>
                                            <span class="new-control-indicator">بد</span>
                                        </label>


                                    </div>
                                    <div
                                        class="form-group @if ($errors->has('question')) has-error @endif">
                                        <label>نظر</label>
                                        <div class="input-group mb-3">
                                            <div class="col-lg-12">
                                                <textarea class="form-control btn-square" name="comment"
                                                    id="comment">@if(isset($question))
               {{$question->comment}}
                @endif</textarea>
                                            </div>
                                        </div>
                                        <span class="text-danger" id="comment"
                                            style="color: red;">{{$errors->first('$question')}}</span>
                                    </div>
                                    <div class="card-footer2 mb-2">
                                        <button class="btn btn-primary" type="submit">
                                            ثبت نظر
                                        </button>
                                    </div>
                                </form>
                            </div>
                            @endif


                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="row">
                    <div class="col-md-6">
                        <a

                            href="/dashboard/question/edit/{{$question->id}}"
                            class="btn btn-primary" type="submit" style="width: 100%;">
                            ویرایش سوال
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="/dashboard/question/delete?question_id={{$question->id}}"
                            class="btn btn-danger" type="submit" style="width: 100%;">
                            حذف سوال
                        </a>
                    </div>
                </div>

            </div>


        </div>
    </div>
</div>


@endif
@endforeach

@endif


@endsection
@section('js')
<script src="{{("/all-css/assets/js/apps/mailbox-chat2.js")}}"></script>
<script src="{{("/all-css/assets/js/widgets/modules-widgets.js")}}"></script>

<script src="{{("/all-css/assets/js/scrollspyNav.js")}}"></script>

<script src="{{("/all-css/plugins/font-icons/feather/feather.min.js")}}"></script>
<script type="text/javascript">
    feather.replace();
</script>

<script>
    function firstAnswer() {
        document.getElementById("lbl_1").innerHTML = "پاسخ صحیح";
        document.getElementById("lbl_2").innerHTML = "پاسخ غلط";
        document.getElementById("lbl_3").innerHTML = "پاسخ غلط";
        document.getElementById("lbl_4").innerHTML = "پاسخ غلط";
        $('textarea[name="answer1"]').css('color', '#B4E50D')
        $('textarea[name="answer2"]').css('color', '#fff')
        $('textarea[name="answer3"]').css('color', '#fff')
        $('textarea[name="answer4"]').css('color', '#fff')

        $('textarea[name="answer1"]').css('border-color', '#B4E50D')
        $('textarea[name="answer2"]').css('border-color', '#fff')
        $('textarea[name="answer3"]').css('border-color', '#fff')
        $('textarea[name="answer4"]').css('border-color', '#fff')
    }

    function secondAnswer() {
        document.getElementById("lbl_2").innerHTML = "پاسخ صحیح";
        document.getElementById("lbl_1").innerHTML = "پاسخ غلط";
        document.getElementById("lbl_3").innerHTML = "پاسخ غلط";
        document.getElementById("lbl_4").innerHTML = "پاسخ غلط";

        $('textarea[name="answer1"]').css('color', '#fff')
        $('textarea[name="answer2"]').css('color', '#B4E50D')
        $('textarea[name="answer3"]').css('color', '#fff')
        $('textarea[name="answer4"]').css('color', '#fff')

        $('textarea[name="answer1"]').css('border-color', '#fff')
        $('textarea[name="answer2"]').css('border-color', '#B4E50D')
        $('textarea[name="answer3"]').css('border-color', '#fff')
        $('textarea[name="answer4"]').css('border-color', '#fff')
    }

    function thirdAnswer() {
        document.getElementById("lbl_3").innerHTML = "پاسخ صحیح";
        document.getElementById("lbl_2").innerHTML = "پاسخ غلط";
        document.getElementById("lbl_1").innerHTML = "پاسخ غلط";
        document.getElementById("lbl_4").innerHTML = "پاسخ غلط";
        $('textarea[name="answer1"]').css('color', '#fff')
        $('textarea[name="answer2"]').css('color', '#fff')
        $('textarea[name="answer3"]').css('color', '#B4E50D')
        $('textarea[name="answer4"]').css('color', '#fff')

        $('textarea[name="answer1"]').css('border-color', '#fff')
        $('textarea[name="answer2"]').css('border-color', '#fff')
        $('textarea[name="answer3"]').css('border-color', '#B4E50D')
        $('textarea[name="answer4"]').css('border-color', '#fff')
    }

    function forthAnswer() {
        document.getElementById("lbl_4").innerHTML = "پاسخ صحیح";
        document.getElementById("lbl_2").innerHTML = "پاسخ غلط";
        document.getElementById("lbl_3").innerHTML = "پاسخ غلط";
        document.getElementById("lbl_1").innerHTML = "پاسخ غلط";

        $('textarea[name="answer1"]').css('color', '#fff')
        $('textarea[name="answer2"]').css('color', '#fff')
        $('textarea[name="answer3"]').css('color', '#fff')
        $('textarea[name="answer4"]').css('color', '#B4E50D')
        $('textarea[name="answer1"]').css('border-color', '#fff')
        $('textarea[name="answer2"]').css('border-color', '#fff')
        $('textarea[name="answer3"]').css('border-color', '#fff')
        $('textarea[name="answer4"]').css('border-color', '#B4E50D')
    }
</script>
<script>
    function hide() {
        var allEditors = document.querySelectorAll('.answers');
        // alert(allEditors.length);
        // alert(document.getElementById('texthide').innerHTML);
        for (var i = 0; i < allEditors.length; i++) {
            if (document.getElementById('texthide').innerHTML == "نمایش گزینه های کلیه سوالات") {
                // alert("bb");
                document.getElementById('answer' + i).style.display = "block";
            } else {
                // alert("aa");
                document.getElementById('answer' + i).style.display = "none";

            }
        }
        if (document.getElementById('texthide').innerHTML == "نمایش گزینه های کلیه سوالات") {
            document.getElementById('texthide').innerHTML = "مخفی کردن گزینه های کلیه سوالات";
        } else {
            document.getElementById('texthide').innerHTML = "نمایش گزینه های کلیه سوالات";
        }
    }

    function hideone(name) {
        // alert(name);
        if (document.getElementById('answer' + name).style.display == "none") {
            document.getElementById('answer' + name).style.display = "block";
        } else {
            document.getElementById('answer' + name).style.display = "none";
        }
    }
</script>
<script>
    $('.ajaxStar').click(function(e) {

        var thenum = $(this).attr('href').match(/\d+/)[0];
        idName = "star" + thenum,
            // alert(idName);

            e.preventDefault(); // Prevents default link action
        $.ajax({
            url: $(this).attr('href'),
            success: function(data) {
                // alert("ستاره دار شد...");
                // Do something
                $text = document.getElementById(idName).style.color;
                if ($text == "gray")
                    document.getElementById(idName).style.color = "yellow";
                else
                    document.getElementById(idName).style.color = "gray";
            }
        });
    });
</script>
@endsection