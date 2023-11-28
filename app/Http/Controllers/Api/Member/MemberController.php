<?php

namespace App\Http\Controllers\Api\Member;

use App\Mail\VerifyEmail;
use App\Models\MemberTransaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;
use PragmaRX\Google2FA\Google2FA;

class MemberController extends BaseController
{
    public function postWithdrawal()
    {
        $amount = request('withdrawal_amount');
        if($amount > $this->user->real_balance){
            return responseJSON_EMPTY_OBJECT(false, 'Số tiền yêu cầu rút lớn hơn số dư tài khoản Thực');
        }
        $minimum_withdrawal = doubleval(setting('minimum_withdrawal'));
        if($amount < $minimum_withdrawal){
            return responseJSON_EMPTY_OBJECT(false, "Số tiền rút phải lớn hơn $$minimum_withdrawal");
        }
        if(!$this->user->is_two_fa){
            return responseJSON_EMPTY_OBJECT(false, 'Vui lòng bật xác thực 2FA để thực hiện thao tác này!');
        }
        $two_fa_code = request('two_fa_code');
        $twoFa = new \PragmaRX\Google2FALaravel\Google2FA(request());
        if(!$two_fa_code || !$twoFa->verifyGoogle2FA($this->user->two_fa, $two_fa_code)){
            return responseJSON_EMPTY_OBJECT(false, 'Mã 2FA không đúng, vui lòng thử lại');
        }

        DB::beginTransaction();
        try {
            $memberTransaction = MemberTransaction::create([
                'member_id' => $this->user->id,
                'point_type' => POINT_TYPE_REAL,
                'transaction_type' => TRANSACTION_TYPE_WITHDRAWAL,
                'transaction_status' => TRANSACTION_STATUS_PENDING,
                'value' => -$amount,
                'payment_type' => PAYMENT_TYPE_BANK
            ]);
            $memberTransaction->withdrawal()->create([
                'payment_type' => PAYMENT_TYPE_BANK,
                'bank_name' => request('withdrawal_bank_name'),
                'bank_number' => request('withdrawal_bank_number'),
                'bank_account' => request('withdrawal_bank_account'),
            ]);
            DB::commit();

            $count = MemberTransaction::query()->where('transaction_type', TRANSACTION_TYPE_WITHDRAWAL)
                ->where('point_type', POINT_TYPE_REAL)
                ->where('transaction_status', TRANSACTION_STATUS_PENDING)
                ->count();
            Redis::publish('we_message', json_encode([
                'type' => TRANSACTION_TYPE_WITHDRAWAL,
                'message' => "Thành viên {$this->user->display_name} vừa yêu cầu rút $$amount",
                'count' => $count
            ]));

            return responseJSON_EMPTY_OBJECT(true, 'Đã gửi lệnh rút tiền thành công, vui lòng chờ duyệt');
        } catch (\Exception $e){
            DB::rollback();
            return responseJSON_EMPTY_OBJECT(false, 'Lỗi: ' . $e->getMessage());
        }
    }

    public function getTransaction()
    {
        $transactions = MemberTransaction::query()
            ->where('member_id', $this->user->id)
            ->when(request('transaction_type'), function ($query, $transaction_type){
                $query->where('transaction_type', $transaction_type);
            })
            ->when(request('point_type'), function ($query, $point_type){
                $query->where('point_type', $point_type);
            })
            ->when(request('transaction_status'), function ($query, $transaction_status){
                $query->where('transaction_status', $transaction_status);
            })
            ->when(request('filter_from'), function ($query, $filter_from){
                $query->whereDate('created_at', '>=', $filter_from);
            })
            ->when(request('filter_to'), function ($query, $filter_to){
                $query->whereDate('created_at', '<=', $filter_to);
            })
            ->when(request('sort_selector'), function ($query, $sort_selector){
                $query->orderBy($sort_selector, request('sort_direction'));
            }, function ($query){
                $query->latest();
            })
            ->paginate($this->limit);
        $total_bet_open = 0;
        if(request('transaction_type') === TRANSACTION_TYPE_BET) {
            $total_bet_open = MemberTransaction::query()
                ->latest()
                ->where('member_id', $this->user->id)
                ->where('transaction_type', TRANSACTION_TYPE_BET)
                ->where('transaction_status', TRANSACTION_STATUS_PENDING)
                ->count();
        }
        return responseJSON([
            'total' => $transactions->total(),
            'data' => MemberTransaction::responseMapping($transactions->items()),
            'total_bet_open' => $total_bet_open
        ]);
    }

