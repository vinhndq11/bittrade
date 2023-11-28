<?php

namespace App\Http\Controllers\Api\Member;

use App\Http\Controllers\Api\BaseController as BaseCT;
use App\Models\Member;

class BaseController extends BaseCT
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware(function ($request, $next) {
            $this->user = \DataSingleton::getInstance()->getUser();
            if(!$this->user)
                $this->user = new Member();
            return $next($request);
        });
    }

    public function getConfig()
    {
        $this->config['banking_name'] = setting('banking_name','Test Bank');
        $this->config['banking_branch'] = setting('banking_branch','Test Branch');
        $this->config['banking_number'] = setting('banking_number','123456789');
        $this->config['banking_owner'] = setting('banking_owner','Nguyễn Văn A');
        $this->config['profit_percent'] = doubleval(setting('profit_percent',0));
        $this->config['minimum_deposit'] = doubleval(setting('minimum_deposit',0));
        $this->config['minimum_withdrawal'] = doubleval(setting('minimum_withdrawal',0));
        $this->config['bank_data'] = setting('bank_data');
        $this->config['phone'] = setting('phone');
        $this->config['socket_link'] = setting('socket_link');
        $this->config['vip_price'] = doubleval(setting('vip_price', 0));
        $this->config['vip_percent_commission'] = doubleval(setting('vip_percent_commission', 0));
        $this->config['trade_percent_commission'] = doubleval(setting('trade_percent_commission', 0));
        $this->config['vnd_per_usd'] = doubleval(setting('vnd_per_usd', 24000));
        $this->config['withdrawal_cost'] = doubleval(setting('withdrawal_cost', 0));
        $this->config['usdt_address'] = setting('usdt_address');
        $this->config['usdt_per_usd'] = doubleval(setting('usdt_per_usd', 1));

        $this->config['asset_logo'] = assetVersion(setting('asset_logo', 'images/logo.png'));
        $this->config['asset_challenge_banner'] = assetVersion(setting('asset_challenge_banner', 'images/bannerDeskTop.jpeg'));
        $this->config['asset_affiliate_network_banner'] = assetVersion(setting('asset_affiliate_network_banner', 'static/media/background_pc.fa409bf.e7945145.png'));
        $this->config['asset_home_app'] = assetVersion(setting('asset_home_app', 'static/media/mockup.17078c5a.png'));
        return parent::getConfig();
    }
}
