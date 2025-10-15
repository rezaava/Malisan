@extends('management.layout.master')
@section('add_styles')
@endsection
@section('title', 'نظرسنجی')
@section('main-content')


    @foreach($kholaseha as $key => $kholase)

        <div class="row">
            <div class="col-2">
            </div>
            <div class="card col-8" style="margin-bottom:6px ; padding-right: 50px">

                <div class="row " >

                    <div class="col-md-2">
                    </div>
                    <div class="col-md-8 " style="margin-right: 40px;margin-left: 50px">
                        <div class="card-body">
<span class="text-danger" style="color: red !important;">
                            {{$kholase['user']->name}}  {{$kholase['user']->family}}({{$kholase['session']->name}})
                           </span> <hr>
                            {{--@endif--}}
                             {!! $kholase->text !!}


                        </div>
                    </div>

                    <div class="col-md-2">
                    </div>
                </div>


            </div>
            <div class="col-2">
            </div>
        </div>

            @endforeach

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
