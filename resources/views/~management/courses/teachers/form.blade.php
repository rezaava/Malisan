@extends('management.layout.master')
@section('styles')
@endsection
@section('title' , 'ویرایش جلسه')
@section('main-content')
    <div class="row">
        <div class="col s12">
            <div id="icon-prefixes" class="card card-tabs">
                <div class="card-content">
                    <div id="view-icon-prefixes" class="active">
                        <div class="row">
                            <form class="col s12" action="@if(isset($course)){{'/dashboard/courses/edit/'.$course->id}}@else{{'/dashboard/courses/create'}}@endif" method="post">
                                @csrf
                                <div class="row">
                                    <div class="input-field col s6">
                                        <i class="material-icons prefix">account_circle</i>
                                        <input id="name" name="name" required type="text" class="validate" value="@if(isset($course)){{$course->name}}@endif">
                                        <label class="contact-input" for="icon_prefix3">نام</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <i class="material-icons dp48 prefix">link</i>
                                        <input id="majazi" name="majazi" type="text" class="validate" value="@if(isset($course)){{$course->majazi}}@endif">
                                        <label class="contact-input" for="icon_telephone">لینک</label>
                                    </div>
                                </div>
                                <input type="submit" class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 float-right" value="ثبت اطلاعات">
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
