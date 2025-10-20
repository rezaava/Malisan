@extends('management.layout.master')
@section('styles')
@endsection
@section('title', 'صفحه اصلی')
@section('main-content')
@php
    if($q_scores>20)
        $q_scores=20;
    
    if($qu_scores>20)
        $qu_scores=20;
    
    if($d_scores>20)
        $d_scores=20;
    
@endphp
@php
if((
((($q_scores+$d_scores+$qu_scores+5)/4)*14)*(max((($questions['all']*8)/($max_session*$setting->max_soal*5/6)), ($discs['all']*5/$max_session), ((($davarii['q'] + $davarii['gozaresh'])*8)/($max_session*(1+$setting->max_soal)*3)), ($count_azmoon*9/($setting->min_w_khod*$max_session)))+1)
)>14)
$score_keifiat=14;
else
$score_keifiat=((($q_scores+$d_scores+$qu_scores+5)/4)*14)*(max((($questions['all']*8)/($max_session*$setting->max_soal*5/6)), ($discs['all']*5/$max_session), ((($davarii['q'] + $davarii['gozaresh'])*8)/($max_session*(1+$setting->max_soal)*3)), ($count_azmoon*9/($setting->min_w_khod*$max_session)))+1);
@endphp

  @php
                                                if((($questions['all']*8)/($max_session*$setting->max_soal*5/6))>8)
                                                $score_soal=8;
                                                else
$score_soal=($questions['all']*8)/($max_session*$setting->max_soal*5/6);

                                            @endphp

 @php
                                                if(($discs['all']*5/$max_session)>5)
                                                $score_gozaresh=5;
                                                else
$score_gozaresh=$discs['all']*5/$max_session;
@endphp


 @php
                                                if(((($davarii['q'] + $davarii['gozaresh'])*8)/($max_session*(1+$setting->max_soal)*3))>8)
                                                $score_davari=8;
                                                else
$score_davari=(($davarii['q'] + $davarii['gozaresh'])*8)/($max_session*(1+$setting->max_soal)*3);
@endphp



                                                                                            @php
                                                if(($count_azmoon*9/($setting->min_w_khod*$max_session))>9)
                                                $score_azmoon=9;
                                                else
$score_azmoon=$count_azmoon*9/($setting->min_w_khod*$max_session);
@endphp
                                                @php
                                                if(($questions['all']*$max_session*$setting->max_soal)==0)
                                                $score_pish_soal=0;
                                                else{
                                                if(($q_scores*12/(($questions['all']*8)/($max_session*$setting->max_soal*5/6)))>12)
                                                $score_pish_soal=12;
                                                else
$score_pish_soal=$q_scores*12/(($questions['all']*8)/($max_session*$setting->max_soal*5/6));
}
@endphp
                                                @php
                                                if($discs['all']*5/$max_session==0)
                                                $score_pish_gozaresh=0;
                                                else
                                                {
                                                if(($d_scores*10/($discs['all']*5/$max_session))>10)
                                                $score_pish_gozaresh=10;
                                                else
$score_pish_gozaresh=$d_scores*10/($discs['all']*5/$max_session);
}
@endphp
                                                @php
                                                if((($qu_scores/24)*(9*$count_azmoon/($max_session*$setting->min_w_khod)))>24)
                                                $score_pish_azmoon=24;
                                                else
 $score_pish_azmoon=($qu_scores/24)*(9*$count_azmoon/($max_session*$setting->min_w_khod));
@endphp

@php
$kelasi=$score_soal+$score_gozaresh+$score_azmoon+$score_davari;
if($kelasi>30)
$kelasi=30;
@endphp

