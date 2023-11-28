<?php

use \Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

Route::get('phpinfo-1204', function () {

});

Route::get('clear-all', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('config:clear');
    return 'Cleared cache, route, view, config successfully';
});

include 'web_backend.php';
include 'web_frontend.php';
