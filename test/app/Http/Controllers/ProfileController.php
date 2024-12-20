<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function showProfile(Request $request){
        return response()->json([
            "first_name"=>Auth::user()->first_name,
            "last_name"=>Auth::user()->last_name,
            "image"=>Auth::user()->image,
        ]);
    }

    public function updateProfile(Request $request){
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'image'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        if($request->hasfile("image"))
            $image=$request->file('image')->store('public');
        else
            $image="";
        Auth::user()->update([
            "first_name"=>$request->first_name,
            "last_name"=>$request->last_name,
            "image"=>$image
        ]);
        return response()->json(['message' => 'Profile updated successfully'], 200);
    }
}
