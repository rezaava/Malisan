@extends('dashboard2.layout.app')

@section('start')

    <link href="{{ '/style/assets/css/scrollspyNav.css' }}" rel="stylesheet" type="text/css" />

@endsection
@section('main')

    <div id="content" class="main-content">
        {{-- <div class="container"> --}}




        <div class="col-md-12">
            @if ($end != 0)
                <label>
                    <h5>
                        زمان پایان : {{ $end }}
                    </h5>
                    <br>
                </label>
            @endif
            <label>
                <h6>
                    {{ $num }}/{{ $question_count }}
                </h6>
            </label>
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <h5>
                            {{ $question->question }}
                            (طراح:{{ $question->designer->name }} {{ $question->designer->family }})</h5>
                    </div>
                </div>
                <form method="post" action="/dashboard/quiz/question" enctype="multipart/form-data">
                    @csrf
                    <input name="answer_id" value="{{ $answer->id }}" hidden>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-body">
                                <div class="row shuffleMe">
                                    <input type="radio" id="answer1" name="answer" value="1">
                                    &nbsp;&nbsp;{{ $question->answer1 }}
                                </div>
                                <div class="row shuffleMe">
                                    <input type="radio" id="answer2" name="answer" value="2">
                                    &nbsp;&nbsp; {{ $question->answer2 }}
                                </div>
                                <div class="row shuffleMe">
                                    <input type="radio" id="answer3" name="answer" value="3">

                                    &nbsp;&nbsp;{{ $question->answer3 }}
                                </div>
                                <div class="row shuffleMe">
                                    <input type="radio" id="answer4" name="answer" value="4">
                                    &nbsp;&nbsp;{{ $question->answer4 }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button class="btn btn-primary btn-large" style="width: 100%" type="submit"
                            onclick="this.style.display = 'none'">
                            ثبت ( سوال بعد )
                        </button>
                    </div>
                </form>
            </div>
        </div>



        @include('dashboard2.layout.footer')

    </div>


@endsection

@section('end')

    <script src="{{ '/style/assets/js/scrollspyNav.js' }}"></script>
    <script>
        window.addEventListener("load", function() {

            var container = document.getElementById("shufflep");
            var elementsArray = Array.prototype.slice.call(container.getElementsByClassName('shuffleMe'));
            elementsArray.forEach(function(element) {
                container.removeChild(element);
            });
            shuffleArray(elementsArray);
            elementsArray.forEach(function(element) {
                container.appendChild(element);
            });
            container.style.display = 'block';



        });

        function shuffleArray(array) {
            for (var i = array.length - 1; i > 0; i--) {
                var j = Math.floor(Math.random() * (i + 1));
                var temp = array[i];
                array[i] = array[j];
                array[j] = temp;
            }
            return array;
        }
    </script>
@endsection
