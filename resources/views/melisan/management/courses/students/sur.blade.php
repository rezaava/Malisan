
@extends('melisan.layoutStudent.master')
@section('styles')
    <!-- <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/ionRangeSlider/css/ion.rangeSlider.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/ionRangeSlider/css/ion.rangeSlider.skinFlat.css') }}"> -->
       <style>
        #menu{
            display: null;
        }
       </style>
@endsection
@section('title', 'نظرسنجی')
@section('main-content')
    <div class="col s12">
        <div id="html-validations" class="card card-tabs">
            <div class="card-content">
                <div class="card-title">
                    <div class="row">
                        <div class="col s12 m6 l10">
                            <h4 class="card-title">{!! $random->text !!}</h4>
                        </div>
                        <div class="col s12 m6 l2">
                        </div>
                    </div>
                </div>
                <form method="post" action="{{ route('survey.answer') }}">
                    @csrf
                    <input name="user_id" value="{{ $user->id }}" hidden>
                    <input name="random_id" value="{{ $random->id }}" hidden>
                    <input name="type" value="{{ $random->type }}" hidden>
                    <div class="row">
                        <div class="col s12">
                            @if ($random->type == 1)
                                @include('management.users.students.servays.survay-textarea')
                            @else
                                @include('management.users.students.servays.survay-radio')
                            @endif

                            <div class="input-field">
                            </div>
                        </div>
                        <div class="input-field col s12">
                            <button class="btn waves-effect waves-light right iransans" type="submit" name="action">ارسال
                                <i class="material-icons right custom-send-material-icon">send</i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection