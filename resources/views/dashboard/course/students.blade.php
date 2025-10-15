@extends('dashboard.layout.app')
@section('title','صفحه نمایش درس')
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
                        {{--                        <h3>درس ها</h3>--}}
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i data-feather="home"></i></a></li>
                            <li class="breadcrumb-item">دانشجویان</li>
                            <li class="breadcrumb-item">لیست دانشجویان</li>
                        </ol>
                    </div>
                    <div class="col-lg-6">
                        <!-- Bookmark Start-->
                        <div class="bookmark pull-right">
                            <ul>
                                <div class="bookmark pull-right">
                                    <ul>
                                        <li><a href="/dashboard/courses/list" data-container="body"
                                               data-toggle="popover" data-placement="top" title=""
                                               data-original-title="بازگشت"><img
                                                        src="{{asset('/cuba-style/assets/images/arrow-left.svg')}}"></a>
                                        </li>

                                    </ul>
                                </div>
                            </ul>
                        </div>
                        <!-- Bookmark Ends-->
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5> لیست دانشجویان درس({{$course->name}})</h5>
            </div>
            @include('dashboard.layout.message')
            <div class="card-body">
                <div class="table-responsive product-table">
                    <table class="display" id="basic-1">
                        <?php $i = 1 ?>
                        <thead>
                        <tr>
                            <th>ردیف</th>
                            <th>عکس</th>
                            <th>نام</th>

                            @if(!Laratrust::hasRole('student'))
                                <td>عملیات</td>
                            @endif
                            <td>سابقه امتحان</td>
                            <td>پیشرفت درسی</td>
                            <td>مشاهده</td>


                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>
                                    @if(isset($user->image))
                                        <img class="img-fluid"
                                             src="{{asset('/files/user').$user->image}}"
                                             alt=""
                                             style="height: 45px">
                                    @endif
                                </td>
                                <td>{{$user->name}}</td>

                                @if(!Laratrust::hasRole('student'))

                                    <td>
                                        <a href="{{route('destroyUser',$user->id)}}"
                                           onclick="return confirm('آیا مطمئن هستید ؟  ')"
                                           class="btn btn-danger">اخراج</a>

                                    </td>

                                @endif
                                <td>
                                    <a href="/dashboard/quiz/list?course_id={{$course->id}}&user={{$user->id}}"
                                       class="btn btn-primary btn-sm">سابقه امتحان</a>
                                </td>
                                <td>
                                    <a href="/dashboard/progress?course_id={{$course->id}}&user={{$user->id}}"
                                       class="btn btn-primary btn-sm">پیشرفت درسی</a>
                                </td>
                                    <td>
                                        <a href="/dashboard/user/{{$user->id}}" class="btn btn-primary">مشاهده</a>
                                    </td>
                                </a>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
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
@endpush
