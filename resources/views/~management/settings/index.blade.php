@extends('management.layout.master')
@section('title', 'تنظیمات')
@section('add-styles')
@endsection
@section('main-content')
    <div class="col s12">
        <form action="/dashboard/courses/edit-setting"
              method="post" enctype="multipart/form-data">
            <input name="course_id" value="{{$course->id}}" hidden>
            @csrf
            <ul class="collapsible popout">
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
                                <td>طراحی سوال</td>
                                <td>
                                    <input onchange="score()"
                                           placeholder="امتیاز " type="text"
                                           name="tarahi_soal_nomre"
                                           id="tarahi_soal_nomre"
                                           class="form-control rtl"
                                           value=" {{$setting->tarahi_soal_nomre}}">
                                </td>
                                <td>
                                    <textarea onchange="score()"
                                              placeholder="توضیح برای دانشجو " type="text"
                                              id="tarahi_soal_desc"
                                              name="tarahi_soal_desc"
                                              class="form-control rtl"
                                              style="font-size: 10px">{{$setting->tarahi_soal_desc}}
                                    </textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>ارسال گزارش</td>
                                <td>
                                    <input onchange="score()"
                                           placeholder="امتیاز " type="text"
                                           name="ersal_gozaresh_nomre"
                                           id="ersal_gozaresh_nomre"
                                           class="form-control rtl"
                                           value=" {{$setting->ersal_gozaresh_nomre}}">
                                </td>
                                <td>
                                    <textarea
                                        placeholder="توضیح برای دانشجو " type="text"
                                        name="ersal_gozaresh_desc"
                                        class="form-control rtl" style="font-size: 10px"
                                    >{{$setting->ersal_gozaresh_desc}}
                                    </textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>تکلیف یا سمینار</td>
                                <td>
                                    <input onchange="score()"
                                           placeholder="امتیاز " type="text"
                                           name="taklif_seminar_nomre"
                                           id="taklif_seminar_nomre"
                                           class="form-control rtl"
                                           value=" {{$setting->taklif_seminar_nomre}}">
                                </td>
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
                                <th>موضوع</th>
                                <th> وضعیت</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    دانشجو فقط برای اخرین جلسه درس مجاز به ثبت سوال است
                                </td>
                                <td>
                                    <label>
                                        <input type="checkbox" name="soal_last"
                                               @if($setting->soal_last=='1') checked
                                               @endif class="form-check-input"
                                               id="exampleCheck1">
                                        <span>بله</span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    دانشجو فقط برای اخرین جلسه درس مجاز به ارسال گزارش است
                                </td>
                                <td>
                                    <label>
                                        <input type="checkbox" name="gozaresh_last"
                                               @if($setting->gozaresh_last=='1') checked
                                               @endif class="form-check-input"
                                               id="exampleCheck1">
                                        <span>بله</span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    دانشجو فقط برای اخرین جلسه درس مجاز به ارسال تکلیف است
                                </td>
                                <td>
                                    <label>
                                        <input type="checkbox" name="taklif_last"
                                               @if($setting->taklif_last=='1') checked
                                               @endif class="form-check-input"
                                               id="exampleCheck1">
                                        <span>بله</span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    حداکثر تعداد سوالاتی که توسط دانشجو در هر جلسه طرح می شود
                                </td>
                                <td>
                                    <input
                                        type="text"
                                        name="max_soal"
                                        class="form-control rtl"
                                        value=" {{$setting->max_soal}}">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    تعداد سوالاتی که طرح آن توسط دانشجو الزامی است
                                </td>
                                <td>
                                    <input
                                        {{--placeholder="سقف نمره "--}}
                                        type="text"
                                        name="min_soal"
                                        class="form-control rtl"
                                        value=" {{$setting->min_soal}}">
                                </td>
                            </tr>
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
                            <tr>
                                <td>
                                    حداکثر تعداد غیبت دنشجو در طول ترم
                                </td>
                                <td>
                                    <input
                                        type="text"
                                        name="max_gheibat"
                                        class="form-control rtl"
                                        value=" {{$setting->max_gheibat}}">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </li>
                <li class="">
                    <div class="collapsible-header" tabindex="0"><i class="material-icons">whatshot</i>آزمون ها</div>
                    <div class="collapsible-body">
                        <table>
                            <thead>
                            <tr>
                                <th>موضوع</th>
                                <th>وضعیت</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    حداقل دفعات شرکت در خود آزمایی در طول هفته
                                </td>
                                <td>
                                    <input
                                        placeholder="عدد " type="number"
                                        name="min_w_khod"
                                        class="form-control rtl"
                                        value="{{$setting->min_w_khod}}">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    تعداد سوالات در هر خودآزمایی
                                </td>
                                <td>
                                    <input
                                        placeholder="عدد " type="number"
                                        name="q_num"
                                        class="form-control rtl"
                                        value="{{$setting->q_num}}">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    سطح سوالات در هر خودآزمایی
                                </td>
                                <td>
                                    <select class="selectpicker" title="یک گزینه را انتخاب کنید" name="sath_khod">
                                        <option selected value="1">عالی</option>
                                        <option @if($setting->sath_khod=='2') selected @endif value="2">عالی و خوب
                                        </option>
                                        <option @if($setting->sath_khod=='3') selected @endif value="3">خوب</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    پاسخ سوالات خود آزمایی به دانشجو نشان داده شود
                                </td>
                                <td>
                                    <input type="checkbox" name="show_khod"
                                           @if($setting->show_khod=='1') checked
                                           @endif class="form-check-input"
                                           id="exampleCheck1">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    تعداد سوالات کوییز (میانترم)
                                </td>
                                <td>
                                    <input
                                        placeholder="عدد " type="number"
                                        name="quiz_num"
                                        class="form-control rtl"
                                        value="{{$setting->quiz_num}}">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    سطح سوالات در هر کوییز (میانترم)
                                </td>
                                <td>
                                    <select class="selectpicker" title="یک گزینه را انتخاب کنید" name="sath_quiz">
                                        <option selected value="1">عالی</option>
                                        <option @if($setting->sath_quiz=='2') selected @endif value="2">عالی و خوب
                                        </option>
                                        <option @if($setting->sath_quiz=='3') selected @endif value="3">خوب</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    دانشجو بلافاصله بعد از ازمون نتیجه خود را ببیند
                                </td>
                                <td>
                                    <input type="checkbox" name="natije"
                                           @if($setting->natije=='1') checked
                                           @endif class="form-check-input"
                                           id="exampleCheck1">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    پاسخ سوالات کوییز به دانشجو نشان داده شود
                                </td>
                                <td>
                                    <input type="checkbox" name="show_quiz"
                                           @if($setting->show_quiz=='1') checked
                                           @endif class="form-check-input"
                                           id="exampleCheck1">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </li>
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
