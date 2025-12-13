@extends('melisan.layout.master')
@section('add-styles')

    <style>


        {{--        box--}}





        {{--end box--}}
/**{*/
        /*font-size:1vw !important;*/
        /*}*/
        .base-timer {
            position: relative;
            width: 50px;
            height: 50px;
        }

        .base-timer__svg {
            transform: scaleX(-1);
        }

        .base-timer__circle {
            fill: none;
            stroke: none;
        }

        .base-timer__path-elapsed {
            stroke-width: 7px;
            stroke: grey;
        }

        .base-timer__path-remaining {
            stroke-width: 7px;
            stroke-linecap: round;
            transform: rotate(90deg);
            transform-origin: center;
            transition: 1s linear all;
            fill-rule: nonzero;
            stroke: currentColor;
        }

        .base-timer__path-remaining.green {
            color: rgb(65, 184, 131);
        }

        .base-timer__path-remaining.orange {
            color: orange;
        }

        .base-timer__path-remaining.red {
            color: red;
        }

        .base-timer__label {
            position: absolute;
            width: 50px;
            height: 50px;
            top: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
        }

    </style>

    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/pages/page-account-settings.min.css') }}">
@endsection
@section('title', 'مدیریت درس')


@if (Session::has('pageDescription'))
    @section('description')
        {!! Session::get('pageDescription') !!}

    @endsection
@endif

@section('main-content')
    <!--Social Card-->
    <div id="card-panel-type1" class="section">
        <div class="row">
            <div class=" s12 m6 l4 card-width">
                <div class=" center-align ">
                    <div class=" black-text">

                        <div class="row ">
                            <a href="#" class="col s4">
                                @if(Session::get('plus')>0)
                                    <h5 class="icon-background circle gradient-45deg-green-teal white-text z-depth-3 mx-auto">
                                        <i class="material-icons">check</i>
                                    </h5>
                                @else
                                    <h5 class="icon-background circle gradient-45deg-red-pink white-text z-depth-3 mx-auto">
                                        <i class="material-icons">close</i>
                                    </h5>
                                @endif


{{--                                <h5 class="icon-background circle gradient-45deg-indigo-blue white-text z-depth-3 mx-auto">--}}
{{--                                    <i class="fab fa-linkedin-in"></i>--}}
{{--                                </h5>--}}
                                <p class="black-text"><b>
                                        @if(Session::get('plus')>0)
                                            +{{Session::get('plus')}}
                                        @else
                                            0+
                                        @endif
                                        ریال
                                    </b></p>
                                <p class="black-text">وضعیت اخرین پاسخ</p>
                            </a>
                            <a href="#" class="col s4">
                                <h5 class="icon-background circle gradient-45deg-light-blue-cyan white-text z-depth-3 mx-auto">
                                    <i class="material-icons">
                                        account_balance_wallet
                                    </i>
                                </h5>

                                <p class="black-text"><b>{{$alls_price}} ریال</b></p>
                                <p class="black-text">درآمد کل</p>
                            </a>
                            <a href="#" class="col s4">
                                <h5 class="icon-background circle gradient-45deg-indigo-blue white-text z-depth-3 mx-auto">
                                    <i class="material-icons">card_giftcard</i>

                                </h5>
                                <p class="black-text"><b>{{$todays_price}} ریال</b></p>
                                <p class="black-text">درآمد روز</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--
    @if(Session::has('plus'))

        @if(Session::get('plus')>0)
            <div class="row" style="margin-right:10px">
                <div id="" class="card">


                    <div class="card-body">
                        <img src="{{asset('files/coins.gif')}}" alt="">
                        {{Session::get('old_aneto')}}+{{Session::get('plus')}}->{{Session::get('new_aneto')}}
            </div>

        </div>
    </div>
@endif
    @endif
    <div class="row" style="margin-right:10px">
                <div id="" class="card">


                    <div class="card-body">
                         today:
                         {{$todays_price}}
    </div>

</div>
</div>


<div class="row" style="margin-right:10px">
<div id="" class="card">


    <div class="card-body">

            all:
{{$alls_price}}
    </div>

