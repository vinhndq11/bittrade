<?php

use App\Models\MemberTransaction;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('node2laravel', function () {
    try{
        $env = $this->option('env');
        $json = json_decode($env);

        $profit_percent = doubleval(setting('profit_percent', 0));
        if($profit_percent > 0){
            MemberTransaction::query()
                ->where('transaction_type', TRANSACTION_TYPE_BET)
                ->where('transaction_status', TRANSACTION_STATUS_PENDING)
                ->where('bet_id', $json->bet_id)
                ->get()
                ->each(function ($member_transaction) use ($profit_percent, $json){
                    $member_transaction->transaction_status = TRANSACTION_STATUS_FINISH;
                    $member_transaction->open_price = $json->open_price;
                    $member_transaction->close_price = $json->close_price;
                    if($json->bet_condition_result == $member_transaction->bet_condition){
                        $member_transaction->value = $member_transaction->bet_value * $profit_percent / 100;
                    }
                    return $member_transaction->save();
                });
        }
        $this->comment(json_encode(['ok' => 1]));
    } catch (\Exception $exception){
        $this->comment(json_encode(['ok' => 0, 'message' => $exception->getMessage()]));
    }
});
