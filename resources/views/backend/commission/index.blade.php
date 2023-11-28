@extends('backend.layout.master')

@section('title', 'Cập nhật hoa hồng')

@section('css')
@endsection

@section('js')
@endsection

@section('content')
    <div class="box">
        {{ Form()::open(['url' => route("admin.commission.update"), 'method' => 'PUT', 'enctype'=>'multipart/form-data', 'spellcheck'=>'false', 'class' => 'form-main']) }}
        <div class="box-header with-border">
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-primary" name="save" value="{{route("admin.commission.index")}}" type="submit"><i class="fa fa-check"></i> Lưu </button>
                    <a class="btn btn-warning pull-right" href="{{route("admin.commission.index")}}"><i class="fa fa-close"></i> Hủy bỏ</a>
                </div>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-xs-12 col-sm-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Cấp</h3>
                        </div>
                        <div class="panel-body">
                            @include('backend.layout.component.form_group.currency', ['name' => 'max_level_commission', 'label' => 'Số cấp VIP tối đa được hưởng hoa hồng (số F)', 'default_value' => 7])
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title">Hoa hồng theo cấp</h3>
                        </div>
                        <div class="panel-body">
                           <div class="table-responsive">
                               <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Cấp</th>
                                            <th>Phần trăm mua VIP (%)</th>
                                            <th>Phần trăm vòng cược (%)</th>
                                            <th>ĐIỀU KIỆN: Số lượng F1 mua VIP</th>
                                            <th>ĐIỀU KIỆN: Khối lượng cược của F1 trong tuần</th>
                                        </tr>
                                    </thead>
                                   <tbody>
                                       @for($i = 1; $i <= setting('max_level_commission'); $i++)
                                           <tr>
                                               <td>Cấp {{$i}}</td>
                                               <td><input type="text" name="commission_vip_{{$i}}" class="form-control input-number commission_vip_{{$i}}" value="{{ setting("commission_vip_{$i}") }}"></td>
                                               <td><input type="text" name="commission_trade_{{$i}}" class="form-control input-number commission_trade_{{$i}}" value="{{ setting("commission_trade_{$i}") }}"></td>
                                               <td><input type="text" name="commission_condition_f1_{{$i}}" class="form-control input-number commission_condition_f1_{{$i}}" value="{{ setting("commission_condition_f1_{$i}") }}"></td>
                                               <td><input type="text" name="commission_condition_volume_{{$i}}" class="form-control input-number commission_condition_volume_{{$i}}" value="{{ setting("commission_condition_volume_{$i}") }}"></td>
                                           </tr>
                                       @endfor
                                   </tbody>
                               </table>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{ Form()::close() }}
    </div>
@endsection

