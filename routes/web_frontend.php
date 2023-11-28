<?php
use \Illuminate\Support\Facades\Route;

Route::get('publish', function () {
    $is_bet = \Illuminate\Support\Facades\Redis::get('is_bet');
    $bet_id = \Illuminate\Support\Facades\Redis::get('bet_id');
    if($is_bet == 'true'){
        dd('true', $is_bet, $bet_id);
    }
    dd('false', $is_bet, $bet_id);
});

Route::get('test', function () {
    dd(now()->setTime(23,59,59)->addDays(7));
});

Route::get('redirect-forget-password', 'Frontend\AuthController@getForgetPassword')->name('forget_password.get');

Route::get('{any}', function () {
    return view('frontend.home.index');
})->where('any', '.*')->name('home');
