<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchasiner;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PurchasinerController extends Controller
{
    public  function add(Request $request){
        $lastPurchasiner = Purchasiner::latest('id')->first();
        $purchasiner_number = $lastPurchasiner ? $lastPurchasiner->id + 1 : 1;
        $content=$request->all();
        foreach($content as $json){
            $amount=Product::find($json["product_id"])->amount;
            if($json["quantity"]>$amount)
            {
                return response()->json(['message'=>"Not enough amount in store"], 400);
            }
            $Product_price=Product::find($json["product_id"])->price;
            $price=$Product_price*$json["quantity"];
            Purchasiner::create([
                "id"=>$purchasiner_number,
                "user_id"=>Auth::user()->id,
                "product_id"=>$json["product_id"],
                "location"=>$json["location"],
                "quantity"=>$json["quantity"],
                "orderState"=>$json["orderState"],
                "price"=>$price
            ]);
            $amount-=$json["quantity"];
            Product::find($json["product_id"])->update(["amount"=>$amount]);
    }
    }
    public function myOrders(Request $request){
        return User::find(Auth::user()->id)->orders;
    }

    public function delete(Request $request){
        $orders=Purchasiner::where("id",$request->purchasiner_id)->get();
        if($orders->count()==0){
            return response()->json(['message'=>"Order not found"], 404);
        }
        foreach($orders as $json){
            $amount=Product::find($json->product_id)->amount;
            $amount+=$json->quantity;
            Product::find($json->product_id)->update(["amount"=>$amount]);
            $json->delete();
        }
        return response()->json(['message'=>"Order deleted successfully"], 200);
    }
}
