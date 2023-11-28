<?php

namespace App\Models;

use App\Traits\ModelTrait;
use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    use ModelTrait;

    protected $fillable = [
        'name',
        'display_name',
        'description'
    ];
}
