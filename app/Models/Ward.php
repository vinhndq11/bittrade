<?php

namespace App\Models;

use Dimsav\Translatable\Translatable;

/**
 * @property int district_id
 * @property string prefix
 * @property string full_name
 */

class Ward extends BaseModel
{
    use Translatable;

    protected $fillable = [
        "district_id",
        "position"
    ];

    public $translatedAttributes = [
        'name',
        'prefix'
    ];

    public $timestamps = false;

    public function getFullNameAttribute()
    {
        return "{$this->prefix} {$this->name}";
    }

    public function responseModel()
    {
        return [
            'id'=>$this->id,
            'name'=> (string)($this->name),
            'prefix'=> (string)($this->prefix),
            'full_name' => $this->full_name,
        ];
    }
}
