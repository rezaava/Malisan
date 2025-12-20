<!DOCTYPE html>

<html>

<header>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Reza avareh">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>ملیسان | @yield('title')</title>
    <!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <link rel="apple-touch-icon" href="{{ asset('files/main.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('files/main.png') }}">

    <!-- جدیددددد -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet"> -->
    
   
    <!-- css -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('all-css/app-assets/style-rtl.min.css') }}">
    <link rel="stylesheet" href="{{ asset('all-css/custom.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('all-css/materialize.min.css') }}">
    <link rel="stylesheet" href="{{ asset('all-css/app-assets/vendors.min.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('all-css/my-style.css') }}"> -->
    
    @yield('add-styles')
    <!-- Boxicons -->
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('all-css/style.min.css') }}"> -->
    
    <link rel="stylesheet" href="{{ asset('all-css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('all-css/style2.css') }}">
    <link rel="stylesheet" href="{{ asset('all-css/style3.css') }}">
    <!-- <link href="all-css/assets/fonts/Boxicons.min.css" rel="stylesheet"> -->
<link rel="stylesheet" href="{{ asset('app-assets/css-rtl/custom/style.css') }}">
    


    <!-- <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/css-rtl/themes/vertical-menu-nav-dark-template/materialize.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/css-rtl/themes/vertical-menu-nav-dark-template/style.min.css') }}"> -->
   
    <style>

        .main-master {
            padding-right: 50px;
            margin-top: 5%;
            margin-right: 15%;
        }

        footer {
            padding-right: 40%;
        }

        @media(max-width: 768px) {
            .main-master {
                margin-top: 15%;
                margin-right: 5%;
            }
        }

        @media (max-width: 480px) {
            .main-master {
                margin-top: 15%;
                margin-right: 5%;
            }
        }


        
    </style>

    
    </head>

    <body class="" data-open="click" data-menu="vertical-modern-menu" data-col="2-columns">
    <div class="global-bg"></div>

        <div class="container_fluid">

            <!-- BEGIN: Header-->
            @include('melisan.layout.partials.top-header')

            <!-- BEGIN: SideNav-->
            @include('melisan.layout.partials.aside')

            <!-- BEGIN: Page Main-->
            <div id="main" style="" class="main-master">
                @include('melisan.layout.partials.page-detial')
                <div class="container-dushbord">
                    <br>
                    @yield('main-content')
                </div>
                <br><br><br><br>
                <!-- BEGIN: footer-->
                <footer class="footer-dashbord mt-3">
                    <div class="container-dushbord ">
                        <span>
                            &copy; 2020
                            <a href="http://mana-group.ir/" style="color: black;">تیم مانا</a>
                            تمامی حقوق محفوظ است.</span>
                        <span class="right hide-on-small-only"> </span>
                    </div>
                </footer>

            </div>
    </body>

    <script src="{{ asset('app-assets/js/vendors.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/plugins.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/search.min.js') }}"></script>
    <script src="{{ asset('app-assets/js-rtl/custom/custom-script-rtl.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/ui-alerts.min.js') }}"></script>
    <!-- <script src="{{ asset('app-assets/js/axios.min.js') }}"></script> -->
    <!-- <script>
        const mobileBtn = document.getElementById('mobileMenuBtn');
        const mainMenu = document.getElementById('mainMenu');

        mobileBtn.addEventListener('click', () => {
            mainMenu.classList.toggle('show');
        });
    </script> -->
    <script>
        // اضافه کردن اینتراکشن‌های ساده
        const buttons = document.querySelectorAll('.icon-btn, .profile-btn');
        buttons.forEach(btn => {
            btn.addEventListener('click', function () {
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 150);
            });
        });

        // شبیه‌سازی کلیک روی دکمه‌ها
        buttons.forEach(btn => {
            btn.addEventListener('click', function () {
                const title = this.getAttribute('title');
                if (title) {
                    console.log(`${title} clicked!`);
                    // اینجا می‌تونی عملکرد واقعی رو اضافه کنی
                }
            });
        });
    </script>
    @yield('js')

</html>