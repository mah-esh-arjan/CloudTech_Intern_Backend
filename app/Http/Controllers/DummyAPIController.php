<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class DummyAPIController extends Controller
{
    public function getData()
    {

        return [
            "name" => "tester123",
            "email" => "tester@fmail.coe",
            "address" => "testerland"
        ];
    }

    public function postData(Request $request) {

        Movie::create([
            'name' => $request->name
        ]);

        return ["Response" =>"New movie Created"];
    }

    public function getMovie($id) {
        
        $data = Movie::find($id);

        return response()->json($data);

    }
}
