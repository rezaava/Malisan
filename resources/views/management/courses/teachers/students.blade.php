@extends('management.layout.master')
@section('add-styles')
    <link rel="stylesheet" type="text/css"
          href="{{ asset('app-assets/vendors/data-tables/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/data-tables.min.css') }}">
@endsection
@section('title', 'دانشجویان درس')
@section('main-content')
    <div class="row">
        <div class="col 12 s12">
            <a href="/dashboard/students/export?crs={{ $course->id }}"
               class="mb-6 btn-floating waves-effect waves-light gradient-45deg-light-blue-cyan gradient-shadow tooltipped"
               data-position="bottom" data-tooltip="خروجی فایل اکسل میدم بهت">
                <i class="material-icons dp48">import_export</i>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <h4 class="card-title">گزینه های طول صفحه</h4>
                    <div class="row">
                        <div class="col s12">
                            <form action="{{'/dashboard/courses/amali/'.$course->id}}" method="post">
                                <table id="page-length-option" class="display">
                                    @csrf
                                    <thead>
                                    <tr>
                                        <th>ردیف</th>
                                        <th>وضعیت</th>
                                        <th>پروفایل</th>
                                        <th>نام کاربر</th>
                                        @if($setting->amali_nomre>0)
                                            <th class="text-center">نمره عملی</th>
                                        @endif
                                        <th hidden></th>
                                        @if($setting->final_nomre>0)
                                            <th class="text-center">نمره پایان ترم(از 20)</th>
                                        @endif
                                        <th class="text-center">مشخصات</th>
                                        <th class="text-center">پیشرفت درسی</th>
                                        <th class="text-center">سابقه خودآزمایی</th>
                                        <th class="text-center">اخراج</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="chip gradient-45deg-purple-deep-orange gradient-shadow white-text">
                                                    <img src="../../../app-assets/images/avatar/avatar-3.png" alt="Materialize">{{ $user->online == 0 ? 'آفلاین' : 'آنلاین' }}
                                                </div>
                                            </td>
                                            <td>
                                                @if(isset($user->image))
                                                    <img class="profile-img"
                                                         src="{{asset('/files/user').$user->image}}"
                                                         alt="{{$user->name}}"
                                                         style="height: 45px">
                                                @else
                                                    <img class="profile-img"
                                                         src="{{asset('/files/user/avatar.png')}}"
                                                         alt="{{$user->name}}"
                                                         style="height: 45px">
                                                @endif
                                            </td>
                                            <td>{{ $user->name . ' ' . $user->family }}</td>
                                            @if($setting->amali_nomre>0)
                                                <td class="text-center">
                                                    <input name="amali[{{$user->id}}]" value="{{$user->nomre}}"
                                                           style="max-width: 45px">
                                                </td>
                                            @endif
                                            <td class="text-center" hidden>
                                                <input name="ind[{{$user->id}}]" value="{{$user->id}}">
                                            </td>
                                            @if($setting->final_nomre>0)
                                                <td class="text-center">
                                                    <input name="final[{{$user->id}}]" type="number" step=".01"
                                                           value="{{$user->final}}" max="20" style="max-width: 60px">
                                                </td>
                                            @endif
                                            <td>
                                                <a href="/dashboard/user/{{$user->id}}"
                                                   class="mb-6 btn-floating waves-effect waves-light gradient-45deg-light-blue-cyan gradient-shadow tooltipped"
                                                   data-position="bottom" data-tooltip="اطلاعات بیشتری از دانشجو مشاهده کنید">
                                                    <i class="material-icons dp48">import_export</i>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="/dashboard/progress?course_id={{$course->id}}&user={{$user->id}}"
                                                   class="mb-6 btn-floating waves-effect waves-light gradient-45deg-light-blue-cyan gradient-shadow tooltipped"
                                                   data-position="bottom" data-tooltip="مشاهده پیشرفت درسی دانشجو">
                                                    <i class="material-icons dp48">import_export</i>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="/dashboard/quiz/list?course_id={{$course->id}}&user={{$user->id}}"
                                                   class="mb-6 btn-floating waves-effect waves-light gradient-45deg-light-blue-cyan gradient-shadow tooltipped"
                                                   data-position="bottom" data-tooltip="خودآزمایی از این دانشجو">
                                                    <i class="material-icons dp48">import_export</i>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="/dashboard/courses/destroy-user?u={{$user->id}}&c={{$course->id}}"
                                                   class="mb-6 btn-floating waves-effect waves-light gradient-45deg-purple-deep-orange gradient-shadow tooltipped"
                                                   onclick="return confirm('آیا مطمئن هستید ؟  ')"
                                                   data-position="bottom" data-tooltip="اخراجش کنم ؟">
                                                    <i class="material-icons dp48">exit_to_app</i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>ردیف</th>
                                        <th>وضعیت</th>
                                        <th>پروفایل</th>
                                        <th>نام کاربر</th>
                                        @if($setting->amali_nomre>0)
                                            <th class="text-center">نمره عملی</th>
                                        @endif
                                        <th hidden></th>
                                        @if($setting->final_nomre>0)
                                            <th class="text-center">نمره پایان ترم(از 20)</th>
                                        @endif
                                        <th class="text-center">مشخصات</th>
                                        <th class="text-center">پیشرفت درسی</th>
                                        <th class="text-center">سابقه خودآزمایی</th>
                                        <th class="text-center">اخراج</th>
                                    </tr>
                                    </tfoot>
                                    @if($setting->amali_nomre >0 || $setting->final_nomre >0)
                                        <input type="submit"
                                               value=" ثبت نمره "
                                               class="btn btn-primary">
                                    @endif
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="/app-assets/vendors/data-tables/js/jquery.dataTables.min.js"></script>
    <script src="/app-assets/js/scripts/data-tables.min.js"></script>
@endsection
