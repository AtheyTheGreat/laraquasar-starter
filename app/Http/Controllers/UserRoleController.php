<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserRoleController extends Controller
{
    public function update(Request $request, $id, $relationId = null)
    {
        $user = User::findOrFail($id);
        $user->assignRole($relationId);
        return $this->respond("Role assigned!", 201);
    }
    public function destroy($id, $relationId = null)
    {
        $user = User::findOrFail($id);
        $role = Role::findOrFail($relationId);
        if (!$user->hasRole($role)) {
            throw new NotFoundHttpException('User does not have the specified role!');
        }
        if ($user->id == Auth::id() && $role->name == 'SUPER_USER' && $user->hasRole('SUPER_USER')) {
            throw new AuthorizationException('You are not authorized to make this request!');
        }
        $user->removeRole($role);
        return $this->respond('Role removed!', 204);
    }
}
