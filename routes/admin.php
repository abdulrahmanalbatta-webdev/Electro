<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RoleController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Auth\PermissionController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;



Route::prefix(LaravelLocalization::setLocale())->middleware(
    [
        'localize',
        'localizationRedirect',
        'localeSessionRedirect',
        'localeCookieRedirect',
        'localeViewPath',
        'auth',
        'verified'
        // 'isAdmin:admin'
    ]
)->group(function () {
    Route::get('/dashboard', function () {
        return view('backend.dashboard');
    })->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::get('/delete-image/{id?}', [ProductController::class, 'delete_image'])->name('delete_image');
    // Route::get('/orders', [AdminController::class, 'orders'])->name('orders');
    Route::resource('orders', OrderController::class);
    Route::get('/change_status/{status?}', [OrderController::class, 'change_status'])->name('change_status');
    Route::get('/payments', [AdminController::class, 'payments'])->name('payments');
    Route::get('/notifications', [AdminController::class, 'notifications'])->name('notifications');
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
});
