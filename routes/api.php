<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\RolePermissions\PermissionManagerController;
use App\Http\Controllers\RolePermissions\RoleManagerController;
use App\Http\Controllers\Shop\ProductController;
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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::post('permissions/attach', [PermissionManagerController::class, 'attach']);

Route::post('roles/assign', [RoleManagerController::class, 'assign']);
Route::post('roles', [RoleManagerController::class, 'create']);
Route::get('roles', [RoleManagerController::class, 'getAll']);

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::post('products', [ProductController::class, 'create']);
});

