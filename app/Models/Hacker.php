<?php

namespace App\Models;

use Illuminate\Http\UploadedFile;

/**
 * @property string name
 * @property string email
 * @property int is_verify
 * @property string password
 * @property string note
 * @property string reset_token
 */

class Hacker extends BaseModel
{
    protected $fillable = [
        'name',
        'email',
        'avatar',
        'is_active',
        'is_verify',
        'password',
        'note',
        'reset_token',
        'last_login',
        'trial_count',
        'expired_tool_at',
        'is_active_tool',
        'user_mode',
        'ip',
        'user_agent',
        'allow_duplicate_ip',
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

    public function responseModel()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'avatar' => assetResource($this->avatar),
            'is_active' => $this->is_active,
            'is_verify' => $this->is_verify,
            'note' => $this->note,
            'last_login' => $this->last_login,
        ];
    }
}
