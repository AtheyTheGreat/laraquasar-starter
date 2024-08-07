<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\ProjectController;
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

Route::get('/', [PageController::class, 'homePage'])->name('home');

Route::get('project', [PageController::class, 'projectHomePage'])->name('project');
Route::get('/projects-by-tag', [ProjectController::class, 'getProjectsByTag'])->name('filter-projects-by-tag');
Route::get('about', [PageController::class, 'aboutHomePage'])->name('about');
Route::get('contact', [PageController::class, 'contactHomePage'])->name('contact');
Route::get('services', [PageController::class, 'serviceHomePage'])->name('services');
Route::get('client', [PageController::class, 'clientHomePage'])->name('client');
Route::get('project/{id}', [PageController::class, 'projectPage'])->name('projects.show');
Route::get('service/{id}', [PageController::class, 'servicePage'])->name('services.show');



Route::get('/login', function () {
    return view('auth/login');
})->name('login');

Route::post('user-login', [UserController::class, 'login'])->name('user.login');
Route::get('user-logout', [UserController::class, 'logout'])->middleware('auth:sanctum')->name('user.logout');


Route::get('/admin/{any?}', function () {
    return view('layout/admin');
})->where("any", ".*")->middleware('auth:sanctum');