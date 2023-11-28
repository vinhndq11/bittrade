<?php

namespace App\Models;

/**
 * @property Member member
 */
class MemberDevice extends BaseModel
{
    protected $fillable = [
        'member_id',
        'fcm_token',
        'device_type',
        'login_token'
    ];

    protected static function boot()
    {
        parent::boot();
        self::created(function (self $model){
            $model->member->update(['last_login' => now()]);
        });
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }
}
