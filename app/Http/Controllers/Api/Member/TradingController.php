<?php

namespace App\Http\Controllers\Api\Member;

use App\Models\MemberTransaction;
use Illuminate\Support\Facades\Redis;

class TradingController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getTradingData()
    {
        return file_get_contents(storage_path('app/public/trade_data.json'));
    }

    public function postBet()
    {
        $isBet = Redis::get('is_bet') == 'true';
        $bet_id = Redis::get('bet_id');
        if(empty($bet_id) || !$isBet){
            return responseJSON_EMPTY_OBJECT(false,'Vui lòng chờ cho đến khi phiên đặt cược mới bắt đầu!');
        }
        $bet_value = request('bet_value', 0);
        $minimum_bet = setting('minimum_bet', 0);
        if($bet_value < $minimum_bet){
            return responseJSON_EMPTY_OBJECT(false,"Số tiền cược tối thiểu là $$minimum_bet");
        }

        if($bet_value > $this->user->{"{$this->user->current_point_type}_balance"}){
            return responseJSON_EMPTY_OBJECT(false,'Giá trị đặt cược không được lớn hơn số tiền đang có!');
        }

        $bet_condition = request('bet_condition');

        $member_transaction = $this->user
            ->member_transactions()
            ->create([
                'point_type' => $this->user->current_point_type,
                'transaction_type' => TRANSACTION_TYPE_BET,
                'transaction_status' => TRANSACTION_STATUS_PENDING,
                'bet_condition' => $bet_condition,
                'bet_value' => $bet_value,
                'bet_id' => $bet_id,
                'value' => -$bet_value
            ]);

        if($this->user->current_point_type == POINT_TYPE_REAL){
            $bet_count = intval(Redis::get('bet_count')) ?? 0;
            $condition_value = doubleval(Redis::get("condition_{$bet_condition}")) ?? 0;
            Redis::set('bet_count', $bet_count + 1);
            Redis::set("condition_{$bet_condition}", $condition_value + $bet_value);

            (new \App\Services\MemberCommission(COMMISSION_TYPE_TRADE))->applyCommission($member_transaction);
        }

        return responseJSON_EMPTY_OBJECT(true, 'Đặt cược thành công!');
    }

    public function getBetResult()
    {
        $bet_id = request('bet_id');
        $memberTransactionValue = MemberTransaction::query()->where('member_id', $this->user->id)
            ->where('bet_id', $bet_id)
            ->where('transaction_type', TRANSACTION_TYPE_BET)
            ->where('transaction_status', TRANSACTION_STATUS_FINISH)
            ->sum('value');
        if(!$memberTransactionValue){
            return responseJSON_EMPTY_OBJECT(false, 'Không tìm thấy giao dịch này');
        }
        $memberTransactionValue = floor($memberTransactionValue);
        $money = number_format($memberTransactionValue);
        return responseJSON([
            'is_win' => $memberTransactionValue > 0,
            'value' => $memberTransactionValue,
        ], true, $memberTransactionValue > 0 ? "Bạn thắng $$money" : "Bạn thua $$money");
    }

}
