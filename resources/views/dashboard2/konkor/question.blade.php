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


        <div class="layout-px-spacing" style="margin-bottom: -300px">

            <div class="row">

                    <div class="col-md-12">
                        <div class="row">

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form method="post"
{{--                                              @if(\Route::current()->getName() == 'editQ')--}}
                                              {{--action={{"/dashboard/question/edit?question_id=".$edit->id}}--}}
                                              {{--@else--}}
                                                      action={{"/dashboard/konkor/question?ii=".$konkor->id}}
                                              {{--@endif--}}
                                                      enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group @if ($errors->has('question')) has-error @endif">
                                                <div class="row">
                                                    <h5>سوال</h5>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="col-lg-12">
                                            <textarea class="form-control btn-square" name="question" minlength="5"
                                                      required
                                                      id="description">
{{--                                                @if (\Route::current()->getName() == 'editQ'){{$edit->question}}@endif--}}
                                            </textarea>
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
                                                                   id="change2">
                                                             {{--@if (\Route::current()->getName() == 'editQ'){{$edit->answer1}}@endif--}}
                                                         </textarea>
                                                            </div>
                                                        </div>
                                                        <span class="text-danger" id="description"
                                                              style="color: red;  ">{{$errors->first('answer1')}}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">

                                                    <div class="form-group @if ($errors->has('answer2')) has-error @endif">
                                                        <div class="row">
                                                            <input type="radio" id="answer2" name="answer" value="2 "
                                                                   onclick="secondAnswer()">
                                                            <label id="lbl_2" for="answer2"> پاسخ غلط</label>
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <div class="col-lg-12">
                                            <textarea class="form-control btn-square" name="answer2"
                                                      id="description">
                                                {{--@if (\Route::current()->getName() == 'editQ'){{$edit->answer2}}@endif--}}
                                            </textarea>
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
                                                      id="description">
                                                {{--@if (\Route::current()->getName() == 'editQ'){{$edit->answer3}}@endif--}}
                                            </textarea>
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
                                                      id="description">
{{--                                                @if (\Route::current()->getName() == 'editQ'){{$edit->answer4}}@endif--}}
                                            </textarea>
                                                            </div>
                                                        </div>
                                                        <span class="text-danger" id="description"
                                                              style="color: red;">{{$errors->first('answer4')}}</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-3">
                                                <div class="form-group m-form__group @if ($errors->has('name')) has-error @endif">
                                                    <label>سال</label>
                                                    <div class="input-group mb-3">
                                                        <input class="form-control" name="year"
                                                               type="text" required
                                                               placeholder="سال">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">

                                            <div class="form-group @if ($errors->has('answer1')) has-error @endif">

                                                <div class="input-group mb-3">
                                                    <div class="col-lg-12">
                                                        <label for="descr" id="lbl_1">توضیح</label>

                                                        <textarea class="form-control btn-square " name="desc"
                                                                   style="background-color: lightblue"
                                                                   id="descr">
                                                             {{--@if (\Route::current()->getName() == 'editQ'){{$edit->answer1}}@endif--}}
                                                         </textarea>
                                                    </div>
                                                </div>
                                                <span class="text-danger" id="description"
                                                      style="color: red;  ">{{$errors->first('answer1')}}</span>
                                            </div>
                                            </div>

                                            <div class="card-footer">
                                                {{--@if (\Route::current()->getName() == 'editQ')--}}
                                                    {{--<a href="/dashboard/question/delete?question_id={{$edit->id}}"--}}
                                                       {{--class="btn btn-danger" type="submit"--}}
                                                       {{--onclick="return confirm('آیا با حذف سوال موافق هستید؟  ')"--}}
                                                    {{-->--}}
                                                        {{--حذف سوال--}}
                                                    {{--</a>--}}
                                                {{--@endif--}}
                                                <button class="btn btn-primary btn-block" type="submit">
                                                    {{--@if(\Route::current()->getName() == 'editQ')--}}
                                                        {{--ویرایش سوال--}}
                                                    {{--@else--}}
                                                        ثبت سوال
                                                    {{--@endif--}}
                                                </button>

                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

            </div>



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
