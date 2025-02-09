<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PurchasinerController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\favoriteController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\CartController;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post("register",[UserController::class,'register']);
Route::post("login",[UserController::class,'login']);
Route::post("logout",[UserController::class,'logout'])->middleware('auth:sanctum');


Route::get("showStores",[StoreController::class,'showStores']);
Route::get("searchStore",[StoreController::class,'searchStore']);
Route::get("showStore",[StoreController::class,'showStore']);


Route::get("showProduct",[ProductController::class,'showProduct']);
Route::get("searchProductInDashboard",[ProductController::class,'searchProductInDashboard']);
Route::get("searchProductInStore",[ProductController::class,"searchProductInStore"]);
Route::get("showAllProducts",[ProductController::class,'showAllProducts']);



Route::middleware(['auth:sanctum'])->group(function () {

    Route::post("addToCart",[CartController::class,"addToCart"]);
    Route::get("showCart",[CartController::class,"showCart"]);




    Route::post("add",[PurchasinerController::class,"add"]);
    Route::get("myOrders",[PurchasinerController::class,"myOrders"]);
    Route::post("delete",[PurchasinerController::class,"delete"]);
    Route::post("update",[PurchasinerController::class,"update"]);



    Route::get("showProfile",[ProfileController::class,"showProfile"]);
    Route::post("updateProfile",[ProfileController::class,"updateProfile"]);
    Route::delete("deleteProfileImage",[ProfileController::class,"deleteProfileImage"]);


    Route::post("addProductToFavorite",[favoriteController::class,"addProductToFavorite"]);
    Route::delete("removeProductFromFavorite",[FavoriteController::class,"removeProductFromFavorite"]);
    Route::get("showAllProductsInFavorite",[FavoriteController::class,"showAllProductsInFavorite"]);
    Route::post("addFromFavorite",[FavoriteController::class,"addFromFavorite"]);


    Route::middleware(['adminOrNot'])->group(function () {
        Route::post("addStore",[AdminController::class,"addStore"]);
        Route::post("addProduct",[AdminController::class,"addProduct"]);
        });
});



