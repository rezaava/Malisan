@extends('melisan.layout.master')
@section('title', 'پروفایل کاربر')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <style>
 
    </style>
@endpush

@section('main-content')
    <div class="container py-5">
        <form action="/dashboard/user/edit/{{$user->id}}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="card card-profile-pro2" style="  background: rgba(255, 255, 255, 0.18);
                backdrop-filter: blur(9px);">
                <div class="profile-header-pro2">
                    <img class='img-pro2' src="{{asset($user->image)}}">
                    <div>
                        <h4 class="mb-1">{{$user->name}} {{$user->family}}</h4>
                        <small>{{ $user->hasRole('student') ? 'دانشجو' : 'استاد' }}</small>
                    </div>
                </div>

                <div class="card-body p-4">

                    {{-- اطلاعات پایه --}}
                    <div class="form-section-pro2">
                        <h5 class='title-pro2'>اطلاعات پایه</h5>
                        <div class="row g-3">
                            <div class="col-md-6"><label class="label-pro2">نام</label><input name="name" class="form-control-pro2"
                                    value="{{$user->name}}" @if(!$edit) disabled @endif></div>
                            <div class="col-md-6"><label class="label-pro2">نام خانوادگی</label><input name="family" class="form-control-pro2"
                                    value="{{$user->family}}" @if(!$edit) disabled @endif></div>
                            <div class="col-md-6"><label class="label-pro2">ایمیل</label><input class="form-control-pro2" value="{{$user->email}}"
                                    ></div>
                            <div class="col-md-6">
                                <label class="label-pro2">جنسیت</label>
                                <select name="gender" class="form-control-pro2" @if(!$edit) disabled @endif>
                                    <option value="">انتخاب کنید</option>
                                    <option value="0" @selected($user->gender == 0)>زن</option>
                                    <option value="1" @selected($user->gender == 1)>مرد</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- اطلاعات هویتی --}}
                    <div class="form-section-pro2">
                        <h5 class='title-pro2'>اطلاعات هویتی</h5>
                        <div class="row g-3">
                            <div class="col-md-6"><label class="label-pro2">کد ملی</label><input name="national" class="form-control-pro2"
                                disabled    value="{{$user->national}}" @if(!$edit) disabled @endif></div>
                            <div class="col-md-6"><label class="label-pro2">شماره شناسنامه</label><input name="shenasname" class="form-control-pro2"
                                    value="{{$user->shenasname}}" @if(!$edit) disabled @endif></div>
                            <div class="col-md-6"><label class="label-pro2">تاریخ تولد</label><input name="birthdate" class="form-control-pro2"
                                    value="{{$user->jalali_birthdate}}" @if(!$edit) disabled @endif></div>
                            <div class="col-md-6"><label class="label-pro2">
                                    @if($user->hasRole('teacher')) کد استادی  
                                    @else
شماره دانشجویی  
  @endif
                                </label>
                                <input name="personal" class="form-control-pro2" value="{{$user->personal}}" @if(!$edit) disabled
                                @endif>
                            </div>
                        </div>
                    </div>

                    {{-- اطلاعات تماس --}}
                    <div class="form-section-pro2">
                        <h5 class='title-pro2'>اطلاعات تماس</h5>
                        <div class="row g-3">
                            <div class="col-md-4"><label class="label-pro2">موبایل</label><input name="mobile" class="form-control-pro2"
                                    value="{{$user->mobile}}" @if(!$edit) disabled @endif></div>
                            <div class="col-md-4"><label class="label-pro2">تلفن ثابت</label><input name="tel" class="form-control-pro2"
                                    value="{{$user->tel}}" @if(!$edit) disabled @endif></div>
                            <div class="col-md-4"><label class="label-pro2">تلفن محل کار</label><input name="tel_work" class="form-control-pro2"
                                    value="{{$user->tel_work}}" @if(!$edit) disabled @endif></div>
                            <div class="col-md-6"><label class="label-pro2">شهر</label><input name="city" class="form-control-pro2"
                                    value="{{$user->city}}" @if(!$edit) disabled @endif></div>
                            <div class="col-md-6"><label class="label-pro2">کد پستی</label><input name="postal" class="form-control-pro2"
                                    value="{{$user->postal}}" @if(!$edit) disabled @endif></div>
                            <div class="col-md-12"><label class="label-pro2">آدرس</label><input name="address" class="form-control-pro2"
                                    value="{{$user->address}}" @if(!$edit) disabled @endif></div>
                        </div>
                    </div>

                    {{-- اطلاعات تحصیلی --}}
                    <div class="form-section-pro2">
                        <h5 class='title-pro2'>اطلاعات تحصیلی</h5>
                        <div class="row g-3">
                            <div class="col-md-4"><label class="label-pro2">مدرک / مقطع</label><input name="degree" class="form-control-pro2"
                                    value="{{$user->degree}}" @if(!$edit) disabled @endif></div>
                            <div class="col-md-4"><label class="label-pro2">رشته</label><input name="field" class="form-control-pro2"
                                    value="{{$user->field}}" @if(!$edit) disabled @endif></div>
                            <div class="col-md-4"><label class="label-pro2">گرایش</label><input name="trend" class="form-control-pro2"
                                    value="{{$user->trend}}" @if(!$edit) disabled @endif></div>

                            @if(!$user->hasRole('student'))
                                <div class="col-md-6"><label class="label-pro2">گرایش (EN)</label><input name="trend_en" class="form-control-pro2"
                                        value="{{$user->trend_en}}" @if(!$edit) disabled @endif></div>
                                <div class="col-md-6"><label class="label-pro2">حوزه پژوهشی</label><input name="research" class="form-control-pro2"
                                        value="{{$user->research}}" @if(!$edit) disabled @endif></div>
                            @endif
                        </div>
                    </div>

                    {{-- شبکه‌ها --}}
                    <div class="form-section-pro2">
                        <h5 class='title-pro2'>شبکه‌ها و وب</h5>
                        <div class="row g-3">
                            <div class="col-md-6"><label class="label-pro2">شبکه اجتماعی</label><input name="social" class="form-control-pro2"
                                    value="{{$user->social}}" @if(!$edit) disabled @endif></div>

                            @if(!$user->hasRole('student'))
                                <div class="col-md-6"><label class="label-pro2">وب‌سایت</label><input name="web" class="form-control-pro2"
                                        value="{{$user->web}}" @if(!$edit) disabled @endif></div>
                                <div class="col-md-6"><label class="label-pro2">Scholar</label><input name="scholar" class="form-control-pro2"
                                        value="{{$user->scholar}}" @if(!$edit) disabled @endif></div>
                            @endif
                        </div>
                    </div>

                    {{-- امنیت --}}
                    <div class="form-section-pro2">
                        <h5 class='title-pro2'>امنیت حساب</h5>
                        <div class="row g-3">
                            <div class="col-md-6"><label class="label-pro2">تغییر رمز عبور</label><input type="password" name="password"
                                    class="form-control-pro2"></div>
                            @if($edit)
                                <div class="col-md-6"><label class="label-pro2">تصویر پروفایل</label><input type="file" name="image"
                                        class="form-control-pro2"></div>
                            @endif
                        </div>
                    </div>

                    @if($edit)
                        <div class="text-center mt-4">
                            <button class="btn btn-save-pro2 px-5">ذخیره تغییرات</button>
                        </div>
                    @endif

                </div>
            </div>
        </form>
    </div>
@endsection
