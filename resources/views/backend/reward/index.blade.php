@extends('backend.layout.master')

@section('title', 'Cập nhật phần thưởng')

@section('css')
@endsection

@section('js')
@endsection

@section('content')
    <div class="box">
        {{ Form()::open(['url' => route("admin.reward.update"), 'method' => 'PUT', 'enctype'=>'multipart/form-data', 'spellcheck'=>'false', 'class' => 'form-main']) }}
        <div class="box-header with-border">
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-primary" name="save" value="{{route("admin.reward.index")}}" type="submit"><i class="fa fa-check"></i> Lưu </button>
                    <a class="btn btn-warning pull-right" href="{{route("admin.reward.index")}}"><i class="fa fa-close"></i> Hủy bỏ</a>
                </div>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Mô tả giao dịch tháng</h3>
                        </div>
                        <div class="panel-body">
                            <textarea name="rank_description_trading_month" class="form-control" rows="6">{{ setting('rank_description_trading_month') }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Mô tả VIP tháng</h3>
                        </div>
                        <div class="panel-body">
                            <textarea name="rank_description_agency_month" class="form-control" rows="6">{{ setting('rank_description_agency_month') }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Mô tả giao dịch tuần</h3>
                        </div>
                        <div class="panel-body">
                            <textarea name="rank_description_trading_week" class="form-control" rows="6">{{ setting('rank_description_trading_week') }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Mô tả VIP tuần</h3>
                        </div>
                        <div class="panel-body">
                            <textarea name="rank_description_agency_week" class="form-control" rows="6">{{ setting('rank_description_agency_week') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title">Phần thưởng theo thứ hạng</h3>
                        </div>
                        <div class="panel-body">
                           <div class="table-responsive">
                               <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Thứ hạng</th>
                                            <th>Giải giao dịch tháng ($)</th>
                                            <th>Giải VIP tháng ($)</th>
                                            <th>Giải giao dịch tuần ($)</th>
                                            <th>Giải VIP tuần ($)</th>
                                        </tr>
                                    </thead>
                                   <tbody>
                                       @for($i = 1; $i < 51; $i++)
                                           <tr>
                                               <td>Hạng {{$i}}</td>
                                               <td><input type="number" name="rank_trading_month_{{$i}}" class="form-control currency rank_trading_month_{{$i}}" value="{{ setting("rank_trading_month_{$i}") }}"></td>
                                               <td><input type="number" name="rank_agency_month_{{$i}}" class="form-control currency rank_agency_month_{{$i}}" value="{{ setting("rank_agency_month_{$i}") }}"></td>
                                               <td><input type="number" name="rank_trading_week_{{$i}}" class="form-control currency rank_trading_week_{{$i}}" value="{{ setting("rank_trading_week_{$i}") }}"></td>
                                               <td><input type="number" name="rank_agency_week_{{$i}}" class="form-control currency rank_agency_week_{{$i}}" value="{{ setting("rank_agency_week_{$i}") }}"></td>
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

