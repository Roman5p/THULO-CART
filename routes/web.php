<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\CartController;

// Route::get('/', function () {
// return view('welcome');
// });

Route::get('/', [HomeController::class,'index'])->name('index');
Route::get('/product-details/{id}', [HomeController::class, 'productDetails'])->name('productDetails');
Route::get('/aboutus', [HomeController::class, 'aboutus'])->name('aboutus');
Route::get('/contactus', [HomeController::class, 'contact'])->name('contact');
Route::get('/checkout', [HomeController::class, 'checkout'])->name('checkout');
Route::post('/checkout/store',[HomeController::class,'storeCheckout'])->name('checkout.store');
Route::get('/payment', [HomeController::class, 'payment'])->name('payment');

//Carts

Route::get('/carts', [CartController::class, 'getCarts'])->name('getcarts');
Route::post('/cart/store/{pid}/{quantity?}', [CartController::class, 'addtoCart'])->name('addtoCart');
Route::delete('/cart/delete/{id}', [CartController::class, 'delete'])->name('deleteCart');

// Route::get('/dashboard', function () {
// return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/confirm/{id}',[HomeController::class,'getConfirm'])->name('getConfirm');

require __DIR__.'/auth.php';
require __DIR__ . '/admin.php';