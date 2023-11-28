@extends('backend.layout.master')

@section('title', 'Cập nhật cài đặt')

@section('css')
@endsection

@section('js')
@endsection

@section('content')
    <div class="box">
        {{ Form()::open(['url' => route("admin.setting.update"), 'method' => 'PUT', 'enctype'=>'multipart/form-data', 'spellcheck'=>'false', 'class' => 'form-main']) }}
        <div class="box-header with-border">
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-primary" name="save" value="{{route("admin.setting.index")}}" type="submit"><i class="fa fa-check"></i> Lưu </button>
                    <a class="btn btn-warning pull-right" href="{{route("admin.setting.index")}}"><i class="fa fa-close"></i> Hủy bỏ</a>
                </div>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-xs-12 col-sm-8">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Cấu hình tiền</h3>
                        </div>
                        <div class="panel-body">
                            @include('backend.layout.component.form_group.text', ['name' => 'profit_percent', 'label' => 'Phần trăm lợi nhuận khách nhận được khi cược thắng (%)'])
                            @include('backend.layout.component.form_group.currency', ['name' => 'demo_default_balance', 'label' => 'Số tiền mặc định của tài khoản demo ($)', 'default_value' => 50000])
                            @include('backend.layout.component.form_group.currency', ['name' => 'minimum_deposit', 'label' => 'Số tiền tối thiểu mỗi lần nạp ($)', 'default_value' => 50000])
                            @include('backend.layout.component.form_group.currency', ['name' => 'minimum_withdrawal', 'label' => 'Số tiền tối thiểu mỗi lần rút ($)', 'default_value' => 50000])
                            @include('backend.layout.component.form_group.currency', ['name' => 'minimum_bet', 'label' => 'Số tiền tối thiểu mỗi lần đặt cược ($)', 'default_value' => 20])
                            @include('backend.layout.component.form_group.currency', ['name' => 'vnd_per_usd', 'label' => 'Tỉ giá $1 = ?VNĐ', 'default_value' => 24000])
                            @include('backend.layout.component.form_group.currency', ['name' => 'usdt_per_usd', 'label' => 'Tỉ giá $1 = ?USDT', 'default_value' => 1])
                            @include('backend.layout.component.form_group.currency', ['name' => 'withdrawal_cost', 'label' => 'Phí mỗi lần rút tiền ($)', 'default_value' => 10])
                            @include('backend.layout.component.form_group.currency', ['name' => 'vip_price', 'label' => 'Số tiền mua VIP ($)', 'default_value' => 100])
                        </div>
                    </div>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Cấu hình nạp tiền</h3>
                        </div>
                        <div class="panel-body">
                            @include('backend.layout.component.form_group.textarea', ['name' => 'bank_data', 'label' => 'Cấu hình ngân hàng', 'rows' => 10])
                            @include('backend.layout.component.form_group.text', ['name' => 'usdt_address', 'label' => 'Địa chỉ ví USDT'])
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Thông tin liên hệ</h3>
                        </div>
                        <div class="panel-body">
                            @include('backend.layout.component.form_group.text', ['name' => 'phone', 'label' => 'Điện thoại liên hệ'])
                            @include('backend.layout.component.form_group.text', ['name' => 'contact_email', 'label' => 'Email liên hệ'])
                        </div>
                    </div>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Cấu hình SEO</h3>
                        </div>
                        <div class="panel-body">
                            @include('backend.layout.component.form_group.text', ['name' => 'seo_title', 'label' => 'Tiêu đề SEO'])
                            @include('backend.layout.component.form_group.text', ['name' => 'seo_keywords', 'label' => 'Từ khóa SEO'])
                            @include('backend.layout.component.form_group.textarea', ['name' => 'seo_description', 'label' => 'Mô tả SEO'])
                        </div>
                    </div>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Cấu hình tool hack</h3>
                        </div>
                        <div class="panel-body">
                            @include('backend.layout.component.form_group.text', ['name' => 'trial_count', 'label' => 'Số LẦN dùng thử mặc định khi mới đăng ký', 'default_value' => 10])
                            @include('backend.layout.component.form_group.text', ['name' => 'trial_expired_count', 'label' => 'Số NGÀY dùng thử mặc định khi mới đăng ký', 'default_value' => 10])
                            @include('backend.layout.component.form_group.text', ['name' => 'single_member_win_percent', 'label' => 'Tỉ lệ phần trăm chiến thắng của 1 người chơi đơn độc', 'default_value' => 45])
                        </div>
                    </div>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Cấu hình khác</h3>
                        </div>
                        <div class="panel-body">
                            @include('backend.layout.component.form_group.text', ['name' => 'socket_link', 'label' => 'Link socket'])
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{ Form()::close() }}
    </div>
@endsection

