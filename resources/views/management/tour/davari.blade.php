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
                                        <th>title</th>
                                        <th>abstract</th>
                                        <th>keywords</th>
                                        <th>file</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($answers as $tour)
                                        <tr
                                        @if($tour->davar)
                                        style="background-color:green;color:white"
                                        @endif
                                        >
                                            <td><a href="/dashboard/tour/score/{{$tour->id}}">{{$tour->id}}</a></td>
                                            <td>{{ $tour->title }}</td>
                                            <td>{{ $tour->abstract }}</td>
                                            <td>{{ $tour->keywords }}</td>
                                            <td><a href="/files/tour/answer{{ $tour->file }}" >download</a></td>

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
