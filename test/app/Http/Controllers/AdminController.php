<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\AdminMiddleware;

class AdminController extends Controller
{
    public function addStore(Request $request){
        Store::create([
            "name"=>$request->name,
            "location"=>$request->location,
            "image"=>$request->image
        ]);
    }
    public function addProduct(Request $request){
        Product::create([
            "name"=>$request->name,
            "store_id"=>$request->store_id,
            "description"=>$request->description,
            "amount"=>$request->amount,
            "price"=>$request->price,
            "image"=>$request->image
        ]);
    }
}
