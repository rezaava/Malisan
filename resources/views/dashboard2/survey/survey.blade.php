@extends('dashboard2.layout.app')

@section('start')

    <link href="{{ '/style/assets/css/scrollspyNav.css' }}" rel="stylesheet" type="text/css" />

@endsection
@section('main')

    <div id="content" class="main-content">
        {{-- <div class="container"> --}}
        <div class="layout-px-spacing">

            <div class="row">

                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-header">
                            <div class="row">
                                <h5> {!! $random->text !!}</h5>
                                {{-- <h5>{{$random->text}}</h5> --}}
                            </div>
                        </div>
                        <form method="post" action="/survey-answer" enctype="multipart/form-data">
                            @csrf
                            <input name="user_id" value="{{ $user->id }}" hidden>
                            <input name="random_id" value="{{ $random->id }}" hidden>
                            <input name="type" value="{{ $random->type }}" hidden>
                            @if ($random->type == 1)
                                <div class="input-group mb-3">
                                    <div class="col-lg-12">
                                        <textarea class="form-control btn-square" name="answer" minlength="3" required
                                            id="answer"></textarea>
                                    </div>
                                </div>



                            @else

                                @foreach ($random->options as $key => $item)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card-body">

                                                <div class="row " style="margin-bottom: 10px">
                                                <input @if ($random->type == '2') type="radio" @else
                                                    type="checkbox"
                                @endif
                                id="answer" @if ($random->type == '2')
                                    name="answer"
                                @else name="answer[{{ $key }}]" @endif value="{{ $item->id }}">
                                    {{-- <label for="answer1" style="margin-right: 5px"> {{$key+1}} : </label> --}}
                                    &nbsp;&nbsp;{{ $item->option }}



                    </div>
                </div>
            </div>
        </div>
        @endforeach

        @endif

        <div class="card-footer">
            <button class="btn btn-primary btn-large" style="width: 100%" type="submit">
                ثبت
            </button>
        </div>
        </form>


    </div>
    </div>
    </div>

    </div>
    </div>


@endsection

@section('end')

    <script src="{{ '/style/assets/js/scrollspyNav.js' }}"></script>

@endsection
