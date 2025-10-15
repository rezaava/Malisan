@extends('dashboard2.layout.app')

@section('start')

    <link rel="stylesheet" type="text/css" href="{{("/style/plugins/dropify/dropify.min.css")}}">
    <link href="{{("/style/assets/css/users/account-setting.css")}}" rel="stylesheet" type="text/css"/>

    <link rel="stylesheet" href="https://unpkg.com/persian-datepicker@latest/dist/css/persian-datepicker.css">
    <script src="https://unpkg.com/persian-date@latest/dist/persian-date.js"></script>
    <script src="https://unpkg.com/persian-datepicker@latest/dist/js/persian-datepicker.js"></script>

@endsection
@section('main')

    <div id="content" class="main-content">
        <div class="layout-px-spacing">

            <div class="page-header">
                <div class="page-title">
                    <h3>تنظیمات اکانت</h3>
                </div>
            </div>

            <div class="account-settings-container layout-top-spacing">

                <div class="account-content">
                    <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll"
                         data-offset="-100">


                        <form action="/dashboard/user/edit/{{$user->id}}"
                              method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-success">
                                        <div class="card-header">
                                            <h3 class="card-title">
                                                اطلاعات
                                            </h3>
                                        </div>
                                        <div class="card-body">
                                            {{--//name--}}
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">نام</span>
                                                    </div>
                                                    <input
                                                            placeholder="نام " type="text"
                                                            name="name"
                                                            class="form-control rtl"
                                                            value="@if(isset($user)) {{$user->name}} @endif"
                                                            @if(!$edit) disabled @endif
                                                    >
                                                </div>
                                                @if ($errors->any()&& $errors->first('name'))
                                                    <p class="mt-2 text-danger mr-1">{{$errors->first('name')}}</p>
                                                @endif
                                            </div>
                                            {{--family--}}
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">نام خانوادگی</span>
                                                    </div>
                                                    <input
                                                            placeholder="نام خانوادگی" type="text"
                                                            name="family"
                                                            class="form-control rtl"
                                                            value="@if(isset($user)) {{$user->family}} @endif"
                                                            @if(!$edit) disabled @endif>
                                                </div>
                                                @if ($errors->any()&& $errors->first('family'))
                                                    <p class="mt-2 text-danger mr-1">{{$errors->first('family')}}</p>
                                                @endif
                                            </div>
                                            {{--//national--}}
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">کدملی</span>
                                                    </div>
                                                    <input maxlength="11"
                                                           placeholder="کد ملی را وارد کنید" type="text"
                                                           name="national"
                                                           class="form-control rtl"
                                                           value="@if(isset($user)) {{$user->national}} @endif"
                                                           @if(Laratrust::hasRole('student'))
                                                           readonly
                                                            @endif>
                                                </div>
                                                @if ($errors->any()&& $errors->first('national'))
                                                    <p class="mt-2 text-danger mr-1">{{$errors->first('national')}}</p>
                                                @endif
                                            </div>
                                            {{--email--}}
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">EMAIL</span>
                                                    </div>
                                                    <input
                                                            placeholder="ایمیل" type="text"
                                                            name="email"
                                                            class="form-control rtl"
                                                            value="@if(isset($user)) {{$user->email}} @endif">
                                                </div>
                                                @if ($errors->any()&& $errors->first('email'))
                                                    <p class="mt-2 text-danger mr-1">{{$errors->first('email')}}</p>
                                                @endif
                                            </div>
                                            {{--//gender--}}
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                        جنسیت</span>
                                                    </div>
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
                                                </div>
                                                @if ($errors->any()&& $errors->first('martial'))
                                                    <p class="mt-2 text-danger mr-1">{{$errors->first('martial')}}</p>
                                            @endif

                                            <!-- /.input group -->
                                            </div>

                                            {{--//shenasname--}}
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">شماره شناسنامه</span>
                                                    </div>
                                                    <input maxlength="11"
                                                           placeholder="شماره شناسنامه را وارد کنید" type="text"
                                                           name="shenasname"
                                                           class="form-control rtl"
                                                           value="@if(isset($user)) {{$user->shenasname}} @endif"
                                                           @if(!$edit) disabled @endif>
                                                </div>
                                                @if ($errors->any()&& $errors->first('shenasname'))
                                                    <p class="mt-2 text-danger mr-1">{{$errors->first('shenasname')}}</p>
                                                @endif
                                            </div>
                                            {{--//personal--}}
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            @if($role=='teacher')
                                                کد استادی
                                            @elseif($role=='student')
                                                شماره دانشجویی
                                            @endif
                                        </span>
                                                    </div>
                                                    <input maxlength="11"
                                                           placeholder="شماره استادی را وارد کنید" type="text"
                                                           name="personal"
                                                           class="form-control rtl"
                                                           value="@if(isset($user)) {{$user->personal}} @endif"
                                                           @if(!$edit) disabled @endif>
                                                </div>
                                                @if ($errors->any()&& $errors->first('personal'))
                                                    <p class="mt-2 text-danger mr-1">{{$errors->first('personal')}}</p>
                                                @endif
                                            </div>
                                            {{--//birthdate--}}
                                            <div class="form-group">

                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">تولد</span>
                                                    </div>
                                                    <input
                                                            placeholder="تاریخ تولد را مشخص کنید" name="birthdate"
                                                            @if(!$edit) disabled @endif
                                                            class="normal-example form-control example1"
                                                            value=@if(isset($user)) @if($user->birthdate) {{$user->birthdate}}  @endif @endif>
                                                </div>
                                                @if ($errors->any()&& $errors->first('birthdate'))
                                                    <p class="mt-2 text-danger mr-1">{{$errors->first('birthdate')}}</p>
                                            @endif
                                            <!-- /.input group -->
                                            </div>
                                            {{--//city--}}
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">شهر</span>
                                                    </div>
                                                    <input
                                                            placeholder="شهر سکونت را وارد کنید"
                                                            @if(!$edit) disabled @endif
                                                            type="text"
                                                            name="city"
                                                            class="form-control rtl"
                                                            value="@if(isset($user)) {{$user->city}} @endif">
                                                </div>
                                                @if ($errors->any()&& $errors->first('city'))
                                                    <p class="mt-2 text-danger mr-1">{{$errors->first('city')}}</p>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">ادرس پستی</span>
                                                    </div>
                                                    <input
                                                            placeholder="ادرس پستی را وارد کنید" type="text"
                                                            @if(!$edit) disabled @endif
                                                            name="address"
                                                            class="form-control rtl"
                                                            value="@if(isset($user)) {{$user->address}}  @endif">
                                                </div>
                                                @if ($errors->any()&& $errors->first('address'))
                                                    <p class="mt-2 text-danger mr-1">{{$errors->first('address')}}</p>
                                                @endif
                                            </div>
                                            {{--//postal--}}
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">کد پستی</span>
                                                    </div>
                                                    <input maxlength="11"
                                                           placeholder="کد پستی را وارد کنید" type="text"
                                                           @if(!$edit) disabled @endif
                                                           name="postal"
                                                           class="form-control rtl"
                                                           value="@if(isset($user)) {{$user->postal}} @else {{ old('postal') }} @endif">
                                                </div>
                                                @if ($errors->any()&& $errors->first('postal'))
                                                    <p class="mt-2 text-danger mr-1">{{$errors->first('postal')}}</p>
                                                @endif
                                            </div>
                                            {{--//tell--}}
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">تلفن ثابت</span>
                                                    </div>
                                                    <input maxlength="11"
                                                           placeholder="تلفن ثابت  را وارد کنید" type="text"
                                                           @if(!$edit) disabled @endif
                                                           name="tel"
                                                           class="form-control rtl"
                                                           value=@if(isset($user)) {{$user->tel}}  @else"{{ old('tel') }}"@endif>
                                                </div>
                                                @if ($errors->any()&& $errors->first('tel'))
                                                    <p class="mt-2 text-danger mr-1">{{$errors->first('tel')}}</p>
                                                @endif
                                            </div>
                                            {{--//mobile--}}
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">تلفن همراه</span>
                                                    </div>
                                                    <input maxlength="11"
                                                           placeholder="تلفن همراه را وارد کنید" type="text"
                                                           @if(!$edit) disabled @endif
                                                           name="mobile"
                                                           class="form-control rtl"
                                                           value=@if(isset($user)) {{$user->mobile}}  @else"{{ old('mobile') }}"@endif>
                                                </div>
                                                @if ($errors->any()&& $errors->first('mobile'))
                                                    <p class="mt-2 text-danger mr-1">{{$errors->first('mobile')}}</p>
                                                @endif
                                            </div>
                                            {{--//tell_work--}}
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">تلفن کار</span>
                                                    </div>
                                                    <input maxlength="11"
                                                           placeholder="تلفن محل کار  را وارد کنید" type="text"
                                                           @if(!$edit) disabled @endif
                                                           name="tel_work"
                                                           class="form-control rtl"
                                                           value=@if(isset($user)) {{$user->tel_work}}  @else"{{ old('tel_work') }}"@endif>
                                                </div>
                                                @if ($errors->any()&& $errors->first('tel_work'))
                                                    <p class="mt-2 text-danger mr-1">{{$errors->first('tel_work')}}</p>
                                                @endif
                                            </div>
                                            {{--//uni_email--}}
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">ایمیل دانشگاه</span>
                                                    </div>
                                                    <input
                                                            placeholder="ایمیل دانشگاه را وارد کنید" type="text"
                                                            @if(!$edit) disabled @endif
                                                            name="uni_email"
                                                            class="form-control rtl"
                                                            value=@if(isset($user)) {{$user->uni_email}}  @else"{{ old('uni_email') }}"@endif>
                                                </div>
                                                @if ($errors->any()&& $errors->first('uni_email'))
                                                    <p class="mt-2 text-danger mr-1">{{$errors->first('uni_email')}}</p>
                                                @endif
                                            </div>
                                            {{--//web--}}
                                            @if($role=='teacher')
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">سایت</span>
                                                        </div>
                                                        <input
                                                                placeholder="وب را وارد کنید" type="text"
                                                                @if(!$edit) disabled @endif
                                                                name="web"
                                                                class="form-control rtl"
                                                                value=@if(isset($user)) {{$user->web}}  @else"{{ old('web') }}"@endif>
                                                    </div>
                                                    @if ($errors->any()&& $errors->first('web'))
                                                        <p class="mt-2 text-danger mr-1">{{$errors->first('web')}}</p>
                                                    @endif
                                                </div>
                                            @endif
                                            {{--//scholar--}}
                                            @if($role=='teacher')
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">صفحه اسکولار</span>
                                                        </div>
                                                        <input
                                                                placeholder="scholar را وارد کنید" type="text"
                                                                @if(!$edit) disabled @endif
                                                                name="scholar"
                                                                class="form-control rtl"
                                                                value=@if(isset($user)) {{$user->scholar}}  @else"{{ old('scholar') }}"@endif>
                                                    </div>
                                                    @if ($errors->any()&& $errors->first('scholar'))
                                                        <p class="mt-2 text-danger mr-1">{{$errors->first('scholar')}}</p>
                                                    @endif
                                                </div>
                                            @endif
                                            {{--//شبکه اجتماعی فعال--}}
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">شبکه اجتماعی</span>
                                                    </div>
                                                    <input
                                                            placeholder="شبکه اجتماعی فعال را وارد کنید" type="text"
                                                            name="social"
                                                            @if(!$edit) disabled @endif
                                                            class="form-control rtl"
                                                            value=@if(isset($user)) {{$user->social}}  @else"{{ old('social') }}"@endif>
                                                </div>
                                                @if ($errors->any()&& $errors->first('social'))
                                                    <p class="mt-2 text-danger mr-1">{{$errors->first('social')}}</p>
                                                @endif
                                            </div>
                                            {{--//اخرین مدرک تحصیلی--}}
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            @if($role=='teacher')
                                                آخرین مدرک تحصیلی
                                            @elseif($role=='student')
                                                مقطع تحصیلی
                                            @endif
                                                </span>
                                                    </div>
                                                    <input
                                                            placeholder="اخرین مدرک تحصیلی را وارد کنید" type="text"
                                                            @if(!$edit) disabled @endif
                                                            name="degree"
                                                            class="form-control rtl"
                                                            value=@if(isset($user)) {{$user->degree}}  @else"{{ old('degree') }}"@endif>
                                                </div>
                                                @if ($errors->any()&& $errors->first('degree'))
                                                    <p class="mt-2 text-danger mr-1">{{$errors->first('degree')}}</p>
                                                @endif
                                            </div>
                                            {{--//رشته تحصیلی--}}
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">رشته</span>
                                                    </div>
                                                    <input
                                                            placeholder="رشته تحصیلی را وارد کنید" type="text"
                                                            name="field"
                                                            @if(!$edit) disabled @endif
                                                            class="form-control rtl"
                                                            value=@if(isset($user)) {{$user->field}}  @else"{{ old('field') }}"@endif>
                                                </div>
                                                @if ($errors->any()&& $errors->first('field'))
                                                    <p class="mt-2 text-danger mr-1">{{$errors->first('field')}}</p>
                                                @endif
                                            </div>
                                            {{--//گرایش--}}
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">گرایش</span>
                                                    </div>
                                                    <input
                                                            placeholder="گرایش را وارد کنید" type="text"
                                                            @if(!$edit) disabled @endif
                                                            name="trend"
                                                            class="form-control rtl"
                                                            value=@if(isset($user)) {{$user->trend}}  @else"{{ old('trend') }}"@endif>
                                                </div>
                                                @if ($errors->any()&& $errors->first('trend'))
                                                    <p class="mt-2 text-danger mr-1">{{$errors->first('trend')}}</p>
                                                @endif
                                            </div>
                                            {{--//گرایش انگلیسی--}}
                                            @if($role=='teacher')
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">گرایش به انگلیسی</span>
                                                        </div>
                                                        <input maxlength="11"
                                                               placeholder="گرایش انگلیسی را وارد کنید" type="text"
                                                               @if(!$edit) disabled @endif
                                                               name="trend_en"
                                                               class="form-control rtl"
                                                               value=@if(isset($user)) {{$user->trend_en}}  @else"{{ old('trend_en') }}"@endif>
                                                    </div>
                                                    @if ($errors->any()&& $errors->first('trend_en'))
                                                        <p class="mt-2 text-danger mr-1">{{$errors->first('trend_en')}}</p>
                                                    @endif
                                                </div>
                                            @endif
                                            {{--//حوزه پژوهش--}}
                                            @if($role=='teacher')
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">حوزه پژوهشی</span>
                                                        </div>
                                                        <input
                                                                placeholder="حوزه پژوهش را وارد کنید" type="text"
                                                                @if(!$edit) disabled @endif
                                                                name="research"
                                                                class="form-control rtl"
                                                                value=@if(isset($user)) {{$user->research}}  @else"{{ old('research') }}"@endif>
                                                    </div>
                                                    @if ($errors->any()&& $errors->first('research'))
                                                        <p class="mt-2 text-danger mr-1">{{$errors->first('research')}}</p>
                                                    @endif
                                                </div>
                                            @endif
                                            {{--//شبا--}}
                                            <div class="form-group" hidden>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">شبا</span>
                                                    </div>
                                                    <input
                                                            placeholder="شماره شبای بانکی خود را وارد کنید" type="text"
                                                            @if(!$edit) disabled @endif
                                                            name="shaba"
                                                            class="form-control rtl"
                                                            value=@if(isset($user)) {{$user->shaba}}  @else"{{ old('shaba') }}"@endif>
                                                </div>
                                                @if ($errors->any()&& $errors->first('shaba'))
                                                    <p class="mt-2 text-danger mr-1">{{$errors->first('shaba')}}</p>
                                                @endif
                                            </div>
                                            {{--//دوره--}}
                                            @if($role=='student')
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">دوره</span>
                                                        </div>
                                                        <input maxlength="11"
                                                               placeholder="روزانه، شبانه ، مجازی و ...." type="text"
                                                               name="turn"
                                                               class="form-control rtl"
                                                               value=@if(isset($user)) {{$user->turn}}  @else"{{ old('turn') }}"@endif>
                                                    </div>
                                                    @if ($errors->any()&& $errors->first('turn'))
                                                        <p class="mt-2 text-danger mr-1">{{$errors->first('turn')}}</p>
                                                    @endif
                                                </div>
                                            @endif

                                            {{--//password--}}
                                            {{--@if($edit)--}}
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">تغییر رمز عبور</span>
                                                    </div>
                                                    <input
                                                            placeholder="رمز جدید را وارد کنید" type="text"
                                                            name="password"
                                                            class="form-control rtl"
                                                    >
                                                </div>
                                            </div>
                                            {{--@endif--}}
                                            {{--image--}}
                                            @if($edit)
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">عکس</span>
                                                        </div>
                                                        <div class="md-form form-line">
                                                            <input type="file" class="form-control"
                                                                   name="image">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if(isset($user)&&$user->image)
                                                <img src="/files/user{{$user->image}}"
                                                     style="height: 100px;width: 100px ; margin: auto;">
                                            @endif
                                            @if ($errors->any()&& $errors->first('image'))
                                                <p class="mt-2 text-danger mr-1">{{$errors->first('image')}}</p>
                                            @endif
                                        </div>

                                    </div>

                                </div>
                            </div>
                            {{--@if($edit)--}}
                            <div class="row">
                                <div class="col-md-10 offset-md-1">
                                    <button type="submit" class="btn btn-block btn-outline-primary" id="btn">ذخیره
                                    </button>
                                </div>
                            </div>
                            {{--@endif--}}
                        </form>


                    </div>
                </div>

            </div>

        </div>
    </div>


@endsection

@section('end')

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
