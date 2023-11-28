<div class="row">
    <div class="col-md-3 col-xs-6">
        <select id="member_id" class="form-control select2 filter" name="member_id" aria-label="">
            <option value="">-- Thành viên --</option>
            @foreach(\App\Models\Member::all() as $item)
            <option value="{{ $item->id }}" {{ request('member_id') == $item->id ? 'selected' : '' }}>{{ $item->first_name ?? "#{$item->username}" }} ({{ $item->email }})</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3 col-xs-6">
        <select id="point_type" class="form-control select2 filter" name="point_type" aria-label="">
            <option value="">-- Loại tài khoản --</option>
            <option value="{{ POINT_TYPE_DEMO }}" {{ request('point_type') == POINT_TYPE_DEMO ? 'selected' : '' }}>Tài khoản {{ trans('frontend.point_type.' . POINT_TYPE_DEMO) }}</option>
            <option value="{{ POINT_TYPE_REAL }}" {{ request('point_type') == POINT_TYPE_REAL ? 'selected' : '' }}>Tài khoản {{ trans('frontend.point_type.' . POINT_TYPE_REAL) }}</option>
        </select>
    </div>
    <div class="col-md-3 col-xs-6">
        <select id="transaction_type" class="form-control select2 filter" name="transaction_type" aria-label="">
            <option value="">-- Loại giao dịch --</option>
            <option value="{{ TRANSACTION_TYPE_RECHARGE }}" {{ request('transaction_type') == TRANSACTION_TYPE_RECHARGE ? 'selected' : '' }}>{{ trans('frontend.transaction_type.' . TRANSACTION_TYPE_RECHARGE) }}</option>
            <option value="{{ TRANSACTION_TYPE_BET }}" {{ request('transaction_type') == TRANSACTION_TYPE_BET ? 'selected' : '' }}>{{ trans('frontend.transaction_type.' . TRANSACTION_TYPE_BET) }}</option>
            <option value="{{ TRANSACTION_TYPE_WITHDRAWAL }}" {{ request('transaction_type') == TRANSACTION_TYPE_WITHDRAWAL ? 'selected' : '' }}>{{ trans('frontend.transaction_type.' . TRANSACTION_TYPE_WITHDRAWAL) }}</option>
        </select>
    </div>
    <div class="col-md-3 col-xs-12">
        <select id="transaction_status" class="form-control select2 filter" name="transaction_status" aria-label="">
            <option value="">-- Trạng thái giao dịch --</option>
            <option value="{{ TRANSACTION_STATUS_PENDING }}" {{ request('transaction_status') == TRANSACTION_STATUS_PENDING ? 'selected' : '' }}>{{ trans('frontend.transaction_status.' . TRANSACTION_STATUS_PENDING) }}</option>
            <option value="{{ TRANSACTION_STATUS_PROCESSING }}" {{ request('transaction_status') == TRANSACTION_STATUS_PROCESSING ? 'selected' : '' }}>{{ trans('frontend.transaction_status.' . TRANSACTION_STATUS_PROCESSING) }}</option>
            <option value="{{ TRANSACTION_STATUS_FINISH }}" {{ request('transaction_status') == TRANSACTION_STATUS_FINISH ? 'selected' : '' }}>{{ trans('frontend.transaction_status.' . TRANSACTION_STATUS_FINISH) }}</option>
            <option value="{{ TRANSACTION_STATUS_CANCEL }}" {{ request('transaction_status') == TRANSACTION_STATUS_CANCEL ? 'selected' : '' }}>{{ trans('frontend.transaction_status.' . TRANSACTION_STATUS_CANCEL) }}</option>
        </select>
    </div>
</div>
