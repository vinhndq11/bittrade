<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class AssetController extends Controller
{
    public function index()
    {
        return view('backend.asset.index');
    }

    public function update()
    {
        $input = request()->except('_method', '_token', 'save');
        foreach ($input as $key => $value){
            setting()->set($key, $value);
        }
        setting()->save();
        return back()->with('success', 'Cập nhật hình ảnh thành công');;
    }
}