@php
$pishraft=$score_pish_soal+$score_pish_gozaresh+$score_pish_azmoon+5+$score_keifiat;
if($pishraft>70)
$pishraft=70;
@endphp
@php
$mostamer=$score_pish_soal+$score_pish_gozaresh+$score_pish_azmoon+5+$score_keifiat+$score_soal+$score_gozaresh+$score_azmoon+$score_davari;
$mostamer=$mostamer*12/100;
if($mostamer>12)
$mostamer=12;
@endphp

    <div class="row">
        <div class="col s12 m7">
            <div id="popout" class="row">
                <div class="col s12">
                    <h4 class="header " style="text-align: center;">نمره ارزشیابی مستمر از {{$setting->mostamar_nomre}} :<span class="text-success" style="color: green;text-decoration: underline;font-size: 25px">
                         {{$mostamer}}
                         </span></h5>
                    <p style="text-align: center;">برای مشاهده جزئیات گزینه مورد نظر را انتخاب کنید</p>
                </div>
                <div class="col s12">
                    <ul class="collapsible popout">
                         <li class="">
                                <div class="collapsible-header custom-collapsible" tabindex="0">
                                    <div>
                                        <i class="material-icons">filter_drama</i>
                                        فعالیت کلاسی
                                    </div>
                                    <div> سقف امتیاز:30</div>
                                    <div>
                                        تاکنون 
                                        :
                                    {{$kelasi}}
                                    </div>
                                </div>
                                <div class="collapsible-body" style="">
                                    <ul>
                                        <li> طرح سوال:
                                            <span style="margin-left: 20px">تعداد:
                                            
{{$questions['all']}}
</span>
                                            سقف امتیاز:
                                            <span style="margin-left: 20px">
8
</span>
                                            امتیاز تاکنون:
                                            <span style="margin-left: 20px">
                                          
{{$score_soal}}                                            
                                            
</span>
                                            
                                        </li>
                                          <li> ارسال گزارش / تحقیق:
                                            <span style="margin-left: 20px">تعداد:

{{$discs['all']}}
</span>
                                            سقف امتیاز:
                                            <span style="margin-left: 20px">
5
</span>
                                            امتیاز تاکنون:
                                            <span style="margin-left: 20px">
                                               
{{$score_gozaresh}}

</span>
                                            
                                        </li>
                                        
                                          <li> انجام داوری:
                                            <span style="margin-left: 20px">تعداد:
 {{$davarii['q'] + $davarii['gozaresh']}}
</span>
                                            سقف امتیاز:
                                            <span style="margin-left: 20px">
8
</span>
                                            امتیاز تاکنون:
                                            <span style="margin-left: 20px">
                                               
{{$score_davari}}
</span>
                                            
                                        </li>
                                        
                                          <li> شرکت در خود آزمایی:
                                            <span style="margin-left: 20px">تعداد:
{{$count_azmoon}}
</span>
                                            سقف امتیاز:
                                            <span style="margin-left: 20px">
9
</span>
                                            امتیاز تاکنون:
                                            <span style="margin-left: 20px">
                                              
{{$score_azmoon}}

</span>
                                            
                                        </li>
                                        
                                    </ul>
                                </div>
                            </li>
                            
                            
                            
                                <li class="">
                                <div class="collapsible-header custom-collapsible" tabindex="0">
                                    <div>
                                        <i class="material-icons">filter_drama</i>
                                        پیشرفت درسی
                                    </div>
                                    <div> سقف امتیاز:70</div>
                                    <div>
                                        تاکنون 
                                        :
                                       {{$pishraft}}
                                    </div>
                                </div>
                                <div class="collapsible-body" style="">
                                    <ul>
                                        <li>  سوال:
                                            <span style="margin-left: 20px">وضعیت:
{{$q_scores}}
</span>
                                            سقف امتیاز:
                                            <span style="margin-left: 20px">
12
</span>
                                            امتیاز تاکنون:
                                            <span style="margin-left: 20px">
                                               
{{$score_pish_soal}}
</span>
                                            
                                        </li>
                                          <li> گزارش:
                                            <span style="margin-left: 20px">وضعیت:

{{$d_scores}}

</span>
                                            سقف امتیاز:
                                            <span style="margin-left: 20px">
