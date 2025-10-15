@extends('management.layout.master')
@section('add-styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/pages/page-account-settings.min.css') }}">
@endsection
@section('title', 'ارزیابی')
@section('main-content')
    <div class="row">
        <div class="col s12 m12 l12">
            <div id="swipeable-tabs" class="card card card-default scrollspy">
                <div class="card-content">
                    <h4 class="header">میخوام یه آمار از عملکردت بهت بدم</h4>
                    @include('management.evaluation.question')
                    <div class="row d-flex">
                        <div class="col s12">
                            <ul id="tabs-swipe-demo" class="tabs">
                                <li class="tab col m4">
                                    <a href="#test-swipe-1" class="custom-main-tab-link">
                                        <i class="material-icons dp48">question_answer</i>
                                        @if (Laratrust::hasRole('teacher'))
                                            سوالات({{ $q_not }})
                                        @else
                                            سوالات
                                        @endif
                                    </a>
                                </li>
                                <li class="tab col m4">
                                    <a class="custom-main-tab-link" href="#test-swipe-2">
                                        <i class="material-icons dp48">record_voice_over</i>
                                        @if (Laratrust::hasRole('teacher'))
                                            گزارش({{ $d_not }})
                                        @else
                                            گزارش
                                        @endif
                                    </a>
                                </li>
                                <li class="tab col m4">
                                    <a href="#test-swipe-3" class="active custom-main-tab-link">
                                        <i class="material-icons dp48">work</i>
                                        @if (Laratrust::hasRole('teacher'))
                                            تکلیف({{ $e_not }})
                                        @else
                                            تکلیف
                                        @endif
                                    </a>
                                </li>
                                <li class="indicator" style="left: 15px; right: 1039px;"></li>
                            </ul>
                            <div class="tabs-content carousel carousel-slider">
                                <div id="test-swipe-1" class="col s12 carousel carousel-item white-text"
                                    style="z-index: -1; opacity: 0.058505; visibility: visible; transform: translateX(0px) translateX(-2257.6px) translateZ(0px);">
                                    <div class="col s12 mt-1"></div>
                                    
                                </div>
                                <div id="test-swipe-2" class="col s12 carousel carousel-item red white-text"
                                    style="transform: translateX(0px) translateX(-1535px) translateZ(0px); z-index: -1; opacity: 1; visibility: visible;">
                                    <div class="col s12 mt-1"></div>
                                    تست ۲
                                </div>
                                <div id="test-swipe-3" class="col s12 carousel carousel-item green white-text active"
                                    style="transform: translateX(0px) translateX(0px) translateX(0px) translateZ(0px); z-index: 0; opacity: 1; visibility: visible;">
                                    <div class="col s12 mt-1"></div>
                                    تست ۳
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('app-assets/js/scripts/page-account-settings.min.js') }}"></script>
@endsection
