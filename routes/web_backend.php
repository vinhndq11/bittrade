<?php

use \Illuminate\Support\Facades\Route;

/*
 * Backend
 */
$prefix_admin = PREFIX_ADMIN;

Route::get("$prefix_admin/login", 'Backend\AuthController@getLogin')->name('admin.login');
Route::get($prefix_admin, function () {
    return redirect()->route('admin.login');
});

Route::post("$prefix_admin/login", 'Backend\AuthController@postLogin')->name('admin.login.post');

Route::get("$prefix_admin/forget-password", 'Backend\AuthController@getForgetPassword')->name('admin.forget.get');
Route::post("$prefix_admin/forget-password", 'Backend\AuthController@postForgetPassword')->name('admin.forget.post');
Route::get("$prefix_admin/change-password", 'Backend\AuthController@getChangePassword')->name('admin.change.get');
Route::post("$prefix_admin/change-password", 'Backend\AuthController@postChangePassword')->name('admin.change.post');

Route::group(['namespace' => 'Backend', 'middleware' => 'backend', 'prefix' => $prefix_admin, 'as' => 'admin.'], function () {
    Route::get("logout", 'AuthController@getLogout')->name('logout.get');

    Route::get('dashboard', 'DashboardController@index')->name('dashboard.index');

    Route::get('analytic', 'AnalyticController@index')->name('analytic.index');
    Route::get('analytic/data', 'AnalyticController@getAnalyticData')->name('analytic.data');
    Route::put('analytic', 'AnalyticController@getUpdateBetResult')->name('analytic.update_bet_result');

    Route::get('profile', 'UserController@getProfile')->name('profile.get');

    Route::put('user/{id}', 'UserController@update');

    Route::resource('log', 'LogController');

    Route::post('member/{id}/recharge', 'MemberController@postRecharge')->name('member.recharge.post');
    Route::resource('member', 'MemberController');

    Route::resource('hacker', 'HackerController');

    Route::resource('user', 'UserController');

    Route::resource('role', 'RoleController');

    Route::resource('permission', 'PermissionController');

    Route::get('reward', 'RewardController@index')->name('reward.index');
    Route::put('reward', 'RewardController@update')->name('reward.update');

    Route::get('commission', 'CommissionController@index')->name('commission.index');
    Route::put('commission', 'CommissionController@update')->name('commission.update');


    Route::post('member_transaction/{id}/confirm', 'MemberTransactionController@postConfirm')->name('member_transaction.confirm.post');
    Route::resource('member_transaction', 'MemberTransactionController');

    Route::get('template', 'TemplateController@index')->name('template.index');
    Route::put('template', 'TemplateController@update')->name('template.update');

    Route::get('asset', 'AssetController@index')->name('asset.index');
    Route::put('asset', 'AssetController@update')->name('asset.update');

    Route::get('setting', 'SettingController@index')->name('setting.index');
    Route::put('setting', 'SettingController@update')->name('setting.update');
    Route::post('clear-cache', 'SettingController@postClearCache')->name('clear_cache.post');
});
