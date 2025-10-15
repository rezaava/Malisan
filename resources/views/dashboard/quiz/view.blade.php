@extends('dashboard.layout.app')
@section('title','صفحه نمایش دوره')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('/cuba-style/assets/css/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/cuba-style/assets/css/owlcarousel.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/cuba-style/assets/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/cuba-style/assets/css/responsive.css')}}">
@endpush
@section('content')
    <div class="row">
        @include('dashboard.layout.message')

        <div class="col-sm-12">
            <div class="row">
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#"><i data-feather="home"></i></a></li>
                                    <li class="breadcrumb-item">نتیجه امتحان</li>
                                    <li class="breadcrumb-item"></li>
                                </ol>
                            </div>
                            <div class="col-lg-6">
                                <!-- Bookmark Start-->
                                <div class="bookmark pull-right">
                                    <ul>
                                        <div class="bookmark pull-right">
                                            <ul>

                                                <li><a href="{{ url()->previous()}}" data-container="body" data-toggle="popover" data-placement="top" title="" data-original-title="بازگشت"><img src="{{asset('/cuba-style/assets/images/arrow-left.svg')}}"></a></li>

                                            </ul>
                                        </div>
                                    </ul>
                                </div>
                                <!-- Bookmark Ends-->
                            </div>
                        </div>
                    </div>
                </div>
                {{--@if(isset($meeting->file))--}}

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

                {{--@endif--}}
            </div>
        </div>

    </div>


@endsection

@push('scripts')
    <script src="{{asset('/cuba-style/assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/cuba-style/assets/js/rating/jquery.barrating.js')}}"></script>
    <script src="{{asset('/cuba-style/assets/js/owlcarousel/owl.carousel.js')}}"></script>
    <script src="{{asset('/cuba-style/assets/js/ecommerce.js')}}"></script>
    <script src="{{asset('/cuba-style/assets/js/product-list-custom.js')}}"></script>
    <script src="{{asset('/cuba-style/assets/js/tooltip-init.js')}}"></script>


@endpush
