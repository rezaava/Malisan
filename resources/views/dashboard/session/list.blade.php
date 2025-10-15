@extends('dashboard.layout.app')
@section('title','صفحه نمایش دوره')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('/cuba-style/assets/css/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/cuba-style/assets/css/owlcarousel.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/cuba-style/assets/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/cuba-style/assets/css/responsive.css')}}">

@endpush
@section('content')
    <div class="row">
        <div class="col-sm-9">
            <div class="row">
                <div class="container-fluid">
                    <div class="page-header">
                        @include('dashboard.layout.message')
                        <div class="row">
                            {{--                            @if(sizeof($sessions) > 0)--}}
                            <div class="col-lg-6">
                                <h3>@if($meeting)جلسه {{$meeting->number}} : {{$meeting->name}} @else جلسه0  @endif</h3>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#"><i data-feather="home"></i></a></li>
                                    {{--<li class="breadcrumb-item">دروس</li>--}}
                                    <li class="breadcrumb-item">لیست جلسات</li>
                                </ol>
                            </div>
                            {{--                            @endif--}}
                            <div class="col-lg-6">
                                <!-- Bookmark Start-->
                                <div class="bookmark pull-right">

                                    <ul>

                                        {{--<li><a href="#" data-container="body" data-toggle="popover" data-placement="top" title="" data-original-title="Chat"><i data-feather="message-square"></i></a></li>--}}
                                        {{--<li><a href="#" data-container="body" data-toggle="popover" data-placement="top" title="" data-original-title="طرح سوال" style="font-size: 20px;color: darkorange">?</a></li>--}}
                                        {{--<li><a href="#" data-container="body" data-toggle="popover" data-placement="top" title="" data-original-title="Icons"><i data-feather="command"></i></a></li>--}}
                                        @if($meeting)
                                            <li><a href="/dashboard/question/show?session_id={{$meeting->id}}"
                                                   data-container="body" data-toggle="popover" data-placement="top"
                                                   title="" data-original-title="طرح سوال"
                                                   style="font-size: 20px;color: darkorange"><img class="img-fluid"
                                                                                                  src="{{asset('/files/icons/question.png')}}"
                                                                                                  alt=""
                                                                                                  style="height: 30px"></a>
                                            </li>
                                        @if(($ex_count>0) || (Laratrust::hasRole("teacher")))
                                            <li><a href="/dashboard/exercise/show?session_id={{$meeting->id}}"
                                                   data-container="body" data-toggle="popover" data-placement="top"
                                                   title="" data-original-title="تکلیف"
                                                   style="font-size: 20px;color: darkorange"><img class="img-fluid"
                                                                                                  src="{{asset('/files/icons/homework.png')}}"
                                                                                                  alt=""
                                                                                                  style="height: 30px"></a>
                                            </li>
                                        @endif
                                        @endif

                                        @if(!Laratrust::hasRole("student") && isset($meeting))
                                            @if($meeting)
                                                <li><a href="{{route('session.edit',$meeting->id)}}"
                                                       data-container="body" data-toggle="popover" data-placement="top"
                                                       title=""
                                                       data-original-title="ویرایش جلسه"><img class="img-fluid"
                                                                                              src="{{asset('/files/icons/edit.png')}}"
                                                                                              alt=""
                                                                                              style="height: 30px"></a>
                                                </li>
                                            @endif
                                        @endif
                                        @if($meeting && Laratrust::hasRole("student"))
                                            <li><a href="#disc"
                                                   data-container="body" data-toggle="popover" data-placement="top"
                                                   title=""
                                                   data-original-title="بحث"><img class="img-fluid"
                                                                                  src="{{asset('/files/icons/report.png')}}"
                                                                                  alt="" style="height: 30px"></a>
                                            </li>
                                        @endif








                                        {{--<li><a href="#"><i class="bookmark-search" data-feather="star"></i></a>--}}
                                        {{--<form class="form-inline search-form">--}}
                                        {{--<div class="form-group form-control-search">--}}
                                        {{--<input type="text" placeholder="Search..">--}}
                                        {{--</div>--}}
                                        {{--</form>--}}
                                        {{--</li>--}}
                                        <li><a href="/dashboard/courses/list"
                                               data-container="body" data-toggle="popover" data-placement="top" title=""
                                               data-original-title="بازگشت"><img
                                                        src="{{asset('/cuba-style/assets/images/arrow-left.svg')}}"></a>
                                        </li>
                                        {{--                                        <li><a href="{{ url()->previous()}}" data-container="body" data-toggle="popover" data-placement="top" title="" data-original-title="بازگشت"><img src="{{asset('/cuba-style/assets/images/arrow-left.svg')}}"></a></li>--}}

                                    </ul>

                                </div>
                                <!-- Bookmark Ends-->
                            </div>
                        </div>
                    </div>
                </div>
                @if(sizeof($sessions) > 0)
                    @if(isset($meeting->file))
                        <div class="card">
                            <div class="card-header">
                                {{--@if($meeting->format_file  && $meeting->text == null)--}}

                                {{--<iframe src="{{asset('files/session'.$meeting->file)}}" style="width: 660px; height:  640px;" frameborder="0"></iframe>--}}

                                {{--@else--}}
                                <div class="row">
                                    <a href="{{ URL::to( '/files/session' . $meeting->file)  }}" target="_blank">
                                        <h6>پیوست <img class="img-fluid"
                                                       src="{{asset('/files/icons/attach.png')}}"
                                                       alt=""
                                                       style="height: 30px"></h6>
                                    </a>
                                </div>
                                {{--@endif--}}
                            </div>
                        </div>
                    @endif
                    @if(isset($meeting->text))
                        <div class="card">
                            <div class="card-body">
                                <h6>
                                    {!!$meeting->text!!}
                                </h6>
                            </div>
                        </div>
                    @endif

                @endif
            </div>
            {{--            @if(sizeof($sessions) > 0)--}}
            @if(Laratrust::hasRole("student") )

                <div class="row" id="disc">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                @if($meeting)
                                    @if(Laratrust::hasRole("student") )


                                        <form method="post"
                                              action={{"/dashboard/discussion/create?session_id=".$meeting->id}}
                                                      enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group @if ($errors->has('discussion')) has-error @endif">
                                                <div class="row">
                                                    <label>ارائه خلاصه ای از محتوای درس</label>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="col-lg-12">
                                                <textarea class="form-control btn-square" name="text"
                                                          id="description">@if(isset($discussion)){{$discussion->text}}@endif</textarea>
                                                    </div>

                                                </div>
                                                <span class="text-danger" id="description"
                                                      style="color: red;">{{$errors->first('$session')}}</span>
                                            </div>
                                            <div class="card-footer">
                                                <button class="btn btn-primary" type="submit">
                                                    @if(isset($discussion))
                                                        بروزرسانی
                                                    @else
                                                        ارسال
                                                    @endif
                                                </button>
                                            </div>
                                        </form>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            @endif
        </div>


        <div class="col-sm-3">
            <div class="card">
                <div class="card-header">
                    <h5>
                        جلسات
                    @if(!Laratrust::hasRole("student") )
                       <a href="/dashboard/courses/sessions/create?course_id={{$course->id}}"
                               data-container="body" data-toggle="popover" data-placement="top"
                               title=""
                               data-original-title="ایجاد جلسه جدید"><img class="img-fluid"
                                                                          src="{{asset('/files/icons/add.png')}}"
                                                                          alt=""
                                                                          style="height: 30px"></a>
                    @endif
                    </h5>

                </div>
                <div class="card-body">
                    <div class="table-responsive product-table">
                        <table class="display" id="basic-1">
                            <?php $i = 1 ?>
                            <tbody>
                            @foreach($sessions as $session)
                                <tr>
                                    <td>
                                        <a href="/dashboard/courses/sessions?course_id={{$course->id}}&meeting_id={{$session->id}}">{{$session->number}}
                                            :{{$session->name}}</a>
                                    </td>

                                    @if(!Laratrust::hasRole("student"))

                                        <td>
                                            <a href="{{route('session.delete',$session->id)}}"
                                               onclick="return confirm('با حذف این جلسه کلیهمطالب مرتبط با آن حذف خواهد شد و محتوای جلسه قابل برگشت نیست،آیا با حذف جلسه کاملا موافق هستید؟  ')" data-original-title="با توجه به اینکه حذف جلسه باعث بهم ریختن ترتیب جلسات می شود توصیه میکنیم به جای حذف ، محتوای آن را ویرایش کنید."><img
                                                        src="{{asset('/cuba-style/assets/images/zarbdar.png')}}"
                                                        width="10px"> </a>

                                        </td>

                                    @endif

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{--        @endif--}}
    </div>


@endsection

@push('scripts')
    <script src="{{asset('/cuba-style/assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/cuba-style/assets/js/rating/jquery.barrating.js')}}"></script>
    <script src="{{asset('/cuba-style/assets/js/owlcarousel/owl.carousel.js')}}"></script>
    <script src="{{asset('/cuba-style/assets/js/ecommerce.js')}}"></script>
    <script src="{{asset('/cuba-style/assets/js/product-list-custom.js')}}"></script>
    <script src="{{asset('/cuba-style/assets/js/tooltip-init.js')}}"></script>
    <script src="{{asset('/cuba-style/assets/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('/cuba-style/assets/js/select2/select2.full.min.js')}}"></script>
    <script src="https://cdn.ckeditor.com/4.15.0/basic/ckeditor.js"></script>

    <script>
        CKEDITOR.replace('description', {
            filebrowserUploadUrl: '/admin/panel/upload-image',
            filebrowserImageUploadUrl: '/admin/panel/upload-image'
        });

    </script>

@endpush
