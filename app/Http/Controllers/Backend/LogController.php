<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Datatable;
use App\Models\Log;

class LogController extends BaseController
{
    public function datatable()
    {
        Datatable::getInstance()->builder = Datatable::getInstance()
            ->addRawColumns(['user', 'message'])
            ->initBuilder($this->query)
            ->getBuilder()
            ->addColumn('user', function (Log $value) {
                $href = route('admin.user.edit', $value->user_id);
                return "<a href='{$href}' target='_blank'>{$value->user->name}</a>";
            })
            ->addColumns(['method_label', 'model_label'])
            ->editColumn('message', function (Log $value) {
                return "<b>[{$value->model_id}]</b> {$value->message}";
            });
        return parent::datatable();
    }
}
