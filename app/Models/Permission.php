<?php

namespace App\Models;

use App\Traits\ModelTrait;
use Laratrust\Models\LaratrustPermission;

class Permission extends LaratrustPermission
{
    use ModelTrait;

    protected $fillable = [
        'name',
        'display_name',
        'description'
    ];
}
