@extends('dashboard2.layout.app')

@section('start')
    <link href="{{("/style/assets/css/scrollspyNav.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{("/style/assets/css/components/tabs-accordian/custom-accordions.css")}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{("/style/plugins/bootstrap-select/bootstrap-select.min.css")}}" rel="stylesheet" type="text/css" />


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
        {{--<li class="breadcrumb-item active" aria-current="page"><span>تنظیمات</span></li>--}}
        {{--</ol>--}}
        {{--</nav>--}}


        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}


        <div class="row layout-top-spacing">


            <div class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    {{--<div id="accordionWithout-spacing" class="widget-header">--}}
                    {{--<div class="row">--}}
                    {{--<div class="col-xl-12 col-md-12 col-sm-12 col-12">--}}
                    {{--<h4>درس {{$course->name}}</h4>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    <div class="widget-content widget-content-area icon-accordion-content">
                        <div id="toggleAccordion">
                            <form action="/dashboard/courses/edit-setting"
                                  method="post" enctype="multipart/form-data">
                                @csrf
                                <input name="course_id" value="{{$course->id}}" hidden>

                                <div class="card">
                                    <div class="card-header" id="headingOne1">
                                        <section class="mb-0 mt-0">
                                            <div role="menu" class="collapsed" data-toggle="collapse"
                                                 data-target="#defaultAccordionOne" aria-expanded="true"
                                                 aria-controls="defaultAccordionOne">
                                                بارم بندی
                                                <div class="icons">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-chevron-down">
                                                        <polyline points="6 9 12 15 18 9"></polyline>
                                                    </svg>
                                                </div>
                                            </div>
                                        </section>
                                    </div>

                                    <div id="defaultAccordionOne" class="collapse" aria-labelledby="headingOne1"
                                         data-parent="#toggleAccordion">
                                        <div class="card-body">
                                            <div class="table-responsive product-table">
                                                <table class="display" id="table-1">
                                                    <thead>
                                                    <tr>
                                                        <th>موضوع</th>
                                                        <th>امتیاز</th>
                                                        <th>توضیح برای دانشجو</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    {{--                                            طراحی سوال--}}
                                                    <tr>
                                                        <td>
                                                            طراحی سوال
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    {{--<div class="input-group-prepend">--}}
                                                                    {{--<span class="input-group-text">سقف نمره</span>--}}
                                                                    {{--</div>--}}

                                                                    <input onchange="score()"
                                                                           placeholder="امتیاز " type="text"
                                                                           name="tarahi_soal_nomre"
                                                                           id="tarahi_soal_nomre"
                                                                           class="form-control rtl"
                                                                           value=" {{$setting->tarahi_soal_nomre}}">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    {{--<div class="input-group-prepend">--}}
                                                                    {{--<span class="input-group-text">سقف نمره</span>--}}
                                                                    {{--</div>--}}
                                                                    <textarea onchange="score()"
                                                                              placeholder="توضیح برای دانشجو " type="text"
                                                                              id="tarahi_soal_desc"
                                                                              name="tarahi_soal_desc"
                                                                              class="form-control rtl" style="font-size: 10px">{{$setting->tarahi_soal_desc}}</textarea>
                                                                    {{--<textarea onchange="score()"--}}
                                                                           {{--placeholder="توضیح برای دانشجو " type="text"--}}
                                                                           {{--id="tarahi_soal_desc"--}}
                                                                           {{--name="tarahi_soal_desc"--}}
                                                                           {{--class="form-control rtl"--}}
                                                                           {{--value=" {{$setting->tarahi_soal_desc}}">--}}
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    {{--ارسال گزارش--}}
                                                    <tr>
                                                        <td>
                                                            ارسال گزارش
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    {{--<div class="input-group-prepend">--}}
                                                                    {{--<span class="input-group-text">سقف نمره</span>--}}
                                                                    {{--</div>--}}
                                                                    <input onchange="score()"
                                                                           placeholder="امتیاز " type="text"
                                                                           name="ersal_gozaresh_nomre"
                                                                           id="ersal_gozaresh_nomre"
                                                                           class="form-control rtl"
                                                                           value=" {{$setting->ersal_gozaresh_nomre}}">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    {{--<div class="input-group-prepend">--}}
                                                                    {{--<span class="input-group-text">سقف نمره</span>--}}
                                                                    {{--</div>--}}
                                                                    <textarea
                                                                            placeholder="توضیح برای دانشجو " type="text"
                                                                            name="ersal_gozaresh_desc"
                                                                            class="form-control rtl" style="font-size: 10px"
                                                                            >{{$setting->ersal_gozaresh_desc}}</textarea>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    {{--تکلیف یا سمینار--}}
                                                    <tr>
                                                        <td>
                                                            تکلیف یا سمینار
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">

                                                                    <input onchange="score()"
                                                                           placeholder="امتیاز " type="text"
                                                                           name="taklif_seminar_nomre"
                                                                           id="taklif_seminar_nomre"
                                                                           class="form-control rtl"
                                                                           value=" {{$setting->taklif_seminar_nomre}}">
                                                                </div>
                                                            </div>
                                                            {{--<input--}}
                                                            {{--placeholder="سقف نمره " --}}
                                                            {{--type="text"--}}
                                                            {{--name="max_taklif"--}}
                                                            {{--class="form-control rtl"--}}
                                                            {{--value=" {{$setting->max_taklif}}">--}}
                                                        </td>
                                                        {{--<td>--}}
                                                            {{--<div class="form-group">--}}
                                                                {{--<div class="input-group">--}}
                                                                    {{--<div class="input-group-prepend">--}}
                                                                    {{--<span class="input-group-text">سقف نمره</span>--}}
                                                                    {{--</div>--}}
                                                                    {{--<input--}}
                                                                            {{--placeholder="توضیح" type="text"--}}
                                                                            {{--name="taklif_seminar_desc"--}}
                                                                            {{--class="form-control rtl"--}}
                                                                            {{--value=" {{$setting->taklif_seminar_desc}}">--}}
                                                                {{--</div>--}}
                                                            {{--</div>--}}
                                                        {{--</td>--}}
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">برآورد تعداد تکلیف یا سمینار</span>
                                                                    </div>
                                                                    <input
                                                                    placeholder="سقف نمره "
                                                                    type="text"
                                                                    name="max_taklif"
                                                                    class="form-control rtl"
                                                                    value=" {{$setting->max_taklif}}">


                                                                </div>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    {{--کوییز یا میانترم--}}
                                                    <tr>
                                                        <td>
                                                            آزمون
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    {{--<div class="input-group-prepend">--}}
                                                                    {{--<span class="input-group-text">سقف نمره</span>--}}
                                                                    {{--</div>--}}
                                                                    <input
                                                                            placeholder="امتیاز " type="text"
                                                                            id="quiz_mid_nomre"
                                                                            name="quiz_mid_nomre"
                                                                            class="form-control rtl"
                                                                            value=" {{$setting->quiz_mid_nomre}}">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">برآورد تعداد آزمون در ترم</span>
                                                                    </div>
                                                                    <input
                                                                            placeholder="تعداد کوییز در ترم"
                                                                            type="number"
                                                                            name="quiz_mid_desc"
                                                                            class="form-control rtl"
                                                                            value="{{$setting->quiz_mid_desc}}">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    {{--پیشرفت درسی--}}
                                                    <tr>
                                                        <td>
                                                            پیشرفت درسی
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    {{--<div class="input-group-prepend">--}}
                                                                    {{--<span class="input-group-text">سقف نمره</span>--}}
                                                                    {{--</div>--}}
                                                                    <input onchange="score()"
                                                                           placeholder="امتیاز " type="text"
                                                                           name="pishraft_nomre"
                                                                           id="pishraft_nomre"
                                                                           class="form-control rtl"
                                                                           value=" {{$setting->pishraft_nomre}}" >
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    {{--<div class="input-group-prepend">--}}
                                                                    {{--<span class="input-group-text">سقف نمره</span>--}}
                                                                    {{--</div>--}}
                                                                    <input
                                                                            placeholder="توضیح" type="text"
                                                                            {{--name="pishraft_desc"--}}
                                                                            class="form-control rtl"
                                                                            disabled
                                                                            value=" {{$setting->pishraft_desc}}" style="font-size: 10px">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    {{--تلاش و فعالیت--}}
                                                    <tr>
                                                        <td>
                                                            تلاش و فعالیت
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    {{--<div class="input-group-prepend">--}}
                                                                    {{--<span class="input-group-text">سقف نمره</span>--}}
                                                                    {{--</div>--}}
                                                                    <input onchange="score()"
                                                                           placeholder="امتیاز " type="text"
                                                                           id="talash_nomre"
                                                                           name="talash_nomre"
                                                                           class="form-control rtl"
                                                                           value=" {{$setting->talash_nomre}}">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    {{--<div class="input-group-prepend">--}}
                                                                    {{--<span class="input-group-text">سقف نمره</span>--}}
                                                                    {{--</div>--}}
                                                                    <input
                                                                            placeholder="امتیاز" type="text"
                                                                            {{--name="talash_desc"--}}
                                                                            class="form-control rtl"
                                                                            disabled
                                                                            value=" {{$setting->talash_desc}}" style="font-size: 10px">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    {{--حضور وغیاب--}}
                                                    <tr>
                                                        <td>
                                                            حضور وغیاب
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    {{--<div class="input-group-prepend">--}}
                                                                    {{--<span class="input-group-text">سقف نمره</span>--}}
                                                                    {{--</div>--}}
                                                                    <input onchange="score()"
                                                                           placeholder="امتیاز" type="text"
                                                                           id="hozor_nomre"
                                                                           name="hozor_nomre"
                                                                           class="form-control rtl"
                                                                           value=" {{$setting->hozor_nomre}}">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    {{--<div class="input-group-prepend">--}}
                                                                    {{--<span class="input-group-text">سقف نمره</span>--}}
                                                                    {{--</div>--}}
                                                                    <input
                                                                            placeholder="توضیح" type="text"
                                                                            name="hozor_desc"
                                                                            class="form-control rtl"
                                                                            value=" {{$setting->hozor_desc}}">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    {{--واحد عملی--}}
                                                    <tr>
                                                        <td>
                                                            واحد عملی
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    {{--<div class="input-group-prepend">--}}
                                                                    {{--<span class="input-group-text">سقف نمره</span>--}}
                                                                    {{--</div>--}}
                                                                    <input onchange="score()"
                                                                           placeholder="امتیاز" type="text"
                                                                           id="amali_nomre"
                                                                           name="amali_nomre"
                                                                           class="form-control rtl"
                                                                           value="{{$setting->amali_nomre}}">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    {{--<div class="input-group-prepend">--}}
                                                                    {{--<span class="input-group-text">سقف نمره</span>--}}
                                                                    {{--</div>--}}
                                                                    <textarea
                                                                            placeholder="توضیح" type="text"
                                                                            {{--name="amali_desc"--}}
                                                                            class="form-control rtl" style="font-size: 10px"
                                                                            disabled>{{$setting->amali_desc}}</textarea>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    {{--پایان ترم--}}
                                                    <tr>
                                                        <td>
                                                            پایان ترم
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    {{--<div class="input-group-prepend">--}}
                                                                    {{--<span class="input-group-text">سقف نمره</span>--}}
                                                                    {{--</div>--}}
                                                                    <input onchange="score()"
                                                                           placeholder="امتیاز" type="text"
                                                                           id="final_nomre"
                                                                           name="final_nomre"
                                                                           class="form-control rtl"
                                                                           value=" {{$setting->final_nomre}}">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    {{--<div class="input-group-prepend">--}}
                                                                    {{--<span class="input-group-text">سقف نمره</span>--}}
                                                                    {{--</div>--}}
                                                                    <textarea
                                                                            placeholder="توضیح" type="text"
                                                                            {{--name="final_desc"--}}
                                                                            disabled
                                                                            class="form-control rtl"
                                                                            style="font-size: 10px">{{$setting->final_desc}}</textarea>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    {{--مجموع امتیازات--}}
                                                    <tr>
                                                        <td>
                                                            مجموع امتیازات
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    {{--<div class="input-group-prepend">--}}
                                                                    {{--<span class="input-group-text">سقف نمره</span>--}}
                                                                    {{--</div>--}}
                                                                    <input
                                                                            placeholder="سقف نمره " type="text"
                                                                            id="all"
                                                                            class="form-control rtl"
                                                                            {{--value=" {{$course->score_q}}"--}}

                                                                            value =" {{$setting->tarahi_soal_nomre+$setting->ersal_gozaresh_nomre+$setting->taklif_seminar_nomre+
                                                                            $setting->final_nomre+$setting->quiz_mid_nomre+
                                                                            $setting->talash_nomre+$setting->pishraft_nomre+$setting->quiz_midhozor_nomre_nomre+$setting->amali_nomre}}"