10
</span>
                                            امتیاز تاکنون:
                                            <span style="margin-left: 20px">
       
{{$score_pish_gozaresh}}

</span>
                                            
                                        </li>
                                        
                                          <li> خودآزمایی:
                                            <span style="margin-left: 20px">وضعیت:
{{$qu_scores}}
</span>
                                            سقف امتیاز:
                                            <span style="margin-left: 20px">
24
</span>
                                            امتیاز تاکنون:
                                            <span style="margin-left: 20px">
{{$score_pish_azmoon}}
</span>
                                            
                                        </li>
                                        
                                          <li> سطح داوری:
                                            <span style="margin-left: 20px">وضعیت:
10
</span>
                                            سقف امتیاز:
                                            <span style="margin-left: 20px">
10
</span>
                                            امتیاز تاکنون:
                                            <span style="margin-left: 20px">
5

</span>
                                            
                                        </li>
                                        
                                          <li> کیفیت فعالیت ها:
                                            <span style="margin-left: 20px">وضعیت:
{{($q_scores+$d_scores+$qu_scores+5)/4}}


</span>
                                            سقف امتیاز:
                                            <span style="margin-left: 20px">
14
</span>
                                            امتیاز تاکنون:
                                            <span style="margin-left: 20px">

{{$score_keifiat}}
</span>
                                            
                                        </li>
                                        
                                    </ul>
                                </div>
                            </li>





                                <li class="">
                                <div class="collapsible-header custom-collapsible" tabindex="0">
                                    <div>
                                        <i class="material-icons">filter_drama</i>
                                        ارزشیابی مستمر
                                    </div>
                                    <div> سقف امتیاز:12</div>
                                    <div>
                                        تاکنون 
                                        :
                                       {{$mostamer}}
                                    </div>
                                </div>
                            </li>


                            @if(0)
                        @if($setting->tarahi_soal_nomre!=0)
                            <li class="">
                                <div class="collapsible-header custom-collapsible" tabindex="0">
                                    <div>
                                        <i class="material-icons">filter_drama</i>
                                        بخش طراحی سوال
                                    </div>
                                    <div> سقف امتیاز: {{$setting->tarahi_soal_nomre}}</div>
                                    <div>
                                        تاکنون : {{$nomre['q']}}
                                    </div>
                                </div>
                                <div class="collapsible-body" style="">
                                    <ul>
                                        <li> تعداد سوالات طراحی شده با وضعیت ضعیف:
                                            <span style="margin-right: 20px"> {{$questions['4']}} </span>
                                        </li>
                                        <li> تعداد سوالات طراحی شده با وضعیت متوسط :
                                            <span style="margin-right: 20px"> {{$questions['3']}} </span>
                                        </li>
                                        <li> تعداد سوالات طراحی شده با وضعیت خوب :
                                            <span style="margin-right: 20px"> {{$questions['2']}} </span>
                                        </li>
                                        <li> تعداد سوالات طراحی شده با وضعیت عالی :
                                            <span style="margin-right: 20px"> {{$questions['1']}} </span>
                                        </li>
                                        <li> تعداد  سوالات طراحی شده :
                                            <span style="margin-right: 20px;color: red;"> {{$questions['all']}} </span>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        @endif
                        @if($setting->ersal_gozaresh_nomre!=0)
                            <li class="">
                                <div class="collapsible-header custom-collapsible" tabindex="0">
                                    <div>
                                        <i class="material-icons">filter_drama</i>
                                        بخش ارائه گزارش
                                    </div>
                                    <div>سقف امتیاز: {{$setting->ersal_gozaresh_nomre}}</div>
                                    <div>
                                        تاکنون : {{round($nomre['d'],2)}}
                                    </div>
                                </div>
                                <div class="collapsible-body" style="">
                                    <ul>
                                        <li>
                                            تعداد گزارش های با وضعیت ضعیف :
                                            <span style="margin-right: 20px">  {{$discs['4']}} </span>
                                        </li>
                                        <li>
                                            تعداد گزارش های با وضعیت متوسط :
                                            <span style="margin-right: 20px"> {{$discs['3']}} </span>
                                        </li>
                                        <li>
                                            تعداد گزارش های با وضعیت خوب :
                                            <span style="margin-right: 20px"> {{$discs['2']}} </span>
                                        </li>
                                        <li>
                                            تعداد گزارش های با وضعیت عالی :
                                            <span style="margin-right: 20px"> {{$discs['1']}} </span>
                                        </li>
                                        <li>
                                            تعداد کل گزارش های ارسال شده :
                                            <span style="margin-right: 20px;color: red"> {{$discs['all']}} </span>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        @endif
                        @if($setting->taklif_seminar_nomre!=0)
                            <li class="">
                                <div class="collapsible-header custom-collapsible" tabindex="0">
                                    <div>
                                        <i class="material-icons">filter_drama</i>
                                        بخش ارائه تکالیف
                                    </div>
                                    <div>سقف امتیاز: {{$setting->taklif_seminar_nomre}}</div>
                                    <div>
                                        تاکنون : {{$nomre['e']}}
                                    </div>
                                </div>
                                <div class="collapsible-body" style="">
                                    <ul>
                                        <li>
                                            تعداد تکالیف با وضعیت ضعیف :
                                            <span style="margin-right: 20px"> {{$exers[4]}} </span>
                                        </li>
                                        <li>
                                            تعداد تکالیف با وضعیت متوسط :
                                            <span style="margin-right: 20px"> {{$exers[3]}}</span>
                                        </li>
                                        <li>
                                            تعداد تکالیف با وضعیت خوب :
                                            <span style="margin-right: 20px"> {{$exers[2]}}</span>
                                        </li>
                                        <li>
                                            تعداد تکالیف وضعیت عالی :
                                            <span style="margin-right: 20px"> {{$exers[1]}}</span>
                                        </li>
                                        <li style="color: red">
                                            تعداد کل تکالیف انجام شده :
                                            <span style="margin-right: 20px"> {{$exers['all']}}</span>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        @endif
                    <!--<li class="">-->
                        <!--    <div class="collapsible-header custom-collapsible" tabindex="0">-->
                        <!--        <div>-->
                        <!--            <i class="material-icons">filter_drama</i>-->
                        <!--            بخش ارائه سمینارها-->
                        <!--        </div>-->
                        <!--        <div>سقف امتیاز: 15<</div>-->
                        <!--        <div>-->
                        <!--            تاکنون : 11-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--    <div class="collapsible-body" style="">-->
                        <!--        <ul>-->
                        <!--            <li>-->
                        <!--                تعداد سمینارهای با وضعیت ضعیف :-->
                        <!--                <span style="margin-right: 20px"> 5 </span>-->
                        <!--            </li>-->
                        <!--            <li>-->
                        <!--                تعداد سمینارهای با وضعیت متوسط :-->
                        <!--                <span style="margin-right: 20px"> 5 </span>-->
                        <!--            </li>-->
                        <!--            <li>-->
                        <!--                تعداد سمینارهای با وضعیت خوب :-->
                        <!--                <span style="margin-right: 20px"> 5 </span>-->
                        <!--            </li>-->
                        <!--            <li>-->
                        <!--                تعداد سمینارهای وضعیت عالی :-->
                        <!--                <span style="margin-right: 20px"> 5 </span>-->
                        <!--            </li>-->
                        <!--            <li style="color: red">-->
                        <!--                تعداد کل سمینارهای ارائه شده :-->
                        <!--                <span style="margin-right: 20px"> 5 </span>-->
                        <!--            </li>-->
                        <!--        </ul>-->
                        <!--    </div>-->
                        <!--</li>-->
                        @if($setting->pishraft_nomre!=0)
                            <li class="">
                                <div class="collapsible-header custom-collapsible" tabindex="0">
                                    <div>
                                        <i class="material-icons">filter_drama</i>
                                        پیشرفت درسی
                                    </div>
                                    <div>سقف امتیاز: {{$setting->pishraft_nomre}}</div>
                                    <div>
                                        تاکنون : {{$nomre['pish']}}
                                    </div>
                                </div>
                                <div class="collapsible-body" style="">
                                    <ul>
                                        <li>
                                            تعداد سوال تائید شده:
                                            <span style="margin-right: 20px"> {{$questions[1]+$questions[2]}} </span>
                                        </li>
                                        <li>
                                            تعداد گزارش تائید شده:
                                            <span style="margin-right: 20px"> {{$discs[1]+$discs[2]}} </span>
                                        </li>

