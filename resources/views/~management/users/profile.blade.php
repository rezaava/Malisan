@extends('management.layout.master')
@section('title', 'مدیریت حساب کاربری')
@section('add-styles')
    <link rel="stylesheet" href="https://unpkg.com/persian-datepicker@latest/dist/css/persian-datepicker.css">
    <script src="https://unpkg.com/persian-date@latest/dist/persian-date.js"></script>
    <script src="https://unpkg.com/persian-datepicker@latest/dist/js/persian-datepicker.js"></script>
@endsection
@section('main-content')
    <div class="row">
        <div class="col s12">
            <div class="container">
                <!-- users edit start -->
                <div class="section users-edit">
                    <form action="/dashboard/user/edit/{{$user->id}}"
                          method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-content">
                                <div class="row">
                                    <div class="col s12">
                                        <div class="media display-flex align-items-center mb-2">
                                            <a class="mr-2" href="#">
                                                @if(isset($user)&&$user->image)
                                                    <img src="/files/user{{$user->image}}"
                                                         class="z-depth-4 circle" width="64" height="64">
                                                @endif
                                                @if ($errors->any()&& $errors->first('image'))
                                                    <p class="mt-2 text-danger mr-1">{{$errors->first('image')}}</p>
                                                @endif
                                            </a>
                                            <div class="media-body">
                                                <h5 class="media-heading mt-0">{{ $user->name . ' ' . $user->family }}</h5>
                                            </div>
                                        </div>
                                        <!-- users edit media object ends -->
                                        <!-- users edit account form start -->
                                        <form id="accountForm" novalidate="novalidate">
                                            <div class="row">
                                                <div class="col s12 m6">
                                                    <div class="row">
                                                        <div class="col s12 input-field">
                                                            <input id="username"
                                                                   placeholder="نام "
                                                                   type="text"
                                                                   name="name"
                                                                   class="form-control rtl"
                                                                   value="@if(isset($user)) {{$user->name}} @endif"
                                                                   @if(!$edit) disabled @endif>
                                                            <label for="username" class="active">نام کاربری</label>
                                                            @if ($errors->any()&& $errors->first('name'))
                                                                <p class="mt-2 text-danger mr-1">{{$errors->first('name')}}</p>
                                                            @endif
                                                        </div>
                                                        <div class="col s12 input-field">
                                                            <input maxlength="11"
                                                                   placeholder="کد ملی را وارد کنید" type="text"
                                                                   name="national"
                                                                   class="form-control rtl"
                                                                   value="@if(isset($user)) {{$user->national}} @endif"
                                                                   @if(Laratrust::hasRole('student'))
                                                                   readonly
                                                                @endif>
                                                            <label for="email" class="active">کدملی</label>
                                                            @if ($errors->any()&& $errors->first('national'))
                                                                <p class="mt-2 text-danger mr-1">{{$errors->first('national')}}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s12 m6">
                                                    <div class="row">
                                                        <div class="col s12 input-field">
                                                            <input placeholder="نام خانوادگی" type="text"
                                                                   name="family"
                                                                   class="form-control rtl"
                                                                   value="@if(isset($user)) {{$user->family}} @endif"
                                                                   @if(!$edit) disabled @endif>
                                                            <label for="name" class="active">نام خانوادگی</label>
                                                            @if ($errors->any()&& $errors->first('family'))
                                                                <p class="mt-2 text-danger mr-1">{{$errors->first('family')}}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s12 m6">
                                                    <div class="row">
                                                        <div class="col s12 input-field">
                                                            <input placeholder="ایمیل" type="text"
                                                                     name="email"
                                                                     class="form-control rtl"
                                                                     value="@if(isset($user)) {{$user->email}} @endif">
                                                            <label for="email" class="active">پست الکترونیکی</label>
                                                            @if ($errors->any()&& $errors->first('email'))
                                                                <p class="mt-2 text-danger mr-1">{{$errors->first('email')}}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s12 m6">
                                                    <div class="row">
                                                        <div class="col s12 input-field">
                                                            <select name="gender" @if(!$edit) disabled @endif required
                                                                    class="form-control rtl">
                                                                <option @if (old('gender') == "") {{ 'selected' }} @endif value="">
                                                                    جنسیت را
                                                                    مشخص کنید
                                                                </option>
                                                                @if(isset($user))
                                                                    <option value="0" @if ($user->gender== "0") {{ 'selected' }} @endif>
                                                                @else
                                                                    <option value="0" @if (old('gender') == "0") {{ 'selected' }} @endif>
                                                                        @endif
                                                                        زن
                                                                    </option>
                                                                    @if(isset($user))
                                                                        <option value="1" @if ($user->gender == "1") {{ 'selected' }} @endif>
                                                                    @else
                                                                        <option value="1" @if (old('gender') == "1") {{ 'selected' }} @endif>
                                                                            @endif
                                                                            مرد
                                                                        </option>
                                                            </select>
                                                            <label for="email" class="active">جنسیت</label>
                                                            @if ($errors->any()&& $errors->first('martial'))
                                                                <p class="mt-2 text-danger mr-1">{{$errors->first('martial')}}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s12 m6">
                                                    <div class="row">
                                                        <div class="col s12 input-field">
                                                            <input maxlength="11"
                                                                   placeholder="شماره شناسنامه را وارد کنید" type="text"
                                                                   name="shenasname"
                                                                   class="form-control rtl"
                                                                   value="@if(isset($user)) {{$user->shenasname}} @endif"
                                                                   @if(!$edit) disabled @endif>
                                                            <label for="email" class="active">شماره شناسنامه</label>
                                                            @if ($errors->any()&& $errors->first('shenasname'))
                                                                <p class="mt-2 text-danger mr-1">{{$errors->first('shenasname')}}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s12 m6">
                                                    <div class="row">
                                                        <div class="col s12 input-field">
                                                            <input maxlength="11"
                                                                   placeholder="شماره استادی را وارد کنید" type="text"
                                                                   name="personal"
                                                                   class="form-control rtl"
                                                                   value="@if(isset($user)) {{$user->personal}} @endif"
                                                                   @if(!$edit) disabled @endif>
                                                            <label for="email" class="active">
                                                                @if($role=='teacher')
                                                                    کد استادی
                                                                @elseif($role=='student')
                                                                    شماره دانشجویی
                                                                @endif</label>
                                                            @if ($errors->any()&& $errors->first('personal'))
                                                                <p class="mt-2 text-danger mr-1">{{$errors->first('personal')}}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s12 m6">
                                                    <div class="row">
                                                        <div class="col s12 input-field">
                                                            <input
                                                                type="text"
                                                                placeholder="تاریخ تولد را مشخص کنید" name="birthdate"
                                                                @if(!$edit) disabled @endif
                                                                class="normal-example form-control example1"
                                                                value=@if(isset($user)) @if($user->birthdate) {{$user->birthdate}}  @endif @endif>
                                                            <label for="birthdate" class="active">
                                                                تولد</label>
                                                            @if ($errors->any()&& $errors->first('personal'))
                                                                <p class="mt-2 text-danger mr-1">{{$errors->first('personal')}}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s12 m6">
                                                    <div class="row">
                                                        <div class="col s12 input-field">
                                                            <input
                                                                placeholder="شهر سکونت را وارد کنید"
                                                                @if(!$edit) disabled @endif
                                                                type="text"
                                                                name="city"
                                                                class="form-control rtl"
                                                                value="@if(isset($user)) {{$user->city}} @endif">
                                                            <label for="birthdate" class="active">
                                                                شهر</label>
                                                            @if ($errors->any()&& $errors->first('city'))
                                                                <p class="mt-2 text-danger mr-1">{{$errors->first('city')}}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s12 m6">
                                                    <div class="row">
                                                        <div class="col s12 input-field">
                                                            <input
                                                                placeholder="آدرس پستی را وارد کنید" type="text"
                                                                @if(!$edit) disabled @endif
                                                                name="address"
                                                                class="form-control rtl"
                                                                value="@if(isset($user)) {{$user->address}}  @endif">
                                                            <label for="birthdate" class="active">
                                                                آدرس پستی</label>
                                                            @if ($errors->any()&& $errors->first('address'))
                                                                <p class="mt-2 text-danger mr-1">{{$errors->first('address')}}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s12 m6">
                                                    <div class="row">
                                                        <div class="col s12 input-field">
                                                            <input maxlength="11"
                                                                   placeholder="کد پستی را وارد کنید" type="text"
                                                                   @if(!$edit) disabled @endif
                                                                   name="postal"
                                                                   class="form-control rtl"
                                                                   value="@if(isset($user)) {{$user->postal}} @else {{ old('postal') }} @endif">
                                                            <label for="birthdate" class="active">
                                                                کد پستی</label>
                                                            @if ($errors->any()&& $errors->first('postal'))
                                                                <p class="mt-2 text-danger mr-1">{{$errors->first('postal')}}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s12 m6">
                                                    <div class="row">
                                                        <div class="col s12 input-field">
                                                            <input maxlength="11"
                                                                   placeholder="تلفن ثابت  را وارد کنید" type="text"
                                                                   @if(!$edit) disabled @endif
                                                                   name="tel"
                                                                   class="form-control rtl"
                                                                   value=@if(isset($user)) {{$user->tel}}  @else"{{ old('tel') }}"@endif>
                                                            <label for="birthdate" class="active">
                                                                تلفن ثابت</label>
                                                            @if ($errors->any()&& $errors->first('tel'))
                                                                <p class="mt-2 text-danger mr-1">{{$errors->first('tel')}}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s12 m6">
                                                    <div class="row">
                                                        <div class="col s12 input-field">
                                                            <input maxlength="11"
                                                                   placeholder="تلفن همراه را وارد کنید" type="text"
                                                                   @if(!$edit) disabled @endif
                                                                   name="mobile"
                                                                   class="form-control rtl"
                                                                   value=@if(isset($user)) {{$user->mobile}}  @else"{{ old('mobile') }}"@endif>
                                                            <label for="birthdate" class="active">
                                                                تلفن همراه</label>
                                                            @if ($errors->any()&& $errors->first('mobile'))
                                                                <p class="mt-2 text-danger mr-1">{{$errors->first('mobile')}}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s12 m6">
                                                    <div class="row">
                                                        <div class="col s12 input-field">
                                                            <input maxlength="11"
                                                                   placeholder="تلفن محل کار  را وارد کنید" type="text"
                                                                   @if(!$edit) disabled @endif
                                                                   name="tel_work"
                                                                   class="form-control rtl"
                                                                   value=@if(isset($user)) {{$user->tel_work}}  @else"{{ old('tel_work') }}"@endif>
                                                            <label for="birthdate" class="active">
                                                                تلفن کار</label>
                                                            @if ($errors->any()&& $errors->first('tel_work'))
                                                                <p class="mt-2 text-danger mr-1">{{$errors->first('tel_work')}}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s12 m6">
                                                    <div class="row">
                                                        <div class="col s12 input-field">
                                                            <input
                                                                placeholder="ایمیل دانشگاه را وارد کنید" type="text"
                                                                @if(!$edit) disabled @endif
                                                                name="uni_email"
                                                                class="form-control rtl"
                                                                value=@if(isset($user)) {{$user->uni_email}}  @else"{{ old('uni_email') }}"@endif>
                                                            <label for="birthdate" class="active">
                                                                <span class="input-group-text">ایمیل دانشگاه</span></label>
                                                            @if ($errors->any()&& $errors->first('uni_email'))
                                                                <p class="mt-2 text-danger mr-1">{{$errors->first('uni_email')}}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s12 m6">
                                                    <div class="row">
                                                        <div class="col s12 input-field">
                                                            <input
                                                                placeholder="وب را وارد کنید" type="text"
                                                                @if(!$edit) disabled @endif
                                                                name="web"
                                                                class="form-control rtl"
                                                                value=@if(isset($user)) {{$user->web}}  @else"{{ old('web') }}"@endif>
                                                            <label for="birthdate" class="active">
                                                                <span class="input-group-text">سایت</span></label>
                                                            @if ($errors->any()&& $errors->first('web'))
                                                                <p class="mt-2 text-danger mr-1">{{$errors->first('web')}}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s12 m6">
                                                    <div class="row">
                                                        <div class="col s12 input-field">
                                                            <input
                                                                placeholder="scholar را وارد کنید" type="text"
                                                                @if(!$edit) disabled @endif
                                                                name="scholar"
                                                                class="form-control rtl"
                                                                value=@if(isset($user)) {{$user->scholar}}  @else"{{ old('scholar') }}"@endif>
                                                            <label for="birthdate" class="active">
                                                                <span class="input-group-text">صفحه اسکولار</span></label>
                                                            @if ($errors->any()&& $errors->first('scholar'))
                                                                <p class="mt-2 text-danger mr-1">{{$errors->first('scholar')}}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s12 m6">
                                                    <div class="row">
                                                        <div class="col s12 input-field">
                                                            <input
                                                                placeholder="شبکه اجتماعی فعال را وارد کنید" type="text"
                                                                name="social"
                                                                @if(!$edit) disabled @endif
                                                                class="form-control rtl"
                                                                value=@if(isset($user)) {{$user->social}}  @else"{{ old('social') }}"@endif>
                                                            <label for="birthdate" class="active">
                                                                <span class="input-group-text">شبکه اجتماعی</span></label>
                                                            @if ($errors->any()&& $errors->first('social'))
                                                                <p class="mt-2 text-danger mr-1">{{$errors->first('social')}}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s12 m6">
                                                    <div class="row">
                                                        <div class="col s12 input-field">
                                                            <input
                                                                placeholder="اخرین مدرک تحصیلی را وارد کنید" type="text"
                                                                @if(!$edit) disabled @endif
                                                                name="degree"
                                                                class="form-control rtl"
                                                                value=@if(isset($user)) {{$user->degree}}  @else"{{ old('degree') }}"@endif>
                                                            <label for="birthdate" class="active">
                                                                <span class="input-group-text">
                                                                    @if($role=='teacher')
                                                                        آخرین مدرک تحصیلی
                                                                    @elseif($role=='student')
                                                                        مقطع تحصیلی
                                                                    @endif</span></label>
                                                            @if ($errors->any()&& $errors->first('degree'))
                                                                <p class="mt-2 text-danger mr-1">{{$errors->first('degree')}}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s12 m6">
                                                    <div class="row">
                                                        <div class="col s12 input-field">
                                                            <input
                                                                placeholder="رشته تحصیلی را وارد کنید" type="text"
                                                                name="field"
                                                                @if(!$edit) disabled @endif
                                                                class="form-control rtl"
                                                                value=@if(isset($user)) {{$user->field}}  @else"{{ old('field') }}"@endif>
                                                            <label for="birthdate" class="active">
                                                                <span class="input-group-text">
                                                                   رشته
                                                                </span></label>
                                                            @if ($errors->any()&& $errors->first('field'))
                                                                <p class="mt-2 text-danger mr-1">{{$errors->first('field')}}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s12 m6">
                                                    <div class="row">
                                                        <div class="col s12 input-field">
                                                            <input
                                                                placeholder="گرایش را وارد کنید" type="text"
                                                                @if(!$edit) disabled @endif
                                                                name="trend"
                                                                class="form-control rtl"
                                                                value=@if(isset($user)) {{$user->trend}}  @else"{{ old('trend') }}"@endif>
                                                            <label for="birthdate" class="active">
                                                                <span class="input-group-text">
                                                                   گرایش
                                                                </span></label>
                                                            @if ($errors->any()&& $errors->first('trend'))
                                                                <p class="mt-2 text-danger mr-1">{{$errors->first('trend')}}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s12 m6">
                                                    <div class="row">
                                                        <div class="col s12 input-field">
                                                            <input maxlength="11"
                                                                   placeholder="گرایش انگلیسی را وارد کنید" type="text"
                                                                   @if(!$edit) disabled @endif
                                                                   name="trend_en"
                                                                   class="form-control rtl"
                                                                   value=@if(isset($user)) {{$user->trend_en}}  @else"{{ old('trend_en') }}"@endif>
                                                            <label for="birthdate" class="active">
                                                                <span class="input-group-text">
                                                                   گرایش به انگلیسی
                                                                </span></label>
                                                            @if ($errors->any()&& $errors->first('trend_en'))
                                                                <p class="mt-2 text-danger mr-1">{{$errors->first('trend_en')}}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s12 m6">
                                                    <div class="row">
                                                        <div class="col s12 input-field">
                                                            <input
                                                                placeholder="حوزه پژوهش را وارد کنید" type="text"
                                                                @if(!$edit) disabled @endif
                                                                name="research"
                                                                class="form-control rtl"
                                                                value=@if(isset($user)) {{$user->research}}  @else"{{ old('research') }}"@endif>
                                                            <label for="birthdate" class="active">
                                                                <span class="input-group-text">
                                                                   حوزه پژوهشی
                                                                </span></label>
                                                            @if ($errors->any()&& $errors->first('research'))
                                                                <p class="mt-2 text-danger mr-1">{{$errors->first('research')}}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s12 m6">
                                                    <div class="row">
                                                        <div class="col s12 input-field">
                                                            <input
                                                                placeholder="شماره شبای بانکی خود را وارد کنید" type="text"
                                                                @if(!$edit) disabled @endif
                                                                name="shaba"
                                                                class="form-control rtl"
                                                                value=@if(isset($user)) {{$user->shaba}}  @else"{{ old('shaba') }}"@endif>
                                                            <label for="birthdate" class="active">
                                                                <span class="input-group-text">
                                                                   شبا
                                                                </span></label>
                                                            @if ($errors->any()&& $errors->first('shaba'))
                                                                <p class="mt-2 text-danger mr-1">{{$errors->first('shaba')}}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s12 m6">
                                                    <div class="row">
                                                        <div class="col s12 input-field">
                                                            <input maxlength="11"
                                                                   placeholder="روزانه، شبانه ، مجازی و ...." type="text"
                                                                   name="turn"
                                                                   class="form-control rtl"
                                                                   value=@if(isset($user)) {{$user->turn}}  @else"{{ old('turn') }}"@endif>
                                                            <label for="birthdate" class="active">
                                                                <span class="input-group-text">
                                                                   دوره
                                                                </span></label>
                                                            @if ($errors->any()&& $errors->first('turn'))
                                                                <p class="mt-2 text-danger mr-1">{{$errors->first('turn')}}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s12 m6">
                                                    <div class="row">
                                                        <div class="col s12 input-field">
                                                            <input
                                                                placeholder="رمز جدید را وارد کنید" type="text"
                                                                name="password"
                                                                class="form-control rtl">
                                                            <label for="birthdate" class="active">
                                                                <span class="input-group-text">
                                                                   تغییر رمز عبور
                                                                </span></label>
                                                            @if ($errors->any()&& $errors->first('turn'))
                                                                <p class="mt-2 text-danger mr-1">{{$errors->first('turn')}}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                @if($edit)
                                                    <div class="col s12 m6">
                                                        <div class="row">
                                                            <div class="file-field input-field">
                                                                <div class="btn">
                                                                    <span>پرونده</span>
                                                                    <input type="file" name="image">
                                                                </div>
                                                                <div class="file-path-wrapper">
                                                                    <input class="file-path validate" type="text">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="col s12 display-flex justify-content-end mt-3">
                                                    <button type="submit" class="btn indigo iransans">
                                                        ذخیره تغییرات
                                                    </button>
                                                    <button type="button" class="btn btn-light iransans">لغو</button>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- users edit account form ends -->
                                    </div>
                                </div>
                                <!-- </div> -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="content-overlay"></div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{("/style/plugins/dropify/dropify.min.js")}}"></script>
    <script src="{{("/style/plugins/blockui/jquery.blockUI.min.js")}}"></script>
    <!-- <script src="plugins/tagInput/tags-input.js"></script> -->
    <script src="{{("/style/assets/js/users/account-settings.js")}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".datapicker").pDatepicker({
                format: 'YYYY/MM/DD',
            });
            $("#form").submit(function () {
                $("#factories").prop('disabled', true);
                return true;
            });
        });

    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".example1").persianDatepicker({
                    format: 'YYYY/MM/DD',
                    responsive: true,
                    // timePicker: {
                    //     enabled: false,
                    //     meridiem: {
                    //         enabled: true
                    //     }
                    // },
                    toolbox: {
                        submitButton: {
                            enabled: true
                        }
                    }
                }
            );
        });
    </script>
@endsection
