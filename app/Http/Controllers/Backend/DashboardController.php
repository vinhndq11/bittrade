<?php

namespace App\Http\Controllers\Backend;

use App\Models\Hacker;
use App\Models\Log;
use App\Models\Member;
use App\Models\MemberTransaction;

class DashboardController extends BaseController
{
    public function index()
    {
        $logs = Log::query()->latest()->limit(10)->get();
        $members = Member::query()->latest()->limit(10)->get();
        $hackers = Hacker::query()->latest()->limit(10)->get();

        $member_count = Member::count();
        $hacker_count = Hacker::count();
        $transaction_withdrawal_amount = MemberTransaction::query()->where('transaction_type', TRANSACTION_TYPE_WITHDRAWAL)
            ->where('point_type', POINT_TYPE_REAL)
            ->where('transaction_status', TRANSACTION_STATUS_FINISH)
            ->sum('value');
        $transaction_withdrawal_count = MemberTransaction::query()->where('transaction_type', TRANSACTION_TYPE_WITHDRAWAL)
            ->where('point_type', POINT_TYPE_REAL)
            ->where('transaction_status', TRANSACTION_STATUS_PENDING)
            ->count();
        $transaction_recharge_amount = MemberTransaction::query()->where('transaction_type', TRANSACTION_TYPE_RECHARGE)
            ->where('point_type', POINT_TYPE_REAL)
            ->where('transaction_status', TRANSACTION_STATUS_FINISH)
            ->sum('value');
        $transaction_recharge_count = MemberTransaction::query()->where('transaction_type', TRANSACTION_TYPE_RECHARGE)
            ->where('point_type', POINT_TYPE_REAL)
            ->where('transaction_status', TRANSACTION_STATUS_PENDING)
            ->count();
        return view('backend.dashboard.index', compact('logs',
            'members',
            'member_count',
            'hacker_count',
            'transaction_recharge_count', 'transaction_recharge_amount',
            'transaction_withdrawal_count', 'transaction_withdrawal_amount',
            'hackers'
        ));
    }
}
