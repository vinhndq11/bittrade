<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function index()
    {
        return view('backend.setting.index');
    }

    public function update()
    {
        $input = request()->except('_method', '_token', 'save');
        foreach ($input as $key => $value){
            setting()->set($key, $value);
        }
        setting()->save();
        return back()->with('success', 'Cập nhật cài đặt thành công');;
    }
}
