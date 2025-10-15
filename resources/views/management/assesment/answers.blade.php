@extends('management.layout.master')
@section('styles')
@endsection
@section('title', 'نتیجه خودآزمایی')
@section('main-content')
    <div class="row">
        @foreach ($questions as $question)
            <div class="row custom_answers_card_wrapper">
                <div class="col s12 m8 m-auto">
                    <div class="card row gradient-45deg-purple-deep-purple gradient-shadow white-text padding-4 mt-5">
                        <div class="col s9 m9 left-align">
                            <div class="row mb-5">
                                <strong class="custom_answers_wrapper">
                                    <i class="material-icons dp48 mr-2" style="height:auto !important">radio_button_checked</i>
                                    {{ $question->question }}
                                </strong>
                            </div>
                            <div class="col s12 m6">
                                <li  style="height:auto !important;line-height:110%" class="mb-6 btn waves-effect waves-light @if ($question->answer == 1) gradient-45deg-green-teal @elseif($question->user_answer->answer=='1') gradient-45deg-red-pink @else  gradient-45deg-light-blue-indigo  @endif gradient-shadow">
                                    1.{{ $question->answer1 }}
                                </li>
                            </div>

                            <div class="col s12 m6">
                                <li style="height:auto !important;line-height:110%" class="mb-6 btn waves-effect waves-light @if ($question->answer == 2) gradient-45deg-green-teal @elseif($question->user_answer->answer=='2') gradient-45deg-red-pink @else  gradient-45deg-light-blue-indigo  @endif gradient-shadow">
                                    2.{{ $question->answer2 }}</li>
                            </div>

                            <div class="col s12 m6">
                                <li style="height:auto !important;line-height:110%" class="mb-6 btn waves-effect @if ($question->answer == 3) gradient-45deg-green-teal @elseif($question->user_answer->answer=='3') gradient-45deg-red-pink @else  gradient-45deg-light-blue-indigo  @endif gradient-shadow">
                                    3.{{ $question->answer3 }}
                                </li>
                            </div>

                            <div class="col s12 m6">
                                <li style="height:auto !important;line-height:110%" class="mb-6 btn waves-effect @if ($question->answer == 4) gradient-45deg-green-teal @elseif($question->user_answer->answer=='4') gradient-45deg-red-pink @else  gradient-45deg-light-blue-indigo  @endif gradient-shadow">
                                    4.{{ $question->answer4 }}
                                </li>
                            </div>
                        </div>
                        <div class="col s3 m3 center-align">
                            <i class="material-icons background-round mt-5 mb-5">attach_money</i>
                        </div>
                    </div>

                </div>
                
            </div>
        @endforeach
                            <a href="/dashboard/courses/sessions?course_id={{$course->id}}" class="waves-effect waves-light btn-small">
                        بازگشت به درس</a>
                         <a href="/dashboard/quiz?course_id={{ $course->id }}" class="waves-effect waves-light btn-small">
                        برگذاری مجدد آزمون
                        </a>
    </div>
@endsection
