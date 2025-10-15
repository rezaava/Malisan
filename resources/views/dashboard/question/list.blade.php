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
            @include('dashboard.layout.message')

            <div class="row">
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">

                            <div class="col-lg-6">
                                @if (\Route::current()->getName() == 'bank')
                                    <h3>درس {{$course->name}}</h3>
                                @else
                                    <h3>جلسه {{$meeting->number}}</h3>
                                @endif
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
                                        <div class="bookmark pull-right">
                                            <ul>
                                                <li><a
                                                            @if (\Route::current()->getName() == 'bank')
                                                            href="/dashboard/courses/list"
                                                            @else
                                                            href="/dashboard/courses/sessions?course_id={{$course->id}}"
                                                            @endif
                                                            data-container="body" data-toggle="popover"
                                                            data-placement="top"
                                                            title="" data-original-title="بازگشت"><img
                                                                src="{{asset('/cuba-style/assets/images/arrow-left.svg')}}"></a>
                                                </li>

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

                <hr>
                @if ((!\Route::current()->getName() == 'bank' && $limit=='0')|| \Route::current()->getName() == 'editQ')
                    <div class="col-md-12">
                        <div class="row">

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form method="post"
                                              @if(\Route::current()->getName() == 'editQ')
                                              action={{"/dashboard/question/edit?question_id=".$edit->id}}
                                              @else
                                                      action={{"/dashboard/question/create?session_id=".$meeting->id}}
                                              @endif
                                                      enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group @if ($errors->has('question')) has-error @endif">
                                                <div class="row">
                                                    <label>سوال</label>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="col-lg-12">
                                            <textarea class="form-control btn-square" name="question" minlength="5"
                                                      required
                                                      id="description">@if (\Route::current()->getName() == 'editQ'){{$edit->question}}@endif</textarea>
                                                    </div>
                                                </div>
                                                <span class="text-danger" id="description"
                                                      style="color: red;">{{$errors->first('$question')}}</span>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">

                                                    <div class="form-group @if ($errors->has('answer1')) has-error @endif">
                                                        <div class="row">
                                                            <input type="radio" checked name="answer" value="1"
                                                                   id="answer1"
                                                                   onclick="firstAnswer()">
                                                            <label for="answer1">پاسخ 1</label>
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <div class="col-lg-12">
                                                         <textarea class="form-control btn-square " name="answer1"
                                                                   style="background-color: lawngreen"
                                                                   id="change2">@if (\Route::current()->getName() == 'editQ'){{$edit->answer1}}@endif</textarea>
                                                            </div>
                                                        </div>
                                                        <span class="text-danger" id="description"
                                                              style="color: red;  ">{{$errors->first('answer1')}}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">

                                                    <div class="form-group @if ($errors->has('answer2')) has-error @endif">
                                                        <div class="row">
                                                            <input type="radio" id="answer2" name="answer" value="2 "
                                                                   onclick="secondAnswer()">
                                                            <label for="answer2"> پاسخ 2</label>
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <div class="col-lg-12">
                                            <textarea class="form-control btn-square" name="answer2"
                                                      id="description">@if (\Route::current()->getName() == 'editQ'){{$edit->answer2}}@endif</textarea>
                                                            </div>
                                                        </div>
                                                        <span class="text-danger" id="description"
                                                              style="color: red;">{{$errors->first('answer2')}}</span>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">

                                                    <div class="form-group @if ($errors->has('answer3')) has-error @endif">
                                                        <div class="row">
                                                            <input type="radio" id="answer3" name="answer" value="3"
                                                                   onclick="thirdAnswer()">
                                                            <label for="answer3">پاسخ 3</label>
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <div class="col-lg-12">
                                            <textarea class="form-control btn-square" name="answer3"
                                                      id="description">@if (\Route::current()->getName() == 'editQ'){{$edit->answer3}}@endif</textarea>
                                                            </div>
                                                        </div>
                                                        <span class="text-danger" id="description"
                                                              style="color: red;">{{$errors->first('answer3')}}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">

                                                    <div class="form-group @if ($errors->has('answer4')) has-error @endif">
                                                        <div class="row">
                                                            <input type="radio" id="answer4" name="answer" value="4"
                                                                   onclick="forthAnswer()">
                                                            <label for="answer4">پاسخ 4</label>
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <div class="col-lg-12">
                                            <textarea class="form-control btn-square" name="answer4"
                                                      id="description">@if (\Route::current()->getName() == 'editQ'){{$edit->answer4}}@endif</textarea>
                                                            </div>
                                                        </div>
                                                        <span class="text-danger" id="description"
                                                              style="color: red;">{{$errors->first('answer4')}}</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card-footer">
                                                <button class="btn btn-primary" type="submit">
                                                    ثبت سوال
                                                </button>
                                            </div>
                                            @if (\Route::current()->getName() == 'editQ')
                                                <div class="card-footer">
                                                    <a href="/dashboard/question/delete?question_id={{$edit->id}}"
                                                       class="btn btn-danger" type="submit">
                                                        حذف سوال
                                                    </a>
                                                </div>
                                            @endif
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif




                @foreach($questions as $question)
                    @if (!\Route::current()->getName() == 'bank' || $question->status)
                        <div class="card col-12">
                            <div class="card-header">
                                <div class="row">
                                    <h5>{{$question->question}}</h5>  <span
                                            style="font-size: 10px"> ({{$question->user->name}}
                                        ) </span>
                                </div>

                                @if(isset($question->status))
                                    @if($question->status =='1' ||$question->status =='2')

                                        <label>سطح سوال : {{$question->level}} <span style="color: green">از این سوال در آزمون ها استفاده شده است</span>
                                        </label>
                                    @else
                                        <label>سطح سوال : {{$question->level}} <span style="color: red">از این سوال در آزمون ها استفاده نشده است</span>
                                        </label>
                                    @endif
                                @endif
                            </div>
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="card-body">
                                        <div class="row">
                                            @if(Laratrust::hasRole('nothing'))


                                                <div class="col-md-9">
                                                    @else
                                                        <div class="col-md-12">

                                                            @endif
                                                            <div class="row"
                                                                 style="@if($question->answer==1)color: forestgreen; @endif margin-bottom: 10px">
                                                                1.{{$question->answer1}}
                                                            </div>
                                                            <div class="row"
                                                                 style="@if($question->answer==2)color: forestgreen; @endif margin-bottom: 10px">
                                                                2.{{$question->answer2}}
                                                            </div>
                                                            <div class="row"
                                                                 style="@if($question->answer==3)color: forestgreen; @endif margin-bottom: 10px ">
                                                                3.{{$question->answer3}}
                                                            </div>
                                                            <div class="row"
                                                                 style="@if($question->answer==4)color: forestgreen; @endif margin-bottom: 10px">
                                                                4.{{$question->answer4}}
                                                            </div>
                                                        </div>
                                                        @if(Laratrust::hasRole('nothing'))
                                                            <div class=" col-md-3">
                                                                <form method="post"
                                                                      action="{{"/dashboard/question/scoring?question_id=".$question->id}}"
                                                                      enctype="multipart/form-data">
                                                                    @csrf
                                                                    <label>امتیاز</label>
                                                                    <div class="col">

                                                                        <input type="radio" id="awli" name="score"
                                                                               value="1" {{$question->status == 1 ? "checked":''}}>
                                                                        <label for="awli">عالی</label><br>
                                                                        <input type="radio" id="khob" name="score"
                                                                               value="2" {{$question->status == 2 ? "checked":''}}>
                                                                        <label for="khob">خوب</label><br>
                                                                        <input type="radio" id="motevaset" name="score"
                                                                               value="3" {{$question->status == 3 ? "checked":''}}>
                                                                        <label for="motevaset">متوسط</label><br>
                                                                        <input type="radio" id="bad" name="score"
                                                                               value="4" {{$question->status == 4 ? "checked":''}}>
                                                                        <label for="bad">بد</label><br>

                                                                    </div>
                                                                    <div class="form-group @if ($errors->has('question')) has-error @endif">
                                                                        <label>نظر</label>
                                                                        <div class="input-group mb-3">
                                                                            <div class="col-lg-12">
                                            <textarea class="form-control btn-square" name="comment"
                                                      id="comment">@if(isset($question)){{$question->comment}}@endif</textarea>
                                                                            </div>
                                                                        </div>
                                                                        <span class="text-danger" id="comment"
                                                                              style="color: red;">{{$errors->first('$question')}}</span>
                                                                    </div>
                                                                    <div class="card-footer">
                                                                        <button class="btn btn-primary" type="submit">
                                                                            ثبت
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        @endif
                                                </div>

                                        </div>
                                        <div class="card-footer">
                                            <a href="/dashboard/question/delete?question_id={{$question->id}}"
                                               class="btn btn-danger" type="submit">
                                                حذف سوال
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                {{--@endif--}}
                            </div>
                        </div>
                    @endif

                @endforeach

                {{--                        @if (!\Route::current()->getName() == 'bank' )--}}


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

                function firstAnswer() {
                    $('textarea[name="answer1"]').css('background-color', 'lawngreen')
                    $('textarea[name="answer2"]').css('background-color', 'white')
                    $('textarea[name="answer3"]').css('background-color', 'white')
                    $('textarea[name="answer4"]').css('background-color', 'white')

                }

                function secondAnswer() {
                    $('textarea[name="answer1"]').css('background-color', 'white')
                    $('textarea[name="answer2"]').css('background-color', 'lawngreen')
                    $('textarea[name="answer3"]').css('background-color', 'white')
                    $('textarea[name="answer4"]').css('background-color', 'white')

                }

                function thirdAnswer() {
                    $('textarea[name="answer1"]').css('background-color', 'white')
                    $('textarea[name="answer2"]').css('background-color', 'white')
                    $('textarea[name="answer3"]').css('background-color', 'lawngreen')
                    $('textarea[name="answer4"]').css('background-color', 'white')
                }

                function forthAnswer() {
                    $('textarea[name="answer1"]').css('background-color', 'white')
                    $('textarea[name="answer2"]').css('background-color', 'white')
                    $('textarea[name="answer3"]').css('background-color', 'white')
                    $('textarea[name="answer4"]').css('background-color', 'lawngreen')
                }

            </script>
    @endpush
