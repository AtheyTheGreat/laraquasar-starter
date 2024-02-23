<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth/login');
})->name('login');

Route::post('user-login', [UserController::class, 'login'])->name('user.login');
Route::get('user-logout', [UserController::class, 'logout'])->middleware('auth:sanctum')->name('user.logout');


Route::get('/admin/{any?}', function () {
    return view('layout/admin');
})->where("any", ".*")->middleware('auth:sanctum');