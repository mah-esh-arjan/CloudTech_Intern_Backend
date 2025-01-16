<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class loginController extends Controller
{
    public function LoginView() {
        return view('login');
    }

    // Below function not working properly
   /*  public function LoginClick(Request $request) {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            if ($user->Registered == 1) {
                return 'This is dashboard';
            }
            else{
                return redirect('/error');
            }
        }
    } */
}
