<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Route::post('/product', [ProductController::class, 'store']);


Route::get("user",function(){
    return view("image");
});
