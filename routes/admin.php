<?php

use App\Http\Controllers\Backend\CarouselController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->as('admin.')->middleware(['auth', 'admin'])->group(function () {

    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    Route::resource('products', ProductController::class);
    Route::resource('users', UserController::class);    


    Route::prefix('product-category')->as('product-category.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::post('/store', [CategoryController::class, 'store'])->name('store');
        Route::put('/edit/{id}', [CategoryController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [CategoryController::class, 'delete'])->name('delete');
    });

    Route::prefix('carousel')->as('carousel.')->group(function () {
        Route::get('/', [CarouselController::class, 'index'])->name('index');
        Route::post('/store', [CarouselController::class, 'store'])->name('store');
        Route::put('/edit/{id}', [CarouselController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [CarouselController::class, 'delete'])->name('delete');
    });

    Route::prefix('user')->as('user.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::put('/edit/{id}', [UserController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [UserController::class, 'delete'])->name('delete');
    });


});