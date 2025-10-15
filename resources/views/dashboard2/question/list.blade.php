@extends('dashboard2.layout.app')

@section('start')

    <link href="{{("/style/assets/css/apps/mailing-chat.css")}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="{{("/style/assets/css/widgets/modules-widgets.css")}}">

    <link href="{{("/style/assets/css/scrollspyNav.css")}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="{{("/style/assets/css/forms/switches.css")}}">

    <script>
        $ex_c = 0;
    </script>

@endsection
@section('main')

    <div id="content" class="main-content">

        @include('dashboard.layout.message')

        @if (\Route::current()->getName() == 'bank')
            <div class="row layout-top-spacing">
                <div class="col-lg-12 col-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>فیلتر سطح سوالات</h4>
                                </div>
                            </div>
                        </div>

                        <div class="widget-content widget-content-area text-center">
                            <form method="get"
                                  action="/dashboard/courses/bank"
                                  enctype="multipart/form-data">

                                <input name="course_id" value="{{$course->id}}" hidden>
                                <div class="row justify-content-center">

                                    <div style="margin-right: 10px" class="col-lg-2 col-md-2 col-sm-2 col-2">
                                        <div class="row">
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <div class="n-chk align-self-end">
                                                            <label class="new-control new-checkbox checkbox-success"
                                                                   style="height: 21px; margin-bottom: 0; margin-right: 0">
                                                                <input type="checkbox" class="new-control-input"
                                                                       name="ex"
                                                                       @if($filter['1']=='1') checked @endif>
                                                                <span class="new-control-indicator"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <label class="form-control" aria-label="checkbox">عالی</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="margin-right: 10px" class="col-lg-2 col-md-2 col-sm-2 col-2">
                                        <div class="row">
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <div class="n-chk align-self-end">
                                                            <label class="new-control new-checkbox checkbox-success"
                                                                   style="height: 21px; margin-bottom: 0; margin-right: 0">
                                                                <input type="checkbox" class="new-control-input"
                                                                       name="go"
                                                                       @if($filter['2']=='1') checked @endif>
                                                                <span class="new-control-indicator"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <label class="form-control" aria-label="checkbox">خوب</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="margin-right: 10px" class="col-lg-2 col-md-2 col-sm-2 col-2">
                                        <div class="row">
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <div class="n-chk align-self-end">
                                                            <label class="new-control new-checkbox checkbox-success"
                                                                   style="height: 21px; margin-bottom: 0; margin-right: 0">
                                                                <input type="checkbox" class="new-control-input"
                                                                       name="med"
                                                                       @if($filter['3']=='1') checked @endif>
                                                                <span class="new-control-indicator"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <label class="form-control" aria-label="checkbox">متوسط</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="margin-right: 10px" class="col-lg-2 col-md-2 col-sm-2 col-2">
                                        <div class="row">
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <div class="n-chk align-self-end">
                                                            <label class="new-control new-checkbox checkbox-success"
                                                                   style="height: 21px; margin-bottom: 0; margin-right: 0">
                                                                <input type="checkbox" class="new-control-input"
                                                                       name="ba"
                                                                       @if($filter['4']=='1') checked @endif>
                                                                <span class="new-control-indicator"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <label class="form-control" aria-label="checkbox">ضعیف</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="margin-right: 10px" class="col-lg-2 col-md-2 col-sm-2 col-2">
                                        <div class="row">
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <div class="n-chk align-self-end">
                                                            <label class="new-control new-checkbox checkbox-success"
                                                                   style="height: 21px; margin-bottom: 0; margin-right: 0">
                                                                <input type="checkbox" class="new-control-input"
                                                                       name="os"
                                                                       @if($filter['5']=='1') checked @endif>
                                                                <span class="new-control-indicator"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <label class="form-control" aria-label="checkbox"> استاد</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row justify-content-center">

                                    <div style="margin-right: 10px" class="col-lg-2 col-md-2 col-sm-2 col-2">
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
                                                    onclick="this.style.display = 'none'"
                                            >
                                                اعمال فیلتر
                                            </button>
                                        </div>
                                    </div>
                                    <div style="margin-right: 10px" class="col-lg-2 col-md-2 col-sm-2 col-2">

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
                                                    name="action" value="excel"
                                            >
                                                دانلود اکسل
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                        <div class="widget-content widget-content-area text-center">
                            <a class="btn btn-primary" onclick="hide()" id="texthide" style="cursor: pointer">مخفی کردن گزینه های کلیه سوالات</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="layout-px-spacing" style="margin-bottom: -300px">

            <div class="row">
                @if (  \Route::current()->getName() == 'editQ' || ( (\Route::current()->getName() != 'bank') && $limit=='0') )

                    <div class="col-md-12">
                        <div class="row">

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">

                                        <form method="post"
                                              @if(\Route::current()->getName() == 'editQ')
                                              action={{"/dashboard/question/edit?question_id=".$edit->id}}
                                              @else
                                                      action={{"/dashboard/question/create?session_id=".$meeting->id}}
                                              @endif
                                                      enctype="multipart/form-data">
                                            @csrf
                                            @if(isset($old))
                                                <input name="old_route" value={{$old}} hidden>
                                            @endif
                                            <div class="form-group @if ($errors->has('question')) has-error @endif">
                                                @if(Laratrust::hasRole('teacher'))
                                                    @if(Route::current()->getName() != 'editQ')

                                                        <div class="row">
                                                            <h6>سوال یا سوالاتی را که در اینجا طرح می کنید مستقیما وارد
                                                                بانک
                                                                سوال می شوند و دانشجو در آزمون های خود آزمایی از آن ها
                                                                استفاده
                                                                خواهد کرد</h6>
                                                        </div>
                                                    @endif
                                                @endif
                                                <div class="row">
                                                    <h5>سوال</h5>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="col-lg-12">
                                            <textarea class="form-control btn-square" name="question" minlength="5"
                                                      required
                                                      id="description">@if (\Route::current()->getName() == 'editQ'){{$edit->question}}@endif</textarea>
                                                    </div>
                                                </div>
                                                <span class="text-danger" id="description"
                                                      style="color: red;">{{$errors->first('$question')}}</span>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">

                                                    <div class="form-group @if ($errors->has('answer1')) has-error @endif">
                                                        <div class="row">
                                                            <input type="radio" checked name="answer" value="1"
                                                                   id="answer1"
                                                                   onclick="firstAnswer()">
                                                            <label for="answer1" id="lbl_1">پاسخ صحیح</label>
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <div class="col-lg-12">
                                                         <textarea class="form-control btn-square " name="answer1"
                                                                   style="background-color: lawngreen"
                                                                   id="change2">@if (\Route::current()->getName() == 'editQ'){{$edit->answer1}}@endif</textarea>
                                                            </div>
                                                        </div>
                                                        <span class="text-danger" id="description"
                                                              style="color: red;  ">{{$errors->first('answer1')}}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">

                                                    <div class="form-group @if ($errors->has('answer2')) has-error @endif">
                                                        <div class="row">
                                                            <input type="radio" id="answer2" name="answer" value="2"
                                                                   onclick="secondAnswer()">
                                                            <label id="lbl_2" for="answer2"> پاسخ غلط</label>
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <div class="col-lg-12">
                                            <textarea class="form-control btn-square" name="answer2"
                                                      id="description">@if (\Route::current()->getName() == 'editQ'){{$edit->answer2}}@endif</textarea>
                                                            </div>
                                                        </div>
                                                        <span class="text-danger" id="description"
                                                              style="color: red;">{{$errors->first('answer2')}}</span>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">

                                                    <div class="form-group @if ($errors->has('answer3')) has-error @endif">
                                                        <div class="row">
                                                            <input type="radio" id="answer3" name="answer" value="3"
                                                                   onclick="thirdAnswer()">
                                                            <label id="lbl_3" for="answer3">پاسخ غلط</label>
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <div class="col-lg-12">
                                            <textarea class="form-control btn-square" name="answer3"
                                                      id="description">@if (\Route::current()->getName() == 'editQ'){{$edit->answer3}}@endif</textarea>
                                                            </div>
                                                        </div>
                                                        <span class="text-danger" id="description"
                                                              style="color: red;">{{$errors->first('answer3')}}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">

                                                    <div class="form-group @if ($errors->has('answer4')) has-error @endif">
                                                        <div class="row">
                                                            <input type="radio" id="answer4" name="answer" value="4"
                                                                   onclick="forthAnswer()">
                                                            <label for="answer4" id="lbl_4">پاسخ غلط</label>
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <div class="col-lg-12">
                                            <textarea class="form-control btn-square" name="answer4"
                                                          id="description">@if (\Route::current()->getName() == 'editQ'){{$edit->answer4}}@endif</textarea>
                                                            </div>
                                                        </div>
                                                        <span class="text-danger" id="description"
                                                              style="color: red;">{{$errors->first('answer4')}}</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card-footer">
                                                @if (\Route::current()->getName() == 'editQ')
                                                    <a href="/dashboard/question/delete?question_id={{$edit->id}}"
                                                       class="btn btn-danger" type="submit"
                                                       onclick="return confirm('آیا با حذف سوال موافق هستید؟  ')"
                                                    >
                                                        حذف سوال
                                                    </a>
                                                @endif
                                                <button class="btn btn-primary" type="submit">
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
                    </div>
                @endif

            </div>
