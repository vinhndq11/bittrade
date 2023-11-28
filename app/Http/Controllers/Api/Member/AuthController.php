<?php

namespace App\Http\Controllers\Api\Member;

use App\Mail\ForgetPassword;
use App\Models\Member;
use App\Models\MemberDevice;
use App\Models\MemberTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use function GuzzleHttp\Psr7\str;

class AuthController extends BaseController
{
    /**
     * @api Register new member
     * @param Request $request
     * @return array
     */
    public function postRegister(Request $request)
    {
        $email = $request->get('email');
        if(!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)){
            return responseJSON_EMPTY_OBJECT(false, 'Email không hợp lệ', ERROR_CODE_REQUIRED_EMAIL);
        }

        $password = $request->get('password');
        if(!$password){
            return responseJSON_EMPTY_OBJECT(false, 'Mật khẩu không được để trống', ERROR_CODE_REQUIRED_PASSWORD);
        }

        $username = $request->get('username');
        if(!$username){
            return responseJSON_EMPTY_OBJECT(false, 'Nickname không được để trống', ERROR_CODE_REQUIRED_PASSWORD);
        }

        if(Member::query()->where('email', $email)->orWhere('username', $username)->exists()){
            return responseJSON_EMPTY_OBJECT(false, 'Email hoặc nickname đã tồn tại trong hệ thống, vui lòng thử email hoặc nickname khác!', ERROR_CODE_ALREADY_EXISTS);
        }

