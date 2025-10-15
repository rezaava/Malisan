@extends('management.layout.master')
@section('styles')
@endsection
@section('title', 'صفحه اصلی')
@section('main-content')
    <div class="row">
        @foreach ($courses as $course)
            <div class="col s3">
                <div class="card card-border z-depth-2">
                    <div class="card-image">
                        <img src="../../../app-assets/images/gallery/post-1.png" alt="">
                    </div>
                    <div class="card-content">
                        <h6 class="font-weight-900 text-uppercase"><a href="#">خدمات طراحی</a></h6>
                        <p>UI / UX و طراحی گرافیک</p>
                    </div>
                </div>
                <div class="social-icon">
                    <span><i class="material-icons vertical-align-bottom mr-1">favorite_border</i>۹۰</span> <i
                        class="material-icons vertical-align-bottom ml-3 mr-1">chat_bubble_outline</i> ۱۵ <span><i
                            class="material-icons vertical-align-bottom ml-3 mr-1">redo</i> ۶</span>
                </div>
            </div>
        @endforeach
    </div>
@endsection
