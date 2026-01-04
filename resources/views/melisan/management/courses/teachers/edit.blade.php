@extends('melisan.layout.master')
@section('styles')
@endsection
@section('title', 'ویرایش کلاس')
@section('main-content')
    <div class="body-insert-courses" style=" margin-top: 1%;">
        <form action="/dashboard/courses/editpost/{{$course->id}} " method="post">
            @csrf
            <div class="profile-card-insert-courses">


                <div class="input-field ">
                    <label class="contact-input" for="icon_prefix3">
                        <!-- <i class="material-icons prefix">account_circle</i> -->
                        نام کلاس </label>
                    <input type="text" class="input-insert-courses" name="name" id="course-code"
                        value="{{ $course->name }}">
                </div>

                <div class="input-field ">
                    <label class="contact-input" for="icon_telephone">
                        <!-- <i class="material-icons dp48 prefix">link</i> -->
                        لینک کلاس مجازی</label>
                    <input type="text" class="input-insert-courses" name='majazi' id="course-code"
                        value="{{ $course->majazi }}">
                </div>

                <div class="actions-insert-courses">
                    <button type="submit" class="btn primary-insert-courses">
                        ذخیره
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- 
                        <div id="icon-prefixes" class="card-tabs" style="width='50%">
                            <div class="card-content">
                                <form class="" action="/dashboard/courses/edit/'.$course->id " method="post">
                                    @csrf
                                    <div class="">
                                        <div class="input-field ">
                                            <i class="material-icons prefix">account_circle</i>
                                            <input id="name" name="name" required type="text" class="validate" value="">
                                            <label class="contact-input" for="icon_prefix3">نام</label>
                                        </div>
                                        <div class="input-field "> <input id="majazi" name="majazi" type="text" class="validate" value="">
                                            <label class="contact-input" for="icon_telephone">لینک</label>
                                        </div>
                                    </div>
                                    <input type="submit" class="btn primary-insert-courses" value="ثبت اطلاعات">
                                </form>
                            </div>
                        </div> -->
@endsection