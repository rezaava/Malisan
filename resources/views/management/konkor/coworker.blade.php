@extends('management.layout.master')
@section('add-styles')
    <link rel="stylesheet" type="text/css"
          href="{{ asset('app-assets/vendors/data-tables/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/data-tables.min.css') }}">
@endsection
@section('title', 'دانشجویان درس')
@section('main-content')
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


    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <h4 class="card-title">گزینه های طول صفحه</h4>
                    <div class="row">
                        <div class="col s12">
                                <table id="page-length-option" class="display">
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
    </div>
@endsection
@section('js')
    <script src="/app-assets/vendors/data-tables/js/jquery.dataTables.min.js"></script>
    <script src="/app-assets/js/scripts/data-tables.min.js"></script>
@endsection
