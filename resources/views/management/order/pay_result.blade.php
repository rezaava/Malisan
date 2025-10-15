@php use App\Order; @endphp
@extends('management.layout.master')
@section('add-styles')

@endsection
@section('title', 'نتیجه پرداخت')
@section('main-content')

    <div class="row">
        <div class="col s12 m3"></div>
        <div class="col s12 m6 card-width">
            <div class="card border-radius-6">
                <div class="card-content center-align">
                    <i style="font-size: 80px;" class="material-icons amber-text small-ico-bg mb-2">@if($isSuccess)
                            check
                        @else
                            error_outline
                        @endif</i>
                    <h4 class="m-2"><b>{{$message}}</b></h4>
                    @if($order->status == Order::STATUS_PENDING_CHECKOUT || $order->status == Order::STATUS_CLOSED)
                        <p class="green-text  mt-3">سفارش شماره {{$order->id}} تایید و تکمیل شد.</p>
                    @elseif($order->status == Order::STATUS_CREATED)
                        <p class="black-text  mt-3">سفارش شماره {{$order->id}} منتظر پرداخت است.</p>
                    @elseif($order->status == Order::STATUS_CANCELED)
                        <p class="gray-text  mt-3">سفارش شماره {{$order->id}} لغو شده است.</p>
                    @endif
                    <a href="{{route('order.details', ['orderId' => $order->id])}}"
                       class="waves-effect waves-light  btn gradient-45deg-green-teal box-shadow-none border-round mr-1 mb-1">بازگشت
                        به صفحه سفارش</a>
                </div>
            </div>
        </div>

    </div>

@endsection
