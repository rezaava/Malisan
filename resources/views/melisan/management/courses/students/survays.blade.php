<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نظرسنجی</title>
    <style>   
     <link rel="apple-touch-icon" href="{{ asset('app-assets/images/favicon/apple-touch-icon-152x152.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('app-assets/images/favicon/favicon-32x32.png') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/css-rtl/themes/vertical-modern-menu-template/materialize.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/css-rtl/themes/vertical-modern-menu-template/style.min.css') }}">

    <link rel="stylesheet" href="{{ asset('app-assets/css-rtl/custom/style.css') }}">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/sweetalert/sweetalert.css">
    {{-- here For Add Specify Page Styles --}}

    <link rel="stylesheet" href="{{ asset('all-css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('all-css/my-style.css') }}">
    ّ</style>
</head>
<body>

    <div class="col s12">
        <div id="html-validations" class="card card-tabs">
            <div class="card-content">
                <div class="card-title">
                    <div class="row">
                        <div class="col-md-12 m6 l10">
                            <h4 class="card-title">{!! $random->text !!}</h4>
                        </div>
                     
                    </div>
                </div>

                <form method="post" action="{{ route('survey.answer') }}">
                    @csrf
                    <input name="user_id" value="{{ $user->id }}" hidden>
                    <input name="random_id" value="{{ $random->id }}" hidden>
                    <input name="type" value="{{ $random->type }}" hidden>
                    <div class="row">
                        <div class="col s12">
                            @if ($random->type == 1)
                                @include('melisan.layoutStudent.survay-textarea')
                            @else
                                @include('melisan.layoutStudent.survay-radio')
                            @endif

                            <div class="input-field">
                            </div>
                        </div>
                        <div class="input-field col s12">
                            <button class="btn waves-effect waves-light right iransans" type="submit" name="action">ارسال
                                <i class="material-icons right custom-send-material-icon">send</i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>