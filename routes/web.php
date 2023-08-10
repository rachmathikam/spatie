<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::middleware(['permission:user-create'])->group(function () {
    Route::get('/create', [App\Http\Controllers\HomeController::class, 'create'])->name('users.create');
    Route::post('/store', [App\Http\Controllers\HomeController::class, 'store'])->name('users.store');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/edit/{id}', [App\Http\Controllers\HomeController::class, 'edit'])->name('users.edit');
Route::get('/delete/{id}', [App\Http\Controllers\HomeController::class, 'delete'])->name('users.delete');
Route::post('/update', [App\Http\Controllers\HomeController::class, 'update'])->name('users.update');
Route::get('/role_permission', [App\Http\Controllers\HomeController::class, 'rolePermission'])->name('role.permission');
Route::post('/role_permission', [App\Http\Controllers\HomeController::class, 'addPermissionToRole'])->name('role.addpermission');

Route::get('/role', [App\Http\Controllers\RoleController::class, 'index'])->name('role');
Route::get('/role_create', [App\Http\Controllers\RoleController::class, 'create'])->name('role.create');
Route::get('/role_edit/{id}', [App\Http\Controllers\RoleController::class, 'edit'])->name('role.edit');
Route::post('/role', [App\Http\Controllers\RoleController::class, 'store'])->name('role.store');
Route::post('/role_update', [App\Http\Controllers\RoleController::class, 'update'])->name('role.update');
Route::get('/role_delete/{id}', [App\Http\Controllers\RoleController::class, 'delete'])->name('role.delete');

Route::get('/permission', [App\Http\Controllers\PermissionController::class, 'index'])->name('permission');
Route::get('/permission_create', [App\Http\Controllers\PermissionController::class, 'create'])->name('permission.create');
Route::post('/permission_store', [App\Http\Controllers\PermissionController::class, 'store'])->name('permission.store');
Route::get('/permission_edit/{id}', [App\Http\Controllers\PermissionController::class, 'edit'])->name('permission.edit');
Route::post('/permission_update', [App\Http\Controllers\PermissionController::class, 'update'])->name('permission.update');
Route::get('/permission_delete/{id}', [App\Http\Controllers\PermissionController::class, 'delete'])->name('permission.delete');





