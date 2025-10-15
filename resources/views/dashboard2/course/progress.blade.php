@extends('dashboard2.layout.app')
@section('start')
    <link href="{{ '/style/assets/css/elements/custom-tree_view.css' }}" rel="stylesheet" type="text/css" />
    <link href="{{ '/style/plugins/apex/apexcharts.css' }}" rel="stylesheet" type="text/css">
    {{-- <link href="{{("/style/assets/css/scrollspyNav.css")}}" rel="stylesheet" type="text/css" /> --}}

@endsection
@section('main')

    <div id="content" class="main-content">
        @include('dashboard.layout.message')

        <div class="container">

            <div class="row layout-top-spacing">
                <div class="col-md-6">
                    <div id="treeviewAnimated" class="col-lg-12 layout-spacing">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-content widget-content-area">
                                <ul class="file-tree">
                                    @if ($setting->tarahi_soal_nomre != 0)
                                        <li class="file-tree-folder">
                                            بخش طراحی سوال
                                            <span style="margin-right: 20px" id="saghfSoal">سقف امتیاز:
                                                {{ $setting->tarahi_soal_nomre }}</span>
                                            <span style="margin-right: 20px">تاکنون : {{ $nomre['q'] }}</span>
                                            <ul>
                                                <li> تعداد سوالات طراحی شده با وضعیت ضعیف:
                                                    <span style="margin-right: 20px"> {{ $questions['4'] }} </span>
                                                </li>
                                                <li> تعداد سوالات طراحی شده با وضعیت متوسط :
                                                    <span style="margin-right: 20px"> {{ $questions['3'] }} </span>
                                                </li>
                                                <li> تعداد سوالات طراحی شده با وضعیت خوب :
                                                    <span style="margin-right: 20px"> {{ $questions['2'] }} </span>
                                                </li>
                                                <li> تعداد سوالات طراحی شده با وضعیت عالی :
                                                    <span style="margin-right: 20px"> {{ $questions['1'] }} </span>
                                                </li>
                                                <li> تعداد کل سوالات طراحی شده :
                                                    <span style="margin-right: 20px;color: red;"> {{ $questions['all'] }}
                                                    </span>
                                                </li>
                                            </ul>
                                        </li>
                                    @endif
                                    @if ($setting->ersal_gozaresh_nomre != 0)
                                        <li class="file-tree-folder">
                                            بخش ارائه گزارش
                                            <span style="margin-right: 20px">سقف امتیاز:
                                                {{ $setting->ersal_gozaresh_nomre }}</span>
                                            <span style="margin-right: 20px">تاکنون : {{ $nomre['d'] }}</span>

                                            <ul>
                                                <li>
                                                    تعداد گزارش های با وضعیت ضعیف :
                                                    <span style="margin-right: 20px"> {{ $discs['4'] }} </span>
                                                </li>
                                                <li>
                                                    تعداد گزارش های با وضعیت متوسط :
                                                    <span style="margin-right: 20px"> {{ $discs['3'] }} </span>
                                                </li>
                                                <li>
                                                    تعداد گزارش های با وضعیت خوب :
                                                    <span style="margin-right: 20px"> {{ $discs['2'] }} </span>
                                                </li>
                                                <li>
                                                    تعداد گزارش های با وضعیت عالی :
                                                    <span style="margin-right: 20px"> {{ $discs['1'] }} </span>
                                                </li>
                                                <li>
                                                    تعداد کل گزارش های ارسال شده :
                                                    <span style="margin-right: 20px;color: red"> {{ $discs['all'] }}
                                                    </span>
                                                </li>
                                            </ul>
                                        </li>
                                    @endif
                                    @if ($setting->taklif_seminar_nomre != 0)
                                        <li class="file-tree-folder">
                                            بخش ارائه تکالیف
                                            <span style="margin-right: 20px">سقف امتیاز:
                                                {{ $setting->taklif_seminar_nomre }}</span>
                                            <span style="margin-right: 20px">تاکنون : {{ $nomre['e'] }}</span>

                                            <ul>
                                                <li>
                                                    تعداد تکالیف با وضعیت ضعیف :
                                                    <span style="margin-right: 20px"> {{ $exers[4] }} </span>
                                                </li>
                                                <li>
                                                    تعداد تکالیف با وضعیت متوسط :
                                                    <span style="margin-right: 20px"> {{ $exers[3] }}</span>
                                                </li>
                                                <li>
                                                    تعداد تکالیف با وضعیت خوب :
                                                    <span style="margin-right: 20px"> {{ $exers[2] }}</span>
                                                </li>
                                                <li>
                                                    تعداد تکالیف وضعیت عالی :
                                                    <span style="margin-right: 20px"> {{ $exers[1] }}</span>
                                                </li>
                                                <li style="color: red">
                                                    تعداد کل تکالیف انجام شده :
                                                    <span style="margin-right: 20px"> {{ $exers['all'] }}</span>
                                                </li>
                                            </ul>
                                        </li>
                                    @endif
                                    <li class="file-tree-folder" hidden>
                                        بخش ارائه سمینارها
                                        <span style="margin-right: 20px">سقف امتیاز: 15</span>
                                        <span style="margin-right: 20px">تاکنون : 11</span>

                                        <ul>
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
                                    @if ($setting->pishraft_nomre != 0)
                                        <li class="file-tree-folder">
                                            پیشرفت درسی
                                            <span style="margin-right: 20px">سقف امتیاز:
                                                {{ $setting->pishraft_nomre }}</span>
                                            <span style="margin-right: 20px">تاکنون : {{ $nomre['pish'] }}</span>

                                            <ul>
                                                <li>
                                                    دفعات شرکت در آزمون های خودآزمایی:
                                                    <span style="margin-right: 20px"> {{ $count_azmoon }} </span>
                                                </li>
                                                {{-- <li> --}}
                                                {{-- حداقل نمره کسب شده در آزمونهای خود آزمایی: --}}
                                                {{-- <span style="margin-right: 20px"> 5 </span> --}}
                                                {{-- </li> --}}
                                                {{-- <li> --}}
                                                {{-- حداکثر نمره کسب شده در آزمونهای خود آزمایی: --}}
                                                {{-- <span style="margin-right: 20px"> 5 </span> --}}
                                                {{-- </li> --}}
                                                {{-- <li> --}}
                                                {{-- میانگین نمره های کسب شده: --}}
                                                {{-- <span style="margin-right: 20px"> 5 </span> --}}
                                                {{-- </li> --}}
                                            </ul>
                                        </li>
                                    @endif
                                    @if ($setting->quiz_mid_nomre != 0)
                                        <li class="file-tree-folder">
                                            آزمون های کلاسی (کوئیز)
                                            <span style="margin-right: 20px">سقف امتیاز:
                                                {{ $setting->quiz_mid_nomre }}</span>
                                            <span style="margin-right: 20px">تاکنون : 11</span>

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
                                        </li>
                                    @endif


                                    <li class="file-tree-folder">تلاش و فعالیت
                                        <span style="margin-right: 20px">سقف امتیاز:{{ $setting->talash_nomre }} </span>
                                        {{-- <span style="margin-right: 20px">تاکنون: {{$nomre['total']}}</span> --}}
                                        <span style="margin-right: 20px">تاکنون: {{ round($nomre['talash'], 2) }}</span>
                                        <ul>
                                            <li>
                                                تعداد سوالات داوری شده : <span style="margin-right: 20px">
                                                    {{ $davarii['q'] }} </span>
                                            </li>
                                            <li>
                                                تعداد گزارشات داوری شده :
                                                <span style="margin-right: 20px"> {{ $davarii['gozaresh'] }} </span>
                                            </li>
                                        </ul>
                                    </li>
                                    <li style="color: forestgreen">مجموع امتیاز ها :
                                        <span style="margin-right: 20px">سقف امتیاز: {{ 100 - $setting->final_nomre }}</span>
                                        <span style="margin-right: 20px">تاکنون: {{ round($nomre['total'], 2) }}</span>

                                    </li>
                                    <li style="color: forestgreen">امتیاز تشویقی
                                        <span style="margin-right: 20px">{{ $setting->erfagh_nomre }}</span>

                                    </li>
                                    <li style="color: forestgreen">نمره مستمر از {{ round(100 - $setting->final_nomre) / 5 }}
                                        ( به اضافه {{ $setting->erfagh_nomre }} نمره تشویقی) :
                                        <span style="margin-right: 40px">
                                            {{ round($nomre['total'] / 5 + $setting->erfagh_nomre, 2) }}</span>

                                    </li>
                                    <li style="color: blueviolet;font-weight: bold">رتبه کلاسی دانشجو:
                                        <button class="btn btn-dark"
                                            onclick="calcRotbe({{ round($nomre['total'] / 5 + $setting->erfagh_nomre, 2) }},{{ $course->id }})"><span
                                                id="rotbe_bt">محاسبه رتبه</span></button>
                                        {{-- <span style="margin-right: 40px"> xaaa</span> --}}
                                    </li>
                                    @if ($setting->final_nomre && $nomre['final'])
                                        <li style="color: blueviolet;font-weight: bold">نمره پایان ترم(از 20):
                                            <span style="margin-right: 40px"> {{ $nomre['final'] }}</span>

                                        </li>
                                        <li style="color: blueviolet;font-weight: bold">نمره نهایی:
                                            <span style="margin-right: 40px">
                                                {{ round($nomre['total'] / 5 + $setting->erfagh_nomre + ($setting->final_nomre * $nomre['final']) / 20 / 5, 2) }}</span>

                                        </li>
                                    @endif
                                </ul>


                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">

                    <div id="chartColumnStacked" style="letter-spacing:normal;" class="col-xl-12 layout-spacing">
                        <div class="statbox widget box box-shadow">
                            {{-- <div class="widget-header"> --}}
                            {{-- <div class="row"> --}}
                            {{-- <div class="col-xl-12 col-md-12 col-sm-12 col-12"> --}}
                            {{-- <h4> وضعیت نمرات </h4> --}}
                            {{-- </div> --}}
                            {{-- </div> --}}
                            {{-- </div> --}}
                            <div class="widget-content widget-content-area">
                                <div id="s-col-stacked" class=""></div>

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

    <script src="{{ '/style/assets/js/scrollspyNav.js' }}"></script>
    <script src="{{ '/style/plugins/treeview/custom-jstree.js' }}"></script>

    <script src="{{ '/style/plugins/apex/apexcharts.min.js' }}"></script>
    {{-- <script src="{{("/style/plugins/apex/custom-apexcharts.js")}}"></script> --}}

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
                    data: [{{ $nomre['q'] }},
                        {{ $nomre['d'] }},
                        {{ $nomre['e'] }},
                        {{ $nomre['pish'] }},
                        {{ round($nomre['talash'], 2) }},
                        {{-- {{round(($nomre['total']),2)}}, --}}
                        {{-- {{round((($nomre['total']/5)+1),2)}}, --}}

                    ]
                }
                {{-- ,{ --}}
                {{-- name: 'نمره کسب نشده', --}}
                {{-- data: [{{$setting->tarahi_soal_nomre}}-{{$nomre['q']}}, --}}
                {{-- {{$setting->ersal_gozaresh_nomre}}-{{$nomre['d']}}, --}}
                {{-- {{$setting->taklif_seminar_nomre}}-{{$nomre['e']}}, --}}
                {{-- {{$setting->pishraft_nomre}}-{{$nomre['pish']}}, --}}
                {{-- 100-{{round(($nomre['talash']),2)}}, --}}
                {{-- {{round(100-round(($nomre['total']),2))}}, --}}
                {{-- 20-{{round((($nomre['total']/5)+1),2)}}, --}}

                {{-- ] --}}
                // }
            ],
            xaxis: {
                // type: 'datetime',
                categories: ['سوال', 'گزارش', 'تکلیف', 'پیشرفت', 'تلاش'
                    // 'مجموع','نمره'
                ],
            },
            yaxis: {
                labels: {
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
        function calcRotbe(nomre, course) {
            $.ajax({
                    url: "https://malisan.ir/dashboard/rotbe?course=" + course + "&nomre=" + nomre,
                    beforeSend: function() {
                        document.getElementById("rotbe_bt").innerHTML = "";
                        document.getElementById("rotbe_bt").classList.add("spinner-border");
                        document.getElementById("rotbe_bt").classList.add("text-info");

                    }
                })
                .done(function(data) {
                    document.getElementById("rotbe_bt").classList.remove("spinner-border");
                    document.getElementById("rotbe_bt").classList.remove("text-info");

                    document.getElementById("rotbe_bt").innerHTML = data;

                });
        }
    </script>
@endsection
