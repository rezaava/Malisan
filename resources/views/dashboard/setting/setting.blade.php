@extends('dashboard.layout.app')
@section('title','صفحه نمایش دوره')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('/cuba-style/assets/css/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/cuba-style/assets/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/cuba-style/assets/css/owlcarousel.css')}}">

@endpush
@section('content')

    <div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header " style="background-color: darkblue">
                            <h3 class="card-title " style="color: white;margin-bottom: -50px">
                                درس {{$course->name}}
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
            <form action="/dashboard/courses/edit-setting"
                  method="post" enctype="multipart/form-data">
                @csrf
                <input name="course_id" value="{{$course->id}}" hidden>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-success">
                            <div class="card-header " style="background-color: darkgreen">
                                <h3 class="card-title " style="color: white;margin-bottom: -50px">
                                    بارم بندی
                                    <a onclick="hide('barom')"><span
                                                style="font-size: 10px">(مخفی)</span></a><a onclick="unhide('barom')"><span
                                                style="font-size: 10px">(نمایش)</span></a>
                                </h3>
                            </div>
                        </div>
                        <div class="card-body" id="barom" style="display: none">
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
                                                    <input onchange="score()"
                                                            placeholder="توضیح برای دانشجو " type="text"
                                                            id="tarahi_soal_desc"
                                                            name="tarahi_soal_desc"
                                                            class="form-control rtl"
                                                            value=" {{$setting->tarahi_soal_desc}}">
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
                                                    <input
                                                            placeholder="توضیح برای دانشجو " type="text"
                                                            name="ersal_gozaresh_desc"
                                                            class="form-control rtl"
                                                            value=" {{$setting->ersal_gozaresh_desc}}">
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
                                                    {{--<div class="input-group-prepend">--}}
                                                    {{--<span class="input-group-text">سقف نمره</span>--}}
                                                    {{--</div>--}}
                                                    <input onchange="score()"
                                                            placeholder="امتیاز " type="text"
                                                            name="taklif_seminar_nomre"
                                                            id="taklif_seminar_nomre"
                                                            class="form-control rtl"
                                                            value=" {{$setting->taklif_seminar_nomre}}">
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
                                                            name="taklif_seminar_desc"
                                                            class="form-control rtl"
                                                            value=" {{$setting->taklif_seminar_desc}}">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    {{--کوییز یا میانترم--}}
                                    <tr>
                                        <td>
                                            کوییز یا میانترم
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
                                                    <span class="input-group-text">تعداد کوییز در ترم</span>
                                                    </div>
                                                    <input
                                                            placeholder="تعداد کوییز در ترم" type="number"
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
                                                            value=" {{$setting->pishraft_nomre}}">
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
                                                            name="pishraft_desc"
                                                            class="form-control rtl"
                                                            value=" {{$setting->pishraft_desc}}">
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
                                                            name="talash_desc"
                                                            class="form-control rtl"
                                                            value=" {{$setting->talash_desc}}">
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
                                                            value=" {{$setting->amali_nomre}}">
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
                                                            name="amali_desc"
                                                            class="form-control rtl"
                                                            value=" {{$setting->amali_desc}}">
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
                                                    <input
                                                            placeholder="توضیح" type="text"
                                                            name="final_desc"
                                                            class="form-control rtl"
                                                            value=" {{$setting->final_desc}}">
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


                        <div class="card card-success">
                            <div class="card-header " style="background-color: darkgreen">
                                <h3 class="card-title " style="color: white;margin-bottom: -50px">
                                    فعالیت ها
                                    <a onclick="hide('faaliat')"><span
                                                style="font-size: 10px">(مخفی)</span></a><a onclick="unhide('faaliat')"><span
                                                style="font-size: 10px">(نمایش)</span></a>
                                </h3>
                            </div>
                        </div>
                        <div class="card-body" id="faaliat" style="display: none">
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
                                                               @endif class="form-check-input" id="exampleCheck1">
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
                                                               @endif class="form-check-input" id="exampleCheck1">
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
                                                               @endif class="form-check-input" id="exampleCheck1">
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
                                    <tr>
                                        <td>
                                            برآورد حداکثر تعداد تکالیفی که به دانشجو در طول ترم داده می شود
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
                                                            name="max_taklif"
                                                            class="form-control rtl"
                                                            value=" {{$setting->max_taklif}}">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    {{--max seminar--}}
                                    <tr hidden>
                                        <td>
                                            حداکثر تعداد سمینارهایی که توسط دانشجو در طول ترم ارسال می شود
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

                        <div class="card card-success">
                            <div class="card-header " style="background-color: darkgreen">
                                <h3 class="card-title " style="color: white;margin-bottom: -50px">
                                    آزمون ها
                                    <a onclick="hide('azmon')"><span
                                                style="font-size: 10px">(مخفی)</span></a><a onclick="unhide('azmon')"><span
                                                style="font-size: 10px">(نمایش)</span></a>
                                </h3>
                            </div>
                        </div>
                        <div class="card-body" id="azmon" style="display: none">
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


                                                        <input type="radio" id="awli" name="sath_khod"
                                                               value="1" checked>
                                                        <label for="awli">عالی</label><br>
                                                        <input type="radio" id="khob" name="sath_khod"
                                                               value="2"  @if($setting->sath_khod=='2') checked @endif>
                                                        <label for="khob"> عالی و خوب</label><br>

                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    {{--zaman_sorati--}}
                                    <tr>
                                        <td>
                                            نحوه تخصیص زمان در هر کوییز (میانترم)
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="form-check">

                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    {{--show-ans--}}
                                    <tr>
                                        <td>
                                            پاسخ سوالات خود آزمایی به دانشجو نشان داده شود
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="form-check">
                                                        <input type="checkbox" name="show_khod" @if($setting->show_khod=='1') checked @endif class="form-check-input" id="exampleCheck1">

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



                                                        <input type="radio" id="awli" name="sath_quiz"
                                                               value="1" checked>
                                                        <label for="awli">عالی</label><br>
                                                        <input type="radio" id="khob" name="sath_quiz"
                                                               value="2"  @if($setting->sath_quiz=='2') checked @endif>
                                                        <label for="khob"> عالی و خوب</label><br>


                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    {{--zama quiz--}}
                                    <tr>
                                        <td>
                                            نحوه تخصیص زمان در هر کوییز (میانترم)
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="form-check">

                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    {{--natije--}}
                                    <tr>
                                        <td>
                                            دانشجو بلافاصله بعد از ازمون نتیجه خود را ببیند
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="form-check">
                                                        <input type="checkbox" name="natije" @if($setting->natije=='1') checked @endif class="form-check-input" id="exampleCheck1">

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
                                                        <input type="checkbox" name="show_quiz" @if($setting->show_quiz=='1') checked @endif class="form-check-input" id="exampleCheck1">

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
                <div class="row" id="btn_submit">
                    <div class="col-md-10 offset-md-1">
                        <button type="submit" class="btn btn-block btn-outline-primary" id="btn">ذخیره
                        </button>
                    </div>
                </div>
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
    <script>
        $('#table-1').DataTable({
            "paging": false,
            "searching": false,
            "ordering": false,
            "info": false,
            "columnDefs": [
                {"width": "50px", "targets": 0},
                {"width": "5px", "targets": 1},
                {"width": "200px", "targets": 2}
            ]
        });
    </script>
    <script>
        function hide(name) {
            // var dd = $('[name="answer"]:checked').val();

               document.getElementById(name).style.display = "none";

        }
        function unhide(name) {
            // var dd = $('[name="answer"]:checked').val();

               document.getElementById(name).style.display = "block";

        }
        function score() {
            $score =0;
            $score=parseInt(document.getElementById('tarahi_soal_nomre').value)
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
                parseInt(document.getElementById('pishraft_nomre').value )
                +
                parseInt(document.getElementById('hozor_nomre').value)
                +
                parseInt(document.getElementById('amali_nomre').value)
            ;
            // alert($score);
            document.getElementById('all').value=$score;
            if($score >100)
            {
                document.getElementById('btn_submit').style.display = "none";
                alert('مجموع امتیازات بیش از 100 می باشد.')
            }else
                document.getElementById('btn_submit').style.display = "block";

        }
    </script>
@endpush
