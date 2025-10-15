@extends('dashboard2.layout.app')
@section('title','خانه')



@include('dashboard.layout.message')
<div id="breadcrumbDefault" class="col-xl-12 col-lg-12 layout-spacing">
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>پیشفرض</h4>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area">

            <nav class="breadcrumb-one" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">اجزاء</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>کیت طراحی</span></li>
                </ol>
            </nav>

            <div class="code-section-container show-code">

                <button class="btn toggle-code-snippet"><span>کد</span></button>

                <div class="code-section text-left">
                                            <pre>
&lt;nav class="breadcrumb-one" aria-label="breadcrumb"&gt;
    &lt;ol class="breadcrumb"&gt;
        &lt;li class="breadcrumb-item"&gt;&lt;a href="javascript:void(0);"&gt;&lt;svg&gt;...&lt;/svg&gt;&lt;/a&gt;&lt;/li&gt;
        &lt;li class="breadcrumb-item"&gt;&lt;a href="javascript:void(0);"&gt;اجزاء&lt;/a&gt;&lt;/li&gt;
        &lt;li class="breadcrumb-item active" aria-current="page"&gt;UI Kit&lt;/li&gt;
    &lt;/ol&gt;
&lt;/nav&gt;
</pre>
                </div>
            </div>

        </div>
    </div>
</div>



@include('dashboard.layout.message')
<div id="breadcrumbDefault" class="col-xl-12 col-lg-12 layout-spacing">
    <div class="statbox widget box box-shadow">
        <div class="widget-content widget-content-area">

            <nav class="breadcrumb-one" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>ایجاد درس</span></li>
                </ol>
            </nav>


        </div>
    </div>
</div>

@include('dashboard.layout.message')
<div id="breadcrumbDefault" class="col-xl-12 col-lg-12 layout-spacing">
    <div class="statbox widget box box-shadow">
        <div class="widget-content widget-content-area">

            <nav class="breadcrumb-one" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>
                    <li class="breadcrumb-item " aria-current="page"><a href="/dashboard/courses/sessions?course_id={{$course->id}}"> <span>درس {{$course->name}}</span></a></li>
                    <li class="breadcrumb-item " aria-current="page"><a href="/dashboard/courses/students?course_id={{$course->id}}" ><span>دانشجویان</span></a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span>پیشرفت درسی دانشجو {{$user->name}} {{$user->family}}</span></li>
                </ol>
            </nav>


        </div>
    </div>
</div>
