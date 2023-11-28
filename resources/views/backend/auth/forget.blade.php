<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>.:Quên Mật Khẩu:.</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <base href="{{asset('')}}">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
    <link rel="shortcut icon" href="{{ assetVersion('img/icon.png') }}" type="image/vnd.microsoft.icon">
    <style type="text/css">
        body{
            background: url("{{asset('img/background_login.jpg')}}") !important;
            background-repeat: no-repeat;
            background-size: cover !important;
        }
    </style>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition login-page" style="overflow: hidden">
<div class="login-box">
    <div class="login-logo">
        <img style="width: 150px;" src="{{ assetVersion('img/logo.png') }}" alt="Logo">
    </div>
    <div class="login-box-body" style="border: 4px solid rgba(36, 36, 37, 0.5);">
        <p class="login-box-msg">Quên mật khẩu</p>
        <form action="{{route('admin.forget.post')}}" method="post" autocomplete="on">
            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            @include('backend.layout.partial.alert')
            <div class="form-group has-feedback">
                <input type="text" aria-label="" class="form-control" required autofocus value="{{ old('email') }}" name="email" placeholder="Email...">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Gửi</button>
                </div>
            </div>
            <div style="margin-top: 10px" class="row">
                <div class="col-xs-12">
                    <a href="{{ route('admin.login') }}">Đăng nhập</a>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="js/jquery.min.js"></script>
</body>
</html>
