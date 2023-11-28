<?php

namespace App\Models;

class CityTranslation extends BaseModel
{
    protected $fillable = [
        'name',
        'prefix'
    ];

    public $timestamps = false;
}
