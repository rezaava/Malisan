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
        <div class="col-sm-12">
            <div class="row">
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#"><i data-feather="home"></i></a></li>
                                    <li class="breadcrumb-item">دروس</li>
                                    <li class="breadcrumb-item">لیست دروس</li>
                                </ol>
                            </div>
                            <div class="col-lg-6">
                                <!-- Bookmark Start-->
                                <div class="bookmark pull-right">
                                    <ul>
                                        {{--<li><a href="#" data-container="body" data-toggle="popover" data-placement="top" title="" data-original-title="Chat"><i data-feather="message-square"></i></a></li>--}}
                                        {{--<li><a href="#" data-container="body" data-toggle="popover" data-placement="top" title="" data-original-title="Icons"><i data-feather="command"></i></a></li>--}}
                                        {{--<li><a href="/dashboard/courses/sessions/create?course_id={{$course->id}}"--}}
                                        {{--data-container="body" data-toggle="popover" data-placement="top" title=""--}}
                                        {{--data-original-title="افزودن جلسه"><i data-feather="plus"></i></a></li>--}}
                                        {{--<li><a href="#"><i class="bookmark-search" data-feather="star"></i></a>--}}
                                        {{--<form class="form-inline search-form">--}}
                                        {{--<div class="form-group form-control-search">--}}
                                        {{--<input type="text" placeholder="Search..">--}}
                                        {{--</div>--}}
                                        {{--</form>--}}
                                        {{--</li>--}}
                                    </ul>
                                </div>
                                <!-- Bookmark Ends-->
                            </div>
                        </div>
                    </div>
                </div>
                {{--@if(isset($meeting->file))--}}

                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-header">
                            <div class="row">
                                <h5>{{$question->question}}
                                    (طراح:{{$question->designer->name}} {{$question->designer->family}})</h5>
                            </div>
                        </div>
                        <form method="post" action="/dashboard/quiz/question" enctype="multipart/form-data">
                            @csrf
                            <input name="answer_id" value="{{$answer->id}}" hidden>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-body" id="shufflep" style="display: none">
                                        <div class="row shuffleMe" style="margin-bottom: 10px">
                                            <input type="radio" id="answer1" name="answer" value="1">
                                            {{--<label for="answer1">1 -</label>--}}
                                            &nbsp;&nbsp;{{$question->answer1}}
                                        </div>
                                        <div class="row shuffleMe" style="margin-bottom: 10px">
                                            <input type="radio" id="answer1" name="answer" value="2">
                                            {{--<label for="answer2">2 -</label>--}}
                                            &nbsp;&nbsp;  {{$question->answer2}}
                                        </div>
                                        <div class="row shuffleMe" style="margin-bottom: 10px">
                                            <input type="radio" id="answer3" name="answer" value="3">
                                            {{--<label for="answer3">3 -</label>--}}
                                            &nbsp;&nbsp;{{$question->answer3}}
                                        </div>
                                        <div class="row shuffleMe" style="margin-bottom: 10px">
                                            <input type="radio" id="answer4" name="answer" value="4">
                                            {{--<label for="answer1">4 -</label>--}}
                                            &nbsp;&nbsp;{{$question->answer4}}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button class="btn btn-primary btn-large" style="width: 100%" type="submit">
                                    ثبت ( سوال بعد )
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
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

            <script>

            </script>

            <script>
                window.addEventListener("load", function(){

                        var container = document.getElementById("shufflep");
                        var elementsArray = Array.prototype.slice.call(container.getElementsByClassName('shuffleMe'));
                        elementsArray.forEach(function (element) {
                            container.removeChild(element);
                        });
                        shuffleArray(elementsArray);
                        elementsArray.forEach(function (element) {
                            container.appendChild(element);
                        });
                        container.style.display='block';



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

    @endpush
