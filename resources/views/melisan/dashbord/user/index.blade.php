@extends('melisan.layout.master')
@section('add-styles')
    <!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@endsection
@section('title', 'صفحه اصلی')
@section('main-content')
    @if(!$user->mobile && 0)
        <div class="row">
            {{-- <form class="col s12" action="/dashboard/courses/list" method="get">--}}
                {{-- @csrf--}}

                <p>
                    جهت تائید حساب وارد <a href="/dashboard/user/{{$user->id}}"> پروفایل </a>شوید و موبایل را وارد کنید
                </p>
                {{-- <div class="row">--}}
                    {{-- <div class="input-field col s12">--}}
                        {{-- <input id="code" name="code" type="text" class="validate">--}}
                        {{-- <label class="contact-input" for="code">کد تائیدیه</label>--}}
                        {{-- </div>--}}
                    {{-- </div>--}}
                {{-- <input type="submit" class="btn btn-primary btn-block" value="تائید">--}}
                {{--
            </form>--}}
        </div>
    @elseif(($user->active == 0 || !$user->mobile) && 0)
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
          <div class="main-card-dashboard">
        <div class="row g-4">
            <!-- درس‌ها -->
            <div class="col-12 col-md-6">
                <a href="dashboard/courses/list" class="btn-card-dashboard lessons-dashboard" 
                         style=" background: #690d83" >
                    <div class="btn-content-dashboard">
                                    <i class="fas fa-book fa-2x"></i>
                        <div class="btn-title-dashboard">درس‌ها</div>
                    </div>
                    <div class="icon-container-dashboard">
                        <div class="btn-count-dashboard">3</div>
                        <div class="btn-info-dashboard"> دروس فعال</div>
                    </div>
                </a>
            </div>
          <!-- دوره‌ها -->
            <div class="col-12 col-md-6 ">
                <a href="/publics" class="btn-card-dashboard lessons-dashboard" 
                style=" background: #690d83">
                    <div class="btn-content-dashboard">
                              <i class="fas fa-graduation-cap fa-2x"></i>
                        <div class="btn-title-dashboard">دوره ها</div>
                    </div>
                    <div class="icon-container-dashboard">
                        <div class="btn-count-dashboard">5</div>
                        <div class="btn-info-dashboard"> دوره فعال</div>
                    </div>
                </a>
            </div>
            <!-- آزمون‌ها -->
               <div class="col-12 col-md-6 ">
                <a href="/dashboard/konkor/list" class="btn-card-dashboard lessons-dashboard" 
                style=" background: #690d83" >
                    <div class="btn-content-dashboard">
                                  <i class="fas fa-clipboard-list fa-2x"></i>
                        <div class="btn-title-dashboard">آزمون ها</div>
                    </div>
                    <div class="icon-container-dashboard">
                        <div class="btn-count-dashboard">5</div>
                        <div class="btn-info-dashboard"> آزمون های درحال برگزاری</div>
                    </div>
                </a>
            </div>
        @if($user->hasRole('teacher'))
         <div class="col-12 col-md-6">
                <a href="dashboard/courses/list" class="btn-card-dashboard lessons-dashboard" 
                       style=" background: #690d83" >
                    <div class="btn-content-dashboard">
                                     <i class="fas fa-user-graduate fa-2x"></i>
                        <div class="btn-title-dashboard">دانشجوها</div>
                    </div>
                    <div class="icon-container-dashboard">
                        <div class="btn-count-dashboard">3</div>
                        <div class="btn-info-dashboard"> دانشجوی فعال</div>
                    </div>
                </a>
            </div>
        @endif
        </div>
    </div>
   
    
    @endif

@endsection

@section('js')

@endsection