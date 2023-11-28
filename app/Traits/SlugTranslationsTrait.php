<?php


namespace App\Traits;

trait SlugTranslationsTrait
{
    public static function findBySlug($slug, $with = [])
    {
        return self::whereTranslation('slug', $slug)->with($with)->first();
    }
}
