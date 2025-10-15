@extends('management.layout.master')
@section('title' , 'نظرسنجی')
@section('add-styles')
    <link rel="stylesheet" href="{{ asset('app-assets/vendors/noUiSlider/nouislider.min.css') }}" type="text/css">
    @endsection
@section('main-content')
    <div class="row">
        <div class="col s12">
            <div id="select" class="card card-tabs">
                <div class="card-content">
                    <div class="card-title">
                        <div class="row">
                            <div class="col s12 m6 l10">
                                <h4 class="card-title">برگزیدن</h4>
                            </div>
                            <div class="col s12 m6 l2">
                                <ul class="tabs">
                                    <li class="tab col s6 p-0"><a class="active p-0" href="#view-select">نما</a></li>
                                    <li class="tab col s6 p-0"><a class="p-0" href="#html-select">Html</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div id="view-select">
                        <p> انتخاب اجازه می دهد تا از طریق گزینه های مشخص شده ورودی کاربر را وارد کند برای هماهنگی مناسب با سایر قسمتهای متنی ، حتماً آن را در <code class="language-markup"> .input-field </code> قرار دهید . به یاد داشته باشید
                            که این یک افزونه jQuery است بنابراین مطمئن شوید که شما
                            <a href="#select-initialization">اولیه سازی</a> این در سند شما آماده است. </p>
                        <div class="row">
                            <div class="input-field col s12">
                                <select>
                                    <option value="" disabled selected>گزینه خود را انتخاب کنید</option>
                                    <option value="1">گزینه 1</option>
                                    <option value="2">گزینه 2</option>
                                    <option value="3">گزینه 3</option>
                                </select>
                                <label>انتخاب Materialize</label>
                            </div>

                            <div class="input-field col s12">
                                <select>
                                    <optgroup label="team 1">
                                        <option value="1">گزینه 1</option>
                                        <option value="2">گزینه 2</option>
                                    </optgroup>
                                    <optgroup label="team 2">
                                        <option value="3">گزینه 3</option>
                                        <option value="4">گزینه 4</option>
                                    </optgroup>
                                </select>
                                <label>انتخاب گروه ها</label>
                            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="/app-assets/js/scripts/form-elements.min.js"></script>
@endsection
