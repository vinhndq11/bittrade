<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>.:Đặt lại mật khẩu:.</title>
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
        .error {
            color: red;
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
        <p class="login-box-msg">Đặt lại mật khẩu</p>
        <form action="{{route('admin.change.post')}}" id="form" autocomplete="off" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{$token ?? null}}">
            <div class="form-group has-feedback">
                <input aria-label="" type="password" class="form-control" autofocus name="new_password" required min="6" id="new_password" placeholder="Mật khẩu mới">
                <span id="new_password_error" class="error" for="password"></span>
            </div>
            <div class="form-group has-feedback">
                <input aria-label="" type="password" placeholder="Nhập lại mật khẩu mới" class="form-control" id="re_new_password" required name="re_new_password">
                <span id="re_new_password_error" class="error" for="password"></span>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat pull-right">Đặt lại mật khẩu</button>
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
<script type="text/javascript">
	$(document).ready(function() {
		$('#form').submit(function (e) {
			const new_password = $('#new_password').val();
			const re_new_password = $('#re_new_password').val();

			const $newPasswordError = $('#new_password_error').html('');
			const $reNewPasswordError = $('#re_new_password_error').html('');
			if(new_password.length < 6){
				$newPasswordError.html('Mật khẩu phải chứa ít nhất 6 kí tự');
				e.preventDefault();
			}
			if(new_password && re_new_password && new_password !== re_new_password){
				$reNewPasswordError.html('Mật khẩu nhập lại không khớp với mật khẩu mới');
				e.preventDefault();
			}
		});
	});
</script>
@if(env('APP_ENV')==='production')
    <script src="js/marker.min.js"></script>
@endif
</body>
</html>
