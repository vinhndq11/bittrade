@extends('backend.layout.master')

@section('title', 'Tổng quan')

@section('css')
@stop

@section('js')
@stop

@section('content')
    <div class="row">
        <div class="col-lg-2 col-xs-4">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{ !empty($transaction_withdrawal_amount) ? number_format($transaction_withdrawal_amount * -1) : 0 }}</h3>
                    <p>Tổng tiền đã rút</p>
                </div>
                <a href="{{ route('admin.member_transaction.index', ['point_type' => POINT_TYPE_REAL, 'transaction_status' => TRANSACTION_STATUS_FINISH, 'transaction_type' => TRANSACTION_TYPE_WITHDRAWAL]) }}" class="small-box-footer">Xem thêm <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-2 col-xs-4">
            <div class="small-box bg-blue">
                <div class="inner">
                    <h3 class="withdrawal_count">{{ $transaction_withdrawal_count ?? 0 }}</h3>
                    <p>Yêu cầu rút đang chờ</p>
                </div>
                <a href="{{ route('admin.member_transaction.index', ['point_type' => POINT_TYPE_REAL, 'transaction_status' => TRANSACTION_STATUS_PENDING, 'transaction_type' => TRANSACTION_TYPE_WITHDRAWAL]) }}" class="small-box-footer">Xem thêm <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-2 col-xs-4">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{ !empty($transaction_recharge_amount) ? number_format($transaction_recharge_amount) : 0 }}</h3>
                    <p>Tổng tiền đã nạp</p>
                </div>
                <a href="{{ route('admin.member_transaction.index', ['point_type' => POINT_TYPE_REAL, 'transaction_status' => TRANSACTION_STATUS_FINISH, 'transaction_type' => TRANSACTION_TYPE_RECHARGE]) }}" class="small-box-footer">Xem thêm <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-2 col-xs-4">
            <div class="small-box bg-red">
                <div class="inner">
                    <h3 class="recharge_count">{{ $transaction_recharge_count ?? 0 }}</h3>
                    <p>Yêu cầu nạp đang chờ</p>
                </div>
                <a href="{{ route('admin.member_transaction.index', ['point_type' => POINT_TYPE_REAL, 'transaction_status' => TRANSACTION_STATUS_PENDING, 'transaction_type' => TRANSACTION_TYPE_RECHARGE]) }}" class="small-box-footer">Xem thêm <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-2 col-xs-4">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{ $member_count ?? 0 }}</h3>
                    <p>Tổng thành viên</p>
                </div>
                <a href="{{ route('admin.member.index') }}" class="small-box-footer">Xem thêm <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-2 col-xs-4">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{ $hacker_count ?? 0 }}</h3>
                    <p>Tổng khách (hack)</p>
                </div>
                <a href="{{ route('admin.hacker.index') }}" class="small-box-footer">Xem thêm <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
    <div class="row">
        <section class="col-xs-12 connectedSortable">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Nhật ký log mới nhất</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin  table-hover table-striped">
                            <thead>
                            <tr>
                                <th>Người dùng</th>
                                <th>Hành động</th>
                                <th>Đối tượng</th>
                                <th>Thời gian</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($logs as $item)
                                <tr>
                                    <td>
                                        <a href='{{ route('admin.user.edit', $item->user_id) }}'>{{ $item->user->name }}</a>
                                    </td>
                                    <td>{{ $item->method_label }}</td>
                                    <td>{{ $item->model_label }}</td>
                                    <td>{{ Date2String($item->created_at, 'H:i:s d/m/Y') }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box-footer clearfix">
                    <a href="{{ route('admin.log.index') }}" class="btn btn-sm btn-default btn-flat pull-right">Xem tất cả</a>
                </div>
            </div>
        </section>
        <section class="col-lg-6 col-xs-12 connectedSortable">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Thành viên mới</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin table-hover  table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Họ tên</th>
                                <th>Email</th>
                                <th>Tạo lúc</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($members as $item)
                                <tr>
                                    <td>
                                        <a href=''>{{ $item->id }}</a>
                                    </td>
                                    <td>{{ $item->full_name ?? '#' .$item->username }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ Date2String($item->created_at, 'H:i:s d/m/Y') }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box-footer clearfix">
                    <a href="{{ route('admin.member.index') }}" class="btn btn-sm btn-default btn-flat pull-right">Xem tất cả</a>
                </div>
            </div>
        </section>
        <section class="col-lg-6 col-xs-12 connectedSortable">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Khách hàng mới (tool hack)</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin table-hover  table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Họ tên</th>
                                <th>Email</th>
                                <th>Tạo lúc</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($hackers as $item)
                                <tr>
                                    <td>
                                        <a href=''>{{ $item->id }}</a>
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ Date2String($item->created_at, 'H:i:s d/m/Y') }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box-footer clearfix">
                    <a href="{{ route('admin.hacker.index') }}" class="btn btn-sm btn-default btn-flat pull-right">Xem tất cả</a>
                </div>
            </div>
        </section>
    </div>
@endsection
