<?php
/**
 * Filename: MemberCommission.php
 * User: hadesker - hadesker.net
 * Date: 4/27/21
 * Time: 1:36 PM
 */

namespace App\Services;


use App\Models\MemberTransaction;

class MemberCommission
{
    private $commission_type;
    private $max_level_commission;

    public function __construct($commission_type)
    {
        $this->commission_type = $commission_type;
        return $this;
    }

    public function applyCommission($member_transaction)
    {
        $this->max_level_commission = intval(setting("max_level_commission", 1));
        if(setting("commission_{$this->commission_type}_1") <= 0 || $this->max_level_commission < 1){
            return null;
        }
        $this->calculate($member_transaction, $this->max_level_commission - 1);
    }

    private function calculate(MemberTransaction $member_transaction, $current_level)
    {
        $child_transaction = null;
        $commission_level = $this->max_level_commission - $current_level;
        $commission_percent = doubleval(setting("commission_{$this->commission_type}_{$commission_level}"));
        $commission_condition_f1 = doubleval(setting("commission_condition_f1_{$commission_level}"));
        $commission_condition_volume = doubleval(setting("commission_condition_volume_{$commission_level}"));
        if($commission_percent > 0 && $member_transaction->point_type == POINT_TYPE_REAL && ($ref = optional($member_transaction->member)->ref)){
            $children = $ref->children;
            if($ref->user_mode == USER_MODE_UNLIMITED && count($children) >= $commission_condition_f1){
                $children_member_transactions_ids = $children->pluck('id')->toArray();
                $bet_value = MemberTransaction::query()
                    ->whereIn('member_id', $children_member_transactions_ids)
                    ->where('transaction_type', TRANSACTION_TYPE_BET)
                    ->where('point_type', POINT_TYPE_REAL)
                    ->where('transaction_status', TRANSACTION_STATUS_FINISH)
                    ->whereBetween('created_at', [today()->startOfWeek()->startOfDay(), today()->endOfWeek()->endOfDay()])
                    ->sum('bet_value');
                if($bet_value >= $commission_condition_volume){
                    $child_transaction = $ref->member_transactions()->create([
                        'point_type' => POINT_TYPE_REAL,
                        'transaction_type' => TRANSACTION_TYPE_REF,
                        'transaction_status' => TRANSACTION_STATUS_FINISH,
                        'value' => ($member_transaction->value < 0 ? -1 * $member_transaction->value : $member_transaction->value ) * $commission_percent / 100,
                        'note' => "Hưởng hoa hồng từ: {$member_transaction->member->username}",
                        'commission_member_id' => $member_transaction->member_id,
                        'commission_transaction_id' => $member_transaction->id,
                        'commission_percent' => $commission_percent,
                        'commission_type' => $this->commission_type,
                        'commission_level' => $commission_level,
                    ]);
                }
            }
        }
        if($child_transaction && --$current_level > 0){
            $this->calculate($child_transaction, $current_level);
        }
    }
}
