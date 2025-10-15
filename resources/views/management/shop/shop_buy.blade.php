@extends('management.layout.master')
@section('js')
    <script src="{{asset('app-assets/js-rtl/scripts/extra-components-sweetalert-rtl.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/sweetalert/sweetalert-rtl.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/gh/mahmoud-eskandari/NumToPersian/dist/num2persian-min.js"></script>

    <script>
        let wallet = {{$wallet}};
        document.getElementById("price-input").addEventListener('input', () => {
            document.getElementById("price-show").innerHTML = Num2persian(+document.getElementById("price-input").value) + " تومان";
        });
    </script>

    <script>
        let shopId = '{{$shopId}}';

        if (shopId != '') {
            selectShop(shopId);
        }

        function selectShop(id) {
            shopId = id;
            document.getElementById("shopId").value = id;
            showShopDetails(shopId);
            document.getElementById("select-shop-card").style.display = "none";
            document.getElementById("details-shop-card").style.display = "block";
        }


        function showShopDetails(id) {
            progress = document.getElementById('progress-shop');
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
                        document.getElementById("shop-details-content").style.display = "block";
                    }

                } catch (e) {
                    throw e;
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

        function shopList() {
            shopId = '';
            document.getElementById("select-shop-card").style.display = "block";
            document.getElementById("details-shop-card").style.display = "none";
            document.getElementById("shop-details-content").style.display = "none";
        }

    </script>
@endsection
@section('title', 'صفحه اصلی')
@section('main-content')

    <div class="card" id="select-shop-card">
        <div class="card-content">
            <h4 class="card-title">ابتدا فروشگاه را انتخاب کنید:</h4>
            <p>
                برای انجام خرید لطفا ابتدا فروشگاهی که قصد پرداخت به آن دارید را از لیست زیر انتخاب کنید.
            </p>

            <div class="row">
                @foreach($shopsList as $shop)
                    <div class="col s12 m3 shop-item" id="item-shop{{$shop->id}}" onclick="selectShop('{{$shop->id}}')">
                        <div class="card gradient-shadow gradient-45deg-light-blue-cyan border-radius-3 shop-item">
                            <div class="card-content center shop-item">
                                <h5 class="white-text lighten-4 shop-item">{{$shop->name}}</h5>
                                <p class="white-text lighten-4">{{$shop->phone}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

    <div class="row" id="details-shop-card" style="display: none;">
        <div class="row">
            <div class="col s12 m1" > </div>
            <div class="col s12 m10" >
                <div class="card" >
                    <div id="progress-shop" class="col s12" style="display: none;">
                        <div class="progress">
                            <div class="indeterminate"></div>
                        </div>
                    </div>
                    <div class="modal-content pt-2" style="padding: 0 20px;" id="shop-details-content">
                        <div class="row" id="product-one">
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
                                <a class="waves-effect waves-light btn gradient-45deg-deep-purple-blue mt-2 mr-2" target="_blank" id="shop-location" style="display: none;">موقعیت روی نقشه</a>
                                <button class="waves-effect btn-flat" onclick="shopList()" style="margin-top: 20px; margin-bottom: 20px;">بازگشت به لیست فروشگاه ها</button>
                                <h5>خرید را انجام دهید: </h5>
                                <form action="{{route('order.create')}}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="input-field col s8">
                                            <input name="price" id="price-input" class="iransans price" placeholder="مبلغ را به تومان وارد کنید!" type="number">
                                        </div>
                                        <input id="shopId" name="shop_id" style="display: none;">
                                        <div class="col s4">
                                            <p style="margin: 0;"><small><span id="price-show">قیمت</span></small></p>
                                            <button type="submit" class="waves-effect waves-light btn gradient-45deg-purple-deep-orange mt-2" id="shop-buy">پرداخت</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <style>
        .shop-item :hover {
            cursor: pointer;
        }
        ::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
            color: black;
            opacity: 1; /* Firefox */
        }
    </style>
@endsection
