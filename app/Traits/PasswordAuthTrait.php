<?php
/**
 * Filename: AuthTrait.php
 * Date: 8/16/20
 * Time: 2:22 AM
 */

namespace App\Traits;


use App\Mail\ForgetPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

trait PasswordAuthTrait
{
    public function getFieldCheck()
    {
        return 'email';
    }

    public function getModelCheck()
    {
        return User::class;
    }

    public function getForgetPassword()
    {
        return "Missing view forget password";
    }

    public function postForgetPassword(Request $request)
    {
        $field = $request->get($this->getFieldCheck());
        $user = User::active()->where($this->getFieldCheck(), $field)->first();
        if(!$user){
            return redirect()->back()->with('error','Có lỗi xảy ra trong quá trình đặt mật khẩu, vui lòng thử lại sau');
        }
        $token = encryptTokenForgotPassword($field, $this->getModelCheck());
        $user->reset_token = $token;
        $user->save();
        Mail::to($user->email)->send(new ForgetPassword($user));
        return redirect()->back()->with('success', 'Hệ thống đã tiếp nhận yêu cầu của bạn, vui lòng kiểm tra lại email và làm theo hướng dẫn');
    }

    public function getChangePassword(Request $request)
    {
        $token = $request->get('token');
        [$success, $field, $model, $message] = array_values(decryptTokenForgotPassword($token));
        if($success) {
            return view('mail.reset_password', compact('token'));
        }
        return redirect()->route('admin.login')->with('error', $message);
    }

    public function postChangePassword(Request $request)
    {
        $token = $request->get('token');
        $new_password = $request->get('new_password');
        [$success, $field, $model, $message] = array_values(decryptTokenForgotPassword($token));
        if($token && $success && class_exists($model)) {
            $user = (new $model())::where($this->getFieldCheck(), $field)->where('reset_token', $token)->first();
            if($user)
            {
                $user->password = $new_password;
                $user->reset_token = '';
                $user->save();
                return redirect()->route('admin.login')->with('success','Mật khẩu đã được thay đổi thành công, bạn có thể đăng nhập bằng mật khẩu mới ngay bây giờ');
            }
        }
        return redirect()->route('admin.login')->with('error', $message ?? 'Mã bảo vệ hết hạn hoặc không đúng, vui lòng thử lại!');
    }
}
