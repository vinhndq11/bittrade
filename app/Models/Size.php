<?php

namespace App\Models;

use Dimsav\Translatable\Translatable;

class Size extends BaseModel
{
    use Translatable;
    protected $fillable = [
        'is_active'
    ];

    public $translatedAttributes = [
        'name'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_colors','color_id', 'product_id');
    }
}
