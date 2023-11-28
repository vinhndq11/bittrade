<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Datatable;

class HackerController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->logMethods = ['store', 'destroy', 'update'];
    }

    public function datatable()
    {
        Datatable::getInstance()->builder = Datatable::getInstance()
            ->initBuilder($this->query)
            ->getBuilder();
        return parent::datatable();
    }
}
