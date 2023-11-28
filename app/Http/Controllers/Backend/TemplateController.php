<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class TemplateController extends Controller
{
    public function index()
    {
        $templates = [
            'forget_password' => 'Khôi phục mật khẩu',
            'verify_email' => 'Xác thực email',
        ];
        return view('backend.template.index', compact('templates'));
    }

    public function update()
    {
        foreach (request()->input('mail') as $file_name => $html){
            file_put_contents(resource_path("views/mail/{$file_name}.blade.php"), $html);
        }
        return back()->with('success', 'Cập nhật template thành công!');
    }
}
