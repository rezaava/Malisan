@extends('management.layout.master')
@section('add-styles')

    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/flag-icon/css/flag-icon.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/data-tables/css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('app-assets/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
@endsection
@section('js')
    <script src="{{asset('app-assets/js-rtl/custom/custom-script-rtl.min.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/customizer.min.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/data-tables.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/data-tables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/data-tables/js/dataTables.select.min.js')}}"></script>
@endsection
@section('title', 'لیست سفارشات')
@section('main-content')

    <div class="row">
        <div class="col s12">
            <div id="borderless-table" class="card ">
                <div class="card-content">

                    <div class="row">
                        <div class="col s12">
                            <table>
                                <thead>
                                <tr>
                                    <th data-field="id">شناسه</th>
                                    @if($role == 'shop')
                                        <th data-field="name">مشتری</th>
                                    @else
                                        <th data-field="name">فروشگاه</th>
                                    @endif
                                    <th data-field="price">قیمت</th>
                                    <th data-field="price">وضعیت</th>
                                    <th data-field="price">اقدام</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orderList as $order)
                                <tr>
                                    <td>{{$order->id}}</td>
                                    @if($role == 'shop')
                                        <td>{{$order->user->name.' '.$order->user->family}}</td>
                                    @else
                                        <td>{{$order->shop->name}}</td>
                                    @endif
                                    <td>{{number_format($order->price)}} تومان</td>
                                    <td>{{$order->getStatus()}}</td>
                                    <td>
                                        <a href="{{route('order.details', ['orderId' => $order->id])}}" class="mb-6 btn-floating waves-effect waves-light gradient-45deg-purple-deep-orange gradient-shadow">
                                            <i class="material-icons">more_horiz</i>
                                        </a>
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
