@extends('melisan.layout.master')

@section('add-styles')
    <style>
        span {
            color: #d3d2d2ff;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/pages/page-account-settings.min.css') }}">
@endsection

@section('title', 'مدیریت درس')

@section('main-content')
    <div class="body-insert-courses" style=" margin-top: 5%;">
        <form action="/dashboard/courses/createPost" method="post">
            @csrf
            <div class="profile-card-insert-courses">
                <input type="text" class="input-insert-courses" name="name" placeholder="نام درس را وارد کنید"
                    id="course-code">
                <input type="text" class="input-insert-courses" name='majazi' placeholder="لینک کلاس مجازی (اختیاری)"
                    id="course-code">
                <div class="actions-insert-courses">

                    <button type="submit" class="btn primary-insert-courses">
                        ذخیره
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('js')

@endsection