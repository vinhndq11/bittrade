<?php

namespace App\Models;

use Dimsav\Translatable\Translatable;

/**
 * @property string full_name
 * @property int shipping_fee
 * @property int shipping_available
 */

class City extends BaseModel
{
    use Translatable;

    protected $fillable = [
        "country_id",
        "position",
        'shipping_fee',
        'shipping_available',
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

    public function districts()
    {
        return $this->hasMany(District::class, 'city_id');
    }

    public function stores()
    {
        return $this->hasMany(Store::class);
    }
}