</div>
</div>



-->





    <div class="row card card-content" style="margin:10px ;padding:20px">


        <div class="row" style="text-align: left">

        </div>
        <div id="app" style="display: inline;position: absolute;right: 0;"></div>


        <form method="post" action="/dashboard/konkor/answer/{{$question->id}}" enctype="multipart/form-data"
              id="form"
        >


            @csrf
            <h5 style="text-align:center;margin-right: 40px;margin-left:15px;


                        @if(strlen($question->question) != mb_strlen($question->question, 'utf-8'))

                        direction: rtl !important;
                    @else
                direction: ltr !important;
                @endif

                ">{{$question->question}}</h5>
            <input name="answer_id" value="" hidden>
            @foreach($rand as $rr)
                @if($rr==1)
                    <div class="col s12 m6">
                        <label>
                            <input type="radio" id="answer1" name="answer" value="1">
                            <span
                                style="height:auto !important ;line-height:110%"
                                class="mb-6 btn waves-effect waves-light gradient-45deg-light-blue-cyan gradient-shadow custom_answer_wrapper false_answer"
                                onclick="formSubmit(this);" id="1">{{ $question->answer1 }}</span>
                        </label>
                    </div>
                @elseif($rr==2)
                    <div class="col s12 m6">
                        <label>
                            <input type="radio" id="answer2" name="answer" value="2">
                            <span
                                style="height:auto !important;line-height:110%"
                                class="mb-6 btn waves-effect waves-light gradient-45deg-light-blue-cyan gradient-shadow custom_answer_wrapper false_answer"
                                onclick="formSubmit(this)" id="2">{{ $question->answer2 }}</span>
                        </label>
                    </div>
                @elseif($rr==3)
                    <div class="col s12 m6">
                        <label>
                            <input type="radio" id="answer3" name="answer" value="3">
                            <span
                                style="height:auto !important;line-height:110%"
                                class="mb-6 btn waves-effect waves-light gradient-45deg-light-blue-cyan gradient-shadow custom_answer_wrapper false_answer"
                                onclick="formSubmit(this)" id="3">{{ $question->answer3 }}</span>
                        </label>
                    </div>
                @elseif($rr==4)
                    <div class="col s12 m6">
                        <label>
                            <input type="radio" id="answer4" name="answer" value="4">
                            <span
                                style="height:auto !important;line-height:110%"
                                class="mb-6 btn waves-effect waves-light gradient-45deg-light-blue-cyan gradient-shadow custom_answer_wrapper false_answer"
                                onclick="formSubmit(this)" id="4">{{ $question->answer4 }}</span>
                        </label>
                    </div>
                @endif
            @endforeach
                            <input name="sended" style="display:none" id="sended" type="text"  >

            {{--                <div class="row">--}}
            {{--                    <button type="submit" style="width:95%"--}}
            {{--                            class="waves-effect waves-light  btn btn-block  gradient-45deg-light-blue-cyan box-shadow-none border-round mr-4 mb-1"--}}
            {{--                            onclick="this.style.display = 'none'">ارسال</button>--}}
            {{--                </div>--}}
        </form>

        <div class="col s12" style="text-align: left;width: fit-content; padding: 0 5px">
            <a onclick="onHelpClick()"
               class="mb-6 btn-floating waves-effect waves-light gradient-45deg-amber-amber gradient-shadow tooltipped"
               data-position="bottom" data-tooltip="میخوام راهنماییت کنم">
                <i class="material-icons dp48">help</i>
            </a>
        </div>


    </div>

    <div class="row">
        <iframe scrolling="no" onload="iframeLoaded()" id="idIframe" class="col-12" style="display: block;width: 100%;" src="/boxes?one={{$box1}}&two={{$box2}}&three={{$box3}}&four={{$box4}}&five={{$box5}}&id={{$course->id}}"></iframe>
    </div>


    <!-- Begin Infographic -->
    {{--    <div id="infographic">--}}
    {{--        <section class="ig_body">--}}
    {{--            <div class="row">--}}
    {{--                <div class="col s4 m4">--}}
    {{--                    <article>--}}
    {{--                        <div>--}}
    {{--                            <a href="/dashboard/konkor/box5?id={{ $course->id }}">--}}
    {{--                            جعبه 5 ({{$box5}})--}}
    {{--                                (مشاهده)--}}
    {{--                            </a>--}}
    {{--                        </div>--}}
    {{--                    </article>--}}
    {{--                </div>--}}
    {{--                <div class="col s2 m2">--}}
    {{--                    <article>--}}
    {{--                        <div>--}}
    {{--                            جعبه 4 ({{$box4}})--}}
    {{--                        </div>--}}
    {{--                    </article>--}}
    {{--                </div>--}}
    {{--                <div class="col s2 m2">--}}
    {{--                    <article>--}}
    {{--                        <div>--}}
    {{--                            جعبه 3 ({{$box3}})--}}
    {{--                        </div>--}}
    {{--                    </article>--}}
    {{--                </div>--}}
    {{--                <div class="col s2 m2">--}}
    {{--                    <article>--}}
    {{--                        <div>--}}
    {{--                            جعبه 2 ({{$box2}})--}}
    {{--                        </div>--}}
    {{--                    </article>--}}
    {{--                </div>--}}
    {{--                <div class="col s2 m2">--}}
    {{--                    <article>--}}
    {{--                        <div>--}}
    {{--                            جعبه 1 ({{$box1}})--}}
    {{--                        </div>--}}
    {{--                    </article>--}}
    {{--                </div>--}}


    {{--            </div>--}}
    {{--        </section>--}}

    {{--    </div>--}}
    <!-- End Infographic -->






    <!--



    <div class="row" style="margin-right:10px">
        <div class="col s12 m4 " id="">
            <div id="" class="card">
                <div class="card-image waves-effect waves-block waves-light">
                    <img class="activator" src="{{ asset('/files/icons/5.jpg') }}" height="100%" alt="user bg">
                </div>
                <div class="card-content">

                    <a class="btn-floating activator btn-move-up waves-effect waves-light red accent-2 z-depth-4 right"
                       href="/dashboard/konkor/box5?id={{ $course->id }}">
                        <i class="material-icons dp48">remove_red_eye</i>edit</i>
                    </a>
                    <h5 class="card-title activator grey-text text-darken-4">
                        مرور سوالات جعبه 5
                    </h5>

                </div>
            </div>
        </div>
        <div class="col s12 m4 " id="">
            <div id="" class="card">
                <div class="card-content">


                    <h4>سوالات جعبه 1:
                        {{$box1}}
    </h4>

    <h4>سوالات جعبه 2:
{{$box2}}
    </h4>
    <h4>سوالات جعبه 3:
{{$box3}}
    </h4>
    <h4>سوالات جعبه 4:
{{$box4}}
    </h4>

    <h4>سوالات جعبه 5:
{{$box5}}
    </h4>


