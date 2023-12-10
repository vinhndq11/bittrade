<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head></head>
<body style="text-align: center; position: relative;background-color: #f5f8fa;">
<div style="width: 80%; position: absolute;margin: auto; left: 0;right: 0;font-family: sans-serif;border-radius: 4px;background: #fff;border: 1px solid #e1e8ed;padding: 10px;">
    <div style="text-align: center; margin-bottom: 20px">
        <a href="/" style="text-decoration:none"
           target="_blank"><img alt="logo" src="{{ assetVersion('images/logo.png') }}"
                                style="width: 150px;">
        </a>
    </div>
    <div style="text-align: justify;margin-bottom: 22px;border: 1px solid beige;padding: 5px;border-radius: 5px;">
        <p>&nbsp;&nbsp;&nbsp; Mã xác nhận email của bạn là: <span style="color:blue;font-size: 1.1em">{{$otp ?? 'xxxx'}}</span> (mã này chỉ được sử dụng 1 lần duy nhất)</p>
    </div>
    <span> <a href="/" style="text-decoration:none;font-family: 'Helvetica Neue Light',Helvetica,Arial,sans-serif;color:#8899a6;font-size:12px;font-weight:normal;">Copyright © {{ env('APP_NAME') }}. 2017 • All rights reserved.</a> </span>
</div>

</body>
</html>
