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
        Purchasiner::create([
            "user_id"=>Auth::user()->id,
            "product_id"=>$request->product_id,
            "location"=>$request->location
        ]);
        $amount=Product::find($request->product_id)->amount;
        $amount--;
        Product::find($request->product_id)->update(["amount"=>$amount]);
    }

    public function myOrders(Request $request){
        return User::find(Auth::user()->id)->products;
    }

    public function delete(Request $request){
        $product_id=Purchasiner::find($request->purchasiner_id)->product_id;
        $amount=Product::find($product_id)->amount;
        $amount++;
        Product::find($product_id)->update(["amount"=>$amount]);
        Purchasiner::find($request->purchasiner_id)->delete();
    }

    public function update(Request $request){
        $old_id=Purchasiner::find($request->purchasiner_id)->product_id;
        $amount=Product::find($old_id)->amount;
        $amount++;
        Product::find($old_id)->update(["amount"=>$amount]);
        Purchasiner::find($request->purchasiner_id)->update([
            "product_id"=>$request->product_id,
            "location"=>$request->location
        ]);
        $amo=Product::find($request->product_id)->amount;
        $amo--;
        Product::find($request->product_id)->update(["amount"=>$amo]);
    }
}
