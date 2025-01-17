<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;


class DatabaseController extends Controller
{
    public function index() {
        $users = DB::table('users')->get();
        return view('/day2Blade.testDatabase',[
            'users' => $users
        ]);
    }
}