>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            {{--<div class="form-group">--}}
                                                            {{--<div class="input-group">--}}
                                                            {{--<div class="input-group-prepend">--}}
                                                            {{--<span class="input-group-text">سقف نمره</span>--}}
                                                            {{--</div>--}}
                                                            {{--<input--}}
                                                            {{--placeholder="سقف نمره " type="text"--}}
                                                            {{--name="score_q"--}}
                                                            {{--class="form-control rtl"--}}
                                                            {{--value=" {{$course->score_q}}">--}}
                                                            {{--</div>--}}
                                                            {{--</div>--}}
                                                        </td>
                                                    </tr>
                                                    {{--ارفاق خارج از 20--}}
                                                    <tr>
                                                        <td>
                                                            ارفاق خارج از 20
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    {{--<div class="input-group-prepend">--}}
                                                                    {{--<span class="input-group-text">سقف نمره</span>--}}
                                                                    {{--</div>--}}
                                                                    <input
                                                                            placeholder="امتیاز" type="text"
                                                                            name="erfagh_nomre"
                                                                            id="erfagh"
                                                                            class="form-control rtl"
                                                                            value=" {{$setting->erfagh_nomre}}">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    {{--<div class="input-group-prepend">--}}
                                                                    {{--<span class="input-group-text">سقف نمره</span>--}}
                                                                    {{--</div>--}}
                                                                    <input
                                                                            placeholder="توضیح" type="text"
                                                                            name="erfagh_desc"
                                                                            class="form-control rtl"
                                                                            value=" {{$setting->erfagh_desc}}">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    {{--نمره نهایی با ارفاق--}}
                                                    <tr>
                                                        <td>
                                                            نمره نهایی با ارفاق
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    {{--<div class="input-group-prepend">--}}
                                                                    {{--<span class="input-group-text">سقف نمره</span>--}}
                                                                    {{--</div>--}}
                                                                    <input
                                                                            placeholder="سقف نمره " type="text"
                                                                            {{--name="score_q"--}}
                                                                            id="final"
                                                                            class="form-control rtl"
                                                                            {{--value=" {{$course->score_q}}"--}}
                                                                            value="{{($setting->tarahi_soal_nomre+$setting->ersal_gozaresh_nomre+$setting->taklif_seminar_nomre+
                                                                            $setting->final_nomre+$setting->quiz_mid_nomre+
                                                                            $setting->talash_nomre+$setting->pishraft_nomre+$setting->quiz_midhozor_nomre_nomre+$setting->amali_nomre)/5 + $setting->erfagh_nomre}}"
                                                                    >
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            {{--<div class="form-group">--}}
                                                            {{--<div class="input-group">--}}
                                                            {{--<div class="input-group-prepend">--}}
                                                            {{--<span class="input-group-text">سقف نمره</span>--}}
                                                            {{--</div>--}}
                                                            {{--<input--}}
                                                            {{--placeholder="سقف نمره " type="text"--}}
                                                            {{--name="score_q"--}}
                                                            {{--class="form-control rtl"--}}
                                                            {{--value=" {{$course->score_q}}">--}}
                                                            {{--</div>--}}
                                                            {{--</div>--}}
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingOne1">
                                        <section class="mb-0 mt-0">
                                            <div role="menu" class="collapsed" data-toggle="collapse"
                                                 data-target="#defaultAccordiontwo" aria-expanded="true"
                                                 aria-controls="defaultAccordionOne">
                                                فعالیت ها
                                                <div class="icons">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-chevron-down">
                                                        <polyline points="6 9 12 15 18 9"></polyline>
                                                    </svg>
                                                </div>
                                            </div>
                                        </section>
                                    </div>

                                    <div id="defaultAccordiontwo" class="collapse" aria-labelledby="headingOne1"
                                         data-parent="#toggleAccordion">
                                        <div class="card-body">
                                            <div class="table-responsive product-table">
                                                <table class="display" id="table-1">
                                                    <thead>
                                                    <tr>
                                                        <th>موضوع</th>
                                                        <th>وضعیت</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    {{--last qu--}}
                                                    <tr>
                                                        <td>
                                                            دانشجو فقط برای اخرین جلسه درس مجاز به ثبت سوال است
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <div class="form-check">
                                                                        <input type="checkbox" name="soal_last"
                                                                               @if($setting->soal_last=='1') checked
                                                                               @endif class="form-check-input"
                                                                               id="exampleCheck1">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    {{--last gozaresh--}}
                                                    <tr>
                                                        <td>
                                                            دانشجو فقط برای اخرین جلسه درس مجاز به ارسال گزارش است
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <div class="form-check">
                                                                        <input type="checkbox" name="gozaresh_last"
                                                                               @if($setting->gozaresh_last=='1') checked
                                                                               @endif class="form-check-input"
                                                                               id="exampleCheck1">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    {{--last taklif--}}
                                                    <tr>
                                                        <td>
                                                            دانشجو فقط برای اخرین جلسه درس مجاز به ارسال تکلیف است
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <div class="form-check">
                                                                        <input type="checkbox" name="taklif_last"
                                                                               @if($setting->taklif_last=='1') checked
                                                                               @endif class="form-check-input"
                                                                               id="exampleCheck1">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    {{--max q--}}
                                                    <tr>
                                                        <td>
                                                            حداکثر تعداد سوالاتی که توسط دانشجو در هر جلسه طرح می شود
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    {{--<div class="input-group-prepend">--}}
                                                                    {{--<span class="input-group-text">سقف نمره</span>--}}
                                                                    {{--</div>--}}
                                                                    <input
                                                                            {{--placeholder="سقف نمره " --}}
                                                                            type="text"
                                                                            name="max_soal"
                                                                            class="form-control rtl"
                                                                            value=" {{$setting->max_soal}}">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    {{--min q--}}
                                                    <tr>
                                                        <td>
                                                            تعداد سوالاتی که طرح آن توسط دانشجو الزامی است
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    {{--<div class="input-group-prepend">--}}
                                                                    {{--<span class="input-group-text">سقف نمره</span>--}}
                                                                    {{--</div>--}}
                                                                    <input
                                                                            {{--placeholder="سقف نمره "--}}
                                                                            type="text"
                                                                            name="min_soal"
                                                                            class="form-control rtl"
                                                                            value=" {{$setting->min_soal}}">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    {{--tedad davari--}}
                                                    <tr>
                                                        <td>
                                                            حداقل تعداد داوری در هر هفته
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    {{--<div class="input-group-prepend">--}}
                                                                    {{--<span class="input-group-text">سقف نمره</span>--}}
                                                                    {{--</div>--}}
                                                                    <input
                                                                            {{--placeholder="سقف نمره "--}}
                                                                            type="text"
                                                                            name="min_davari"
                                                                            class="form-control rtl"
                                                                            value=" {{$setting->min_davari}}">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    {{--max taklif--}}
                                                    {{--<tr>--}}
                                                        {{--<td>--}}
                                                            {{--برآورد حداکثر تعداد تکالیفی که به دانشجو در طول ترم داده می--}}
                                                            {{--شود--}}
                                                        {{--</td>--}}
                                                        {{--<td>--}}
                                                            {{--<div class="form-group">--}}
                                                                {{--<div class="input-group">--}}
                                                                    {{--<div class="input-group-prepend">--}}
                                                                    {{--<span class="input-group-text">سقف نمره</span>--}}
                                                                    {{--</div>--}}
                                                                    {{--<input--}}
                                                                            {{--placeholder="سقف نمره " --}}
                                                                            {{--type="text"--}}
                                                                            {{--name="max_taklif"--}}
                                                                            {{--class="form-control rtl"--}}
                                                                            {{--value=" {{$setting->max_taklif}}">--}}
                                                                {{--</div>--}}
                                                            {{--</div>--}}
                                                        {{--</td>--}}
                                                    {{--</tr>--}}
                                                    {{--max seminar--}}
                                                    <tr hidden>
                                                        <td>
                                                            حداکثر تعداد سمینارهایی که توسط دانشجو در طول ترم ارسال می
                                                            شود
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">سقف نمره</span>
                                                                    </div>
                                                                    <input
                                                                            placeholder="سقف نمره " type="text"
                                                                            {{--name="score_q"--}}
                                                                            class="form-control rtl"
                                                                            value=" {{$course->score_q}}">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    {{--max_gheibat--}}
                                                    <tr>
                                                        <td>
                                                            حداکثر تعداد غیبت دنشجو در طول ترم
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    {{--<div class="input-group-prepend">--}}
                                                                    {{--<span class="input-group-text">سقف نمره</span>--}}
                                                                    {{--</div>--}}
                                                                    <input
                                                                            {{--placeholder="سقف نمره " --}}
                                                                            type="text"
                                                                            name="max_gheibat"
                                                                            class="form-control rtl"
                                                                            value=" {{$setting->max_gheibat}}">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingThree1">
                                        <section class="mb-0 mt-0">
                                            <div role="menu" class="collapsed" data-toggle="collapse"
                                                 data-target="#defaultAccordionThree" aria-expanded="false"
                                                 aria-controls="defaultAccordionThree">
                                                آزمون ها
                                                <div class="icons">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-chevron-down">
                                                        <polyline points="6 9 12 15 18 9"></polyline>
                                                    </svg>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                    <div id="defaultAccordionThree" class="collapse" aria-labelledby="headingThree1"
                                         data-parent="#toggleAccordion">
                                        <div class="card-body">
                                            <div class="table-responsive product-table">
                                                <table class="display" id="table-1">
                                                    <thead>
                                                    <tr>
                                                        <th>موضوع</th>
                                                        <th>وضعیت</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    {{--min-w-khod--}}
                                                    <tr>
                                                        <td>
                                                            حداقل دفعات شرکت در خود آزمایی در طول هفته
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">

                                                                    <input
                                                                            placeholder="عدد " type="number"
                                                                            name="min_w_khod"
                                                                            class="form-control rtl"
                                                                            value="{{$setting->min_w_khod}}">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    {{--q num--}}
                                                    <tr>
                                                        <td>
                                                            تعداد سوالات در هر خودآزمایی
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <input
                                                                            placeholder="عدد " type="number"
                                                                            name="q_num"
                                                                            class="form-control rtl"
                                                                            value="{{$setting->q_num}}">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    {{--sathe soala--}}
                                                    <tr>
                                                        <td>
                                                            سطح سوالات در هر خودآزمایی
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <div class="form-check">


                                                                        <select class="selectpicker"  title="یک گزینه را انتخاب کنید" name="sath_khod">
                                                                            <option  selected  value="1">عالی</option>
                                                                            <option @if($setting->sath_khod=='2') selected @endif value="2">عالی و خوب</option>
                                                                            <option @if($setting->sath_khod=='3') selected @endif value="3">خوب</option>
                                                                        </select>
                                                                        {{----}}
                                                                        {{--<input type="radio" id="awli" name="sath_khod"--}}
                                                                               {{--value="1" checked>--}}
                                                                        {{--<label for="awli">عالی</label><br>--}}
                                                                        {{--<input type="radio" id="khob" name="sath_khod"--}}
                                                                               {{--value="2"--}}
                                                                               {{--@if($setting->sath_khod=='2') checked @endif>--}}
                                                                        {{--<label for="khob"> عالی و خوب</label><br>--}}

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    {{--zaman_sorati--}}
                                                    {{--<tr>--}}
                                                        {{--<td>--}}
                                                            {{--نحوه تخصیص زمان در هر کوییز (میانترم)--}}
                                                        {{--</td>--}}
                                                        {{--<td>--}}
                                                            {{--<div class="form-group">--}}
                                                                {{--<div class="input-group">--}}
                                                                    {{--<div class="form-check">--}}

                                                                    {{--</div>--}}
                                                                {{--</div>--}}
                                                            {{--</div>--}}
                                                        {{--</td>--}}
                                                    {{--</tr>--}}
                                                    {{--show-ans--}}
                                                    <tr>
                                                        <td>
                                                            پاسخ سوالات خود آزمایی به دانشجو نشان داده شود
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <div class="form-check">
                                                                        <input type="checkbox" name="show_khod"
                                                                               @if($setting->show_khod=='1') checked
                                                                               @endif class="form-check-input"
                                                                               id="exampleCheck1">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    {{--quiz-num--}}
                                                    <tr>
                                                        <td>
                                                            تعداد سوالات کوییز (میانترم)
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <input
                                                                            placeholder="عدد " type="number"
                                                                            name="quiz_num"
                                                                            class="form-control rtl"
                                                                            value="{{$setting->quiz_num}}">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    {{--sathe quiz--}}
                                                    <tr>
                                                        <td>
                                                            سطح سوالات در هر کوییز (میانترم)
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <div class="form-check">

                                                                        <select class="selectpicker"  title="یک گزینه را انتخاب کنید" name="sath_quiz">
                                                                            <option  selected  value="1">عالی</option>
                                                                            <option @if($setting->sath_quiz=='2') selected @endif value="2">عالی و خوب</option>
                                                                            <option @if($setting->sath_quiz=='3') selected @endif value="3">خوب</option>
                                                                        </select>

                                                                        {{--<input type="radio" id="awli" name="sath_quiz"--}}
                                                                               {{--value="1" checked>--}}
                                                                        {{--<label for="awli">عالی</label><br>--}}
                                                                        {{--<input type="radio" id="khob" name="sath_quiz"--}}
                                                                               {{--value="2"--}}
                                                                               {{--@if($setting->sath_quiz=='2') checked @endif>--}}
                                                                        {{--<label for="khob"> عالی و خوب</label><br>--}}


                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    {{--zama quiz--}}
                                                    {{--<tr>--}}
                                                        {{--<td>--}}
                                                            {{--نحوه تخصیص زمان در هر کوییز (میانترم)--}}
                                                        {{--</td>--}}
                                                        {{--<td>--}}
                                                            {{--<div class="form-group">--}}
                                                                {{--<div class="input-group">--}}
                                                                    {{--<div class="form-check">--}}

                                                                    {{--</div>--}}
                                                                {{--</div>--}}
                                                            {{--</div>--}}
                                                        {{--</td>--}}
                                                    {{--</tr>--}}
                                                    {{--natije--}}
                                                    <tr>
                                                        <td>
                                                            دانشجو بلافاصله بعد از ازمون نتیجه خود را ببیند
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <div class="form-check">
                                                                        <input type="checkbox" name="natije"
                                                                               @if($setting->natije=='1') checked
                                                                               @endif class="form-check-input"
                                                                               id="exampleCheck1">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    {{--show-ans--}}
                                                    <tr>
                                                        <td>
                                                            پاسخ سوالات کوییز به دانشجو نشان داده شود
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <div class="form-check">
                                                                        <input type="checkbox" name="show_quiz"
                                                                               @if($setting->show_quiz=='1') checked
                                                                               @endif class="form-check-input"
                                                                               id="exampleCheck1">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>


                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingThree1">
                                        <section class="mb-0 mt-0">
                                            <div role="menu" class="collapsed" data-toggle="collapse"
                                                 data-target="#defaultAccordionzarib" aria-expanded="false"
                                                 aria-controls="defaultAccordionzarib">
                                                ضریب اثر هر کدام از فعالیت ها
                                                <div class="icons">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-chevron-down">
                                                        <polyline points="6 9 12 15 18 9"></polyline>
                                                    </svg>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                    <div id="defaultAccordionzarib" class="collapse" aria-labelledby="headingThree1"
                                         data-parent="#toggleAccordion">
                                        <div class="card-body">
                                            <div class="table-responsive product-table">
                                                <table class="display" id="table-1">
                                                    <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>عالی</th>
                                                        <th>خوب</th>
                                                        <th>متوسط</th>
                                                        <th>ضعیف</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    {{--                                            طراحی سوال--}}
                                                    <tr>
                                                        <td>
                                                            طراحی سوال
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    {{--<div class="input-group-prepend">--}}
                                                                    {{--<span class="input-group-text">سقف نمره</span>--}}
                                                                    {{--</div>--}}
                                                                    <input
                                                                            placeholder="امتیاز " type="text"
                                                                            name="q_1"
                                                                            class="form-control rtl"
                                                                            value=" {{$scoring->q_1}}">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    {{--<div class="input-group-prepend">--}}
                                                                    {{--<span class="input-group-text">سقف نمره</span>--}}
                                                                    {{--</div>--}}
                                                                    <input
                                                                            placeholder="امتیاز " type="text"
                                                                            name="q_2"
                                                                            class="form-control rtl"
                                                                            value=" {{$scoring->q_2}}">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    {{--<div class="input-group-prepend">--}}
                                                                    {{--<span class="input-group-text">سقف نمره</span>--}}
                                                                    {{--</div>--}}
                                                                    <input
                                                                            placeholder="امتیاز " type="text"
                                                                            name="q_3"
                                                                            class="form-control rtl"
                                                                            value=" {{$scoring->q_3}}">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    {{--<div class="input-group-prepend">--}}
                                                                    {{--<span class="input-group-text">سقف نمره</span>--}}
                                                                    {{--</div>--}}
                                                                    <input
                                                                            placeholder="امتیاز " type="text"
                                                                            name="q_4"
                                                                            class="form-control rtl"
                                                                            value=" {{$scoring->q_4}}">
                                                                </div>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    {{--                                            گزارش--}}
                                                    <tr>
                                                        <td>
                                                            گزارش
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    {{--<div class="input-group-prepend">--}}
                                                                    {{--<span class="input-group-text">سقف نمره</span>--}}
                                                                    {{--</div>--}}
                                                                    <input
                                                                            placeholder="امتیاز " type="text"
                                                                            name="d_1"
                                                                            class="form-control rtl"
                                                                            value=" {{$scoring->d_1}}">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    {{--<div class="input-group-prepend">--}}
                                                                    {{--<span class="input-group-text">سقف نمره</span>--}}
                                                                    {{--</div>--}}
                                                                    <input
                                                                            placeholder="امتیاز " type="text"
                                                                            name="d_2"
                                                                            class="form-control rtl"
                                                                            value=" {{$scoring->d_2}}">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    {{--<div class="input-group-prepend">--}}
                                                                    {{--<span class="input-group-text">سقف نمره</span>--}}
                                                                    {{--</div>--}}
                                                                    <input
                                                                            placeholder="امتیاز " type="text"
                                                                            name="d_3"
                                                                            class="form-control rtl"
                                                                            value=" {{$scoring->d_3}}">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    {{--<div class="input-group-prepend">--}}
                                                                    {{--<span class="input-group-text">سقف نمره</span>--}}
                                                                    {{--</div>--}}
                                                                    <input
                                                                            placeholder="امتیاز " type="text"
                                                                            name="d_4"
                                                                            class="form-control rtl"
                                                                            value=" {{$scoring->d_4}}">
                                                                </div>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    {{--                                            تکلیف--}}
                                                    <tr>
                                                        <td>
                                                            تکلیف
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    {{--<div class="input-group-prepend">--}}
                                                                    {{--<span class="input-group-text">سقف نمره</span>--}}
                                                                    {{--</div>--}}
                                                                    <input
                                                                            placeholder="امتیاز " type="text"
                                                                            name="e_1"
                                                                            class="form-control rtl"
                                                                            value=" {{$scoring->e_1}}">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    {{--<div class="input-group-prepend">--}}
                                                                    {{--<span class="input-group-text">سقف نمره</span>--}}
                                                                    {{--</div>--}}
                                                                    <input
                                                                            placeholder="امتیاز " type="text"
                                                                            name="e_2"
                                                                            class="form-control rtl"
                                                                            value=" {{$scoring->e_2}}">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    {{--<div class="input-group-prepend">--}}
                                                                    {{--<span class="input-group-text">سقف نمره</span>--}}
                                                                    {{--</div>--}}
                                                                    <input
                                                                            placeholder="امتیاز " type="text"
                                                                            name="e_3"
                                                                            class="form-control rtl"
                                                                            value=" {{$scoring->e_3}}">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    {{--<div class="input-group-prepend">--}}
                                                                    {{--<span class="input-group-text">سقف نمره</span>--}}
                                                                    {{--</div>--}}
                                                                    <input
                                                                            placeholder="امتیاز " type="text"
                                                                            name="e_4"
                                                                            class="form-control rtl"
                                                                            value=" {{$scoring->e_4}}">
                                                                </div>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    {{--                                            سمینار--}}
                                                    <tr>
                                                        <td>
                                                            سمینار
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    {{--<div class="input-group-prepend">--}}
                                                                    {{--<span class="input-group-text">سقف نمره</span>--}}
                                                                    {{--</div>--}}
                                                                    <input
                                                                            placeholder="امتیاز " type="text"
                                                                            name="s_1"
                                                                            class="form-control rtl"
                                                                            value=" {{$scoring->s_1}}">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    {{--<div class="input-group-prepend">--}}
                                                                    {{--<span class="input-group-text">سقف نمره</span>--}}
                                                                    {{--</div>--}}
                                                                    <input
                                                                            placeholder="امتیاز " type="text"
                                                                            name="s_2"
                                                                            class="form-control rtl"
                                                                            value=" {{$scoring->s_2}}">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    {{--<div class="input-group-prepend">--}}
                                                                    {{--<span class="input-group-text">سقف نمره</span>--}}
                                                                    {{--</div>--}}
                                                                    <input
                                                                            placeholder="امتیاز " type="text"
                                                                            name="s_3"
                                                                            class="form-control rtl"
                                                                            value=" {{$scoring->s_3}}">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    {{--<div class="input-group-prepend">--}}
                                                                    {{--<span class="input-group-text">سقف نمره</span>--}}
                                                                    {{--</div>--}}
                                                                    <input
                                                                            placeholder="امتیاز " type="text"
                                                                            name="s_4"
                                                                            class="form-control rtl"
                                                                            value=" {{$scoring->s_4}}">
                                                                </div>
                                                            </div>
                                                        </td>

                                                    </tr>

                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                </div>


                                <div class="row" id="btn_submit">
                                    <div class="col-md-10 offset-md-1">
                                        <button type="submit" class="btn btn-block btn-outline-primary" id="btn">ذخیره
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        @include('dashboard2.layout.footer')


    </div>


