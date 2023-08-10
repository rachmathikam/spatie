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
Route::get('/permission', [App\Http\Controllers\HomeController::class, 'rolePermission'])->name('role.permission');
Route::post('/permission', [App\Http\Controllers\HomeController::class, 'addPermissionToRole'])->name('role.addpermission');



