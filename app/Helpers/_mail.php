<?php

use App\Helpers\Crypt;
use Carbon\Carbon;

function encryptTokenForgotPassword($fieldCheck, $classModel)
{
    return Crypt::encrypt(['field' => $fieldCheck, 'model' => $classModel, 'created_at' => now() ]);
}

function decryptTokenForgotPassword($token = '')
{
    $errorMessage = null;
    try {
        $decryptedValue = Crypt::decrypt($token);
        if(Carbon::parse($decryptedValue['created_at'])->diffInMinutes(now()) < 30)
        {
            return [
                'success'=>true,
                'field'=> $decryptedValue['field'],
                'model'=> $decryptedValue['model'],
                'message' => null
            ];
        }
        $errorMessage = 'Token hết hạn, vui lòng lấy lại token mới để đổi mật khẩu';
    } catch (Exception $e) { $errorMessage = 'Token không hợp lệ, vui lòng kiểm tra lại'; }
    return [
        'success'=>false,
        'field'=>'',
        'model'=>'',
        'message' => $errorMessage
    ];
}
