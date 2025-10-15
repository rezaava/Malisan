@extends('management.layout.master')
@section('title', 'داوری دوستان')
@section('add-styles')
@endsection
@section('main-content')
    <div class="scurvy_section_parent gradient-45deg-yellow-green padding-5 medium-small">
        <div class="row">
            <div class="col s12">
                <div id="radio-buttons" class="card card-tabs custom_survay_box">
                    <div class="card-content">
                        <div class="card-title">
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <h4 class="card-title">
                                        <div class="question_number_container">
                                            <p class="custom_survay_lable">Q</p>
                                        </div>
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('judments.post', $pageData->id) }}" method="post">
                            @csrf
                            <input type="hidden" value="{{ $pageData->type }}" name="type">
                            <div id="view-radio-buttons" class="active">
                                <p class="survay_title">
                                    {{ $pageData->content ?? '' }}
                                </p>
                                @isset($pageData->answers)
                                    @foreach ($pageData->answers as $key => $value)
                                        <div class="col l3 m4 s12">
                                            <div class="custom_answer_box_wrapper @if ($key == $pageData->bestAnswer) tru_answer @else false_answer  @endif">
                                                <div class="best_answer_title">
                                                    @if ($key == $pageData->bestAnswer)
                                                        <img class="custom_best_answer_icon"
                                                            src="{{ asset('app-assets/images/icon/true.png') }}" alt="">
                                                    @else
                                                        <img class="custom_best_answer_icon"
                                                            src="{{ asset('app-assets/images/icon/false.png') }}" alt="">
                                                    @endif
                                                </div>
                                                <div class="custom_divider @if ($key == $pageData->bestAnswer) custom_bg_success @else custom_bg_danger  @endif"></div>
                                                <div class="best_answer_content">
                                                    <strong class="@if ($key == $pageData->bestAnswer) custom_text_success @else custom_text_danger  @endif">
                                                        {{ $value }}
                                                    </strong>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endisset
                                <div class="custom_choice_container">
                                    <p class="mb-1">
                                        <label>
                                            <input name="answer" type="radio" value="true" checked="">
                                            <span>با دقت بررسی شد و اشکالی نداشت</span>
                                        </label>
                                    </p>
                                    <p class="mb-1">
                                        <label>
                                            <input name="answer" value="incorrect" type="radio">
                                            <span>متن یا سوال مشکل دارد</span>
                                        </label>
                                    </p>
                                </div>
                                <div class="submit_survay">
                                    <input type="submit"
                                        class="mb-6 btn waves-effect waves-light gradient-45deg-amber-amber gradient-shadow"
                                        value="ثبت">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection
