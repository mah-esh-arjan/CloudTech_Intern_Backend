<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DummyAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get("data", [DummyAPIController::class, 'getData']);

Route::post("createMovie", [DummyAPIController::class, 'postData']);

Route::get('/get-movie/{id}', [DummyAPIController::class, 'getMovie']);


Route::post('/test-token/create', function () {
    $user = User::find(1);
    $token = $user->createToken('test-token')->plainTextToken;

    return response()->json(['token' => $token]);
});


Route::post('/login',[AuthController::class,'login']);
Route::middleware('auth:sanctum')->get('user', [AuthController::class,'getUser']);