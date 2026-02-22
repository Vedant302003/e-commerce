<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AdminLoginController;


Route::name('admin.')
    ->middleware(['auth:admin'])
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::get('/profile', function () {
            return view('admin.profile');
        })->name('profile');
         Route::post('/logout', [AdminLoginController::class, 'logout'])
            ->name('logout');
        Route::post('/update-name', [ProfileController::class, 'updateName'])
            ->name('update.name');

        Route::post('/change-password', [AdminLoginController::class, 'changePassword'])
            ->name('change.password');

        Route::prefix('products')
            ->name('products.')
            ->group(function () {
                Route::get('/', [ProductController::class, 'index'])->name('index');
                Route::get('/create', [ProductController::class, 'create'])->name('create');
                Route::post('/store', [ProductController::class, 'store'])->name('store');
                Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit');
                Route::put('/update/{id}', [ProductController::class, 'update'])->name('update');
                Route::delete('/delete/{id}', [ProductController::class, 'destroy'])->name('destroy');
            });

        Route::prefix('categories')
            ->name('categories.')
            ->group(function () {
                Route::get('/', [CategoryController::class, 'index'])->name('index');
                Route::post('/store', [CategoryController::class, 'store'])->name('store');
                Route::put('/update/{id}', [CategoryController::class, 'update'])->name('update');
                Route::delete('/delete/{id}', [CategoryController::class, 'destroy'])->name('destroy');
            });
    });