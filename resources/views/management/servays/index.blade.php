@extends('management.layout.master')
@section('title' , 'نظرسنجی')
@section('main-content')
    @if(Laratrust::hasRole("teacher"))
        @foreach($courses as $course)
            <div class="col s12 m12 xl4">
                <div id="flight-card" class="card hoverable">
                    <div class="card-header deep-orange accent-2">
                        <div class="card-title">
                            <h5 class="task-card-title mb-3 mt-0 white-text">{{ $course->name }}</h5>
                            <p class="flight-card-date">کد درس {{ $course->code }}</p>
                        </div>
                    </div>
                    <div class="card-content-bg white-text" style="background-size: cover !important;background: url({{asset('/files/user/' . $user->image)}})">
                        <div class="card-content">
                            <div class="row flight-state-wrapper">
                                <div class="col s5 m5 l5 center-align">
                                    <div class="flight-state">
                                        <h4 class="margin white-text">{{ $course->max_session }}</h4>
                                        <p class="ultra-small">حداکثر شرکت کننده</p>
                                    </div>
                                </div>
                                <div class="col s2 m2 l2 center-align"><i class="material-icons flight-icon">local_airport</i>
                                </div>
                                <div class="col s5 m5 l5 center-align">
                                    <div class="flight-state">
                                        <h4 class="margin white-text">{{ $course->majazi ? "بله" : "خیر" }}</h4>
                                        <p class="ultra-small">مجازی بود</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row vertical-align-bottom">
                                <div class="col s12 m12 l12 center-align">
                                    <a class="mb-6 btn waves-effect waves-light gradient-45deg-amber-amber gradient-shadow" href="/dashboard/survey?course_id={{$course->id}}">نظرسنجی</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
    @endif

    @if(Laratrust::hasRole("content") ||Laratrust::hasRole("admin"))
        @foreach($cats as $cat)
            <div class="col s12 m12 xl4">
                <div id="flight-card" class="card hoverable">
                    <div class="card-header deep-orange accent-2">
                        <div class="card-title">
                            <h5 class="task-card-title mb-3 mt-0 white-text">{{ $cat->name }}</h5>
                        </div>
                    </div>
                    <div class="card-content-bg white-text" style="background-size: cover !important;background: url({{asset('/files/user/' . $user->image)}})">
                        <div class="card-content">

                            <div class="row vertical-align-bottom">
                                <div class="col s12 m12 l12 center-align">
                                    <a class="mb-6 btn waves-effect waves-light gradient-45deg-amber-amber gradient-shadow" href="/dashboard/survey?cat_id={{$cat->id}}">نظرسنجی</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
@endsection
