<?php

namespace App\Http\Controllers;

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

    public function postData() {


    }

}
