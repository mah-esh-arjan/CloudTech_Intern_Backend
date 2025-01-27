<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request) {

        $user = User::where('email',$request->email)->first();

        if(!$user){
            return response()->json(['message' => 'User not found'], 404);
        }

        $token = $user->createToken('User')->plainTextToken;

        return response()->json(['token' => $token, 'message' => 'Token created sucessfully']);

    }

    public function getUser(Request $request){
        return response()->json([$request->user()]);
    }

}
