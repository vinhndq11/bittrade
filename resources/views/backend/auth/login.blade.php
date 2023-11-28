<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>.:Đăng Nhập:.</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <base href="{{asset('')}}">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
    <link rel="shortcut icon" href="{{ assetVersion('images/favicon.png') }}" type="image/vnd.microsoft.icon">

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
        <img style="width: 300px;" src="{{ assetVersion(setting('asset_logo', 'images/logo.png')) }}" alt="Logo">
    </div>
    <div class="login-box-body" style="border: 4px solid rgba(36, 36, 37, 0.5);">
        <p class="login-box-msg">Mời đăng nhập</p>
        <p style="color: red; font-weight: bold">Sản phẩm này thuộc team Telegram <a target="_blank" href="https://t.me/gamexlt">https://t.me/gamexlt</a> phát triển, các trường hợp liên hệ mua/bán không thông qua team chúng tôi đều có thể là lừa đảo, vui lòng cẩn thận khi giao dịch.</p>
        <form action="{{route('admin.login')}}" method="post" autocomplete="on">
            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            @include('backend.layout.partial.alert')
            <div class="form-group has-feedback">
                <input type="text" aria-label="" class="form-control" required autofocus value="{{ old('email') }}" name="email" placeholder="Email...">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" aria-label="" class="form-control" required name="password" value="" placeholder="Mật khẩu...">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" name="remember"> Ghi nhớ
                        </label>
                    </div>
                </div>
                <div class="col-xs-6">
                    <button type="submit" class="btn btn-primary btn-block btn-flat pull-right">Đăng nhập</button>
                </div>
            </div>
            <a href="{{ route('admin.forget.get') }}">Quên mật khẩu</a>
        </form>
    </div>
</div>

<script src="js/jquery.min.js"></script>
<script src="vendor/jquery-ui/jquery-ui.min.js"></script>
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
    jQuery('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%'
    });
</script>
</body>
</html>
