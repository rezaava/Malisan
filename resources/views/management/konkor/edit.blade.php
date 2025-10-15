@extends('management.layout.master')
@section('add-styles')

    <script>
        $ex_c = 0;
    </script>

@endsection
@section('title', 'دانشجویان درس')
@section('main-content')

    <div class="row">

        <div class="col-md-12">
            <div class="row">

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12" style="margin-right:10%;margin-left:5%;margin-top:10%">
                            <form method="post"
                                  {{--                                              @if(\Route::current()->getName() == 'editQ')--}}
                                  {{--action={{"/dashboard/question/edit?question_id=".$edit->id}}--}}
                                  {{--@else--}}
                                  action={{"/dashboard/konkor/question/edit/".$q->id}}
                                              {{--@endif--}}
                                                      enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="row">
                                        <div class="row p-5">


                                            <div class="row">
                                                <h5>سوال</h5>
                                            </div>
                                            <div class="input-group mb-3">
                                                <div class="col-lg-12">
                                            <textarea class="materialize-textarea" name="question" minlength="5"
                                                      required
                                                      id="description">{{$q->question}}</textarea>


                                                    <p class="mb-1">
                                                        <label>
                                                            <input name="answer" type="radio" checked name="answer"
                                                                   value="1"
                                                                   id="answer1"
                                                                   onclick="firstAnswer()">
                                                            <span id="lbl_1">پاسخ صحیح</span>
                                                        </label>
                                                        <textarea id="textarea2"
                                                                  class="materialize-textarea" id="change2"
                                                                  name="answer1">{{$q->answer1}}</textarea>
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
                                                            id="description">{{$q->answer2}}</textarea>
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
                                                                  id="description">{{$q->answer3}}</textarea>
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
                                                                  id="description">{{$q->answer4}}</textarea>
                                                    </p>
                                                </div>
                                                <div class="card-footer">

                                                    <button class="btn btn-primary" type="submit">

                                                            ویرایش سوال

                                                    </button>

                                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('js')

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