{{--                                        <li>--}}
{{--                                            درصد پاسخ های درست در خودآزمایی:--}}
{{--                                            <span style="margin-right: 20px"> {{$count_azmoon}} </span>--}}
{{--                                        </li>--}}
                                        <li>
                                            دفعات شرکت در خودآزمایی:
                                            <span style="margin-right: 20px"> {{$count_azmoon}} </span>
                                        </li>
                                        {{--<li>--}}
                                        {{--حداقل نمره کسب شده در آزمونهای خود آزمایی:--}}
                                        {{--<span style="margin-right: 20px"> 5 </span>--}}
                                        {{--</li>--}}
                                        {{--<li>--}}
                                        {{--حداکثر نمره کسب شده در آزمونهای خود آزمایی:--}}
                                        {{--<span style="margin-right: 20px"> 5 </span>--}}
                                        {{--</li>--}}
                                        {{--<li>--}}
                                        {{--میانگین نمره های کسب شده:--}}
                                        {{--<span style="margin-right: 20px"> 5 </span>--}}
                                        {{--</li>--}}
                                    </ul>
                                </div>
                            </li>
                        @endif
                        @if($setting->quiz_mid_nomre!=0)
                            <li class="">
                                <div class="collapsible-header custom-collapsible" tabindex="0">
                                    <div>
                                        <i class="material-icons">filter_drama</i>
                                        آزمون های کلاسی (کوئیز)
                                    </div>
                                    <div>سقف امتیاز: {{$setting->quiz_mid_nomre}}</div>
                                    <div>
                                        تاکنون : 11
                                    </div>
                                </div>
                                <div class="collapsible-body" style="">
                                    <ul>
                                        <li>
                                            تعداد آزمون ها:
                                            <span style="margin-right: 20px"> 5 </span>
                                        </li>
                                        <li>
                                            حداقل نمره :
                                            <span style="margin-right: 20px"> 5 </span>
                                        </li>
                                        <li>
                                            حداکثر نمره:
                                            <span style="margin-right: 20px"> 5 </span>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        @endif
                        <li class="">
                            <div class="collapsible-header custom-collapsible" tabindex="0">
                                <div>
                                    <i class="material-icons">filter_drama</i>
                                    تلاش و فعالیت
                                </div>
                                <div>سقف امتیاز:{{$setting->talash_nomre}} </div>
                                <div>
                                    تاکنون: {{round(($nomre['talash']),2)}}
                                </div>
                            </div>
                            <div class="collapsible-body" style="">
                                <ul>
                                    <li>
                                        طرح سوال : <span
                                            style="margin-right: 20px"> {{$questions['all']}} </span>
                                    </li>
                                    <li>
                                        سوالات داوری شده : <span
                                            style="margin-right: 20px"> {{$davarii['q']}} </span>
                                    </li>
                                    <li>
                                        ارسال گزارش : <span
                                            style="margin-right: 20px"> {{$discs['all']}} </span>
                                    </li>
                                    <li>
                                        گزارشات داوری شده :
                                        <span style="margin-right: 20px"> {{$davarii['gozaresh']}} </span>
                                    </li>
                                    <li>
                                        شرکت در خود ازمایی :
                                        <span style="margin-right: 20px"> {{$count_azmoon}} </span>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="">
                            <div class="collapsible-header custom-collapsible" tabindex="0">
                                <div>
                                    <i class="material-icons">filter_drama</i>
                                    مجموع امتیاز ها :
                                </div>

                                <div>
                                    سقف امتیاز:
                                    {{$setting->tarahi_soal_nomre + $setting->ersal_gozaresh_nomre + $setting->pishraft_nomre + $setting->talash_nomre}}</div>
                            <!--<div>سقف امتیاز: {{100-$setting->final_nomre}}</div>-->
                                <div>
                                    تاکنون: {{round(($nomre['total']),2)}}
                                </div>
                            </div>
                        </li>
                        <!--<li class="">-->
                        <!--    <div class="collapsible-header custom-collapsible" tabindex="0">-->
                        <!--        <div>-->
                        <!--            <i class="material-icons">filter_drama</i>-->
                        <!--            امتیاز تشویقی-->
                        <!--        </div>-->
                    <!--        <div>{{$setting->erfagh_nomre}}</div>-->
                        <!--    </div>-->
                        <!--</li>-->
                        <!--<li class="">-->
                        <!--    <div class="collapsible-header custom-collapsible" tabindex="0">-->
                        <!--        <div>-->
                        <!--            <i class="material-icons">filter_drama</i>-->
                    <!--            نمره مستمر از {{(round(100-$setting->final_nomre)/5)}} ( به-->
                    <!--            اضافه {{$setting->erfagh_nomre}} نمره تشویقی) :-->
                        <!--        </div>-->
                    <!--        <div>{{round((($nomre['total']/5)+$setting->erfagh_nomre),2)}}</div>-->
                        <!--    </div>-->
                        <!--    <div class="collapsible-body" style="">-->
                        <!--        <ul>-->
                        <!--            <li>-->
                        <!--                تعداد سوالات داوری شده : <span-->
                    <!--                    style="margin-right: 20px"> {{$davarii['q']}} </span>-->
                        <!--            </li>-->
                        <!--            <li>-->
                        <!--                تعداد گزارشات داوری شده :-->
                    <!--                <span style="margin-right: 20px"> {{$davarii['gozaresh']}} </span>-->
                        <!--            </li>-->
                        <!--        </ul>-->
                        <!--    </div>-->
                        <!--</li>-->
                        <li class="">
                            <div class="collapsible-header custom-collapsible" tabindex="0">
                                <div>
                                    <i class="material-icons">filter_drama</i>
                                    رتبه کلاسی دانشجو:
                                </div>
                                <button class="btn btn-dark"
                                        onclick="calcRotbe({{round((($nomre['total']/5)+$setting->erfagh_nomre),2)}},{{$course->id}})">
                                    <span id="rotbe_bt">محاسبه رتبه</span></button>

                            </div>
                        </li>
                        @if($setting->final_nomre && $nomre['final'])
                            <li class="">
                                <div class="collapsible-header custom-collapsible" tabindex="0">
                                    <div>
                                        <i class="material-icons">filter_drama</i>
                                        نمره پایان ترم(از 20):
                                    </div>
                                    <div>{{$nomre['final']}}</div>
                                    <div>
                                        نمره نهایی:
                                        {{round(($nomre['total']/5)+$setting->erfagh_nomre+(($setting->final_nomre*$nomre['final']/20)/5),2)}}
                                    </div>
                                </div>
                                <div class="collapsible-body" style="">
                                    <ul>
                                        <li>
                                            تعداد سوالات داوری شده : <span
                                                style="margin-right: 20px"> {{$davarii['q']}} </span>
                                        </li>
                                        <li>
                                            تعداد گزارشات داوری شده :
                                            <span style="margin-right: 20px"> {{$davarii['gozaresh']}} </span>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        @endif
                        
                        @endif
                    </ul>
                </div>
            </div>

        </div>
        <div class="col m5 s12 mt-5">
            <div id="chartColumnStacked" style="letter-spacing:normal;" class="col-xl-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    {{--<div class="widget-header">--}}
                    {{--<div class="row">--}}
                    {{--<div class="col-xl-12 col-md-12 col-sm-12 col-12">--}}
                    {{--<h4> وضعیت نمرات </h4>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    <div class="widget-content widget-content-area">
                        <div id="s-col-stacked" class=""></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{("/style/plugins/apex/apexcharts.min.js")}}"></script>
    <script src="{{("/style/assets/js/scrollspyNav.js")}}"></script>
    <script src="{{("/style/plugins/treeview/custom-jstree.js")}}"></script>

    <script src="{{("/style/plugins/apex/apexcharts.min.js")}}"></script>
    {{--    <script src="{{("/style/plugins/apex/custom-apexcharts.js")}}"></script>--}}

    <script>
        var sColStacked = {
            chart: {
                height: 350,
                type: 'bar',
                stacked: true,
                toolbar: {
                    show: false,
                }
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    legend: {
                        position: 'bottom',
                        offsetX: -10,
                        offsetY: 0
                    }
                }
            }],
            plotOptions: {
                bar: {
                    horizontal: false,
                },
            },
            series: [{
                name: 'نمره کسب شده',
                data: [{{$nomre['q']}},
                    {{round($nomre['d'],2)}},
                    {{$nomre['e']}},
                    {{$nomre['pish']}},
                    {{round(($nomre['talash']),2)}},
                    {{--                    {{round(($nomre['total']),2)}},--}}
                    {{--                    {{round((($nomre['total']/5)+1),2)}},--}}

                ]
            }
                {{--,{--}}
                {{--name: 'نمره کسب نشده',--}}
                {{--data: [{{$setting->tarahi_soal_nomre}}-{{$nomre['q']}},--}}
                {{--{{$setting->ersal_gozaresh_nomre}}-{{$nomre['d']}},--}}
                {{--{{$setting->taklif_seminar_nomre}}-{{$nomre['e']}},--}}
                {{--{{$setting->pishraft_nomre}}-{{$nomre['pish']}},--}}
                {{--100-{{round(($nomre['talash']),2)}},--}}
                {{--{{round(100-round(($nomre['total']),2))}},--}}
                {{--20-{{round((($nomre['total']/5)+1),2)}},--}}

                {{--]--}}
                // }
            ],
            xaxis: {
                // type: 'datetime',
                categories: ['سوال', 'گزارش', 'تکلیف', 'پیشرفت', 'تلاش'
                    // 'مجموع','نمره'
                ],
            },
            yaxis: {
                labels:
                    {
                        offsetX: -20,
                    }
            },
            legend: {
                position: 'right',
                offsetY: 40
            },
            fill: {
                opacity: 1
            },
        }

        var chart = new ApexCharts(
            document.querySelector("#s-col-stacked"),
            sColStacked
        );

        chart.render();
    </script>
    <script>
        function calcRotbe(nomre,course){
            $.ajax({
                url: "https://malisan.ir/dashboard/rotbe?course="+course+"&nomre="+nomre,
                beforeSend: function(  ) {
                    document.getElementById("rotbe_bt").innerHTML="";
                    // document.getElementById("rotbe_bt").classList.add("spinner-border");
                    // document.getElementById("rotbe_bt").classList.add("text-info");
                    // document.getElementById("rotbe_bt").classList.add("bg-info");
                    document.getElementById("rotbe_bt").innerHTML="قدری صبوری کنید...";

                }
            })
                .done(function( data ) {
                    document.getElementById("rotbe_bt").classList.remove("spinner-border");
                    document.getElementById("rotbe_bt").classList.remove("text-info");

                    document.getElementById("rotbe_bt").innerHTML=data;

                });
        }
    </script>
@endsection
