<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;

class favoriteController extends Controller
{
    public function addProductToFavorite(Request $request){
        Favorite::create([
            "user_id" => Auth::user()->id,
            "product_id" => $request->product_id
        ]);
        return response()->json(["message" => "Product is added to favorite"]);
    }
    public function removeProductFromFavorite(Request $request){
        Favorite::find($request->id)->delete();
        return response()->json(["message" => "Product is deleted to favorite"]);
    }
    public function showAllProductsInFavorite(Request $request){
        return Auth::user()->favorite;
    }

}
