<?php

namespace App\Models;

class DistrictTranslation extends BaseModel
{
    protected $fillable = [
        'name',
        'prefix'
    ];

    public $timestamps = false;
}
