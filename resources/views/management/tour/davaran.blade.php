@extends('management.layout.master')
@section('add-styles')
    <link rel="stylesheet" type="text/css"
          href="{{ asset('app-assets/vendors/data-tables/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/data-tables.min.css') }}">
@endsection
@section('title', 'دانشجویان درس')
@section('main-content')
       <div class="row">
        <div class="col s12">
            <div id="icon-prefixes" class="card card-tabs">
                <div class="card-content">
                    <div id="view-icon-prefixes" class="active">
                        <div class="row">
                            <form class="col s12" action=" /dashboard/tour/davar/add/{{$id}} " method="post">
                                @csrf
                                <div class="row">
                                    <div class="input-field col s6">
                                        <i class="material-icons prefix">account_circle</i>
                                        <input id="name" name="national" required type="text" class="validate"  >
                                        <label class="contact-input" for="icon_prefix3">
                                            کد ملی داور جدید
                                        </label>
                                    </div>
                                    
                                </div>
                                <input type="submit" class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 float-right" value="ثبت داور جدید">
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


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
                                        <th>ردیف</th>
                                        <th>نام داور</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($davaran as $tour)
                                        <tr>
                                            <td>{{$tour->id}}</td>
                                            <td>{{ $tour['user'] }}</td>

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
