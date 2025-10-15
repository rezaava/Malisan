@extends('management.layout.master')
@section('js')
    <script src="{{asset('app-assets/js-rtl/scripts/extra-components-sweetalert-rtl.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/sweetalert/sweetalert-rtl.min.js')}}"></script>
    <script>

        function payRequest() {
            progress = document.getElementById('progress-pay');
            payButton = document.getElementById('payButton');
            progress.style.display = "block";
            payButton.style.display = "none";

            try {
                let xhr = new XMLHttpRequest();

                xhr.open('GET', '{{route('shop.details', ['shopId' => 'SHOP_ID'])}}'.replace("SHOP_ID" , id));
                xhr.responseType = 'json';

                xhr.onload = function() {
                    progress.style.display = "none";

                    try {

                        let responseObj = xhr.response;
                        if (responseObj.status === '0') {
                            swal(responseObj.message)
                        } else {

                            document.getElementById("shop-name").innerText = responseObj.shop.name;
                            document.getElementById("shop-description").innerText = responseObj.shop.description;
                            document.getElementById("shop-phone").innerText = responseObj.shop.phone;
                            document.getElementById("shop-address").innerText = responseObj.shop.address;
                            document.getElementById("shop-image").src = '{{asset('files/shops/SHOP_IMAGE')}}'.replace('SHOP_IMAGE' , responseObj.shop.image);
                            document.getElementById("shop-buy").href = '{{route('shop.buy' , ['shopId' => 'SHOP_ID'])}}'.replace("SHOP_ID" , id);

                            if(responseObj.shop.latitude && responseObj.shop.longitude) {
                                document.getElementById("shop-location").style.display = "inline-block";
                                document.getElementById("shop-location").href = "geo:"+responseObj.shop.latitude+","+responseObj.shop.longitude;
                            } else {
                                document.getElementById("shop-location").style.display = "none";
                            }


                            document.getElementById("modal-trigger").click();
                        }

                    } catch (e) {
                        swal({
                            title: "مشکلی پیش آمد!",
                            text: "اینترنت خود را بررسی و مجدد امتحان کنید.",
                            timer: 2e3,
                            buttons: !1
                        })
                    }
                };

                xhr.onerror = function() {
                    progress.style.display = "none";
                    payButton.style.display = "block";
                    swal({
                        title: "مشکلی پیش آمد!",
                        text: "اینترنت خود را بررسی و مجدد امتحان کنید.",
                        timer: 2e3,
                        buttons: !1
                    })
                };

                xhr.send();
            } catch (e) {
                progress.style.display = "none";
                payButton.style.display = "block";
                swal({
                    title: "مشکلی پیش آمد!",
                    text: "خطا در پردازش ...",
                    timer: 2e3,
                    buttons: !1
                })
            }


        }

    </script>
@endsection
@section('title', 'سفارش: '.$order->id)
@section('main-content')

    <div class="row">
        <div class="col s12 m1" > </div>
        <div class="col s12 m10">
            <div class="card" id="select-shop-card">
                <div class="card-content">
                    @php
                        $transaction = $order->transactions->first()
                    @endphp
                    <h4 class="card-title">وضعیت سفارش شماره {{$order->id}}: {{$order->getStatus()}}</h4>
                    <p>
                        جزییات بیشتر سفارش:
                    </p>

                    <div class="row">
                        <div class="col s12 m6">
                            <div class="card gradient-shadow gradient-45deg-light-blue-cyan border-radius-3 shop-item">
                                <div class="card-content center shop-item">
                                    <p class="white-text lighten-4">اطلاعات فروشگاه:</p>
                                    <h5 class="white-text lighten-4 shop-item">{{$order->shop->name}}</h5>
                                    <p class="white-text lighten-4">{{$order->shop->phone}}</p>
                                    <p class="white-text lighten-4">{{$order->shop->address}}</p>
                                </div>
                            </div>

                            <div class="card gradient-shadow gradient-45deg-light-blue-cyan border-radius-3 shop-item">
                                <div class="card-content center shop-item">
                                    <p class="white-text lighten-4">اطلاعات مشتری:</p>
                                    <h5 class="white-text lighten-4 shop-item">{{$order->user->name}} {{$order->user->family}}</h5>
                                    <p class="white-text lighten-4">{{$order->user->mobile}}</p>
                                    <p class="white-text lighten-4">{{$order->user->email}}</p>
                                </div>
                            </div>

                            <p>موارد زیر را در نظر داشته باشید:</p>
                            <ol>
                                <li>مبلغ کسر شده از کیف پول درصورتی که سفارش لغو شود، عودت داده میشود.</li>
                                <li>در هر سفارش نام، شماره تلفن و ایمیل مشتری به فروشگاه نمایش داده میشود.</li>
                                @if($role == 'user')
                                    <li>تا زمانی که پرداخت را انجام ندهید، سفارش نهایی نخواهد شد.</li>
                                    <li>درصورتی که مبلغ از حساب شما کسر شد ولی سفارش شما تایید نشد، مبلغ برداشت شده حداکثر 48 ساعت به حسابتان عودت داده میشود.</li>
                                @else
                                    <li>درخواست تصفیه شما بعد از پرداخت کاربر ایجاد می شود.</li>
                                    <li>اگر کاربر پرداخت را انجام داد و تصفیه ایجاد نشد شما می توانید دستی درخواست تصفیه را ایجاد کنید!</li>
                                @endif
                            </ol>

                            @if($order->status == \App\Order::STATUS_CREATED)
                            <a href="{{route('order.cancel', ['orderId' => $order->id])}}" class="waves-effect waves-light btn gradient-45deg-blue-grey-blue-grey box-shadow-none border-round mr-1 mb-1">لغو سفارش</a>
                            @endif
                        </div>

                        <div class="col s12 m6">

                            <ul>
                                <li class="display-flex justify-content-between">
                                    <span class="invoice-subtotal-title">قیمت کل</span>
                                    <h6 class="invoice-subtotal-value">{{number_format($order->price)}} تومان</h6>
                                </li>
                                <li class="display-flex justify-content-between" style="margin-bottom: 20px;">
                                    <span class="invoice-subtotal-title">مبلغ کسر شده از کیف پول</span>
                                    <h6 class="invoice-subtotal-value">{{number_format($walletDecrement)}} تومان</h6>
                                </li>
                                <li class="divider mt-2 mb-2"></li>
                                <li class="display-flex justify-content-between">
                                    <span class="invoice-subtotal-title">مبلغ پرداختی</span>
                                    <h6 class="invoice-subtotal-value">{{number_format($paymentPrice)}} تومان</h6>
                                </li>
                                <li class="display-flex justify-content-between">
                                    <span class="invoice-subtotal-title">وضعیت پرداخت</span>
                                    <h6 class="invoice-subtotal-value">{{$order->getStatus()}}</h6>
                                </li>

                                <div id="progress-pay" class="col s12" style="display: none;">
                                    <div class="progress">
                                        <div class="indeterminate"></div>
                                    </div>
                                </div>

                                @if($order->status == \App\Order::STATUS_CREATED && $role == 'user')
                                <form action="{{route('order.payRequest', ['orderId' => $order->id])}}" method="POST">
                                    @csrf
                                    <button style="width: 100%; margin-top: 10px;" class="waves-effect waves-light btn gradient-45deg-green-teal z-depth-4 mr-1 mb-2">پرداخت را انجام دهید</button>

