<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="{{asset('')}}">
    <title>{{env('APP_NAME')}}</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="shortcut icon" href="{{ assetVersion('img/icon.png') }}" type="image/vnd.microsoft.icon">
</head>

<body>
<div class="container" style="margin-top:20px">
    <div class="text-center">
        <img src="{{ assetVersion('img/logo.png') }}" alt="" class="img-responsive" style="display: block;margin: auto; width: 150px;">
    </div>
    <div class="container" style="margin-top:20px">
        @include('backend.layout.partial.alert')
    </div>
</div>
</body>
</html>
