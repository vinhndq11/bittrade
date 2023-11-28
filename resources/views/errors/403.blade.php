@extends('errors::illustrated-layout')

@section('code', '403')
@section('title', __('Forbidden'))

@section('image')
    <div style="background-image: url({{ asset('/svg/403.svg') }});" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
    </div>
@endsection

@section('message', 'Rất tiếc, bạn không có quyền truy cập trang này, vui lòng liên hệ quản trị viên để được hướng dẫn.')
