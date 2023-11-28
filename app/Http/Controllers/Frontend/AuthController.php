<?php

namespace App\Http\Controllers\Frontend;

class AuthController extends BaseController
{
    public function getForgetPassword()
    {
        $token = request('token');
        $data = decryptTokenForgotPassword($token);
        if(!$data['success']){
            return $data['message'];
        }
        $model = (new $data['model']())->where($data['field'], $token)->first();
        if(!$model){
            return "Liên kết không hợp lệ hoặc bị lỗi, vui lòng thử lại sau!";
        }
        $email = urlencode($model->email);
        $token = urlencode($token);
        return redirect(url("forget-password?e={$email}&token={$token}"));
    }
}
