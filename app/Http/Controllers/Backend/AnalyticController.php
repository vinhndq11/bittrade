<?php

namespace App\Http\Controllers\Backend;

use App\Models\MemberTransaction;
use Illuminate\Support\Facades\Redis;

class AnalyticController extends BaseController
{
    public function index()
    {
        return view('backend.analytic.index');
    }

    public function getAnalyticData(): array
    {
        $bet_id = Redis::get('bet_id');
        $override_result = Redis::get('override_result');
        $bet_guess = Redis::get('bet_guess');
        $bet_guess = $bet_guess == 'up' ? 'Tăng' : ($bet_guess == 'down' ? 'Giảm' : '...');
        $transactions = MemberTransaction::query()
            ->where('bet_id', $bet_id)
            ->where('transaction_type', TRANSACTION_TYPE_BET)
            ->whereIn('transaction_status', [TRANSACTION_STATUS_PENDING, TRANSACTION_STATUS_FINISH, TRANSACTION_STATUS_PROCESSING])
            ->where('point_type', POINT_TYPE_REAL);

        $money_total = (clone $transactions)->sum('bet_value');
        $money_count = (clone $transactions)->count();
        $money_up_total = number_format((clone $transactions)->where('bet_condition',  BET_CONDITION_UP)->sum('bet_value') ?? 0);
        $money_up_count = (clone $transactions)->where('bet_condition',  BET_CONDITION_UP)->count();
        $money_down_total = number_format((clone $transactions)->where('bet_condition',  BET_CONDITION_DOWN)->sum('bet_value') ?? 0);
        $money_down_count = (clone $transactions)->where('bet_condition',  BET_CONDITION_DOWN)->count();

        $member_transactions = (clone $transactions)->groupBy(['member_id', 'bet_condition'])
            ->leftJoin('members', 'member_transactions.member_id', '=', 'members.id')
            ->selectRaw('wf_member_transactions.id, count(code) as count, sum(bet_value) as sum, bet_condition, wf_members.username, wf_members.email')
            ->get();

        return responseJSON(compact(
            'money_total',
            'money_count',
            'money_up_total',
            'money_up_count',
            'money_down_total',
            'money_down_count',
            'member_transactions',
            'bet_guess',
            'override_result'
        ));
    }

    public function getUpdateBetResult(): array
    {
        $override_result = request('override_result');
        Redis::set('override_result', $override_result);
        return responseJSON_EMPTY_OBJECT(true, 'Ghi đè kết quả thành công!');
    }
}
