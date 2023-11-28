<?php

namespace App\Http\Controllers\Api;

use App\Mail\ForgetPassword;
use App\Mail\VerifyRegister;
use App\Models\BaseModel;
use App\Models\Member;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

/**
 * @property Member $user
 * @property Builder|BaseModel $mainModel
 * @property BaseModel|Product|Member|Color|mixed $query
 */
class BaseController extends Controller
{
    protected $env = 'dev';
    protected $config = [];
    protected $lang;
    protected $limit;
    protected $user;

    protected $mainModel;
    protected $mainId;
    protected $query;
    protected $includeResponse = [];

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->limit = (int)($request->limit ?? 10);
            $this->query = $this->mainModel;
            if($id = $request->{$this->mainId}){
                $this->query = $this->mainModel->find($id);
                if(!$this->query){
                    return response(responseJSON_EMPTY_OBJECT(false, "Not found {$this->mainId} = {$id}", ERROR_CODE_NO_EXIST_DATA));
                }
            }
            return $next($request);
        });

        $this->config['env'] = $this->env = env('APP_ENV', 'developer');
    }

    /**
     * @api Get config
     * @return array
     */
    public function getConfig()
    {
        return responseJSON($this->config);
    }

    /**
     * @api Get list objects
     * @return array
     */
    public function getList()
    {
        $list = $this->mainModel->responseSpecial($this->query);
        return responseJSON($list);
    }

    /**
     * @api Get object detail
     * @return array
     */
    public function getDetail()
    {
        $object = $this->query;
        return responseJSON($object->responseModel());
    }

    /**
     * @api Gửi yêu cầu lấy lại mật khẩu
     * @param Request $request
     * @return array
     */
    public function postForgetPassword(Request $request)
    {
        $email = $request->get('email');
        $user = $this->user->where('email',$email)->where('status',1)->first();
        if (!empty($user))
        {
            $token = genTokenForgotPassword($user->email, $this->user->getTable());

            $input['name'] = $user->name;
            $input['link'] = route('api.get_reset_password', ['token' => $token]);

            $user->reset_token = $token;
            $user->save();

            Mail::to($user->email)->send(new ForgetPassword($input));
        }
        return responseJSON_EMPTY_OBJECT();
    }

    /**
     * @api Hiển thị view phục hồi mật khẩu
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getResetPassword(Request $request)
    {
        $token = $request->get('token');
        $result = getTokenForgotPassword($token);
        if ($result['success'])
            return view('mail.reset_password', ['email' => $result['email'], 'token' => $token, 'table' => $result['table']]);
        return view('mail.notify')->with('error','Link cập nhật mật khẩu không hợp lệ hoặc đã hết hạn');
    }

    /**
     * @api Cập nhật mật khẩu mới từ link quên mật khẩu của email
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function postResetPassword(Request $request)
    {
        $token = $request->get('token');
        $new_password = $request->get('new_password');
        $email = $request->get('email');

        if('partner' === $request->get('table'))
            $user = Partner::where('email', $email)->where('reset_token', $token)->first();
        else
            $user = Member::where('email', $email)->where('reset_token', $token)->first();

        if (!empty($user) && !empty($token))
        {
            $user->password = $new_password;
            $user->reset_token = null;
            if ($user->save())
            {
                session()->flash('success','Mật khẩu đã được thay đổi thành công, bạn có thể đăng nhập bằng mật khẩu mới ngay bây giờ');
                return view('mail.notify');
            }
        }
        session()->flash('error', 'Mã bảo vệ hết hạn hoặc không đúng, vui lòng thử lại!');
        return view('mail.notify');
    }

    /**
     * @api Gửi email chứa OTP xác thực
     * @param Request $request
     * @return array
     */
    public function postVerify(Request $request)
    {
        if(!$email = $request->get('email'))
            return responseJSON_EMPTY_OBJECT(false,'Require email',ERROR_CODE_REQUIRED_EMAIL);

        if($this->user->where('email',$email)->exists())
            return responseJSON_EMPTY_OBJECT(false,'Already exists account',ERROR_CODE_ALREADY_EXISTS);

        $otp = generateOTP();
        Mail::to($email)->send(new VerifyRegister($otp));
        return responseJSON(compact('otp'));
    }

    /**
     * @api Cập nhật thông tin nhận email và push notification
     * @param Request $request
     * @return array
     */
    public function putSetting(Request $request)
    {
        if(!is_null($email_notification = $request->get('email_notification')))
            $this->user->email_notification = $email_notification;

        if(!is_null($push_notification = $request->get('push_notification')))
            $this->user->push_notification = $push_notification;

        $this->user->save();
        return responseJSON_EMPTY_OBJECT();
    }
}
