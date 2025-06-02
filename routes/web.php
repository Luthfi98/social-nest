<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Cms\MenuController;
use App\Http\Controllers\Cms\RoleController;
use App\Http\Controllers\Cms\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Landing\HomeController;
use App\Http\Controllers\Cms\DashboardController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/login', [LoginController::class, 'index']);

Route::prefix('cms')->name('cms.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);

    Route::get('sorting-menus', [MenuController::class, 'sorting'])->name('menus.sorting');
    Route::post('update-menu-sorting', [MenuController::class, 'updateSorting'])->name('menus.update-sorting');
    Route::resource('menus', MenuController::class);
});
// Route::get('/login', [LoginController::class, 'index']);

