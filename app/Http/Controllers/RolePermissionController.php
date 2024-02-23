<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends BaseController
{
    public function __construct()
    {
        $this->model = Permission::class;
        $this->relation = [];
        $this->allowedFilters = ['query'];
        $this->allowedIncludes = ['roles'];
        $this->allowedSorts = ['id'];
    }

    public function searchColumns(): array
    {
        return [
            'permissions.name'
        ];
    }


    function updatePermissionForRole(Request $request)
    {
        // dd($request->all());
        $role = Role::findOrFail($request->role_id);
        return $role->givePermissionTo($request->permission_name);
    }

    function revokePermissionForRole(Request $request)
    {
        $role = Role::findOrFail($request->role_id);
        return $role->revokePermissionTo($request->permission_name);
        // $permission = Permission::findById($permissionId);
        // $permission->delete();
    }
}
