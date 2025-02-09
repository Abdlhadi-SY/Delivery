<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    public function showProfile(Request $request){
        return response()->json([
            "first_name"=>Auth::user()->first_name,
            "last_name"=>Auth::user()->last_name,
            "image"=>Auth::user()->image,
            "status"=>Auth::user()->status
        ]);
    }

    public function updateProfile(Request $request){
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'image'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        if($request->hasfile("image")){
            $name=$request->file('image')->getClientOriginalName();
            $image=$request->file('image')->storeAs('userImages',$name,"images");
        }
        else
            $image=Auth::user()->image;

        Auth::user()->update([
            "first_name"=>$request->first_name,
            "last_name"=>$request->last_name,
            "image"=>$image
        ]);
        return response()->json(['message' => 'Profile updated successfully'], 200);
    }

    public function deleteProfileImage(Request $request){
        File::delete(Auth::user()->image);
        Auth::user()->update([
            "image"=>""
        ]);
        return response()->json(["message"=>"Profile image deleted successfully"]);
    }
}
