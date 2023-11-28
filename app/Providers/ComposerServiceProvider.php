<?php

namespace App\Providers;

use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Global composer
        View::composer('*', function (\Illuminate\View\View $view) {
            $locales = config('translatable.locales');
            $view->with('composerLocales', $locales);
            $view->with('composerLocale', app()->getLocale());
        });


        if(!app()->runningInConsole()){
            $time_exp = Carbon::now()->addDays(30);
            $setting = Cache::get(CACHE_SETTING, function () use ($time_exp) {
                $default = Setting::query()->orderBy('key')->pluck('value', 'key')->toArray();
                Cache::add(CACHE_SETTING, $default, $time_exp);
                return $default;
            });

            view()->share([
                'share_setting' => $setting,
            ]);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
