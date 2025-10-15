@extends('dashboard2.layout.app')

@section('start')

    <link rel="stylesheet" type="text/css" href="{{("/style/plugins/dropify/dropify.min.css")}}">
    <link href="{{("/style/assets/css/users/account-setting.css")}}" rel="stylesheet" type="text/css"/>

@endsection
@section('main')

    <div id="content" class="main-content">
        <div class="row layout-spacing">
            <div class="col-lg-12">
                <div class="statbox widget box box-shadow">

                    <div class="widget-content widget-content-area">
                        <div class="table-responsive mb-4">

                            <table id="zero-config" class="table table-responsive style-3  table-hover">
                                <?php $i = 1 ?>
                                <thead>
                                <tr>
                                    <th>ردیف</th>
                                    <th>نام</th>
                                    <th>نوع</th>
                                    <th>ایمیل</th>
                                    <th>تعداد درس</th>
                                    <th>سوالات 3روز اخیر</th>
                                    <th>حذف</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td><a href="/dashboard/user/{{$user->id}}">
                                                {{$user->name}}   {{$user->family}}                            </a>
                                        </td>
                                        <td>{{$user->role}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->courses}}</td>
                                        <td>{{$user['questions_new']}}</td>
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
        </div>
    </div>


@endsection

@section('end')

    <script src="{{("/style/plugins/dropify/dropify.min.js")}}"></script>
    <script src="{{("/style/plugins/blockui/jquery.blockUI.min.js")}}"></script>
    <!-- <script src="plugins/tagInput/tags-input.js"></script> -->
    <script src="{{("/style/assets/js/users/account-settings.js")}}"></script>


    <script src="{{("/style/plugins/table/datatable/datatables.js")}}"></script>
    <script>
        $('#zero-config').DataTable({
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>' },
                "sInfo": "صفحه _PAGE_ از _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "جستجو کنید...",
                "sLengthMenu": "نتایج :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 7
        });
    </script>
@endsection
