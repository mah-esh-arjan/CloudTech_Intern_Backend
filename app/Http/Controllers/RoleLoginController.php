<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Customer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RoleLoginController extends Controller
{
    public function showRoleLoginForm()
    {

        return view('/auth.login');
    }

    public function roleLogin(Request $request)
    {

        $customer = Customer::where('name', $request->name)->first();

        if (!$customer) {
            return back()->withErrors(["message" => "Not found"]);
        }

        if ($customer->role !== $request->role) {
            return back()->withErrors(["message" => "You are not authorized"]);
        }

        Auth::login($customer);
        
        
        return redirect('/panel');
    }

    public function viewPanel()
    {
        if (Gate::allows('isRole','admin')){
            return view('auth.panel', ['role'=> 'admin']);
        }
        elseif (Gate::allows('isRole','client')){
            return view('auth.panel', ['role'=> 'client']);
        }
        elseif (Gate::allows('isRole','reader')){
            return view('auth.panel', ['role'=> 'reader']);
        }
        
        return response()->json(['message' => 'Unauthorized action.']);

    }
}
