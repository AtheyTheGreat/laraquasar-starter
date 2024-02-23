<?php

namespace App\Http\Controllers;

use App\Models\Role as ModelsRole;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends BaseController
{
    public function __construct()
    {
        $this->model = ModelsRole::class;
        $this->relation = [];
        $this->allowedFilters = ['query'];
        $this->allowedIncludes = ['permissions'];
        $this->allowedSorts = ['name'];
    }

    public function searchColumns(): array
    {
        return [
            'roles.name'
        ];
    }

    public function getPermissions()
    {
        return Permission::all();
    }

    public function getRoles()
    {
        return Role::all();
    }
}
