@extends('management.layout.master')
@section('js')
    <script src="{{asset('app-assets/js/scripts/advance-ui-modals.min.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/eCommerce-products-page.min.js')}}"></script>
    <script src="{{asset('app-assets/js-rtl/scripts/extra-components-sweetalert-rtl.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/sweetalert/sweetalert-rtl.min.js')}}"></script>

    <script>

        function showShopDetails(id) {
            progress = document.getElementById('progress-shop' + id);
            progress.style.display = "block";

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
                swal({
                    title: "مشکلی پیش آمد!",
                    text: "اینترنت خود را بررسی و مجدد امتحان کنید.",
                    timer: 2e3,
                    buttons: !1
                })
            };

            xhr.send();
        }

    </script>
@endsection
@section('title', 'لیست فروشگاه ها')
@section('main-content')

    <a id="modal-trigger" class="modal-trigger" href="#modal1" disabled="none"></a>

    <div class="row">
        @foreach($shopsList as $shop)
        <div class="col s12 m3">
            <div class="card animate fadeLeft">
                <div class="card-content  center">
                    <h6 class="card-title font-weight-400 mb-0">{{$shop->name}}</h6>
                    <img src="{{asset('/files/shops/'.$shop->image)}}" alt="" class="responsive-img">
                    <p>{{mb_substr($shop->description, 0, 150, 'utf-8')}} ...</p>
                </div>
                <div class="card-action border-non center">
                    <button onclick="showShopDetails('{{$shop->id}}')" class="waves-effect waves-light btn gradient-45deg-light-blue-cyan box-shadow">اطلاعات بیشتر</button>
                    <a href="{{route('shop.buy' , ['shopId' => $shop->id])}}" class="waves-effect waves-light btn gradient-45deg-light-blue-cyan box-shadow">خرید</a>
                    <div class="indeterminate"></div>
                    <div id="progress-shop{{$shop->id}}" class="col s12" style="display: none;">
                        <div class="progress">
                            <div class="indeterminate"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

    </div>

    <div id="modal1" class="modal">
        <div class="modal-content pt-2">
            <div class="row" id="product-one">
                <div class="col s12">
                    <a class="modal-close right"><i class="material-icons">close</i></a>
                </div>
                <div class="col m6 s12">
                    <img id="shop-image" src="" class="responsive-img" alt="">
                </div>
                <div class="col m6 s12">
                    <p>فروشگاه</p>
                    <h5><span id="shop-name"></span></h5>
                    <p><span id="shop-description"></span></p>
                    <hr class="mb-5">
                    <ul class="list-bullet">
                        <li class="list-item-bullet">شماره تلفن: <span id="shop-phone"></span></li>
                        <li class="list-item-bullet">آدرس: <span id="shop-address"></span></li>
                    </ul>
                    <h5>می خواهید خرید کنید؟!</h5>
                    <a class="waves-effect waves-light btn gradient-45deg-deep-purple-blue mt-2 mr-2" target="_blank" id="shop-location" style="display: none;">موقعیت روی نقشه</a>
                    <a class="waves-effect waves-light btn gradient-45deg-purple-deep-orange mt-2" id="shop-buy">خرید حضوری</a>
                </div>
            </div>
        </div>
    </div>

@endsection
