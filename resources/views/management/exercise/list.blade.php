@extends('management.layout.master')
@section('add_styles')
@endsection
@section('title', 'تکلیف ها')
@section('main-content')

    @if(\Route::current()->getName() != 'editQ')
        <div class="row">

            @foreach($tamrinha as $key => $tamrin)
                    <div class="card col-12" style="margin-bottom:6px ; padding-right: 50px">

                        <h6 class="pt-3">{!!$tamrin->text!!}</h6>

                        <div class="row">
                            @foreach($tamrin['answers'] as $answer)
                                <p class="text-danager">پاسخ {{$answer->user->name}} {{$answer->user->family}} :</p>
                                <p>{!!$answer->answer!!}</p>
                            @if($answer->file)
                                    <a class="btn btn-dark" href="{{ URL::to('/files/answer' . $answer->file) }}" target="_blank">
                                        دانلود پیوست
                                    </a>
                                @endif
                                <hr>
                            @endforeach
                        </div>
                        <hr>
                     


</div>

            @endforeach
        </div>

    @endif
@endsection
@section('js')
    <script src="{{("/style/assets/js/apps/mailbox-chat.js")}}"></script>
    <script src="{{("/style/assets/js/widgets/modules-widgets.js")}}"></script>

    <script src="{{("/style/assets/js/scrollspyNav.js")}}"></script>


    <script src="{{("/style/assets/js/scrollspyNav.js")}}"></script>
    <script src="{{("/style/plugins/font-icons/feather/feather.min.js")}}"></script>
    <script type="text/javascript">
        feather.replace();
    </script>


@endsection
