<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Khôi phục mật khẩu</title>
</head>
<body style="text-align: center; position: relative;background-color: #f5f8fa;">
<div style="margin: 50px auto;width: 80%; position: absolute;left: 0;right: 0;font-family: sans-serif;border-radius: 4px;background: #fff;border: 1px solid #e1e8ed;padding: 10px;">
    <div style="text-align: center; margin-bottom: 20px">
        <a href="{{ url('/') }}" style="text-decoration:none"
           target="_blank"><img alt="" src="{{ assetVersion(setting('asset_logo', 'images/logo.png')) }}"
                                style="max-width: 150px;">
        </a>
    </div>
    <div style="text-align: justify;margin-bottom: 22px;border: 1px solid beige;padding: 5px;border-radius: 5px;">
        <p>&nbsp;&nbsp;&nbsp;Chào <b style="font-size: 1.1em">{{ $input['name'] }}</b>, gần đây chúng tôi nhận được yêu cầu đặt lại mật khẩu
        của bạn từ tài khoản: <span style="color:blue">{{ $input['email'] ?? ''}}</span>,
            nếu đúng là bạn thì vui lòng click vào liên kết sau để đặt lại mật khẩu mới cho tài khoản <i>(liên kết này chỉ có hiệu lực trong vòng <span style="color:#cc783b;">30 phút</span> và chỉ sử dụng được 1 lần duy nhất)</i></p>
        <div style="text-align: center">
            <p style="margin: 2px auto 2px auto;padding: 10px 25px;display: inline-block;background-color: #007b70;border-radius: 18px; text-align: center" >
                <a target="_blank" style="color: white;font-weight: bold;text-decoration:none " href="{{ $input['link'] }}">Đặt Lại Mật Khẩu</a>
            </p>
        </div>
        <p>hoặc bỏ qua email này nếu đó không phải là bạn...</p>
    </div>
    <span> <a href="{{ url('/') }}" style="text-decoration:none;font-family: 'Helvetica Neue Light',Helvetica,Arial,sans-serif;color:#8899a6;font-size:12px;font-weight:normal;">Copyright © {{ env('APP_NAME_SUMMARY') }}. {{ date('Y') }} • All rights reserved.</a> </span>
</div>

</body>
</html>
