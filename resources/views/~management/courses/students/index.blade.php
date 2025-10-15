@extends('management.layout.master')
@section('styles')
@endsection
@section('title', 'صفحه اصلی')
@section('main-content')
    <div class="row">
        <div class="col 12 s12">
            @if (Laratrust::hasRole('teacher'))
                @include('management.layout.components.btn-loader.btn-loader' ,
                ['url' => '/dashboard/courses/create' ,
                'icon' => "<i class='material-icons dp48'>add_circle_outline</i>" ,
                'pos' => 'top' ,
                'text' => 'درس جدید'
                ])
            @endif
        </div>
    </div>
    <div class="row">
        @foreach ($courses as $course)
            <div class="col s3">
                <div id="profile-card" class="card">
                    <div class="card-image waves-effect waves-block waves-light">
                        <img class="activator" src="{{ asset('/files/user/' . $course->user->image) }}" alt="user bg">
                    </div>
                    <div class="card-content">
                        <img src="{{ asset('/files/user/' . $course->user->image) }}" alt=""
                            class="circle responsive-img activator card-profile-image red lighten-1 padding-2 custom_teacher_profile">
                        <a class="btn-floating activator btn-move-up waves-effect waves-light red accent-2 z-depth-4 right"
                            href="/dashboard/courses/sessions?course_id={{ $course->id }}">
                            <i class="material-icons dp48">remove_red_eye</i>edit</i>
                        </a>
                        <h5 class="card-title activator grey-text text-darken-4">
                            {{ $course->name }}</h5>
                        <p><i
                                class="material-icons profile-card-i">perm_identity</i>{{ $course->user->name . ' ' . $course->user->family }}
                        </p>
                        <p><i class="material-icons profile-card-i">perm_phone_msg</i>{{ $course->code }}</p>
                        <p><i class="material-icons profile-card-i">email</i> yourmail@domain.com</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
