<?php

namespace App\Models;

use Dimsav\Translatable\Translatable;

class Country extends BaseModel
{
    use Translatable;

    protected $fillable = [
        'code',
        'position'
    ];

    public $translatedAttributes = [
        'name'
    ];

    public $timestamps = false;
}
