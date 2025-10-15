@extends('dashboard.layout.app')
@section('title','صفحه نمایش دوره')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('/cuba-style/assets/css/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/cuba-style/assets/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/cuba-style/assets/css/owlcarousel.css')}}">

@endpush
@section('content')
    <div class="col-sm-12">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-6">
                        <h3>دوره ها</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i data-feather="home"></i></a></li>
                            <li class="breadcrumb-item">دروس</li>
                            <li class="breadcrumb-item">لیست دروس</li>
                        </ol>
                    </div>
                    <div class="col-lg-6">
                        <!-- Bookmark Start-->
                        <div class="bookmark pull-right">
                            <ul>
                                <li><a href="#" data-container="body" data-toggle="popover" data-placement="top" title="" data-original-title="Chat"><i data-feather="message-square"></i></a></li>
                                <li><a href="#" data-container="body" data-toggle="popover" data-placement="top" title="" data-original-title="Icons"><i data-feather="command"></i></a></li>
                                <li><a href="#" data-container="body" data-toggle="popover" data-placement="top" title="" data-original-title="Learning"><i data-feather="layers"></i></a></li>
                                <li><a href="#"><i class="bookmark-search" data-feather="star"></i></a>
                                    <form class="form-inline search-form">
                                        <div class="form-group form-control-search">
                                            <input type="text" placeholder="Search..">
                                        </div>
                                    </form>
                                </li>
                            </ul>
                        </div>
                        <!-- Bookmark Ends-->
                    </div>
                </div>
            </div>
        </div>
{{--        @if(Laratrust::hasRole("student"))--}}

        {{--@endif--}}
        <div class="card">
            <div class="card-header">
                <h5>لیست دروس</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive product-table">
                    <table class="display" id="basic-1">
                        <?php $i=1 ?>
                        <thead>
                        <tr>
                            <th>ردیف</th>
                            <th>نام</th>
                            <th>نوع</th>
                            <th>ایمیل</th>
                            <th>تعداد درس</th>
                            <th>حذف</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{$i++}}</td>
                               <td>                         <a href="/dashboard/user/{{$user->id}}">
                                   {{$user->name}}   {{$user->family}}                            </a>
                               </td>
                               <td>{{$user->role}}</td>
                               <td>{{$user->email}}</td>
                               <td>{{$user->courses}}</td>
                                <td>
                                    <a href="/dashboard/user/remove/{{$user->id}}"
                                       onclick="return confirm('مطمئن هستید؟  ')">حذف</a>

                                </td>
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
