<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class Setting extends BaseModel
{
    protected $fillable = ['value'];

    public static function content($key, $default = null)
    {
        $setting = Cache::get(CACHE_SETTING, function() {
            $time_exp = Carbon::now()->addDays(30);
            $default = self::orderBy('key')->pluck('value','key')->toArray();
            Cache::add(CACHE_SETTING, $default, $time_exp);
            return $default;
        });
        return $setting[$key] ?? $default;
    }
}