@if(\Route::current()->getName() != 'editQ')
            <div class="row">
                @foreach($questions as $key => $question)
                    @if (\Route::current()->getName() != 'bank' || $question->status)
                        <div class="card col-12" style="margin-bottom:6px ">
                            <div class="card-header">
                                <div class="row">
                                    <h5>
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
                                        {{$question->question}}</h5>  <span
                                            style="font-size: 10px"> ({{$question->user}}
                                        ) </span>
                                    <a onclick="hideone({{$key}})"><span
                                                style="font-size: 10px">(نمایش/ مخفی جزئیات)</span></a>
                                </div>

                                @if(isset($question->status))
                                    @if($question->status =='1' ||$question->status =='2')

                                        <label>سطح سوال : {{$question->level}} <span style="color: green">از این سوال در آزمون ها استفاده شده است</span>
                                        </label>
                                    @else
                                        <label>سطح سوال : {{$question->level}} <span style="color: red">از این سوال در آزمون ها استفاده نشده است</span>
                                        </label>
                                    @endif
                                @endif
                            </div>


                            <div class="row answers" id="answer{{$key}}" style="display: block">

                                <div class="col-md-12">
                                    <div class="card-body">
                                        <div class="row">
                                            {{--@if(Laratrust::hasRole('nothing'))--}}


                                            {{--<div class="col-md-9">--}}
                                            {{--@else--}}
                                            <div class="col-md-9">

                                                {{--@endif--}}
                                                <div class="row"
                                                     style="@if($question->answer==1)color: forestgreen; @endif margin-bottom: 10px">
                                                    1.{{$question->answer1}}
                                                </div>
                                                <div class="row"
                                                     style="@if($question->answer==2)color: forestgreen; @endif margin-bottom: 10px">
                                                    2.{{$question->answer2}}
                                                </div>
                                                <div class="row"
                                                     style="@if($question->answer==3)color: forestgreen; @endif margin-bottom: 10px ">
                                                    3.{{$question->answer3}}
                                                </div>
                                                <div class="row"
                                                     style="@if($question->answer==4)color: forestgreen; @endif margin-bottom: 10px">
                                                    4.{{$question->answer4}}
                                                </div>
                                                @if(Route::current()->getName() == 'bank')
                                                    {{--<div class="row"--}}
                                                    {{--style="@if($question->answer==4)color: forestgreen; @endif margin-bottom: 10px">--}}
                                                    @if(count($question['nazar'])>0)
                                                        @foreach($question['nazar'] as $key=>$nazar)
                                                            <div class="row"
                                                                 style="color: red; margin-bottom: 10px">
                                                                نظر داوری-{{$nazar['user']}}
                                                                :
                                                                @if($nazar->score==1)
                                                                    دارای
                                                                    غلط تایپی یا ایراد
                                                                    نگارشی
                                                                    است
                                                                @elseif($nazar->score==2)
                                                                    گزینه
                                                                    ها به هم ریخته
                                                                    است
                                                                @elseif($nazar->score==3)
                                                                    سوال
                                                                    برای آزمون مناست
                                                                    است
                                                                @elseif($nazar->score==4)
                                                                    سوال
                                                                    ایراد دارد و مناسب
                                                                    آزمون
                                                                    نیست
                                                                @endif
                                                                @if($nazar->comment)
                                                                    , {{$nazar->comment}}
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                    {{--</div>--}}
                                                @endif
                                            </div>


                                            {{--emtiaz dehi cancel shode--}}
                                            {{--@if(Laratrust::hasRole('nothing'))--}}
                                            @if (\Route::current()->getName() == 'bank')
                                                <div class=" col-md-3">
                                                    <form method="post"
                                                          action="{{"/dashboard/question/scoring?question_id=".$question->id}}"
                                                          enctype="multipart/form-data">
                                                        @csrf
                                                        <label>امتیاز</label>
                                                        <div class="col">

                                                            <input type="radio" id="awli" name="score"
                                                                   value="1" {{$question->status == 1 ? "checked":''}}>
                                                            <label for="awli">عالی</label><br>
                                                            <input type="radio" id="khob" name="score"
                                                                   value="2" {{$question->status == 2 ? "checked":''}}>
                                                            <label for="khob">خوب</label><br>
                                                            <input type="radio" id="motevaset" name="score"
                                                                   value="3" {{$question->status == 3 ? "checked":''}}>
                                                            <label for="motevaset">متوسط</label><br>
                                                            <input type="radio" id="bad" name="score"
                                                                   value="4" {{$question->status == 4 ? "checked":''}}>
                                                            <label for="bad">بد</label><br>

                                                        </div>
                                                        <div class="form-group @if ($errors->has('question')) has-error @endif">
                                                            <label>نظر</label>
                                                            <div class="input-group mb-3">
                                                                <div class="col-lg-12">
       <textarea class="form-control btn-square" name="comment"
                 id="comment">@if(isset($question)){{$question->comment}}@endif</textarea>
                                                                </div>
                                                            </div>
                                                            <span class="text-danger" id="comment"
                                                                  style="color: red;">{{$errors->first('$question')}}</span>
                                                        </div>
                                                        <div class="card-footer">
                                                            <button class="btn btn-primary" type="submit">
                                                                ثبت
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            @endif
                                            {{--@endif--}}
                                            {{----}}


                                        </div>

                                    </div>
                                    <div class="card-footer">
                                        <a href="/dashboard/question/delete?question_id={{$question->id}}"
                                           class="btn btn-danger" type="submit">
                                            حذف سوال
                                        </a>
                                        <a

                                                href="/dashboard/question/edit/{{$question->id}} "
                                                class="btn btn-primary" type="submit">
                                            ویرایش سوال
                                        </a>
                                    </div>
                                </div>
                            </div>

                            {{--@endif--}}
                        </div>


                    @endif

                @endforeach
            </div>
