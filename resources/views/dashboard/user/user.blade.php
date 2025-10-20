@extends('dashboard.layout.app')
@section('title','صفحه نمایش دوره')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('all-css/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('all-css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('all-css/owlcarousel.css')}}">

@endpush
@section('content')

    <div>
        <div class="container-fluid">
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
                                                value="@if(isset($user)) {{$user->email}} @endif" disabled>
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
                                               @if(!$edit) disabled @endif  required>
                                    </div>
                                    @if ($errors->any()&& $errors->first('national'))
                                        <p class="mt-2 text-danger mr-1">{{$errors->first('national')}}</p>
                                    @endif
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
                                            @if(Laratrust::hasRole("teacher"))
                                                کد استادی
                                            @elseif(Laratrust::hasRole("student"))
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
                                                class="normal-example form-control"
                                                value=@if(isset($user)) {{$user->jalali_birthdate}} @else"{{ old('birthdate') }}"@endif>
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
                                        <input maxlength="11"
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
                                {{--//address--}}
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">ادرس پستی</span>
                                        </div>
                                        <input maxlength="11"
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
                                        <input maxlength="11"
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
                                @if(!Laratrust::hasRole("student"))
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">سایت</span>
                                        </div>
                                        <input maxlength="11"
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
                                @if(!Laratrust::hasRole("student"))
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">صفحه اسکولار</span>
                                        </div>
                                        <input maxlength="11"
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
                                        <input maxlength="11"
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
                                            @if(Laratrust::hasRole("teacher"))
                                                آخرین مدرک تحصیلی
                                            @elseif(Laratrust::hasRole("student"))
                                                مقطع تحصیلی
                                            @endif
                                                </span>
                                        </div>
                                        <input maxlength="11"
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
                                        <input maxlength="11"
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
                                        <input maxlength="11"
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
                                @if(!Laratrust::hasRole("student"))
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
                                @if(!Laratrust::hasRole("student"))
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">حوزه پژوهشی</span>
                                        </div>
                                        <input maxlength="11"
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
                                        <input maxlength="11"
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
                                @if(Laratrust::hasRole("student"))
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">دوره</span>
                                            </div>
                                            <input maxlength="11"
                                                   placeholder="دوره را وارد کنید" type="text"
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
                                            <input maxlength="11"
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
                                                       name="image" required>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if(isset($user)&&$user->image)
                                    <img src="/files/user{{$user->image}}"
                                         style="height: 100px;width: 100px ; margin: auto;">
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
            <br>
            <!-- /.row -->
        </div><!-- /.container-fluid -->


    </div>


@endsection

@push('scripts')
    <script src="{{asset('/cuba-style/assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/cuba-style/assets/js/rating/jquery.barrating.js')}}"></script>
    <script src="{{asset('/cuba-style/assets/js/owlcarousel/owl.carousel.js')}}"></script>
    <script src="{{asset('/cuba-style/assets/js/ecommerce.js')}}"></script>
    <script src="{{asset('/cuba-style/assets/js/product-list-custom.js')}}"></script>
    <script src="{{asset('/cuba-style/assets/js/tooltip-init.js')}}"></script>
@endpush
