<?php

use App\Http\Controllers\Backend\CarouselController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\OrderController;
use Illuminate\Support\Facades\Route;

// Admin routes group with prefix 'admin', named routes prefixed with 'admin.', 
// and middleware for authentication and admin authorization
Route::prefix('admin')->as('admin.')->middleware(['auth', 'admin'])->group(function () {

    // Dashboard route - GET request to show admin dashboard
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    // Resource route for products - automatically creates RESTful routes 
    // (index, create, store, show, edit, update, destroy)
    Route::resource('products', ProductController::class);
    
    // Resource route for users - automatically creates RESTful routes
    Route::resource('users', UserController::class);

    // Product category routes group with prefix 'product-category' 
    // and named routes prefixed with 'product-category.'
    Route::prefix('product-category')->as('product-category.')->group(function () {
        // GET route to list all product categories
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        // POST route to create/store a new product category
        Route::post('/store', [CategoryController::class, 'store'])->name('store');
        // PUT route to update an existing product category by ID
        Route::put('/edit/{id}', [CategoryController::class, 'update'])->name('update');
        // DELETE route to remove a product category by ID
        Route::delete('/delete/{id}', [CategoryController::class, 'delete'])->name('delete');
    });

    // Carousel routes group with prefix 'carousel' 
    // and named routes prefixed with 'carousel.'
    Route::prefix('carousel')->as('carousel.')->group(function () {
        // GET route to list all carousel items
        Route::get('/', [CarouselController::class, 'index'])->name('index');
        // POST route to create/store a new carousel item
        Route::post('/store', [CarouselController::class, 'store'])->name('store');
        // PUT route to update an existing carousel item by ID
        Route::put('/edit/{id}', [CarouselController::class, 'update'])->name('update');
        // DELETE route to remove a carousel item by ID
        Route::delete('/delete/{id}', [CarouselController::class, 'delete'])->name('delete');
    });

    // User management routes group with prefix 'user' 
    // and named routes prefixed with 'user.'
    Route::prefix('user')->as('user.')->group(function () {
        // GET route to list all users
        Route::get('/', [UserController::class, 'index'])->name('index');
        // POST route to create/store a new user
        Route::post('/store', [UserController::class, 'store'])->name('store');
        // PUT route to update an existing user by ID
        Route::put('/edit/{id}', [UserController::class, 'update'])->name('update');
        // DELETE route to remove a user by ID
        Route::delete('/delete/{id}', [UserController::class, 'delete'])->name('delete');
    });

    Route::prefix('/orders')->as('orders.')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('/{id}', [OrderController::class, 'details'])->name('show');
        Route::put('/{id}', [OrderController::class, 'update'])->name('update');
        Route::delete('/{id}', [OrderController::class, 'destroy'])->name('destroy');
    });
});
    