    public function postRecharge()
    {
        $amount = request('amount');
        $minimum_deposit = setting('minimum_deposit', 0);
        if($amount < $minimum_deposit){
            return responseJSON_EMPTY_OBJECT(false, "Số tiền tối thiểu mỗi lần nạp là: $$minimum_deposit");
        }
        $payment_type = request('payment_method', PAYMENT_TYPE_BANK);
        $memberTransaction = MemberTransaction::create([
            'member_id' => $this->user->id,
            'point_type' => POINT_TYPE_REAL,
            'transaction_type' => TRANSACTION_TYPE_RECHARGE,
            'transaction_status' => TRANSACTION_STATUS_PENDING,
            'value' => $amount,
            'payment_type' => $payment_type
        ]);

        $count = MemberTransaction::query()->where('transaction_type', TRANSACTION_TYPE_RECHARGE)
            ->where('point_type', POINT_TYPE_REAL)
            ->where('transaction_status', TRANSACTION_STATUS_PENDING)
            ->count();
        Redis::publish('we_message', json_encode([
            'type' => TRANSACTION_TYPE_RECHARGE,
            'message' => "Thành viên {$this->user->display_name} vừa yêu cầu nạp $$amount vào tài khoản",
            'count' => $count
        ]));

        return responseJSON([
            'code' => $memberTransaction->code
        ],true, 'Đã gửi lệnh nạp tiền thành công, vui lòng chờ duyệt');
    }

    public function postBuyVip()
    {
        $vip_price = doubleval(setting('vip_price', 0));
        if($this->user->real_balance < $vip_price){
            return responseJSON_EMPTY_OBJECT(false, "Tài khoản thực của bạn không đủ để mua VIP. Vui lòng nạp thêm tiền để tiếp tục");
        }
        $this->user->update([ 'user_mode' => USER_MODE_UNLIMITED ]);
        $member_transaction = MemberTransaction::create([
            'member_id' => $this->user->id,
            'point_type' => POINT_TYPE_REAL,
            'transaction_type' => TRANSACTION_TYPE_BUY_VIP,
            'transaction_status' => TRANSACTION_STATUS_FINISH,
            'value' => -$vip_price
        ]);
        (new \App\Services\MemberCommission(COMMISSION_TYPE_VIP))->applyCommission($member_transaction);
        return responseJSON_EMPTY_OBJECT(true, "Chúc mừng bạn đã nâng hạng thành công!");
    }

    public function getCommission()
    {
        $query = MemberTransaction::query()
            ->where('member_id', $this->user->id)
            ->where('transaction_type', TRANSACTION_TYPE_REF)
            ->where('point_type', POINT_TYPE_REAL)
            ->where('transaction_status', TRANSACTION_STATUS_FINISH);
        $trade_commission = (clone $query)->where('commission_type', COMMISSION_TYPE_TRADE)->sum('value');
        $vip_commission = (clone $query)->where('commission_type', COMMISSION_TYPE_VIP)->sum('value');
         return responseJSON([
             'trade_commission' => $trade_commission,
             'vip_commission' => $vip_commission,
         ]);
    }

    public function getDashboard()
    {
        $query = MemberTransaction::query()
            ->where('member_id', $this->user->id)
            ->where('point_type', POINT_TYPE_REAL)
            ->where('transaction_type', TRANSACTION_TYPE_BET)
            ->where('transaction_status', TRANSACTION_STATUS_FINISH);
        $totalAll = (clone $query)->count();
        $fund = floor((clone $query)->sum('bet_value'));
        $totalWinCount = (clone $query)->where('value', '>', 0)->count();
        $totalLoseCount = (clone $query)->where('value', '<', 0)->count();
        $profit = floor((clone $query)->sum('value'));
        $revenue = floor($fund + $profit);
        $totalUp = (clone $query)->where('bet_condition', BET_CONDITION_UP)->count();

        return responseJSON([
            'total_all' => $totalAll,
            'total_win' => $totalWinCount,
            'total_lose' => $totalLoseCount,
            'total_draw' => 0,
            'fund' => $fund,
            'revenue' => $revenue,
            'profit' => $profit,
            'percent_up'=> $totalAll != 0 ? floor($totalUp * 100 / $totalAll) : 0
        ]);
    }

