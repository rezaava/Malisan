@extends('dashboard2.layout.app')

@section('start')

    <link href="{{("/style/assets/css/apps/mailing-chat.css")}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="{{("/style/assets/css/widgets/modules-widgets.css")}}">

    <link href="{{("/style/assets/css/scrollspyNav.css")}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="{{("/style/assets/css/forms/switches.css")}}">



    <link rel="stylesheet" type="text/css" href="{{("/style/plugins/table/datatable/datatables.css")}}">
    <link rel="stylesheet" type="text/css" href="{{("/style/assets/css/forms/theme-checkbox-radio.css")}}">
    <link rel="stylesheet" type="text/css" href="{{("/style/plugins/table/datatable/dt-global_style.css")}}">
    <link rel="stylesheet" type="text/css" href="{{("/style/plugins/table/datatable/custom_dt_custom.css")}}">

    <style>
        .feather-icon .icon-section {
            padding: 30px;
        }

        .feather-icon .icon-section h4 {
            color: #3b3f5c;
            font-size: 17px;
            font-weight: 600;
            margin: 0;
            margin-bottom: 16px;
        }

        .feather-icon .icon-content-container {
            padding: 0 16px;
            width: 86%;
            margin: 0 auto;
            border: 1px solid #bfc9d4;
            border-radius: 6px;
        }

        .feather-icon .icon-section p.fs-text {
            padding-bottom: 30px;
            margin-bottom: 30px;
        }

        .feather-icon .icon-container {
            cursor: pointer;
        }

        .feather-icon .icon-container svg {
            color: #3b3f5c;
            margin-right: 6px;
            vertical-align: middle;
            width: 20px;
            height: 20px;
            fill: rgba(0, 23, 55, 0.08);
        }

        .feather-icon .icon-container:hover svg {
            color: #1b55e2;
            fill: rgba(27, 85, 226, 0.23921568627450981);
        }

        .feather-icon .icon-container span {
            display: none;
        }

        .feather-icon .icon-container:hover span {
            color: #1b55e2;
        }

        .feather-icon .icon-link {
            color: #1b55e2;
            font-weight: 600;
            font-size: 14px;
        }

        /*FAB*/
        .fontawesome .icon-section {
            padding: 30px;
        }

        .fontawesome .icon-section h4 {
            color: #3b3f5c;
            font-size: 17px;
            font-weight: 600;
            margin: 0;
            margin-bottom: 16px;
        }

        .fontawesome .icon-content-container {
            padding: 0 16px;
            width: 86%;
            margin: 0 auto;
            border: 1px solid #bfc9d4;
            border-radius: 6px;
        }

        .fontawesome .icon-section p.fs-text {
            padding-bottom: 30px;
            margin-bottom: 30px;
        }

        .fontawesome .icon-container {
            cursor: pointer;
        }

        .fontawesome .icon-container i {
            font-size: 20px;
            color: #3b3f5c;
            vertical-align: middle;
            margin-right: 10px;
        }

        .fontawesome .icon-container:hover i {
            color: #1b55e2;
        }

        .fontawesome .icon-container span {
            color: #888ea8;
            display: none;
        }

        .fontawesome .icon-container:hover span {
            color: #1b55e2;
        }

        .fontawesome .icon-link {
            color: #1b55e2;
            font-weight: 600;
            font-size: 14px;
        }
    </style>

    <script>
        $ex_c = 0;
    </script>

