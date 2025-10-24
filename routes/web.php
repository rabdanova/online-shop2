<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/signUp',[UserController::class,'getSignUpForm']);
Route::post('/signUp',[UserController::class,'signUp']);

Route::get('/login',[UserController::class,'getLoginForm']);
Route::post('/login',[UserController::class,'login']);

Route::get('/catalog', [ProductController::class,'getCatalog']);
Route::get('/cart', [UserProductController::class,'cart']);
Route::post('/addUserProduct', [UserProductController::class,'addUserProduct']);
Route::post('/removeUserProduct', [UserProductController::class,'removeUserProduct']);
Route::get('/profile', [UserController::class,'getProfile']);
