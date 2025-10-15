@extends('dashboard2.layout.app')

@section('start')

    <link href="{{("/style/assets/css/scrollspyNav.css")}}" rel="stylesheet" type="text/css" />

@endsection
@section('main')

    <div id="content" class="main-content">
        <div class="layout-px-spacing">

            {{--<div class="page-header">--}}
                {{--<div class="page-title">--}}
                    {{--<h3>لیست خود آزمایی ها</h3>--}}
                {{--</div>--}}
            {{--</div>--}}

            <div class="row layout-spacing">
                <div class="col-lg-12">
                    <div class="statbox widget box box-shadow">
                        {{--<div class="widget-header">--}}
                            {{--<div class="row">--}}
                                {{--<div class="col-xl-12 col-md-12 col-sm-12 col-12">--}}
                                    {{--<h4>{{$course->name}}</h4>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        <div class="widget-content widget-content-area">
                            <div class="table-responsive mb-4">
                                <table id="style-3" class="table style-3  table-hover">
                                    <thead>
                                    <tr>
                                        <th class="checkbox-column text-center"> ردیف </th>
                                        <th class="text-center">شناسه</th>
                                        <th class="text-center">نمره</th>
                                        <th class="text-center">مشاهده</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($quizzes as $key=>$quiz)
                                        <tr>
                                            <td class="checkbox-column text-center"> {{$key+1}}</td>
                                            <td class="text-center">{{$quiz->id}}</td>
                                            <td class="text-center">{{$quiz->score}}</td>
                                            <td class="text-center">
                                                <a href="/dashboard/quiz/view?quiz_id={{$quiz->id}}"
                                                   class="btn btn-success btn-sm">مشاهده ( {{$quiz->count}} )</a>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        @include('dashboard2.layout.footer')


    </div>


@endsection

@section('end')

    <script src="{{("/style/assets/js/scrollspyNav.js")}}"></script>

@endsection
