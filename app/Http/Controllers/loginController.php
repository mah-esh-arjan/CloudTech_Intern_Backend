<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class loginController extends Controller
{
    public function LoginView() {
        return view('login');
    }

    public function LoginClick(Request $request) {
        $request -> input("name");
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            if ($user->Registered) {
                return 'This is dashboard';
            }
            else{
                return 'This is error';
            }
        }
    }
}
