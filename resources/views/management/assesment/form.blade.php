@extends('management.layout.master')
@section('styles')
@endsection
@section('title', 'نظرسنجی')
@section('main-content')
    <div class="row" id="soal">
        <div class="col s12 m12 l12 card-width">
            <div class="card card-border center-align gradient-45deg-blue-grey-blue">
                <div class="card-content white-text">
                    <div class="col s12">
                        <div class="custom_queiz_answer_container">
                            <!--<p>-->
                            <!--    {{ $end }}-->
                            <!--    <i class="material-icons right">favorite</i>-->
                            <!--</p>-->
                            <p>
                                {{ $num }}/{{ $question_count }}
                                <i class="material-icons  ">done_outline</i>
                            </p>
                        </div>
                    </div>
                    <div class="row d-flex w-100">

                        <strong class="w-100 f-normal p-2">
                            {{ $question->question }}
                        </strong>

                    </div>
                    <div class="row mt-5 center-align">
                        <form method="post" action="/dashboard/quiz/question#soal" enctype="multipart/form-data">
                            @csrf
                            <input name="answer_id" value="{{ $answer->id }}" hidden>
                            <div class="col s12 m6">
                                <label>
                                    <input type="radio" id="answer1" name="answer" value="1">
                                    <span
                                    style="height:auto !important ;line-height:110%"
                                        class="mb-6 btn waves-effect waves-light gradient-45deg-red-pink gradient-shadow custom_answer_wrapper false_answer"
                                        onclick="handleClickAnswer(event)">{{ $question->answer1 }}</span>
                                </label>
                            </div>
                            <div class="col s12 m6">
                                <label>
                                    <input type="radio" id="answer2" name="answer" value="2">
                                    <span 
                                    style="height:auto !important;line-height:110%"
                                        class="mb-6 btn waves-effect waves-light gradient-45deg-red-pink gradient-shadow custom_answer_wrapper false_answer"
                                        onclick="handleClickAnswer(event)">{{ $question->answer2 }}</span>
                                </label>
                            </div>

                            <div class="col s12 m6">
                                <label>
                                    <input type="radio" id="answer3" name="answer" value="3">
                                    <span
                                    style="height:auto !important;line-height:110%"
                                        class="mb-6 btn waves-effect waves-light gradient-45deg-red-pink gradient-shadow custom_answer_wrapper false_answer"
                                        onclick="handleClickAnswer(event)">{{ $question->answer3 }}</span>
                                </label>
                            </div>
                            <div class="col s12 m6">
                                <label>
                                    <input type="radio" id="answer4" name="answer" value="4">
                                    <span
                                    style="height:auto !important;line-height:110%"
                                        class="mb-6 btn waves-effect waves-light gradient-45deg-red-pink gradient-shadow custom_answer_wrapper false_answer"
                                        onclick="handleClickAnswer(event)">{{ $question->answer4 }}</span>
                                </label>
                            </div>
                            <div class="row">
                                <button type="submit"
                                    class="waves-effect waves-light  btn gradient-45deg-light-blue-cyan box-shadow-none border-round mr-1 mb-1"
                                    onclick="this.style.display = 'none'">ارسال</button>
                            </div>
                        </form>
                        <p class="mt-1">
                            طراح سوال دوست عزیز : {{ $question->designer->name }} {{ $question->designer->family }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function handleClickAnswer(e) {
            $('.false_answer').removeClass(
                'mb-6 btn waves-effect waves-light gradient-45deg-green-teal gradient-shadow custom_answer_wrapper');
            $('.false_answer').addClass(
                'mb-6 btn waves-effect waves-light gradient-45deg-red-pink gradient-shadow custom_answer_wrapper');

            $(e.target).addClass(
                ' gradient-45deg-green-teal ');
            $(e.target).removeClass(
                ' gradient-45deg-red-pink ');
        }
    </script>
@endsection
