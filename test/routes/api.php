<?php

use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post("register",[UserController::class,'register']);
Route::post("login",[UserController::class,'login']);
Route::post("logout",[UserController::class,'logout'])->middleware('auth:sanctum');


Route::get("showStores",[StoreController::class,'showStores']);
Route::get("showStore",[StoreController::class,'showStore']);



Route::get("showProducts",[ProductController::class,'showProducts']);
Route::get("searchProductInDashboard",[ProductController::class,'searchProductInDashboard']);
Route::get("searchProductInStore",[ProductController::class,"searchProductsInStore"]);

