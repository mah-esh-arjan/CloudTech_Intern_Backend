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

        if (Gate::allows('isAdmin')) {
            return redirect('/admin-dashboard');

        } elseif (Gate::allows('isClient')) {
            return redirect('/client-dashboard');
            
        } elseif (Gate::allows('isReader'))
            return redirect('/reader-dashboard');
    }

    public function viewAdmin()
    {
        return view('/auth.admin');
    }

    public function viewClient()
    {
        return view('/auth.client');
    }

    public function viewReader()
    {
        return view('/auth.reader');
    }
}
