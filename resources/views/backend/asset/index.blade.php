@extends('backend.layout.master')

@section('title', 'Cập nhật hình ảnh')

@section('css')
@endsection

@section('js')
@endsection

@section('content')
    <div class="box">
        {{ Form()::open(['url' => route("admin.asset.update"), 'method' => 'PUT', 'enctype'=>'multipart/form-data', 'spellcheck'=>'false', 'class' => 'form-main']) }}
        <div class="box-header with-border">
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-primary" name="save" value="{{route("admin.asset.index")}}" type="submit"><i class="fa fa-check"></i> Lưu </button>
                    <a class="btn btn-warning pull-right" href="{{route("admin.asset.index")}}"><i class="fa fa-close"></i> Hủy bỏ</a>
                </div>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Logo</h3>
                        </div>
                        <div class="panel-body">
                            @include('backend.layout.component.image', [ 'src' => setting('asset_logo'), 'name'=> 'asset_logo', 'height' => 200, 'class' => 'form-control' ])
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Ảnh nền banner giải đấu</h3>
                        </div>
                        <div class="panel-body">
                            @include('backend.layout.component.image', [ 'src' => setting('asset_challenge_banner'), 'name'=> 'asset_challenge_banner', 'height' => 200, 'class' => 'form-control' ])
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Ảnh nền banner sơ đồ các cấp</h3>
                        </div>
                        <div class="panel-body">
                            @include('backend.layout.component.image', [ 'src' => setting('asset_affiliate_network_banner'), 'name'=> 'asset_affiliate_network_banner', 'height' => 200, 'class' => 'form-control' ])
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Ảnh app trang chủ</h3>
                        </div>
                        <div class="panel-body">
                            @include('backend.layout.component.image', [ 'src' => setting('asset_home_app'), 'name'=> 'asset_home_app', 'height' => 200, 'class' => 'form-control' ])
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{ Form()::close() }}
    </div>
@endsection