@endsection
@section('main')

    <div id="content" class="main-content">
        @include('dashboard.layout.message')
        {{--<div id="breadcrumbDefault" class="col-xl-12 col-lg-12 layout-spacing">--}}
            {{--<div class="statbox widget box box-shadow">--}}
                {{--<div class="widget-content widget-content-area">--}}

                    {{--<nav class="breadcrumb-one" aria-label="breadcrumb">--}}
                        {{--<ol class="breadcrumb">--}}
                            {{--<li class="breadcrumb-item"><a href="/dashboard"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>--}}
                            {{--<li class="breadcrumb-item " aria-current="page"><a href="/dashboard/courses/sessions?course_id={{$course->id}}"> <span>درس {{$course->name}}</span></a></li>--}}
                            {{--<li class="breadcrumb-item active" aria-current="page"><span>دانشجویان</span></li>--}}
                        {{--</ol>--}}
                    {{--</nav>--}}


                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

        <div class="layout-px-spacing">

            {{--<div class="page-header">--}}
                {{--<div class="page-title">--}}
                    {{--<h3>لیست دانشجویان</h3>--}}
                {{--</div>--}}
            {{--</div>--}}

            <div class="row layout-spacing">
                <div class="col-lg-12">
                    <div class="statbox widget box box-shadow">

                        <div class="widget-content widget-content-area">
                            <div>
                                <a href="/dashboard/students/export?crs={{$course->id}}" class="btn btn-primary btn-block">دانلود لیست بصورت اکسل(پس از کلیک قدری صبر کنید)</a>
                            </div>
                            <div class="table-responsive mb-4">
                                <form method="post" class="was-validated"
                                      action="{{'/dashboard/courses/amali/'.$course->id}}"
                                      enctype="multipart/form-data">
                                    @csrf
                                <table id="zero-config" class="table table-responsive style-3  table-hover">
                                    <thead>
                                    <tr>
                                        <th class="checkbox-column text-center"> ردیف </th>
                                        <th class="text-center">عکس</th>
                                        <th class="text-center">نام</th>
                                        <th class="text-center">نام خانوادگی</th>
                                        @if($setting->amali_nomre>0)
                                        <th class="text-center">نمره عملی</th>
                                        @endif
                                        <th hidden>,,</th>
                                        @if($setting->final_nomre>0)
                                        <th class="text-center">نمره پایان ترم(از 20)</th>
                                        @endif
                                        <th class="text-center">مشخصات</th>
                                        <th class="text-center">پیشرفت درسی</th>
                                        <th class="text-center">سابقه خودآزمایی</th>
                                        <th class="text-center">اخراج</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $key=>$user)
                                        <tr>
                                            <td class="checkbox-column text-center"> {{$key+1}}
                                                @if($user->online)
                                                    <span class="spinner-grow text-success"></span>
                                                @else
                                                    <span class="spinner-grow text-dark " style="visibility: hidden"></span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <span>
                                                     @if(isset($user->image))
                                                        <img class="profile-img"
                                                             src="{{asset('/files/user').$user->image}}"
                                                             alt="{{$user->name}}"
                                                             style="height: 45px">
                                                    @else
                                                        <img class="profile-img"
                                                             src="{{asset('/files/user/avatar.png')}}"
                                                             alt="{{$user->name}}"
                                                             style="height: 45px">
                                                    @endif
                                                </span>
                                            </td>
                                            <td class="text-center" style="max-width: 70px">{{$user->name}}</td>
                                            <td class="text-center" style="max-width: 70px">{{$user->family}}</td>
                                            @if($setting->amali_nomre>0)
                                            <td class="text-center">
                                                <input name="amali[{{$user->id}}]" value="{{$user->nomre}}"  style="max-width: 45px">
                                            </td>
                                            @endif

                                            <td class="text-center" hidden>
                                                <input name="ind[{{$user->id}}]" value="{{$user->id}}">
                                            </td>

                                            @if($setting->final_nomre>0)
                                            <td class="text-center">
                                                <input name="final[{{$user->id}}]" type="number" step=".01" value="{{$user->final}}" max="20" style="max-width: 60px">
                                            </td>
                                            @endif
                                            <td class="text-center">
                                                <ul class="table-controls">
                                                    <li><a href="/dashboard/user/{{$user->id}}"
                                                                class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="مشاهده">
                                                            <i data-feather="eye"></i>
                                                        </a></li>
                                                </ul>
                                            </td>
                                            <td class="text-center">
                                                <ul class="table-controls">
                                                    <li>
                                                        <a href="/dashboard/progress?course_id={{$course->id}}&user={{$user->id}}"
                                                           class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="پیشرفت درسی">
                                                            <i data-feather="pie-chart"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>

                                            <td class="text-center">
                                                <ul class="table-controls">
                                                    <li>
                                                        <a href="/dashboard/quiz/list?course_id={{$course->id}}&user={{$user->id}}"
                                                           class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="سابقه امتحان">
                                                            <i data-feather="help-circle"></i>
                                                        </a></li>
                                                </ul>
                                            </td>
                                            <td class="text-center">
                                                <ul class="table-controls">
                                                    <li><a
{{--                                                                href="{{route('destroyUser',$user->id , $course->id)}}"--}}
                                                                href="/dashboard/courses/destroy-user?u={{$user->id}}&c={{$course->id}}"
                                                           onclick="return confirm('آیا مطمئن هستید ؟  ')"
                                                           class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="حذف">
                                                            {{--<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash p-1 br-6 mb-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>--}}
                                                            <i data-feather="x-circle"></i>

                                                        </a></li>
                                                </ul>
                                            </td>

                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>

@if($setting->amali_nomre >0 || $setting->final_nomre >0)
                                    <input type="submit"
                                           value= " ثبت نمره "
                                           class="btn btn-primary">
    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        @include('dashboard2.layout.footer')

    </div>

@endsection

@section('end')

    <script src="{{("/style/assets/js/apps/mailbox-chat.js")}}"></script>
    <script src="{{("/style/assets/js/widgets/modules-widgets.js")}}"></script>

    <script src="{{("/style/assets/js/scrollspyNav.js")}}"></script>


    <script src="{{("/style/assets/js/scrollspyNav.js")}}"></script>
    <script src="{{("/style/plugins/font-icons/feather/feather.min.js")}}"></script>
    <script type="text/javascript">
        feather.replace();
    </script>


    <script src="{{("/style/plugins/table/datatable/datatables.js")}}"></script>
    <script>
        $('#zero-config').DataTable({
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>' },
                "sInfo": "صفحه _PAGE_ از _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "جستجو کنید...",
                "sLengthMenu": "نتایج :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 7
        });
    </script>

@endsection
