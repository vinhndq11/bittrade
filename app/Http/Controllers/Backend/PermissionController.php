<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Datatable;

class PermissionController extends BaseController
{
    public function __construct()
    {
        Datatable::getInstance()->ignoreDelete();
        parent::__construct();
    }
}
