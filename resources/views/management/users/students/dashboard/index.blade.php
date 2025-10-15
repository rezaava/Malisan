@extends('management.layout.master')
@section('add-styles')
<!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@endsection
@section('title', 'صفحه اصلی')
@section('main-content')


    @if(!$user->mobile && 0)
        <div class="row">
            {{--            <form class="col s12" action="/dashboard/courses/list" method="get">--}}
            {{--                @csrf--}}

            <p>
                جهت تائید حساب وارد <a href="/dashboard/user/{{$user->id}}"> پروفایل </a>شوید و موبایل را وارد کنید
            </p>
            {{--                <div class="row">--}}
            {{--                    <div class="input-field col s12">--}}
            {{--                        <input id="code" name="code" type="text" class="validate">--}}
            {{--                        <label class="contact-input" for="code">کد تائیدیه</label>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--                <input type="submit" class="btn btn-primary btn-block" value="تائید">--}}
            {{--            </form>--}}
        </div>
    @elseif(($user->active==0 || !$user->mobile )&& 0)
        <div class="row">
            <form class="col s12" action="/dashboard/courses/list" method="get">
                @csrf

                <p>
                    کد تائیدیه sms شده را وارد کنید
                </p>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="code" name="code" type="text" class="validate">
                        <label class="contact-input" for="code">کد تائیدیه</label>
                    </div>
                </div>
                <input type="submit" class="btn btn-primary btn-block" value="تائید">
            </form>
        </div>

        @else

<div class="card">
                            <div class="card-content">
                                <p class="caption mb-0">
                                    {!!$angizesh->text!!}
                            </div>
                        </div>
             <div id="cards-extended">
                 <div class="card">
                     <div class="card-content">
                         @if(isset($aneto['wallet'] ))

                         <div class="row justify-content-center mx-auto">
                             <div class="col  s12 m3 offset-m3">
                                 <div class="card gradient-shadow gradient-45deg-amber-amber border-radius-3">
                                     <div class="card-content center">
                                         <img src="../../../app-assets/images/icon/wallet.png" alt="images" class="width-60 " />
                                         <h5 class="white-text lighten-4">کیف پول طلایی</h5>
                                         <p class="white-text lighten-4">{{$aneto['silver_wallet']}} ریال</p>
                                     </div>
                                 </div>
                             </div>
                             <div class="col s12 m3">
                                 <div class="card gradient-shadow gradient-45deg-brown-brown border-radius-3">
                                     <div class="card-content center">
                                         <img src="../../../app-assets/images/icon/wallet.png" alt="images" class="width-60" />
                                         <h5 class="white-text lighten-4">کیف پول نقره ای </h5>
                                         <p class="white-text lighten-4">{{$aneto['wallet']}} ریال   </p>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         @endif
                         <div class="row" id="gradient-Analytics">
                             <a href="dashboard/courses/list" class="col s12 m6 l3 card-width">
                                 <div class="card row gradient-45deg-orange-amber gradient-shadow white-text padding-4 mt-5">
                                     <div class="col s7 m7">
                                         <i class="material-icons background-round mt-5 mb-5">format_list_bulleted</i>
                                         <p>درس ها</p>
                                     </div>
                                     <div class="col s5 m5 right-align">
                                         <h5 class="mb-0 white-text">{{\Illuminate\Support\Facades\Auth::user()->courses()->count()}}</h5>
                                         <p class="no-margin">درس فعال</p>

                                     </div>
                                 </div>
                             </a>
                             @if(\Illuminate\Support\Facades\Auth::user()->hasRole('teacher'))
                             <div class="col s12 m6 l3 card-width">
                                 <div class="card row  gradient-45deg-purple-light-blue gradient-shadow white-text padding-4 mt-5">
                                     <div class="col s7 m7 text-center">
                                         <i class="material-icons background-round mt-5 mb-5">perm_identity</i>
                                         <p>دانشجو ها</p>
                                     </div>
                                     <div class="col s5 m5 right-align">
                                         <h5 class="mb-0 white-text">50</h5>
                                         <p class="no-margin">دانشجوی فعال</p>

                                     </div>
                                 </div>
                             </div>
                             @endif
                             <a href="/publics" class="col s12 m6 l3 card-width">
                                 <div class="card row gradient-45deg-indigo-light-blue gradient-shadow white-text padding-4 mt-5">
                                     <div class="col s7 m7">
                                         <i class="material-icons background-round mt-5 mb-5">dvr</i>
                                         <p>دوره ها</p>
                                     </div>
                                     <div class="col s5 m5 right-align">
                                         <h5 class="mb-0 white-text">80</h5>
                                         <p class="no-margin">دوره در حال برگزاری</p>

                                     </div>
                                 </div>
                             </a>
                             <a href="/dashboard/konkor/list" class="col s12 m6 l3 card-width">
                                 <div class="card row gradient-45deg-green-teal gradient-shadow white-text padding-4 mt-5">
                                     <div class="col s7 m7">
                                         <i class="material-icons dp48 background-round mt-5 mb-5">event_available</i>
                                         <p>ازمون ها</p>
                                     </div>
                                     <div class="col s5 m5 right-align">
                                         <h5 class="mb-0 white-text">50</h5>
                                         <p class="no-margin">ازمون در حال برگزاری</p>

                                     </div>
                                 </div>
                             </a>
                         </div>
                     </div>
                 </div>
                 <div class="divider mt-2"></div>

             </div>
    <!--@endif-->

@endsection

@section('js')

@endsection
