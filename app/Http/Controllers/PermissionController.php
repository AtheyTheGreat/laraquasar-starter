<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends BaseController
{
    public function __construct()
    {
        $this->model = Permission::class;
        $this->relation = [];
        $this->allowedFilters = [];
        $this->allowedIncludes = [];
        $this->allowedSorts = ['id'];
    }

    public function index($id = null)
    {
        $collection = Permission::all();
        return response(['data' => $collection], 200);
    }

    public function getRolePermissions($id)
    {
        $rolePermissions = Role::findOrFail($id)->permissions()->get();
        return $rolePermissions;
    }
}
