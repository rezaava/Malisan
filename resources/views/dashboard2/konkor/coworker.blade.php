@extends('dashboard2.layout.app')

@section('start')

    <link href="{{("/style/plugins/drag-and-drop/dragula/dragula.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{("/style/plugins/drag-and-drop/dragula/example.css")}}" rel="stylesheet" type="text/css"/>

@endsection
@section('main')

    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            @include('dashboard.layout.message')

            @if(Laratrust::hasRole("admin"))
                <div class="row">

                    <div class="page-header">
                        <div class="page-title">
                            <h3>افزودن همکار</h3>
                        </div>
                    </div>
                    <div class="col-lg-12 col-12  layout-spacing">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <form method="post"
                                                      action="/dashboard/konkor/coworker/{{$konkor->id}}"
                                                      enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group m-form__group @if ($errors->has('name')) has-error @endif">
                                                                <label>کد ملی</label>
                                                                <div class="input-group mb-3">
                                                                    <input class="form-control" name="national"
                                                                           type="text" required
                                                                           placeholder="کد ملی">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="card-footer">
                                                        <button class="btn btn-primary btn-block" type="submit"
                                                                id="upload_btn"
                                                                onclick="deactive('upload_btn')">
                                                            افزودن
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>


                </div>
            @endif


            <div class="row" id="cancel-row">

                <div class="col-lg-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <table id="zero-config" class="table table-responsive style-3  table-hover">
                                <thead>
                                <tr>
                                    <th class="text-center">کد ملی</th>
                                    <th class="text-center">نام</th>
                                    <th class="text-center">مقطع</th>
                                    <th class="text-center">حذف</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($coworkers as $key=>$coworker)
                                    <tr>
                                        <td class=" text-center"> {{$coworker['user']->national}}</td>
                                        <td class=" text-center"> {{$coworker['user']->name." ".$coworker['user']->family}}</td>
                                        <td class=" text-center"> {{$coworker['user']->degree}}</td>
                                        <td class=" text-center">
                                            <a href="/dashboard/konkor/coworker-delete/{{$konkor->id}}/{{$coworker['user']->id}}" class="btn btn-block btn-danger">حذف</a>
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
        @include('dashboard2.layout.footer')

    </div>

@endsection

@section('end')

    <script src="{{("/style/plugins/drag-and-drop/dragula/dragula.min.js")}}"></script>
    <script src="{{("/style/plugins/drag-and-drop/dragula/custom-dragula.js")}}"></script>

@endsection
