<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Implement\PasswordAuth;
use App\Traits\PasswordAuthTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller implements PasswordAuth
{
    use PasswordAuthTrait;

    public function getLogin()
    {
        if (Auth::check()){
            return redirect()->route('admin.dashboard.index');
        }
        return view('backend.auth.login');
    }

    public function postLogin(Request $request)
    {
        $rules = [
            'email' => 'required',
            'password' => 'required',
        ];
        $messages = [
            'email.required' => 'Email không được để trống',
            'password.required' => 'Mật khẩu không được để trống',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }

        if (Auth::attempt($request->only('email', 'password'), $request->has('remember')))
        {
            if(!auth()->user()->is_active)
            {
                Auth::logout();
                return back()->withInput()->with('error', 'Tài khoản này đã bị khoá hoặc chưa được kích hoạt, vui lòng liên hệ quản trị viên để biết thêm chi tiết!');
            }
            return redirect()->route('admin.dashboard.index');
        }
        return back()->withInput()->with('error', 'Bạn đã  nhập sai thông tin đăng nhập, vui lòng thử lại');
    }

    public function getLogout()
    {
        if(Auth::check()){
            Auth::logout();
        }
        return redirect()->route('admin.login');
    }

    public function getForgetPassword()
    {
        return view('backend.auth.forget');
    }
}