@endsection

@section('end')

    <script src="{{("/style/assets/js/scrollspyNav.js")}}"></script>
    <script src="{{("/style/assets/js/components/ui-accordions.js")}}"></script>
    <script src="{{("/style/plugins/bootstrap-select/bootstrap-select.min.js")}}"></script>


    <script>
        function score() {
            $score = 0;
            $score = parseInt(document.getElementById('tarahi_soal_nomre').value)
                + parseInt(document.getElementById('ersal_gozaresh_nomre').value)
                +
                parseInt(document.getElementById('taklif_seminar_nomre').value)
                +
                parseInt(document.getElementById('final_nomre').value)
                +
                parseInt(document.getElementById('quiz_mid_nomre').value)
                +
                parseInt(document.getElementById('talash_nomre').value)
                +
                parseInt(document.getElementById('pishraft_nomre').value)
                +
                parseInt(document.getElementById('hozor_nomre').value)
                +
                parseInt(document.getElementById('amali_nomre').value)
            ;
            // alert($score);
            document.getElementById('all').value = $score;
            document.getElementById('final').value = ($score / 5) + parseInt(document.getElementById('erfagh').value);
            if ($score > 100) {
                document.getElementById('btn_submit').style.display = "none";
                alert('مجموع امتیازات بیش از 100 می باشد.')
            } else
                document.getElementById('btn_submit').style.display = "block";

        }
    </script>

@endsection
