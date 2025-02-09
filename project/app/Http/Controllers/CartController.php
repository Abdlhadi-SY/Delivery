<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    public function addToCart(Request $request){
        $product=Product::find($request->product_id);
        Cart::create([
            "user_id"=>Auth::user()->id,
            "product_id"=>$product->id,
        ]);
    }
    public function showCart(){
        return response()->json([
            "orders"=>Auth::user()->cart,
        ]);
    }
}
