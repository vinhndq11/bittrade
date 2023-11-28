<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Datatable;
use App\Models\Permission;
use App\Models\Role;

class RoleController extends BaseController
{
    public function __construct()
    {
        $this->sync = ['permissions'];
        parent::__construct();
        if (!app()->runningInConsole() && in_array(request()->route()->getActionMethod(), ['create', 'edit'])) {
            $permissions = Permission::all();
            view()->share(compact('permissions'));
        }
    }

    public function edit($id)
    {
        $mainData = $this->query->find($id);
        $grantedPermissions = $mainData->permissions->pluck('id')->toArray();
        view()->share(compact('grantedPermissions'));
        return parent::edit($id);
    }

    public function datatable()
    {
        Datatable::getInstance()->builder = Datatable::getInstance()
            ->initBuilder($this->query)
            ->getBuilder()
            ->addColumn('permission_count', function (Role $value){
                return $value->permissions()->count();
            });
        return parent::datatable();
    }
}
