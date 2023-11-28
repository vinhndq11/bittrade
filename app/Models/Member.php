<?php

namespace App\Models;

use Illuminate\Http\UploadedFile;

/**
 * @property string first_name
 * @property string last_name
 * @property string full_name
 * @property string display_name
 * @property string username
 * @property string email
 * @property string two_fa
 * @property string identity_number
 * @property string before_identity_card
 * @property string after_identity_card
 * @property int is_verify
 * @property int is_two_fa
 * @property int enable_sound
 * @property int is_show_balance
 * @property string otp
 * @property string password
 * @property string note
 * @property string reset_token
 * @property int email_notification
 * @property string current_point_type
 * @property double demo_balance
 * @property double real_balance
 * @property string user_mode
 * @property string ref_username
 */

class Member extends BaseModel
{
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'avatar',
        'two_fa',
        'identity_number',
        'before_identity_card',
        'after_identity_card',
        'is_active',
        'is_verify',
        'is_two_fa',
        'enable_sound',
        'is_show_balance',
        'otp',
        'password',
        'note',
        'reset_token',
        'last_login',
        'email_notification',
        'current_point_type',
        'trial_count',
        'expired_tool_at',
        'is_active_tool',
        'user_mode',
        'ref_username',
    ];

    public function setAvatarAttribute($value)
    {
        if($value instanceof UploadedFile) {
            $filename = $this->id . '_' . strtotime(now()) . '.' . $value->getClientOriginalExtension();
            $value->move(public_path("upload/images/avatar"), $filename);
            $value = "upload/images/avatar/{$filename}";
            if($this->avatar && file_exists(public_path($this->avatar))){
                unlink(public_path($this->avatar));
            }
        }
        $this->attributes['avatar'] = $value;
    }

    public function member_devices()
    {
        return $this->hasMany(MemberDevice::class);
    }

    public function member_transactions()
    {
        return $this->hasMany(MemberTransaction::class);
    }

    public function getRealBalanceAttribute()
    {
        return $this->member_transactions()->where('point_type', POINT_TYPE_REAL)
            ->balance();
    }

    public function getDemoBalanceAttribute()
    {
        return $this->member_transactions()->where('point_type', POINT_TYPE_DEMO)
            ->balance();
    }

    public function getFullNameAttribute()
    {
        if(!$this->first_name && !$this->last_name){
            return null;
        }
        return trim($this->first_name . ' ' . $this->last_name);
    }

    public function getDisplayNameAttribute()
    {
        return $this->full_name ?? "#{$this->username}";
    }

    public function ref()
    {
        return $this->belongsTo(self::class, 'ref_username', 'username');
    }

    public function children()
    {
        return $this->hasMany(self::class,'ref_username', 'username');
    }

    public function getUserModeLabelAttribute()
    {
        return trans("member.user_modes.{$this->user_mode}");
    }

    public function responseModel()
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'full_name' => $this->full_name,
            'display_name' => $this->display_name,
            'username' => $this->username,
            'email' => $this->email,
            'avatar' => assetResource($this->avatar),
            'is_active' => $this->is_active,
            'is_verify' => $this->is_verify,
            'is_two_fa' => $this->is_two_fa,
            'enable_sound' => $this->enable_sound,
            'is_show_balance' => $this->is_show_balance,
            'note' => $this->note,
            'last_login' => $this->last_login,
            'email_notification' => $this->email_notification,
            'current_point_type' => $this->current_point_type,
            'real_balance' => $this->real_balance,
            'demo_balance' => $this->demo_balance,
            'user_mode' => $this->user_mode,
            'ref_username' => $this->ref_username,
            'login_token' => \DataSingleton::getInstance()->getToken()
        ];
    }
}
