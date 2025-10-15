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
                            <h3>ایجاد</h3>
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
                                                      action="/dashboard/konkor"
                                                      enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group m-form__group @if ($errors->has('name')) has-error @endif">
                                                                <label>نام رشته</label>
                                                                <div class="input-group mb-3">
                                                                    <input class="form-control" name="reshte"
                                                                           type="text" required
                                                                           placeholder="نام رشته">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col">


                                                            <div class="form-group m-form__group @if ($errors->has('name')) has-error @endif">
                                                                <label>نام گرایش</label>
                                                                <div class="input-group mb-3">
                                                                    <input class="form-control" name="gerayesh"
                                                                           type="text" required
                                                                           placeholder="نام گرایش">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group m-form__group @if ($errors->has('name')) has-error @endif">
                                                                <label>نام درس</label>
                                                                <div class="input-group mb-3">
                                                                    <input class="form-control" name="dars" type="text"
                                                                           required
                                                                           placeholder="نام درس">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="card-footer">
                                                        <button class="btn btn-primary btn-block" type="submit"
                                                                id="upload_btn"
                                                                onclick="deactive('upload_btn')">
                                                            ایجاد
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
                                    <th class="text-center">رشته</th>
                                    <th class="text-center">گرایش</th>
                                    <th class="text-center">درس</th>
                                    @if(Laratrust::hasRole('admin'))
                                    <th class="text-center">همکاران</th>
                                    @endif
                                    <th class="text-center">ثبت سوال</th>
                                    <th class="text-center">داوری سوال</th>
                                    <th class="text-center">سوالات من</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($konkors as $key=>$konkor)
                                    <tr>
                                        <td class=" text-center"> {{$konkor->reshte}}</td>
                                        <td class=" text-center"> {{$konkor->gerayesh}}</td>
                                        <td class=" text-center"> {{$konkor->dars}}</td>
                                        @if(Laratrust::hasRole('admin'))
                                        <td class=" text-center">
                                            <a href="/dashboard/konkor/coworker?ii={{$konkor->id}}" class="btn btn-outline-primary">
                                                لیست همکاران
                                            </a>
                                        </td>
                                        @endif
                                        <td class=" text-center">
                                            <a href="/dashboard/konkor/question?ii={{$konkor->id}}" class="btn btn-outline-success">
                                                ثبت سوال
                                            </a>
                                        </td>
                                        <td class=" text-center">
                                            <a href="/dashboard/konkor/refree?ii={{$konkor->id}}" class="btn btn-outline-success">
                                                داوری
                                            </a>
                                        </td>
                                        <td class=" text-center">
                                            <a href="/dashboard/konkor/myquestion?ii={{$konkor->id}}" class="btn btn-outline-success">
                                                سوالات من
                                            </a>
                                        </td>
                                        <td class=" text-center">
                                            <a href="/dashboard/konkor/final-questions?ii={{$konkor->id}}" class="btn btn-outline-success">
                                                سوالات نهایی
                                            </a>
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
