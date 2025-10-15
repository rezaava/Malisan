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
                                <div class="bookmark pull-right">
                                    <ul>
                                        <li><a href="/dashboard/courses/list" data-container="body" data-toggle="popover" data-placement="top" title="" data-original-title="بازگشت"><img src="{{asset('/cuba-style/assets/images/arrow-left.svg')}}"></a></li>

                                    </ul>
                                </div>
                            </ul>
                        </div>
                        <!-- Bookmark Ends-->
                    </div>
                        <!-- Bookmark Ends-->
                    </div>
                </div>
            </div>
        </div>
        {{--        @if(Laratrust::hasRole("student"))--}}

        <div class="card">
            @include('dashboard.layout.message')

            <div class="card-header">
                <h5>لیست امتحانات</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive product-table">
                    <table class="display" id="basic-1">
                        <?php $i = 1 ?>
                        <thead>
                        <tr>
                            <th>ردیف</th>
                            <th>شناسه</th>
                            <th>نمره</th>
                            <th>مشاهده</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($quizzes as $quiz)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$quiz->id}}</td>
                                <td>{{$quiz->score}}</td>
                                <td>
                                    <a href="/dashboard/quiz/view?quiz_id={{$quiz->id}}"
                                       class="btn btn-success btn-sm">مشاهده ( {{$quiz->count}} )</a>
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
    <script>
        table = $('#basic-1').DataTable();

        table.destroy();

        table = $('#basic-1').DataTable( {
            searching: false
        } );
    </script>
@endpush