@endif

        </div>
        {{--        @include('dashboard2.layout.footer')--}}

    </div>



@endsection

@section('end')

    <script src="{{("/style/assets/js/apps/mailbox-chat.js")}}"></script>
    <script src="{{("/style/assets/js/widgets/modules-widgets.js")}}"></script>

    <script src="{{("/style/assets/js/scrollspyNav.js")}}"></script>


    <script src="{{("/style/assets/js/scrollspyNav.js")}}"></script>
    <script src="{{("/style/plugins/font-icons/feather/feather.min.js")}}"></script>
    <script type="text/javascript">
        feather.replace();
    </script>

    <script>
        function firstAnswer() {
            document.getElementById("lbl_1").innerHTML = "پاسخ صحیح";
            document.getElementById("lbl_2").innerHTML = "پاسخ غلط";
            document.getElementById("lbl_3").innerHTML = "پاسخ غلط";
            document.getElementById("lbl_4").innerHTML = "پاسخ غلط";
            $('textarea[name="answer1"]').css('background-color', 'lawngreen')
            $('textarea[name="answer2"]').css('background-color', 'white')
            $('textarea[name="answer3"]').css('background-color', 'white')
            $('textarea[name="answer4"]').css('background-color', 'white')

        }

        function secondAnswer() {
            $('textarea[name="answer1"]').css('background-color', 'white')
            document.getElementById("lbl_2").innerHTML = "پاسخ صحیح";
            document.getElementById("lbl_1").innerHTML = "پاسخ غلط";
            document.getElementById("lbl_3").innerHTML = "پاسخ غلط";
            document.getElementById("lbl_4").innerHTML = "پاسخ غلط";

            $('textarea[name="answer2"]').css('background-color', 'lawngreen')
            $('textarea[name="answer3"]').css('background-color', 'white')
            $('textarea[name="answer4"]').css('background-color', 'white')

        }

        function thirdAnswer() {
            document.getElementById("lbl_3").innerHTML = "پاسخ صحیح";
            document.getElementById("lbl_2").innerHTML = "پاسخ غلط";
            document.getElementById("lbl_1").innerHTML = "پاسخ غلط";
            document.getElementById("lbl_4").innerHTML = "پاسخ غلط";
            $('textarea[name="answer1"]').css('background-color', 'white')
            $('textarea[name="answer2"]').css('background-color', 'white')
            $('textarea[name="answer3"]').css('background-color', 'lawngreen')
            $('textarea[name="answer4"]').css('background-color', 'white')
        }

        function forthAnswer() {
            document.getElementById("lbl_4").innerHTML = "پاسخ صحیح";
            document.getElementById("lbl_2").innerHTML = "پاسخ غلط";
            document.getElementById("lbl_3").innerHTML = "پاسخ غلط";
            document.getElementById("lbl_1").innerHTML = "پاسخ غلط";

            $('textarea[name="answer1"]').css('background-color', 'white')
            $('textarea[name="answer2"]').css('background-color', 'white')
            $('textarea[name="answer3"]').css('background-color', 'white')
            $('textarea[name="answer4"]').css('background-color', 'lawngreen')
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
                }
                else {
// alert("aa");
                    document.getElementById('answer' + i).style.display = "none";

                }
            }
            if (document.getElementById('texthide').innerHTML == "نمایش گزینه های کلیه سوالات") {
                document.getElementById('texthide').innerHTML = "مخفی کردن گزینه های کلیه سوالات";
            }
            else {
                document.getElementById('texthide').innerHTML = "نمایش گزینه های کلیه سوالات";
            }
        }

        function hideone(name) {
// alert(name);
            if (document.getElementById('answer' + name).style.display == "none") {
                document.getElementById('answer' + name).style.display = "block";
            }
            else {
                document.getElementById('answer' + name).style.display = "none";
            }
        }
    </script>
    <script>
        $('.ajaxStar').click(function (e) {

            var thenum = $(this).attr('href').match(/\d+/)[0];
            idName = "star" + thenum,
                // alert(idName);

                e.preventDefault(); // Prevents default link action
            $.ajax({
                url: $(this).attr('href'),
                success: function (data) {
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
