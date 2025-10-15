@extends('management.layout.master')
@section('title', 'تنظیمات')
@section('add-styles')
@endsection
@section('main-content')
    <div class="col s12">
        <form action="/dashboard/courses/edit-setting"
              method="post" enctype="multipart/form-data">
            <input name="course_id" value="{{99999}}" hidden>
            @csrf
            <ul class="collapsible popout">

                <li class="">
                    <div class="collapsible-header" tabindex="0"><i class="material-icons">whatshot</i>ضریب اثر هر کدام
                        از فعالیت ها
                    </div>
                    <div class="collapsible-body">
                        <table>
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
                            <tr>
                                <td>
                                    طراحی سوال
                                </td>
                                <td>
                                    <input
                                        placeholder="امتیاز " type="text"
                                        name="q_1"
                                        class="form-control rtl"
                                        value=" {{$scoring->q_1}}">
                                </td>
                                <td>
                                    <input
                                        placeholder="امتیاز " type="text"
                                        name="q_2"
                                        class="form-control rtl"
                                        value=" {{$scoring->q_2}}">
                                </td>
                                <td>
                                    <input
                                        placeholder="امتیاز " type="text"
                                        name="q_3"
                                        class="form-control rtl"
                                        value=" {{$scoring->q_3}}">
                                </td>
                                <td>
                                    <input
                                        placeholder="امتیاز " type="text"
                                        name="q_4"
                                        class="form-control rtl"
                                        value=" {{$scoring->q_4}}">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    گزارش
                                </td>
                                <td>
                                    <input
                                        placeholder="امتیاز " type="text"
                                        name="d_1"
                                        class="form-control rtl"
                                        value=" {{$scoring->d_1}}">
                                </td>
                                <td>
                                    <input
                                        placeholder="امتیاز " type="text"
                                        name="d_2"
                                        class="form-control rtl"
                                        value=" {{$scoring->d_2}}">
                                </td>
                                <td>
                                    <input
                                        placeholder="امتیاز " type="text"
                                        name="d_3"
                                        class="form-control rtl"
                                        value=" {{$scoring->d_3}}">
                                </td>
                                <td>
                                    <input
                                        placeholder="امتیاز " type="text"
                                        name="d_4"
                                        class="form-control rtl"
                                        value=" {{$scoring->d_4}}">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    تکلیف
                                </td>
                                <td>
                                    <input
                                        placeholder="امتیاز " type="text"
                                        name="e_1"
                                        class="form-control rtl"
                                        value=" {{$scoring->e_1}}">
                                </td>
                                <td>
                                    <input
                                        placeholder="امتیاز " type="text"
                                        name="e_2"
                                        class="form-control rtl"
                                        value=" {{$scoring->e_2}}">
                                </td>
                                <td>
                                    <input
                                        placeholder="امتیاز " type="text"
                                        name="e_3"
                                        class="form-control rtl"
                                        value=" {{$scoring->e_3}}">
                                </td>
                                <td>
                                    <input
                                        placeholder="امتیاز " type="text"
                                        name="e_4"
                                        class="form-control rtl"
                                        value=" {{$scoring->e_4}}">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    سمینار
                                </td>
                                <td>
                                    <input
                                        placeholder="امتیاز " type="text"
                                        name="s_1"
                                        class="form-control rtl"
                                        value=" {{$scoring->s_1}}">
                                </td>
                                <td>
                                    <input
                                        placeholder="امتیاز " type="text"
                                        name="s_2"
                                        class="form-control rtl"
                                        value=" {{$scoring->s_2}}">
                                </td>
                                <td>
                                    <input
                                        placeholder="امتیاز " type="text"
                                        name="s_3"
                                        class="form-control rtl"
                                        value=" {{$scoring->s_3}}">
                                </td>
                                <td>
                                    <input
                                        placeholder="امتیاز " type="text"
                                        name="s_4"
                                        class="form-control rtl"
                                        value=" {{$scoring->s_4}}">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </li>
                <li class="">
                    <div class="collapsible-header" tabindex="0"><i class="material-icons">filter_drama</i>بارم بندی
                    </div>
                    <div class="collapsible-body" style="">
                        <table>
                            <thead>
                            <tr>
                                <th>موضوع</th>
                                <th>امتیاز</th>
                                <th>توضیح برای دانشجو</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>آزمون</td>
                                <td>
                                    <input
                                        placeholder="امتیاز " type="text"
                                        id="quiz_mid_nomre"
                                        name="quiz_mid_nomre"
                                        class="form-control rtl"
                                        value=" {{$setting->quiz_mid_nomre}}">
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
                            <tr>
                                <td>پیشرفت درسی</td>
                                <td>
                                    <input onchange="score()"
                                           placeholder="امتیاز " type="text"
                                           name="pishraft_nomre"
                                           id="pishraft_nomre"
                                           class="form-control rtl"
                                           value=" {{$setting->pishraft_nomre}}">
                                </td>
                                <td>
                                    <input
                                        placeholder="توضیح" type="text"
                                        {{--name="pishraft_desc"--}}
                                        class="form-control rtl"
                                        disabled
                                        value=" {{$setting->pishraft_desc}}" style="font-size: 10px">
                                </td>
                            </tr>
                            <tr>
                                <td>تلاش و فعالیت</td>
                                <td>
                                    <input onchange="score()"
                                           placeholder="امتیاز " type="text"
                                           id="talash_nomre"
                                           name="talash_nomre"
                                           class="form-control rtl"
                                           value=" {{$setting->talash_nomre}}">
                                </td>
                                <td>
                                    <input
                                        placeholder="امتیاز" type="text"
                                        {{--name="talash_desc"--}}
                                        class="form-control rtl"
                                        disabled
                                        value=" {{$setting->talash_desc}}" style="font-size: 10px">
                                </td>
                            </tr>
                            <tr>
                                <td>حضور وغیاب</td>
                                <td>
                                    <input onchange="score()"
                                           placeholder="امتیاز" type="text"
                                           id="hozor_nomre"
                                           name="hozor_nomre"
                                           class="form-control rtl"
                                           value=" {{$setting->hozor_nomre}}">
                                </td>
                                <td>
                                    <input
                                        placeholder="توضیح" type="text"
                                        name="hozor_desc"
                                        class="form-control rtl"
                                        value=" {{$setting->hozor_desc}}">
                                </td>
                            </tr>
                            <tr>
                                <td>واحد عملی</td>
                                <td>
                                    <input onchange="score()"
                                           placeholder="امتیاز" type="text"
                                           id="amali_nomre"
                                           name="amali_nomre"
                                           class="form-control rtl"
                                           value="{{$setting->amali_nomre}}">
                                </td>
                                <td>
                                    <textarea
                                        placeholder="توضیح" type="text"
                                        {{--name="amali_desc"--}}
                                        class="form-control rtl" style="font-size: 10px"
                                        disabled>{{$setting->amali_desc}}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>پایان ترم</td>
                                <td>
                                    <input onchange="score()"
                                           placeholder="امتیاز" type="text"
                                           id="final_nomre"
                                           name="final_nomre"
                                           class="form-control rtl"
                                           value=" {{$setting->final_nomre}}">
                                </td>
                                <td>
                                    <textarea
                                        placeholder="توضیح" type="text"
                                        {{--name="final_desc"--}}
                                        disabled
                                        class="form-control rtl"
                                        style="font-size: 10px">{{$setting->final_desc}}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>مجموع امتیازات</td>
                                <td>
                                    <input
                                        placeholder="سقف نمره " type="text"
                                        id="all"
                                        class="form-control rtl"
                                        value=" {{$setting->tarahi_soal_nomre+$setting->ersal_gozaresh_nomre+$setting->taklif_seminar_nomre+
                                                                            $setting->final_nomre+$setting->quiz_mid_nomre+
                                                                            $setting->talash_nomre+$setting->pishraft_nomre+$setting->quiz_midhozor_nomre_nomre+$setting->amali_nomre}}"
                                    >
                                </td>
                                <td>تومان۷.۰۰</td>
                            </tr>
                            <tr>
                                <td>ارفاق خارج از 20</td>
                                <td>
                                    <input
                                        placeholder="امتیاز" type="text"
                                        name="erfagh_nomre"
                                        id="erfagh"
                                        class="form-control rtl"
                                        value=" {{$setting->erfagh_nomre}}">
                                </td>
                                <td>
                                    <input
                                        placeholder="توضیح" type="text"
                                        name="erfagh_desc"
                                        class="form-control rtl"
                                        value=" {{$setting->erfagh_desc}}">
                                </td>
                            </tr>
                            <tr>
                                <td>نمره نهایی با ارفاق</td>
                                <td>
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
                                </td>
                                <td>mfkf</td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </li>


                <li class="">
                    <div class="collapsible-header" tabindex="0"><i class="material-icons">place</i>فعالیت ها</div>
                    <div class="collapsible-body" style="">
                        <table>
                            <thead>

                            <tr>
                                <td>
                                    حداقل تعداد داوری در هر هفته
                                </td>
                                <td>
                                    <input
                                        type="text"
                                        name="min_davari"
                                        class="form-control rtl"
                                        value=" {{$setting->min_davari}}">
                                </td>
                            </tr>


                            </tbody>
                        </table>
                    </div>
                </li>



            </ul>
            <div class="form-group pl-1 d-flex justify-content-center">
                <input type="submit" class="waves-effect waves-light btn gradient-45deg-amber-amber z-depth-4 mr-1 mb-2"
                       value="ذخیره اطلاعات">
            </div>
        </form>
    </div>
@endsection
@section('js')
@endsection
