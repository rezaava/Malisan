<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content2="IE=edge">
    <meta name="viewport" content2="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        @import url("https://fonts.googleapis.com/css?family=Montserrat:400,400i,700");
        body {
            font-family: Montserrat, sans-serif;
            margin-top: 50px;
        }

        .container {
            display: flex;
        }
        .container .card {
            flex: 1;
            text-align: center;
        }
        .container .card .title {
            text-transform: uppercase;
            font-size: 25px;
            font-weight: bold;
            padding: 15px;
            width: 80%;
            max-width: 170px;
            margin: auto;
            box-sizing: border-box;
            background-color: #000000;
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
            color: #ffffff;
            position: relative;
            z-index: 1;
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.25);
        }
        .container .card .title span {
            display: block;
            font-size: 50px;
            font-weight: normal;
        }
        .container .card .title:before, .container .card .title:after {
            content: "";
            width: 0px;
            height: 0px;
            position: absolute;
            border: 12px solid transparent;
            border-top-color: #000000;
            top: 5px;
        }
        .container .card .title:before {
            transform: rotate(-45deg);
            left: -12px;
        }
        .container .card .title:after {
            transform: rotate(45deg);
            right: -12px;
        }
        .container .card .content {
            margin-top: -105px;
            padding: 125px 20px 50px 20px;
            box-shadow: inset 0px 15px 10px -12px rgba(0, 0, 0, 0.5);
        }
        .container .card .icon {
            font-size: 50px;
        }
        .container .card:nth-child(1) .title {
            background-color: #EF2F78;
        }
        .container .card:nth-child(1) .title:before, .container .card:nth-child(1) .title:after {
            border-top-color: #c60f54;
        }
        .container .card:nth-child(1) .icon {
            color: #EF2F78;
        }
        .container .card:nth-child(2) .title {
            background-color: #03A1A4;
        }
        .container .card:nth-child(2) .title:before, .container .card:nth-child(2) .title:after {
            border-top-color: #056264;
        }
        .container .card:nth-child(2) .icon {
            color: #03A1A4;
        }
        .container .card:nth-child(3) .title {
            background-color: #EF9523;
        }
        .container .card:nth-child(3) .title:before, .container .card:nth-child(3) .title:after {
            border-top-color: #b16b12;
        }
        .container .card:nth-child(3) .icon {
            color: #EF9523;
        }
        .container .card:nth-child(4) .title {
            background-color: #1C7BBB;
        }
        .container .card:nth-child(4) .title:before, .container .card:nth-child(4) .title:after {
            border-top-color: #105888;
        }
        .container .card:nth-child(4) .icon {
            color: #1C7BBB;
        }
        .container .card:nth-child(5) .title {
            background-color: #616161;
        }
        .container .card:nth-child(5) .title:before, .container .card:nth-child(5) .title:after {
            border-top-color: #232323;
        }
        .container .card:nth-child(5) .icon {
            color: #616161;
        }
        @media (max-width: 767px) {
            .container {
                flex-wrap: wrap;
            }
            .container .card {
                flex: 0 0 100%;
            }
        }
    </style>
</head>
<body>


<div class="container">
    <div class="card">
        <div class="title">
            BOX<span>1</span>
        </div>
        <div class="content">
            <h3>{{$box1}}</h3>

        </div>
    </div>

    <div class="card">
        <div class="title">
            Box<span>2</span>
        </div>
        <div class="content">
            <h3>{{$box2}}</h3>

        </div>
    </div>

    <div class="card">
        <div class="title">
            Box<span>3</span>
        </div>
        <div class="content">
            <h3>{{$box3}}</h3>

        </div>
    </div>

    <div class="card">
        <div class="title">
            Box<span>4</span>
        </div>
        <div class="content">
            <h3>{{$box4}}</h3>

        </div>
    </div>

    <div class="card">
        <div class="title">
            Box<span>5</span>
        </div>
        <div class="content">
            <h3><a href="/dashboard/konkor/box5?id={{ $id }}" target="_top">{{$box5}}<br><span>(مرور)</span></a></h3>
        </div>
    </div>
</div>


</body>
</html>
