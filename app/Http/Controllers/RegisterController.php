<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function ViewForm() {
        return view('/FormValidation.RegisterForm');
    }

    public function ClickSubmit(Request $request) {
        $validated = $request->validate([
            'name' => 'required',
            'password' => 'required|min:6',
            'age' => 'required|integer|min:18'
        ],[
            'name.required' => 'Please put your name',
            'password.min' => 'Sorry, your password must be more than 6 characters.',
            'age.integer' => 'Age must be a number.',
            'age.min' => 'You must be over 18 to register.'
        ]);


       session()->flash('message', 'User was Registered!');
       return redirect('/register');
        
    }
}