        $member = Member::create([
            'user_mode' => USER_MODE_MEMBER,
            'trial_count' => setting('trial_count', 0),
            'expired_tool_at' => now()->addDays(intval(setting('trial_expired_count', 0)))->setTime(23,59,59),
            'email' => $email,
            'password' => $password,
            'username' => $username,
            'ref_username' => $request->get('ref_username')
        ]);
        $demo_default_balance = doubleval(setting('demo_default_balance', 0));
        if($demo_default_balance > 0){
            MemberTransaction::create([
                'member_id' => $member->id,
                'point_type' => POINT_TYPE_DEMO,
                'transaction_type' => TRANSACTION_TYPE_RECHARGE,
                'transaction_status' => TRANSACTION_STATUS_FINISH,
                'value' => $demo_default_balance,
                'note' => 'Nạp demo khi đăng ký thành công!'
            ]);
        }
        return responseJSON_EMPTY_OBJECT(true, 'Đã tạo tài khoản thành công. Xin mời đăng nhập!');
    }

    /**
     * @api Login
     * @param Request $request
     * @return array
     */
    public function postLogin(Request $request):? array
    {
        $email = $request->get('email');
        $password = $request->get('password');
        $two_fa = $request->get('two_fa');

        $member = Member::query()->where('email', $email)->first();
        if(!$member){
            return responseJSON_EMPTY_OBJECT(false, trans('system.message.account_not_exists'), ERROR_CODE_INVALID_ACCOUNT);
        }

        if (!$member->is_active){
            return responseJSON_EMPTY_OBJECT(false, trans('system.message.account_blocked'), ERROR_CODE_ACCOUNT_BLOCKED_OR_NOT_ACTIVE);
        }

        if(!password_verify($password, $member->password)){
            return responseJSON_EMPTY_OBJECT(false, 'Tài khoản hoặc mật khẩu không đúng!', ERROR_CODE_INVALID_ACCOUNT);
        }

        if($member->is_two_fa){
            if(strlen($two_fa) != 6){
                return responseJSON_EMPTY_OBJECT(false, 'Vui lòng nhập 2FA từ ứng dụng Google Auth!', ERROR_CODE_REQUIRE_TWO_FA);
            }
            $twoFa = new \PragmaRX\Google2FALaravel\Google2FA(request());
            if(!$twoFa->verifyGoogle2FA($member->two_fa, $two_fa)){
                return responseJSON_EMPTY_OBJECT(false, 'Mã 2FA không đúng, vui lòng thử lại');
            }
        }

        $login_token = userToToken($member);
        \DataSingleton::getInstance()->setToken($login_token);
        $member->member_devices()->create(compact('login_token'));
        return responseJSON($member->responseModel(), true, 'Đăng nhập thành công!');
    }

    /**
     * @api Logout and delete token
     * @return array
     */
    public function postLogout()
    {
        try {
            $token = \DataSingleton::getInstance()->getToken();
            MemberDevice::query()->where('login_token', $token)->delete();
        } catch (\Exception $exception) {
        }
        return responseJSON_EMPTY_OBJECT(true, 'Đăng xuất thành công!');
    }

    /**
     * @return array
     * @api Get profile info
     */
    public function getProfile()
    {
        return responseJSON($this->user->responseModel());
    }

    /**
     * @api Update profile
     * @param Request $request
     * @return array
     */
    public function putUpdateProfile(Request $request)
    {
        $this->user->update($request->only('avatar', 'first_name', 'last_name', 'current_point_type', 'enable_sound', 'is_show_balance'));
        $this->user->refresh();
        return responseJSON($this->user->responseModel(), true, 'Cập nhật thông tin thành công!');
    }

    /**
     * @api Update new password
     * @param Request $request
     * @return array
     */
    public function putChangePassword(Request $request)
    {
        $old_password = $request->get('old_password');
        $new_password = $request->get('new_password');
        if (!password_verify($old_password, $this->user->password)){
            return responseJSON_EMPTY_OBJECT(false, trans('system.message.old_password_invalid'), ERROR_CODE_INVALID_OLD_PASSWORD);
        }
        $this->user->update(['password' => $new_password]);
        return responseJSON_EMPTY_OBJECT(true, 'Cập nhật mật khẩu thành công!');
    }

    public function putResetDemoBalance()
    {
        $demo_default_balance = setting('demo_default_balance', 0);
        $this->user->member_transactions()->where('point_type', POINT_TYPE_DEMO)->delete();
        $this->user->member_transactions()->create([
            'point_type' => POINT_TYPE_DEMO,
            'transaction_type' => TRANSACTION_TYPE_RECHARGE,
            'transaction_status' => TRANSACTION_STATUS_FINISH,
            'value' => $demo_default_balance,
            'note' => 'Nạp demo khi đăng ký thành công!'
        ]);
        $this->user->refresh();
        return responseJSON($this->user->responseModel(),true, 'Đã khôi phục lại tài khoản demo thành công!');
    }

    public function postChangeAvatar()
    {
        $avatar = request()->file('avatar');
        $this->user->update(compact('avatar'));
        return responseJSON($this->user->responseModel(), true,'Cập nhật ảnh đại diện thành công');
    }

    public function postForgetPassword(Request $request)
    {
        $email = $request->get('email');
        $user = Member::where('email', $email)->where('is_active',1)->first();
        if ($user)
        {
            $token = encryptTokenForgotPassword('reset_token', Member::class);

            $input['name'] = $user->display_name;
            $input['email'] = $user->email ?? $user->username;
            $input['link'] = route('forget_password.get', ['token' => $token]);

            $user->reset_token = $token;
            $user->save();

            Mail::to($user->email)->send(new ForgetPassword($input));
        }
        return responseJSON_EMPTY_OBJECT(true, 'Vui lòng kiểm tra email để khôi phục mật khẩu');
    }

    public function postResetPassword(Request $request)
    {
        $token = $request->get('token');
        $password = $request->get('password');
        if(!$password || strlen($password) < 6){
            return responseJSON_EMPTY_OBJECT(false, 'Mật khẩu phải tối thiểu 6 ký tự', ERROR_CODE_REQUIRED_PASSWORD);
        }
        $data = decryptTokenForgotPassword($token);
        if(!$data['success']){
            return responseJSON_EMPTY_OBJECT(false, $data['message']);
        }
        $model = (new $data['model']())->where($data['field'], $token)->first();
        if(!$model){
            return responseJSON_EMPTY_OBJECT(false, "Liên kết không hợp lệ hoặc bị lỗi, vui lòng thử lại sau!");
        }
        $model->update(['password' => $password, $data['field'] => '']);
        return responseJSON_EMPTY_OBJECT(true, 'Thay đổi mật khẩu thành công!');
    }
}
