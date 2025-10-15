@extends('dashboard.layout.app')
@section('title','صفحه پیشرفت درس')
@push('css')
    <style>
        /* Remove default bullets */
        ul, #myUL {
            list-style-type: none;
            margin-right: 40px;

        }

        li {
            text-align: right
        }

        /* Remove margins and padding from the parent ul */
        #myUL {
            margin: 0;
            padding: 0;
        }

        /* Style the caret/arrow */
        .caret {
            cursor: pointer;
            user-select: none; /* Prevent text selection */
        }

        /* Create the caret/arrow with a unicode, and style it */
        .caret::before {
            content: "\25B6";
            color: black;
            display: inline-block;
            margin-right: 6px;
        }

        /* Rotate the caret/arrow icon when clicked on (using JavaScript) */
        .caret-down::before {
            transform: rotate(90deg);
        }

        /* Hide the nested list */
        .nested {
            display: none;
        }

        /* Show the nested list when the user clicks on the caret/arrow (with JavaScript) */
        .active {
            display: block;
        }
    </style>

@endpush
@section('content')
    <div class="row " style="margin-bottom: 15px;margin-right: 20px">
        <h3>
            وضعیت پیشرفت درسی دانشجو در درس {{$course->name}}
        </h3>

    </div>
    <div class="col-sm-12">
        <div class="container-fluid">
            <ul id="myUL">

                @if($setting->tarahi_soal_nomre!=0)
                    <li style="margin-bottom: 5px">
                    <span class="caret">
                      بخش طراحی سوال
                        <span style="margin-right: 20px">سقف امتیاز: {{$setting->tarahi_soal_nomre}}</span>
                        <span style="margin-right: 20px">تاکنون : {{$nomre['q']}}</span>
                    </span>
                        <ul class="nested">
                            <li>
                                تعداد سوالات طراحی شده با وضعیت ضعیف :
                                <span style="margin-right: 20px"> {{$questions['4']}} </span>
                            </li>
                            <li>
                                تعداد سوالات طراحی شده با وضعیت متوسط :
                                <span style="margin-right: 20px"> {{$questions['3']}}</span>
                            </li>
                            <li>
                                تعداد سوالات طراحی شده با وضعیت خوب :
                                <span style="margin-right: 20px"> {{$questions['2']}} </span>
                            </li>
                            <li>
                                تعداد سوالات طراحی شده با وضعیت عالی :
                                <span style="margin-right: 20px"> {{$questions['1']}} </span>
                            </li>
                            <li>
                                تعداد کل سوالات طراحی شده :
                                <span style="margin-right: 20px;color: red;"> {{$questions['all']}} </span>
                            </li>
                        </ul>
                    </li>
                @endif
                @if($setting->ersal_gozaresh_nomre!=0)
                    <li style="margin-bottom: 5px">
                    <span class="caret">
                      بخش ارائه گزارش
                        <span style="margin-right: 20px">سقف امتیاز: {{$setting->ersal_gozaresh_nomre}}</span>
                        <span style="margin-right: 20px">تاکنون : {{$nomre['d']}}</span>

                    </span>
                        <ul class="nested">
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
                    </li>
                @endif
                @if($setting->taklif_seminar_nomre!=0)
                    <li style="margin-bottom: 5px">
                    <span class="caret">
                      بخش ارائه تکالیف
                        <span style="margin-right: 20px">سقف امتیاز: {{$setting->taklif_seminar_nomre}}</span>
                        <span style="margin-right: 20px">تاکنون : {{$nomre['e']}}</span>

                    </span>
                        <ul class="nested">
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
                    </li>
                @endif
                {{--@if($setting->tarahi_soal_nomre!=0)--}}
                <li style="margin-bottom: 5px" hidden>
                    <span class="caret">
                      بخش ارائه سمینارها
                        <span style="margin-right: 20px">سقف امتیاز: 15</span>
                        <span style="margin-right: 20px">تاکنون : 11</span>

                    </span>
                    <ul class="nested">
                        <li>
                            تعداد سمینارهای با وضعیت ضعیف :
                            <span style="margin-right: 20px"> 5 </span>
                        </li>
                        <li>
                            تعداد سمینارهای با وضعیت متوسط :
                            <span style="margin-right: 20px"> 5 </span>
                        </li>
                        <li>
                            تعداد سمینارهای با وضعیت خوب :
                            <span style="margin-right: 20px"> 5 </span>
                        </li>
                        <li>
                            تعداد سمینارهای وضعیت عالی :
                            <span style="margin-right: 20px"> 5 </span>
                        </li>
                        <li style="color: red">
                            تعداد کل سمینارهای ارائه شده :
                            <span style="margin-right: 20px"> 5 </span>
                        </li>
                    </ul>
                </li>
                {{--@endif--}}
                @if($setting->pishraft_nomre!=0)
                    <li style="margin-bottom: 5px">
                    <span class="caret">
