@extends('dashboard.layout.app')
@section('title','صفحه نمایش دوره')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('/cuba-style/assets/css/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/cuba-style/assets/css/owlcarousel.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/cuba-style/assets/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/cuba-style/assets/css/responsive.css')}}">
@endpush
@section('content')
    <div class="col-sm-12">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-6">
                        {{--                        <h3>دوره ها</h3>--}}
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i data-feather="home"></i></a></li>
                            <li class="breadcrumb-item">دروس</li>
                            <li class="breadcrumb-item">لیست درس های من</li>
                        </ol>
                    </div>
                    <div class="col-lg-6">
                        <!-- Bookmark Start-->
                        <div class="bookmark pull-right">
                            <ul>
                                {{--<div class="bookmark pull-right">--}}
                                {{--<ul>--}}

                                {{--<li><a href="{{ url()->previous()}}" data-container="body" data-toggle="popover"--}}
                                {{--data-placement="top" title="" data-original-title="بازگشت"><img--}}
                                {{--src="{{asset('/cuba-style/assets/images/arrow-left.svg')}}"></a>--}}
                                {{--</li>--}}

                                {{--</ul>--}}
                                {{--</div>--}}
                            </ul>
                        </div>
                        <!-- Bookmark Ends-->
                    </div>
                </div>
            </div>
        </div>
        {{--        @if($user->hasRole("student"))--}}
        {{--@endif--}}
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-9">
                        <h5>لیست درس های من</h5>
                        @include('dashboard.layout.message')
                    </div>
                    @if($user->hasRole('teacher'))

                        {{--<div class="col-md-3">--}}
                            {{--<a href="/dashboard/survey" class="btn btn-info-gradien btn-sm">نظرسنجی</a>--}}
                        {{--</div> --}}
                <div class="col-md-3">
                            <a href="/dashboard/courses/create" class="btn btn-primary btn-sm">ایجاد درس</a>
                        </div>
                    @endif
                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive product-table">
                    <table class="display" id="basic-1">
                        <?php $i = 1 ?>
                        <thead>
                        <tr>
                            <th>ردیف</th>
                            {{--@if($user->hasRole('teacher'))--}}
                            {{--<th>شناسه</th>--}}
                            {{--@endif--}}
                            <th>نام درس</th>
                            @if($user->hasRole('teacher'))
                                <th>شناسه</th>
                            @endif
                            <th>جلسات</th>
                            @if(!$user->hasRole('student'))
                                <th>لیست دانشجویان</th>
                            @endif
                            @if($user->hasRole('teacher') || $user->hasRole('student'))
                            <th>
                                @if($user->hasRole('teacher'))
                                    ارزیابی فعالیت
                                @elseif($user->hasRole('student'))
                                    فعالیت های من
                                @endif
                            </th>
                            @endif
                            @if($user->hasRole('student'))
                                <th> داوری دوستان</th>
                            @endif
                            @if($user->hasRole('teacher'))
                                <th> تنظیمات</th>
                            @endif
                            @if($user->hasRole('teacher'))
                                <th>بانک سوال</th>
                            @endif
                            @if(!$user->hasRole('teacher'))
                                <th>استاد</th>
                            @endif

                            @if($user->hasRole('student'))
                                <th>امتحان</th>
                            @endif
                            {{--<th>سابقه امتحان</th>--}}
                            @if(!$user->hasRole('student'))
                                <th>حذف</th>
                            @endif
                            @if($user->hasRole('teacher'))
                                <th>نمایش</th>
                            @endif
                            @if($user->hasRole('teacher'))
                                <th>اتمام</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($courses as $course)
                            <tr>
                                <td>{{$i++}}</td>
                                {{--@if($user->hasRole('teacher'))--}}
                                {{--<td>{{$course->id}}</td>--}}
                                {{--@endif--}}
                                <form method="post" action="{{route('course.update',$course->id)}}">
                                    @csrf
                                    <td>

                                        <input @if($user->hasRole("student")) disabled @endif type='text'
                                               name="name" value="{{$course->name}}">
                                        @if($user->hasRole("teacher"))
                                            <input type="submit" value="بروزرسانی">
                                        @endif
                                    </td>
                                </form>

                                @if($user->hasRole('teacher'))
                                    {{--                                    <form method="post" action="{{route('course.update',$course->id)}}">--}}
                                    {{--@csrf--}}
                                    <td>

                                        <input disabled type='text'
                                               name="code" value="{{$course->code}}">
                                        {{--                                            @if(!$user->hasRole("student"))--}}

                                        {{--<input type="submit" value="بروزرسانی">--}}
                                        {{--@endif--}}
                                    </td>
                                    {{--</form>--}}
                                @endif

                                <td>

                                    {{--                                    <a  @if($course->sessions <= 0 && $user->hasRole("student"))  @else href="/dashboard/courses/sessions?course_id={{$course->id}}" @endif   class="btn btn-primary btn-sm">جلسات ({{$course->sessions}})</a>--}}
                                    <a
                                            @if(( $user->hasRole("student") &&  $course->status=='0' ))
                                             href="#"

                                            @elseif(( $user->hasRole("student") &&  $course->sessions()->count() <= 0 )||$user->hasRole("admin") )  disabled
                                       @else href="/dashboard/courses/sessions?course_id={{$course->id}}"
                                       @endif   class="btn btn-primary btn-sm">
                                        @if(( $user->hasRole("student") &&  $course->status=='0' ))
                                            جلسات غیرفعال است
                                            @else
                                        جلسات ({{$course->sessions()->count()}}
                                        )
                                            @endif
                                    </a>
                                </td>
                                @if(!$user->hasRole('student'))
                                    <td>
                                        <a href="/dashboard/courses/students?course_id={{$course->id}}" @if($user->hasRole("admin")) disabled @endif
                                           class="btn btn-success btn-sm">دانشجویان ({{$course->count}})</a>
                                    </td>
                                @endif



                                {{--                                @if($user->hasRole('teacher'))--}}
                                @if($user->hasRole('teacher') || $user->hasRole('student'))

                                <td>
                                    <a href="/dashboard/evaluation?course_id={{$course->id}}"
                                       class="btn btn-success btn-sm">
                                        @if($user->hasRole('teacher'))
                                            ارزیابی فعالیت
                                        @elseif($user->hasRole('student'))
                                            فعالیت های من
                                        @endif
                                    </a>
                                </td>
                                @endif
                                @if($user->hasRole('student'))
                                    <td>
                                        <a href="/dashboard/referee?course_id={{$course->id}}"
                                           class="btn btn-success btn-sm">داوری</a>
                                    </td>
                                @endif
                                @if($user->hasRole('teacher'))
                                    <td>
                                        <a href="/dashboard/courses/setting?course_id={{$course->id}}"
                                           class="btn btn-success btn-sm">تنظیمات</a>
                                    </td>
                                @endif
                                @if($user->hasRole('teacher'))
                                    <td>
                                        <a href="/dashboard/courses/bank?course_id={{$course->id}}"
                                           class="btn btn-success btn-sm">بانک سوالات</a>
                                    </td>
                                @endif
                                {{--                                "<td align='center'><input type='text' value='" + name + "' id='name_"+id+"'></td>" +--}}
                                @if(!$user->hasRole('teacher'))
                                    <td>{{$course->user->name}} {{$course->user->family}}</td>
                                @endif


                                @if($user->hasRole('student') )

                                    <td>
                                        <a @if($course->sessions()->count() >0 &&  $course->quizCount($course)==false)  href="/dashboard/quiz?course_id={{$course->id}}"
                                           @else disabled @endif class="btn btn-primary btn-sm">برگزاری امتحان</a>
                                    </td>
                                @endif
                                {{--<td>--}}
                                {{--<a href="/dashboard/quiz/list?course_id={{$course->id}}"--}}
                                {{--class="btn btn-primary btn-sm">سابقه امتحان</a>--}}
                                {{--</td>--}}
                                @if(!$user->hasRole('student'))
                                    <td>
                                        <a href="{{route('course.delete',$course->id)}}"
                                           onclick="return confirm('با حذف این درس کلیه جلسات مربوط به آن و فعالیت دانشجویان حذف شده و قابل برگشت نیست.آیا با حذف این درس کاملا موافق هستید؟  ')">حذف</a>

                                    </td>
                                @endif
                                @if($user->hasRole('teacher'))
                                    <td>
                                        <a href="{{route('course.status',$course->id)}}"
                                           {{--onclick="return confirm('با حذف این درس کلیه جلسات مربوط به آن و فعالیت دانشجویان حذف شده و قابل برگشت نیست.آیا با حذف این درس کاملا موافق هستید؟  ')"--}}
                                        >
                                        @if($course->status==1)
                                                مخفی شدن جلسات
                                            @else
                                            نمایش دادن جلسات
                                            @endif
                                        </a>

                                    </td>
                                @endif
                                @if($user->hasRole('teacher'))
                                    <td>
                                        <a href="{{route('course.active',$course->id)}}"
                                           {{--onclick="return confirm('با حذف این درس کلیه جلسات مربوط به آن و فعالیت دانشجویان حذف شده و قابل برگشت نیست.آیا با حذف این درس کاملا موافق هستید؟  ')"--}}
                                        >
                                        @if($course->active==1)
                                               اتمام درس
                                            @else
                                            برگزاری درس
                                            @endif
                                        </a>

                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @if($user->hasRole('student'))
            <div class="card">
                <div class="card-header">
                    <h5>عضویت در کلاس</h5>
                </div>
                @include('dashboard.layout.message')
                <div class="card-body">
                    <div class="col">
                        <form method="post"
                              action="/dashboard/courses/join"
                              enctype="multipart/form-data">
                            @csrf
                            <div
                                    class="form-group m-form__group @if ($errors->has('code')) has-error @endif">
                                <label>شناسه دوره</label>
                                <div class="input-group mb-3">
                                    <input class="form-control" type="text" placeholder="شناسه دوره"
                                           value="@if(isset($course)){{$course->code}}@endif" name="code">
                                </div>
                                <span class="text-danger" id="code"
                                      style="color: red;">{{$errors->first('code')}}</span>
                            </div>
                            <div class="card-footer" style="margin-bottom: -50px">
                                <button class="btn btn-primary" type="submit">
                                    پیوستن به دوره
                                </button>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        @endif

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
        table = $('#basic-1').DataTable();

        table.destroy();

        table = $('#basic-1').DataTable({
            searching: false
        });
    </script>

@endpush
