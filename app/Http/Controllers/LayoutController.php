<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LayoutController extends Controller
{
    public function ContactLayout() {
        $var1 = "one ";
        $var2 = "<script>alert('trying something new'); </script>";
        return view ('contact',['var1' => $var1, 'var2' => $var2]);
    }
}
