<?php

namespace App\Http\Controllers\Api\Member;

use App\Models\MemberTransaction;
use Carbon\Carbon;

class ChallengeController extends BaseController
{
    public function getChallengeLive()
    {
        return responseJSON([
            [
                'type' => CHALLENGE_TYPE_TRADING,
                'schedule' => CHALLENGE_SCHEDULE_MONTH,
                'start' => getPreciseTimestamp(today()->startOfMonth()),
                'end' => getPreciseTimestamp(today()->endOfMonth()),
                'value' => today()->month,
                'total_reward' => 80000,
                'status' => 'live',
            ],
            [
                'type' => CHALLENGE_TYPE_AGENCY,
                'schedule' => CHALLENGE_SCHEDULE_MONTH,
                'start' => getPreciseTimestamp(today()->startOfMonth()),
                'end' => getPreciseTimestamp(today()->endOfMonth()),
                'value' => today()->month,
                'total_reward' => 40000,
                'status' => 'live',
            ],
            [
                'type' => CHALLENGE_TYPE_TRADING,
                'schedule' => CHALLENGE_SCHEDULE_WEEK,
                'start' => getPreciseTimestamp(today()->startOfWeek()),
                'end' => getPreciseTimestamp(today()->endOfWeek()),
                'value' => today()->weekOfYear,
                'total_reward' => 23000,
                'status' => 'live',
            ],
            [
                'type' => CHALLENGE_TYPE_AGENCY,
                'schedule' => CHALLENGE_SCHEDULE_WEEK,
                'start' => getPreciseTimestamp(today()->startOfWeek()),
                'end' => getPreciseTimestamp(today()->endOfWeek()),
                'value' => today()->weekOfYear,
                'total_reward' => 11500,
                'status' => 'live',
            ],
        ]);
    }

    public function getChallengeInfo()
    {
        $schedule = request('schedule');
        $type = request('type');
        $rewards = [];
        for ($i = 1; $i < 51; $i++){
            if(setting("rank_{$type}_{$schedule}_{$i}") > 0){
                $rewards[] = [
                    'rank' => $i,
                    'reward' => setting("rank_{$type}_{$schedule}_{$i}")
                ];
            }
        }
        return responseJSON([
            'rewards' => $rewards,
            'description' => setting("rank_description_{$type}_{$schedule}")
        ]);
    }

    public function getChallengeEnd()
    {
        $result = [];
        foreach ([CHALLENGE_TYPE_TRADING, CHALLENGE_TYPE_AGENCY] as $type){
            $transactionsLastMonth = MemberTransaction::challenge(now()->subMonth(1)->startOfMonth(), now()->subMonth(1)->endOfMonth(), $type, 3)
                ->get()
                ->map(function ($transaction, $index) use ($type){
                    $rank = $index + 1;
                    return [
                        'rank' => $rank,
                        'username' => mb_convert_encoding(hideUsername($transaction->member->username), 'UTF-8', 'UTF-8'),
                        'value' => hideMoney($transaction->sum),
                        'reward' => setting("rank_{$type}_month_{$rank}")
                    ];
                });
            if(count($transactionsLastMonth) > 0){
                $result[] = [
                    'type' => $type,
                    'schedule' => CHALLENGE_SCHEDULE_MONTH,
                    'start' => getPreciseTimestamp(now()->subMonth(1)->startOfMonth()),
                    'end' => getPreciseTimestamp(now()->subMonth(1)->endOfMonth()),
                    'value' => now()->subMonth(1)->month,
                    'total_reward' => $type == CHALLENGE_TYPE_TRADING ? 80000 : 40000,
                    'status' => 'end',
                    'members' => $transactionsLastMonth
                ];
            }
        }

        $now = now();
        $days = [];
        for ($i = 1; $i <= 3; $i++){
            $days[] = $now->copy()->subWeek($i);
        }
        foreach ([CHALLENGE_TYPE_TRADING, CHALLENGE_TYPE_AGENCY] as $type){
            foreach ($days as $day){
                $transactionsLastWeek = MemberTransaction::challenge($day->copy()->startOfWeek(), $day->copy()->endOfWeek(), $type, 3)
                    ->get()
                    ->map(function ($transaction, $index) use ($type){
                        $rank = $index + 1;
                        return [
                            'rank' => $rank,
                            'username' => mb_convert_encoding(hideUsername($transaction->member->username), 'UTF-8', 'UTF-8'),
                            'value' => hideMoney($transaction->sum),
                            'reward' => setting("rank_{$type}_month_{$rank}")
                        ];
                    });
                if(count($transactionsLastWeek) > 0){
                    $result[] = [
                        'type' => $type,
                        'schedule' => CHALLENGE_SCHEDULE_WEEK,
                        'start' => getPreciseTimestamp($day->copy()->startOfWeek()),
                        'end' => getPreciseTimestamp($day->copy()->endOfWeek()),
                        'value' => $day->copy()->weekOfYear,
                        'total_reward' => $type == CHALLENGE_TYPE_TRADING ? 23000 : 11500,
                        'status' => 'end',
                        'members' => $transactionsLastWeek
                    ];
                }
            }
        }

        return responseJSON($result);
    }

    public function getChallengeBoard()
    {
        $start = Carbon::createFromTimestampMs(request('start'));
        $end = Carbon::createFromTimestampMs(request('end'));
        $type = request('type');
        $schedule = request('schedule');

        $transactions = MemberTransaction::challenge($start, $end, $type, $schedule==CHALLENGE_SCHEDULE_MONTH?50:20)->get();

        $result = [];
        foreach ($transactions as $key => $transaction){
            $rank = $key+1;
            $username = mb_convert_encoding($transaction->member->username, 'UTF-8', 'UTF-8');
            if(!optional(getAuthUser())->is_admin){
                $username = hideUsername($username);
            }
            $result[] = [
                'rank' => $rank,
                'username' => $username,
                'value' => hideMoney($transaction->sum),
                'reward' => setting("rank_{$type}_{$schedule}_{$rank}")
            ];
        }
        return responseJSON($result);
    }
}
