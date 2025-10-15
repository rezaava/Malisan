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
                                        <form
                                            method="post"
                                              @if(isset($ang))
                                              action="/dashboard/angizeshi/edit"
                                              @else
                                              action="/dashboard/angizeshi"
                                              @endif
                                              enctype="multipart/form-data">
                                            @csrf
                                            @if(isset($ang))
                                            <input type="text" name="id" style="visibility: hidden" value="{{$ang->id}}">
                                            @endif
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group m-form__group @if ($errors->has('name')) has-error @endif">
                                                        <label>متن</label>
                                                        <div class="input-group mb-3">

                                                            <textarea class="form-control" name="text">@if(isset($ang)){{$ang->text}}@endif</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">


                                                    <div class="form-group m-form__group @if ($errors->has('name')) has-error @endif">
                                                        <label>سطح</label>
                                                        <div class="input-group mb-3">
                                                            <select name="level" class="form-control" id="">
                                                                <option value="1" >1عالی</option>
                                                                <option value="2"@if(isset($ang)) @if($ang->level==2) selected @endif @endif>2خیلی خوب</option>
                                                                <option value="3"@if(isset($ang)) @if($ang->level==3) selected @endif @endif>3خوب</option>
                                                                <option value="4"@if(isset($ang)) @if($ang->level==4) selected @endif @endif>4متوسط</option>
                                                                <option value="5"@if(isset($ang)) @if($ang->level==5) selected @endif @endif>ضعیف5</option>
                                                                <option value="6"@if(isset($ang)) @if($ang->level==6) selected @endif @endif>خیلی ضعیف6</option>
                                                                <option value="7"@if(isset($ang)) @if($ang->level==7) selected @endif @endif>7راهنما</option>
                                                                <option value="8"@if(isset($ang)) @if($ang->level==8) selected @endif @endif>انگیزشی داشبورد8</option>
                                                            </select>

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="card-footer">
                                                <button class="btn btn-primary btn-block" type="submit"
                                                        id="upload_btn"
                                                        onclick="deactive('upload_btn')">
                                                  @if(isset($ang))
                                                      ویرایش
                                                    @else
                                                    ایجاد
                                                      @endif
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

@if(!isset($ang))
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
                                    <th class="text-center">متن</th>
                                    <th class="text-center">سطح</th>
                                    <th class="text-center">حذف</th>
                                    <th class="text-center">ویرایش</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($angizeshs as $key=>$item)
                                    <tr>
                                        <td class=" text-center">{!! $item->text !!}</td>
                                        <td class=" text-center"> {{$item->level}}</td>
                                        <td class=" text-center text-warning"> <a href="/dashboard/angizeshi/delete?id={{$item->id}}">حذف</a></td>
                                        <td class=" text-center text-info"> <a href="/dashboard/angizeshi/edit?id={{$item->id}}">ویرایش</a></td>

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
    @endif
@endsection
@section('js')
    <script src="/app-assets/vendors/data-tables/js/jquery.dataTables.min.js"></script>
    <script src="/app-assets/js/scripts/data-tables.min.js"></script>
@endsection
