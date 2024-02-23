<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {


    Route::middleware(['can:roles.update'])->group(function () {
        Route::get('/permissions', [RoleController::class, 'getPermissions'])->name('permissions.index');
        Route::get('/roles', [RoleController::class, 'getRoles'])->name('roles.index');
        Route::get('/roles/{id}/permissions', [PermissionController::class, 'getRolePermissions'])->name('roles.permissions.index');
        Route::post('/roles/update', [RolePermissionController::class, 'updatePermissionForRole'])->name('roles.update');
        Route::post('/roles/revoke', [RolePermissionController::class, 'revokePermissionForRole'])->name('roles.revoke');
    });
});

Route::get('me', [UserController::class, 'me'])->middleware('auth:sanctum');