{{--                                        <button id="payButton" type="submit" style="margin-right: auto;" class="btn waves-effect waves-light display-flex align-items-center justify-content-center">--}}
{{--                                            <span class="text-nowrap">پرداخت را انجام دهید</span>--}}
{{--                                        </button>--}}
                                </form>
                                @endif

                                @if($role == 'user')
                                    <div class="row">

                                    @if($order->payments->count() + $order->transactions->count() == 0)
                                        <p style="margin-top: 20px;">هنوز تراکنشی ثبت نشده است.</p>
                                    @else
                                        <p style="margin-top: 20px;">لیست تراکنش ها:</p>
                                    @endif

                                    @foreach($order->payments->all() as $payment)
                                        <div class="col s12 m12 l12 card-width">
                                            <div class="card row  @if($payment->isSuccessful())gradient-45deg-green-teal @else  gradient-45deg-blue-grey-blue-grey @endif white-text padding-4">
                                                <div class="col s5 m5">
                                                    <i class="material-icons background-round mt-5 mb-5">monetization_on</i>
                                                </div>
                                                <div class="col s7 m7 right-align">
                                                    <h5 class="mb-2 white-text">{{number_format(abs($payment->price))}} تومان</h5>
                                                    <p class="no-margin">{{$payment->getCodeMessage()}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    @foreach($order->transactions->all() as $transaction)
                                        <div class="col s12 m12 l12 card-width">
                                            <div class="card row gradient-45deg-deep-orange-orange gradient-shadow white-text padding-4">
                                                <div class="col s5 m5">
                                                    <i class="material-icons background-round mt-5 mb-5">account_balance_wallet</i>
                                                </div>
                                                <div class="col s7 m7 right-align">
                                                    <h5 class="mb-2 white-text">{{number_format(abs($transaction->price))}} تومان</h5>
                                                    @if($transaction->price > 0)
                                                        <p class="no-margin">عودت داده شد!</p>
                                                    @else
                                                        <p class="no-margin">از کیف پول کسر شد</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @else
                                    <div class="row">
                                        @if($order->checkouts->count() == 0)
                                            <p style="margin-top: 20px;">تصفیه ای وجود ندارد!</p>
                                        @else
                                            <p style="margin-top: 20px;">لیست تصفیه ها:</p>
                                        @endif

                                        @foreach($order->checkouts->all() as $checkout)
                                            <div class="col s12 m12 l12 card-width">
                                                <div class="card row  @if($checkout->isSuccessful())gradient-45deg-green-teal @else  gradient-45deg-blue-grey-blue-grey @endif white-text padding-4">
                                                    <div class="col s5 m5">
                                                        <i class="material-icons background-round mt-5 mb-5">monetization_on</i>
                                                    </div>
                                                    <div class="col s7 m7 right-align">
                                                        <h5 class="mb-2 white-text">{{number_format(abs($checkout->price))}} تومان</h5>
                                                        <p class="no-margin">{{$checkout->message}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                            </ul>
                        </div>


                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
