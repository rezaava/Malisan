@extends('management.layout.master')
@section('add-styles')
    <link rel="stylesheet" type="text/css"
          href="{{ asset('app-assets/vendors/data-tables/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/data-tables.min.css') }}">
    <style>
        .old{
            background-color: #7ba8ff;
        }
        .new{
            background-color: #ff7471;
        }
    </style>
@endsection
@section('title', 'دانشجویان درس')
@section('main-content')
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <h4 class="card-title">گزینه های طول صفحه</h4>
                    <div class="row">
                        <div class="col s12">
                            <table id="page-length-option" class="display">
                                @csrf
                                <thead>
                                <tr>
                                    <th rowspan="2">نام و نام خانوادگی</th>
                                    <th rowspan="2" >وضعیت</th>
                                    <th rowspan="1" colspan="5">فعالیت های انجام شده</th>
                                    <th rowspan="1" colspan="6">فعالیت های سه روز اخیر</th>

                                </tr>
                                <tr>
                                    <th>گزارش</th>
                                    <th>سوال</th>
                                    <th>تکلیف</th>
                                    <th>داوری</th>
                                    <th>جمع</th>
                                    <th>گزارش</th>
                                    <th>سوال</th>
                                    <th>تکلیف</th>
                                    <th>داوری</th>
                                    <th>جمع</th>

                                    <th>تعداد خود ازمایی</th>
                                </tr>
                                </thead>

                                َ<tbody>
                                @foreach($users as $key=>$user)

                                    <tr>
                                        <td class="old"><a href="/dashboard/progress?course_id={{$course->id}}&user={{$user->id}}">{{$user->name}} {{$user->family}}</a></td>
                                        <td>
                                            <div class="" style="@if($user->online)background-color:yellow @else background-color:black @endif">
{{--                                            <div class="chip gradient-45deg-purple-deep-orange gradient-shadow white-text">--}}
{{--                                                <img src="../../../app-assets/images/avatar/avatar-3.png" alt="Materialize">--}}
                                                {{ $user->online == 0 ? 'آفلاین' : 'آنلاین' }}
                                            </div>
                                        </td>
                                        <td class="old">{{$user['disc']}} </td>
                                        <td class="old">{{$user['questions']}} </td>
                                        <td class="old">{{$user['exer']}} </td>
                                        <td class="old">{{$user['davari']}} </td>
                                        <td class="old">{{$user['davari'] + $user['exer'] + $user['questions'] + $user['disc']}} </td>
                                        <td class="new">{{$user['disc_new']}} </td>
                                        <td class="new">{{$user['questions_new']}} </td>
                                        <td class="new">{{$user['exer_new']}} </td>
                                        <td class="new">{{$user['davari_new']}} </td>
                                        <td class="new">{{$user['davari_new'] + $user['exer_new'] + $user['questions_new'] + $user['disc_new']}} </td>
                                        <td class="new">{{$user['khod_new']}} </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
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