</div>
</div>
</div>
</div>
-->
@endsection
@section('js')
    <script src="{{ asset('app-assets/js/scripts/page-account-settings.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/css-transition.js') }}"></script>

    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{ asset('app-assets/js/scripts/advance-ui-feature-discovery.min.js') }}"></script>
    <script>
        clicked = 0

        function formSubmit(elem) {
            if (clicked == 0) {
                 
                correct = {{$question->answer}};
                document.getElementById('sended').value=elem.id
                elem1=document.getElementById('1')
                elem2=document.getElementById('2')
                elem3=document.getElementById('3')
                elem4=document.getElementById('4')
                elem1.readOnly = true;
                elem2.readOnly = true;
                elem3.readOnly = true;
                elem4.readOnly = true;
                elem1.classList.remove('gradient-45deg-light-blue-cyan')
                elem2.classList.remove('gradient-45deg-light-blue-cyan')
                elem3.classList.remove('gradient-45deg-light-blue-cyan')
                elem4.classList.remove('gradient-45deg-light-blue-cyan')
                elem1.classList.add('gradient-45deg-red-pink')
                elem2.classList.add('gradient-45deg-red-pink')
                elem3.classList.add('gradient-45deg-red-pink')
                elem4.classList.add('gradient-45deg-red-pink')
                elem_correct = document.getElementById(correct);
                elem_correct.classList.remove('gradient-45deg-red-pink')
                elem_correct.classList.add('gradient-45deg-green-teal')
                clicked = 1;
                countdown()
                elem.style.backgroundColor = 'green'
                setTimeout(function () {
                    document.getElementById('form').submit();
                }, 6000);
                // document.getElementById('form').submit();

            }

        }
    </script>
    <script>
        // Credit: Mateusz Rybczonec

        function countdown() {
            const FULL_DASH_ARRAY = 283;
            const WARNING_THRESHOLD = 3;
            const ALERT_THRESHOLD = 1;

            const COLOR_CODES = {
                info: {
                    color: "green"
                },
                warning: {
                    color: "orange",
                    threshold: WARNING_THRESHOLD
                },
                alert: {
                    color: "red",
                    threshold: ALERT_THRESHOLD
                }
            };

            const TIME_LIMIT = 6;
            let timePassed = 0;
            let timeLeft = TIME_LIMIT;
            let timerInterval = null;
            let remainingPathColor = COLOR_CODES.info.color;

            document.getElementById("app").innerHTML = `
<div class="base-timer">
  <svg class="base-timer__svg" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
    <g class="base-timer__circle">
      <circle class="base-timer__path-elapsed" cx="50" cy="50" r="45"></circle>
      <path
        id="base-timer-path-remaining"
        stroke-dasharray="283"
        class="base-timer__path-remaining ${remainingPathColor}"
        d="
          M 50, 50
          m -45, 0
          a 45,45 0 1,0 90,0
          a 45,45 0 1,0 -90,0
        "
      ></path>
    </g>
  </svg>
  <span id="base-timer-label" class="base-timer__label">${formatTime(
                timeLeft
            )}</span>
</div>
`;

            startTimer();

            function onTimesUp() {
                clearInterval(timerInterval);
            }

            function startTimer() {
                timerInterval = setInterval(() => {
                    timePassed = timePassed += 1;
                    timeLeft = TIME_LIMIT - timePassed;
                    document.getElementById("base-timer-label").innerHTML = formatTime(
                        timeLeft
                    );
                    setCircleDasharray();
                    setRemainingPathColor(timeLeft);

                    if (timeLeft === 0) {
                        onTimesUp();
                    }
                }, 1000);
            }

            function formatTime(time) {
                const minutes = Math.floor(time / 60);
                let seconds = time % 60;

                if (seconds < 10) {
                    seconds = `0${seconds}`;
                }

                return `${minutes}:${seconds}`;
            }

            function setRemainingPathColor(timeLeft) {
                const {alert, warning, info} = COLOR_CODES;
                if (timeLeft <= alert.threshold) {
                    document
                        .getElementById("base-timer-path-remaining")
                        .classList.remove(warning.color);
                    document
                        .getElementById("base-timer-path-remaining")
                        .classList.add(alert.color);
                } else if (timeLeft <= warning.threshold) {
                    document
                        .getElementById("base-timer-path-remaining")
                        .classList.remove(info.color);
                    document
                        .getElementById("base-timer-path-remaining")
                        .classList.add(warning.color);
                }
            }

            function calculateTimeFraction() {
                const rawTimeFraction = timeLeft / TIME_LIMIT;
                return rawTimeFraction - (1 / TIME_LIMIT) * (1 - rawTimeFraction);
            }

            function setCircleDasharray() {
                const circleDasharray = `${(
                    calculateTimeFraction() * FULL_DASH_ARRAY
                ).toFixed(0)} 283`;
                document
                    .getElementById("base-timer-path-remaining")
                    .setAttribute("stroke-dasharray", circleDasharray);
            }
        }
    </script>
    <script type="text/javascript">
        function iframeLoaded() {
            var iFrameID = document.getElementById('idIframe');
            if(iFrameID) {
                // here you can make the height, I delete it first, then I make it again
                iFrameID.height = "";
                iFrameID.height = iFrameID.contentWindow.document.body.scrollHeight+50 + "px";
            }
        }
    </script>
@endsection
