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
    <div class="body-insert-courses" style=" margin-top: 8%;">
        <form action="/dashboard/courses/createPost" method="post">
            @csrf
            <div class="profile-card-insert-courses">
                <input type="text" class="input-insert-courses" placeholder="نام درس را وارد کنید" id="course-code">
                   <input type="text" class="input-insert-courses" placeholder="    لینک کلاس مجازی (اختیاری)" id="course-code">
                <div class="actions-insert-courses">
                    <a class="btn primary-insert-courses" href="/dashboard/user/edit/{{ $user->id }}">
                        <!-- <i class="material-icons">edit</i> -->
                        ذخیره
                    </a>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('js')

@endsection