<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
@include('frontend.layout.partial.head')
</head>
<body class="{{ isset($bodyClass) ? $bodyClass : '' }}">

@include('frontend.layout.partial.header')

@hasSection('content')
    @yield('content')
@else
    Error show content...
@endif

@include('frontend.layout.partial.footer')
@include('frontend.layout.partial.js')
@stack('js')
<script src="{{ assetVersion('js/style.js') }}"></script>
@if(env('APP_ENV')==='production')
    <script src="{{ assetVersion('js/marker.min.js') }}"></script>
@endif
</body>
</html>
