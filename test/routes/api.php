<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PurchasinerController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\AdminMiddleware;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post("register",[UserController::class,'register']);
Route::post("login",[UserController::class,'login']);
Route::post("logout",[UserController::class,'logout'])->middleware('auth:sanctum');


Route::get("showStores",[StoreController::class,'showStores']);
Route::get("searchStore",[StoreController::class,'searchStore']);
Route::get("showStore",[StoreController::class,'showStore']);


Route::get("showProducts",[ProductController::class,'showProducts']);
Route::get("showProduct",[ProductController::class,'showProduct']);
Route::get("searchProductInDashboard",[ProductController::class,'searchProductInDashboard']);
Route::get("searchProductInStore",[ProductController::class,"searchProductsInStore"]);


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get("add",[PurchasinerController::class,"add"]);
    Route::get("myOrders",[PurchasinerController::class,"myOrders"]);
    Route::get("delete",[PurchasinerController::class,"delete"]);
    Route::get("update",[PurchasinerController::class,"update"]);


    Route::get("addStore",[AdminController::class,"addStore"])->middleware("adminOrNot");
    Route::get("addProduct",[AdminController::class,"addProduct"])->middleware("adminOrNot");

    Route::get("showProfile",[ProfileController::class,"showProfile"]);
    Route::get("updateProfile",[ProfileController::class,"updateProfile"]);
});