    public function getTwoFaKey()
    {
        $twoFa = new \PragmaRX\Google2FALaravel\Google2FA(request());
        $secret = $twoFa->generateSecretKey();
        $auth_string = $twoFa->getQRCodeUrl(env('TWO_FA_COMPANY', env('APP_NAME')), $this->user->email, $secret);
        return responseJSON([
            'secret' => $secret,
            'auth_string' => $auth_string
        ]);
    }

    public function postSendOTPEmail()
    {
        $otp = generate()->get(6, generate()->STRING_NUMBER);
        $this->user->update(['otp' => $otp]);
        Mail::to([$this->user->email])->send(new VerifyEmail($otp));
        return responseJSON_EMPTY_OBJECT(true, 'Đã gửi mã xác nhận đến email');
    }

    public function postEnableTwoFa()
    {
        $auth_password = request('auth_password');
        $auth_email_code = request('auth_email_code');
        $auth_two_fa_code = request('auth_two_fa_code');
        $secret = request('secret');
        if(empty($auth_password) || empty($auth_email_code) || empty($auth_two_fa_code) || empty($secret)){
            return responseJSON_EMPTY_OBJECT(false, 'Vui lòng điền đầy đủ dữ liệu');
        }

        if(!password_verify($auth_password, $this->user->password)){
            return responseJSON_EMPTY_OBJECT(false, 'Mật khẩu đã nhập không đúng, vui lòng kiểm tra lại');
        }

        if($auth_email_code != $this->user->otp){
            return responseJSON_EMPTY_OBJECT(false, 'Mã xác nhận email không đúng, vui lòng kiểm tra lại');
        }

        $twoFa = new \PragmaRX\Google2FALaravel\Google2FA(request());
        if(!$twoFa->verifyGoogle2FA($secret, $auth_two_fa_code)){
            return responseJSON_EMPTY_OBJECT(false, 'Mã 2FA không đúng, vui lòng thử lại');
        }

        $this->user->update(['two_fa' => $secret, 'is_two_fa' => 1, 'is_verify' => 1]);
        $this->user->refresh();
        return responseJSON($this->user->responseModel(), true, 'Bật 2FA thành công');
    }

    public function postDisableTwoFa()
    {
        $auth_password = request('auth_password');
        $auth_email_code = request('auth_email_code');
        $auth_two_fa_code = request('auth_two_fa_code');
        if(empty($auth_password) || empty($auth_email_code) || empty($auth_two_fa_code)){
            return responseJSON_EMPTY_OBJECT(false, 'Vui lòng điền đầy đủ dữ liệu');
        }

        if(!password_verify($auth_password, $this->user->password)){
            return responseJSON_EMPTY_OBJECT(false, 'Mật khẩu đã nhập không đúng, vui lòng kiểm tra lại');
        }

        if($auth_email_code != $this->user->otp){
            return responseJSON_EMPTY_OBJECT(false, 'Mã xác nhận email không đúng, vui lòng kiểm tra lại');
        }

        $twoFa = new \PragmaRX\Google2FALaravel\Google2FA(request());
        if(!$twoFa->verifyGoogle2FA($this->user->two_fa, $auth_two_fa_code)){
            return responseJSON_EMPTY_OBJECT(false, 'Mã 2FA không đúng, vui lòng thử lại');
        }

        $this->user->update(['two_fa' => '', 'is_two_fa' => 0]);
        $this->user->refresh();
        return responseJSON($this->user->responseModel(), true, 'Tắt 2FA thành công');
    }

    public function getNetwork()
    {
        $max_level_commission = intval(setting("max_level_commission", 1));
        $list = getChildren($this->user, 0 , $max_level_commission);
        return responseJSON($list);
    }
}
