<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => 'auth'], function () {
    Route::resource('products', ProductController::class)->names('products');
    Route::get('/wishlist', [ProductController::class, 'getAllWishlistProducts'])->name('products.wishlist.index');
    Route::post('/products/wishlist/toggle/{product}', [ProductController::class, 'toggleWishlist'])->name('products.wishlist.toggle');
});

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::get('/users/wishlist/{user?}', [UserController::class, 'getAllWishlist'])->name('user.wishlist.index');
    Route::resource('users', UserController::class);
});
