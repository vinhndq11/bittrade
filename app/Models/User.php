<?php

namespace App\Models;

use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;

/**
 * @mixin BaseModel
 */
class User extends Authenticatable
{
    use LaratrustUserTrait, SoftDeletes, ModelTrait;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'birthday',
        'gender',
        'is_active',
        'is_admin',
        'remember_token',
        'last_login'
    ];

    protected $dates = ['deleted_at', 'last_login'];
}
