<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Cms\MenuController;
use App\Http\Controllers\Cms\RoleController;
use App\Http\Controllers\Cms\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Landing\HomeController;
use App\Http\Controllers\Cms\DashboardController;
use App\Http\Controllers\Auth\ForgotPasswordController;

Route::get('/', [HomeController::class, 'index'])->middleware('auth');

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::get('register', [RegisterController::class, 'index'])->name('register');
Route::post('register/store', [RegisterController::class, 'register'])->name('register.store');

Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('verify-email/{token}', [RegisterController::class, 'verifyEmail'])->name('email.verify');

Route::prefix('cms')->name('cms.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);

    Route::get('sorting-menus', [MenuController::class, 'sorting'])->name('menus.sorting');
    Route::post('update-menu-sorting', [MenuController::class, 'updateSorting'])->name('menus.update-sorting');
    Route::resource('menus', MenuController::class);
});

// Authentication Routes
Route::post('login', [LoginController::class, 'authenticate']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Password Reset Routes
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ForgotPasswordController::class, 'reset'])->name('password.update');

// Route::get('/login', [LoginController::class, 'index']);

