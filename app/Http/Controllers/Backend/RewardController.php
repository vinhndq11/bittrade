<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class RewardController extends Controller
{
    public function index()
    {
        return view('backend.reward.index');
    }

    public function update()
    {
        $input = request()->except('_method', '_token', 'save');
        foreach ($input as $key => $value){
            setting()->set($key, $value);
        }
        setting()->save();
        return back();
    }
}
