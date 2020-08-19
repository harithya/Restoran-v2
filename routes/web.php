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

// admin module
Route::prefix('admin')->group(function () {
    // primary route
    Route::get('dashboard', 'Admin\DashboardController@index')->name('dashboard');
    // master
    Route::prefix('master')->group(function () {
        Route::resource('role', 'Admin\Master\RoleController', ['except' => ['create', 'edit']]);
        Route::resource('user', 'Admin\Master\UserController', ['except' => ['create', 'edit']]);
        Route::get('user/reset/{id}', 'Admin\Master\UserController@reset')->name('user.reset');
    });
});
