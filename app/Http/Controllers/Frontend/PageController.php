<?php

namespace App\Http\Controllers\Frontend;

class PageController extends BaseController
{
    public function getIndex()
    {
        return view('frontend.home.index');
    }

    public function getTradeData()
    {
        return file_get_contents(storage_path('app/public/trade_data.json'));
    }
}
