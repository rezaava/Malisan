@extends('dashboard2.layout.app')

@section('start')

    <link href="{{("/style/assets/css/scrollspyNav.css")}}" rel="stylesheet" type="text/css" />

@endsection
@section('main')

    <div id="content" class="main-content">
        {{--<div class="container">--}}


                <div class="row">


                    <div class="col-lg-12 col-12  layout-spacing">
                        @foreach($questions as $question)

                            <div class="card col-12">
                                <div class="card-header">
                                    <div class="row">
                                        <h5>{{$question->question}}</h5>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="col-md-12">
                                        <div class="row"
                                             style="@if($question->answer==1)color: forestgreen; @elseif($question->user_answer->answer=='1') color: red; @endif margin-bottom: 10px">
                                            1.{{$question->answer1}}
                                        </div>
                                        <div class="row"
                                             style=" @if($question->answer==2)color: forestgreen; @elseif($question->user_answer->answer=='2') color: red;  @endif margin-bottom: 10px">
                                            2.{{$question->answer2}}
                                        </div>
                                        <div class="row"
                                             style=" @if($question->answer==3)color: forestgreen; @elseif($question->user_answer->answer=='3') color: red;  @endif margin-bottom: 10px ">
                                            3.{{$question->answer3}}
                                        </div>
                                        <div class="row"
                                             style=" @if($question->answer==4)color: forestgreen; @elseif($question->user_answer->answer=='4') color: red;  @endif margin-bottom: 10px">
                                            4.{{$question->answer4}}
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>


                </div>

        @include('dashboard2.layout.footer')

    </div>


@endsection

@section('end')

    <script src="{{("/style/assets/js/scrollspyNav.js")}}"></script>

@endsection
