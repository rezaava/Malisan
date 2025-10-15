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


            @foreach($questions as $key=>$question)
                <h3>
                    {{$question->question}}<span class="text-info" style="font-size: 14px">({{($question->year)}}
                        )</span>
                </h3>
                <h6 @if($question->answer==1) class="text-success" @endif>
                    1.{{$question->answer1}}
                </h6>
                <h6 @if($question->answer==2) class="text-success" @endif>
                    2.{{$question->answer2}}
                </h6>
                <h6 @if($question->answer==3) class="text-success" @endif>
                    3.{{$question->answer3}}
                </h6>
                <h6 @if($question->answer==4) class="text-success" @endif>
                    4.{{$question->answer4}}
                </h6>
                @if($question->description)
                    <span class="text-danger" style="font-size: 14px">توضیح:{{($question->description)}}</span>
                @endif
                <div class="row">
                    <div class="col">
                        <a href="/dashboard/konkor/decline?ii={{$question->id}}" class="btn btn-block btn-danger">رد
                            سوال</a>
                    </div>
                    <div class="col">
                        <a href="/dashboard/konkor/accept?ii={{$question->id}}" class="btn btn-block btn-success">تائید
                            سوال</a>
                    </div>
                    {{--<div class="col">--}}
                        {{--<a href="/dashboard/konkor/edit?ii={{$question->id}}" class="btn btn-block btn-outline-success">ویرایش--}}
                            {{--و تائید سوال</a>--}}
                    {{--</div>--}}
                </div>
                <hr>
            @endforeach


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
