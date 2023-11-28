<?php

namespace App\Models;

class WardTranslation extends BaseModel
{
    protected $fillable = [
        'name',
        'prefix'
    ];

    public $timestamps = false;
}
