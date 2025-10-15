@extends('dashboard.layout.app')
@section('title','صفحه نمایش دوره')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('/cuba-style/assets/css/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/cuba-style/assets/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/cuba-style/assets/css/owlcarousel.css')}}">

@endpush
@section('content')

    <div>
        <div class="container-fluid">
            <form action="/dashboard/courses/edit-setting"
                  method="post" enctype="multipart/form-data">
                @csrf
                <input name="course_id" value="{{$course->id}}" hidden>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-success">
                            <div class="card-header " style="background-color: darkgreen">
                                <h3 class="card-title " style="color: white;margin-bottom: -50px">
                                    طراحی سوال
                                </h3>
                            </div>
                            <div class="card-body">
                                {{--//nomre--}}
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">سقف نمره</span>
                                        </div>
                                        <input
                                                placeholder="سقف نمره " type="text"
                                                name="score_q"
                                                class="form-control rtl"
                                                value=" {{$course->score_q}}">
                                    </div>
                                </div>
                                {{--num_q--}}
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">تعداد سوال</span>
                                        </div>
                                        <input
                                                placeholder="تعداد سوال" type="text"
                                                name="num_q"
                                                class="form-control rtl"
                                                value=" {{$course->num_q}}">
                                    </div>

                                </div>

                            </div>

                            <div class="card-header " style="background-color: darkgreen">
                                <h3 class="card-title " style="color: white;margin-bottom: -50px">
                                    گزارش
                                </h3>
                            </div>
                            <div class="card-body">
                                {{--//nomre--}}
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">سقف نمره</span>
                                        </div>
                                        <input
                                                placeholder="سقف نمره " type="text"
                                                name="score_d"
                                                class="form-control rtl"
                                                value=" {{$course->score_d}}">
                                    </div>
                                </div>
                                {{--num_q--}}
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">تعداد </span>
                                        </div>
                                        <input
                                                placeholder="تعداد " type="text"
                                                name="num_q"
                                                class="form-control rtl"
                                                value=" 1" disabled>
                                    </div>

                                </div>

                            </div>
                            <div class="card-header " style="background-color: darkgreen">
                                <h3 class="card-title " style="color: white;margin-bottom: -50px">
                                    تکلیف
                                </h3>
                            </div>
                            <div class="card-body">
                                {{--//nomre--}}
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">سقف نمره</span>
                                        </div>
                                        <input
                                                placeholder="سقف نمره " type="text"
                                                name="score_e"
                                                class="form-control rtl"
                                                value=" {{$course->score_e}}">
                                    </div>
                                </div>
                                {{--num_q--}}
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">تعداد </span>
                                        </div>
                                        <input
                                                placeholder="تعداد " type="text"
                                                name="num_q"
                                                class="form-control rtl"
                                                value=" 1" disabled>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <button type="submit" class="btn btn-block btn-outline-primary" id="btn">ذخیره
                        </button>
                    </div>
                </div>
            </form>
            <br>
            <!-- /.row -->
        </div><!-- /.container-fluid -->


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
