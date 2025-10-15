@extends('management.layout.master')
@section('add-styles')
    <meta http-equiv="refresh" content="3;url={{$paymentLink}}" />
@endsection
@section('title', 'درحال انتقال به درگاه ...')
@section('main-content')

    <div class="row">
        <div class="col s12 m1" > </div>
        <div class="col s12 m10">
            <div class="card" id="select-shop-card">
                <div class="card-content">
                    <h4 class="card-title">تا ثانیه های دیگر به درگاه منتقل خواهید شد ...</h4>
                    <p>
                        در صورتی که منتقل نشدید، <a href="{{$paymentLink}}">اینجا</a> کلیک کنید
                    </p>
                </div>
            </div>
        </div>

    </div>

@endsection
