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
    <div class="body.pro1 " style=" margin-top: 8%;">

        <div class="profile-card pro1">

            <div class="avatar pro1">
                <img src="{{ asset($user->image) }}" alt="Profile">
<<<<<<< HEAD
                     
=======
            
>>>>>>> 5ad25d67343dd020cc33cc5ea051e0a22033c618
            </div>

            <div class="name pro1"> {{ $user->name }}{{ $user->family }}</div>
            <div class="role pro1">
                @if ($user->hasRole('student')) {
                    دانشجو
                } @elseif ('teacher') {
                    استاد
                }@endif
            </div>

            <!-- <div class="stats pro1">
                <div class="stat pro1">
                    <span>12</span>
                    <small>دوره‌ها</small>
                </div>
                <div class="stat pro1">
                    <span>34</span>
                    <small>تمرین‌ها</small>
                </div>
                <div class="stat pro1">
                    <span>890</span>
                    <small>امتیاز</small>
                </div>
            </div> -->

            <div class="bio pro1">
           {{$user->mobile}}
            </div>

            <div class="actions pro1">
                <a class="btn primary pro1" href="/dashboard/user/edit/{{ $user->id }}">
                    <i class="material-icons">edit</i>
                    ویرایش
                </a>
                <a class="btn outline pro1" href="{{ route('logout') }}" >
                    <i class="material-icons">logout</i>
                    خروج
                </a>
            </div>

        </div>
    </div>
@endsection

@section('js')



@endsection