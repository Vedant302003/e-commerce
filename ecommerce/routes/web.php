<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\Auth\AdminTwoFactorController;

// Admin Authentication Routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminLoginController::class, 'login']);

    Route::get('/verify', [AdminTwoFactorController::class, 'index'])->name('admin.verify');
    Route::post('/verify', [AdminTwoFactorController::class, 'store']);
    Route::post('/resend', [AdminTwoFactorController::class, 'resend'])->name('admin.resend');
});
