<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/signUp',[UserController::class,'getSignUpForm'])->name('signUp');
Route::post('/signUp',[UserController::class,'signUp'])->name('post.signUp');

Route::get('/login',[UserController::class,'getLoginForm'])->name('login');
Route::post('/login',[UserController::class,'login'])->name('post.login');
Route::get('/logout', [UserController::class,'logout'])->name('logout');

Route::get('/catalog', [ProductController::class,'getCatalog'])->name('catalog');

Route::middleware(['auth'])->get('/cart', [UserProductController::class,'cart'])->name('cart');
Route::post('/addUserProduct', [UserProductController::class,'addUserProduct'])->name('addUserProduct');
Route::post('/removeUserProduct', [UserProductController::class,'removeUserProduct'])->name('removeUserProduct');

Route::middleware(['auth'])->get('/profile', [UserController::class,'getProfile'])->name('profile');
Route::middleware(['auth'])->get('/editProfile', [UserController::class,'editProfile'])->name('editProfile');
Route::middleware(['auth'])->post('/editProfile', [UserController::class,'editProfile'])->name('post.editProfile');

Route::middleware(['auth'])->get('/checkoutForm', [OrderController::class,'getCheckoutForm'])->name('checkoutForm');
Route::middleware(['auth'])->post('/createOrder', [OrderController::class,'getOrderForm'])->name('createOrder');
Route::get('/product/{id}', [ProductController::class,'getProduct']);