پیشرفت درسی
                        <span style="margin-right: 20px">سقف امتیاز: {{$setting->pishraft_nomre}}</span>
                        <span style="margin-right: 20px">تاکنون : {{$nomre['pish']}}</span>

                    </span>
                        <ul class="nested">
                            <li>
                                دفعات شرکت در آزمون های خودآزمایی:
                                <span style="margin-right: 20px"> {{$count_azmoon}} </span>
                            </li>
                            <li>
                                حداقل نمره کسب شده در آزمونهای خود آزمایی:
                                <span style="margin-right: 20px"> 5 </span>
                            </li>
                            <li>
                                حداکثر نمره کسب شده در آزمونهای خود آزمایی:
                                <span style="margin-right: 20px"> 5 </span>
                            </li>
                            <li>
                                میانگین نمره های کسب شده:
                                <span style="margin-right: 20px"> 5 </span>
                            </li>


                        </ul>
                    </li>
                @endif
                @if($setting->quiz_mid_nomre!=0)
                    <li style="margin-bottom: 5px">
                    <span class="caret">
آزمون های کلاسی (کوئیز)
                        <span style="margin-right: 20px">سقف امتیاز: {{$setting->quiz_mid_nomre}}</span>
                        <span style="margin-right: 20px">تاکنون : 11</span>

                    </span>
                        <ul class="nested">
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
                    </li>
                @endif
                <li style="margin-bottom: 5px;margin-right: 21px">
                    <span>
تلاش و فعالیت
                        <span style="margin-right: 20px">سقف امتیاز: 100</span>
                        {{--<span style="margin-right: 20px">تاکنون: {{$nomre['total']}}</span>--}}
                        <span style="margin-right: 20px">{{round(($nomre['talash']),2)}}</span>

                    </span>
                </li>

                <li style="margin-bottom: 5px;margin-right: 21px">
                    <span class="">
مجموع امتیاز ها :
                        <span style="margin-right: 20px">سقف امتیاز: 100</span>
                        <span style="margin-right: 20px">تاکنون: {{round(($nomre['total']),2)}}</span>

                    </span>
                </li>


                <li style="margin-bottom: 5px;margin-right: 21px">
                    <span>
امتیاز تشویقی
                        <span style="margin-right: 20px">1</span>

                    </span>
                </li>

                <li style="margin-bottom: 5px;margin-right: 21px">
                    <span class="">
نمره نهایی از 20 ( با احتساب نمره تشویقی) :
                        <span style="margin-right: 40px"> {{round((($nomre['total']/5)+1),2)}}</span>

                    </span>
                </li>

                <li style="margin-bottom: 5px;margin-right: 21px">
                    <span class="">
رتبه کلاسی دانشجو:
                        <span style="margin-right: 40px"> {{$rotbe}}</span>

                    </span>
                </li>


            </ul>
        </div>
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
        var toggler = document.getElementsByClassName("caret");
        var i;

        for (i = 0; i < toggler.length; i++) {
            toggler[i].addEventListener("click", function () {
                this.parentElement.querySelector(".nested").classList.toggle("active");
                this.classList.toggle("caret-down");
            });
        }
    </script>
@endpush
