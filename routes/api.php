<?php
use \Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Api', 'as'=>'api.'], function () {
    Route::get("reset-password", 'Api\BaseController@getResetPassword')->name('api.get_reset_password.get');
    Route::post("reset-password", 'Api\BaseController@postResetPassword')->name('api.post_reset_password.post');
    Route::post("upload", 'Api\BaseController@postUpload')->name('api.post_upload_file.post');

    Route::group(['namespace' => 'Member'], function () {
        Route::post("login", 'AuthController@postLogin')->name('login.post');
        Route::post("verify", 'AuthController@postVerifyPhone')->name('verify.post');
        Route::post("register", 'AuthController@postRegister')->name('register.post');
        Route::post("forgot-password", 'AuthController@postForgetPassword')->name('forget.post');
        Route::post("reset-password", 'AuthController@postResetPassword')->name('reset.post');
        Route::get("config", 'BaseController@getConfig');

        Route::group(['prefix'=>'location','as'=>'location.'], function (){
            Route::get('province','LocationController@getProvince')->name('get_province');
            Route::get('province/{province_id}/district','LocationController@getDistrict')->name('get_district');
            Route::get('district/{district_id}/ward','LocationController@getWard')->name('get_ward');
        });

        Route::group(['middleware' => 'api-member'], function () {
            Route::post("logout", 'AuthController@postLogout');
            Route::get('profile','AuthController@getProfile');
            Route::put('profile','AuthController@putUpdateProfile');
            Route::put('profile/password','AuthController@putChangePassword');
            Route::post('profile/avatar','AuthController@postChangeAvatar');
            Route::put('profile/reset-demo-balance','AuthController@putResetDemoBalance');

            Route::get('trading-data','TradingController@getTradingData');

            Route::post('bet','TradingController@postBet');

            Route::post('withdrawal','MemberController@postWithdrawal');

            Route::post('buy-vip','MemberController@postBuyVip');

            Route::get('commission','MemberController@getCommission');

            Route::get('network','MemberController@getNetwork');

            Route::get('challenge/live','ChallengeController@getChallengeLive');

            Route::get('challenge/end','ChallengeController@getChallengeEnd');

            Route::get('challenge/info','ChallengeController@getChallengeInfo');

            Route::get('challenge/board','ChallengeController@getChallengeBoard');

            Route::get('transaction','MemberController@getTransaction');

            Route::get('dashboard','MemberController@getDashboard');

            Route::post('recharge','MemberController@postRecharge');

            Route::get('bet-result','TradingController@getBetResult');

            Route::post('otp-email','MemberController@postSendOTPEmail');

            Route::post('enable-two-fa','MemberController@postEnableTwoFa');

            Route::get('two-fa-key','MemberController@getTwoFaKey');

            Route::post('disable-two-fa','MemberController@postDisableTwoFa');

            Route::group(['prefix'=>'delivery','as'=>'delivery.'], function (){
                Route::get('/','DeliveryController@getList')->name('get_list');
                Route::get('{delivery_id}','DeliveryController@getDetail')->name('get_detail');
            });
        });
    });
});


