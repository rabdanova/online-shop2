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

Route::get('/catalog', [ProductController::class,'getCatalog'])->name('catalog');

Route::get('/Mail/testMail', [\App\Http\Controllers\TestMailController::class, 'send']);
Route::get('/test', [\App\Http\Controllers\TestMailController::class, 'receive']);
route::middleware(['auth'])->group(function () {

    Route::get('/logout', [UserController::class,'logout'])->name('logout');
    Route::get('/profile', [UserController::class,'getProfile'])->name('profile');
    Route::get('/editProfile', [UserController::class,'editProfile'])->name('editProfile');
    Route::post('/editProfile', [UserController::class,'editProfile'])->name('post.editProfile');

    Route::get('/product/{id}', [ProductController::class,'getProductPage'])->name('productPage');
    Route::post('/addReview', [ProductController::class,'addReview'])->name('addReview');

    Route::get('/cart', [UserProductController::class,'cart'])->name('cart');
    Route::post('/addUserProduct', [UserProductController::class,'addUserProduct'])->name('addUserProduct');
    Route::post('/removeUserProduct', [UserProductController::class,'removeUserProduct'])->name('removeUserProduct');

    Route::get('/checkoutForm', [OrderController::class,'getCheckoutForm'])->name('checkoutForm');
    Route::post('/createOrder', [OrderController::class,'getOrderForm'])->name('createOrder');
    Route::get('/userOrders', [OrderController::class,'getUserOrders'])->name('userOrders');
});



