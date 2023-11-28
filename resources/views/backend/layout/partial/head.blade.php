<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', $title ?? '') {{".:".env('APP_NAME').":."}}</title>
    <base href="{{url('')}}/">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="vendor/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="vendor/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="vendor/morris.js/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="vendor/jvectormap/jquery-jvectormap.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="vendor/bootstrap-daterangepicker/daterangepicker.css">
    <!-- Date Time Picker -->
    <link rel="stylesheet" href="vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css">

    <link rel="stylesheet" href="vendor/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">

    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">

    <link rel="stylesheet" href="plugins/jquery-confirm/jquery-confirm.min.css">

    <link rel="shortcut icon" href="{{ assetVersion('images/favicon.png') }}" type="image/vnd.microsoft.icon">

    <!-- Switchery -->
    <link href="plugins/switchery/dist/switchery.min.css" rel="stylesheet">

    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">

    <link rel="stylesheet" href="plugins/iCheck/all.css">

    <link href="vendor/animate/animate.min.css" rel="stylesheet">

    <link rel="stylesheet" href="vendor/select2/dist/css/select2.min.css">
    <link ref="stylesheet/less" type="text/css" href="vendor/bootstrap-timepicker/css/timepicker.less">

    <link rel="stylesheet" href="{{ assetVersion('css/admin.css') }}">

    @yield('css')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <style>
        nav.pagex{
            float: right;
        }
        nav.pagex .pagination{
            margin: 0;
        }
    </style>
</head>
