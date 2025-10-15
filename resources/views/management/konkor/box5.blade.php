@extends('management.layout.master')
@section('add-styles')
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        @media (max-width: 600px) {
            * {
                font-size: 3vw !important;
            }
        }

    </style>
@endsection
@section('title', 'جعبه 5')
@section('main-content')

    <div class="section">
        <div class="container">

            @foreach($questions as $key => $question)



                <div class="card col s12" style="margin-bottom:6px ; padding-right: 50px">
                    <div class="card-header">
                        <div class="row">
                            <h5>
                                {{$question->question}}</h5>
                        </div>
                    </div>


                    <div class="row answers" id="answer{{$key}}" style="display: block">

                        <div class="col-md-12">
                            <div class="card-body">
                                <div class="row" style="margin-right:30px">
                                    <div class="col-md-9">
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                        @endforeach

                
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
                            $('textarea[name="answer1"]').css('background-color', '#e8f5e9')
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

                            $('textarea[name="answer2"]').css('background-color', '#e8f5e9')
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
                            $('textarea[name="answer3"]').css('background-color', '#e8f5e9')
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
                            $('textarea[name="answer4"]').css('background-color', '#e8f5e9')
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
