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
                                                    <div
                                                        class="form-group m-form__group @if ($errors->has('name')) has-error @endif">
                                                        <label>درس</label>
                                                        <div class="input-group mb-3">
                                                            <input class="form-control" name="reshte"
                                                                   type="text" required
                                                                   placeholder="درس">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">


                                                    <div
                                                        class="form-group m-form__group @if ($errors->has('name')) has-error @endif">
                                                        <label>سطح</label>
                                                        <div class="input-group mb-3">
                                                            <input class="form-control" name="gerayesh"
                                                                   type="text" required
                                                                   placeholder="سطح">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div
                                                        class="form-group m-form__group @if ($errors->has('name')) has-error @endif">
                                                        <label>عنوان</label>
                                                        <div class="input-group mb-3">
                                                            <input class="form-control" name="dars" type="text"
                                                                   required
                                                                   placeholder="عنوان">
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
                                    <th class="text-center">درس</th>
                                    <th class="text-center">سطح</th>
                                    <th class="text-center">عنوان</th>
                                    @if(Laratrust::hasRole('admin'))
                                        <th class="text-center">حذف</th>
                                    @endif
                                    @if(Laratrust::hasRole('admin'))
                                        <th class="text-center">همکاران</th>
                                    @endif
                                    <th class="text-center">کاربران</th>

                                    <th class="text-center">ثبت سوال</th>
                                    @if(Laratrust::hasRole('admin'))

                                    <th class="text-center">وضعیت</th>
                                    @endif
                                    <th class="text-center">سوالات من</th>
                                    <th class="text-center">بانک سوالات</th>

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
                                                <a href="/dashboard/konkor/delete?ii={{$konkor->id}}"
                                                   class="btn btn-outline-primary">
                                                    حذف
                                                </a>
                                            </td>
                                        @endif
                                        @if(Laratrust::hasRole('admin'))
                                            <td class=" text-center">
                                                <a href="/dashboard/konkor/coworker?ii={{$konkor->id}}"
                                                   class="btn btn-outline-primary">
                                                     همکاران
                                                </a>
                                            </td>
                                        @endif
                                        <td class=" text-center">
                                            <a href="/dashboard/konkor/students?ii={{$konkor->id}}"
                                               class="btn btn-outline-primary">
                                                 کاربران
                                            </a>
                                        </td>
                                        <td class=" text-center">
                                            <a href="/dashboard/konkor/question?ii={{$konkor->id}}"
                                               class="btn btn-outline-success">
                                                ثبت
                                            </a>
                                        </td>
                                        @if(Laratrust::hasRole('admin'))

                                        <td class=" text-center">
                                            <a href="/dashboard/konkor/active?ii={{$konkor->id}}"
                                               class="btn btn-outline-success">
                                                @if($konkor->active==1)
                                                    فعال
                                                @else
                                                    غیرفعال
                                                @endif
                                            </a>
                                        </td>
                                        @endif
                                        <td class=" text-center">
                                            <a href="/dashboard/konkor/myquestion?ii={{$konkor->id}}"
                                               class="btn btn-outline-success">
                                                سوالات
                                            </a>
                                        </td>
                                        <td class=" text-center">
                                            <a href="/dashboard/konkor/final-questions?ii={{$konkor->id}}"
                                               class="btn btn-outline-success">
                                                بانک
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>

                            </table>
                            </form>
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
