<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;
use App\Models\Purchasiner;
use App\Models\Product;

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
        Favorite::where("user_id",Auth::user()->id)->where("product_id",$request->product_id)->delete();
        return response()->json(["message" => "Product is deleted to favorite"]);
    }
    public function showAllProductsInFavorite(Request $request){
        return Auth::user()->favorite;
    }

    public  function addFromFavorite(Request $request){
        $amount=Product::find($request->product_id)->amount;
        if($request->quantity>$amount)
        {
            return response()->json(['message'=>"Not enough amount in store"], 400);
        }
        $Product_price=Product::find($request->product_id)->price;
        $price=$Product_price*$request->quantity;
        Purchasiner::create([
            "user_id"=>Auth::user()->id,
            "product_id"=>$request->product_id,
            "location"=>$request->location,
            "quantity"=>$request->quantity,
            "price"=>$price
        ]);
        $amount-=$request->quantity;
        Product::find($request->product_id)->update(["amount"=>$amount]);
    }
}
