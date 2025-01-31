<?php

use App\Http\Controllers\API\RegisterAPIController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DummyAPIController;
use App\Http\Controllers\API\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get("data", [DummyAPIController::class, 'getData']);

Route::post("createMovie", [DummyAPIController::class, 'postData']);

Route::get('/get-movie/{id}', [DummyAPIController::class, 'getMovie']);


Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('user', [AuthController::class, 'getUser']);

Route::post('/user-register', [RegisterAPIController::class, 'store']);


Route::post('/student-login', [StudentController::class, 'loginStudent']);
Route::middleware('auth:sanctum')->get('/students-list', [StudentController::class, 'getStudents']);
Route::middleware('auth:sanctum')->post('/student-register', [StudentController::class, 'registerStudent']);
Route::middleware('auth:sanctum')->put('/student-update/{student_id}', [StudentController::class, 'updateStudent']);
Route::middleware('auth:sanctum')->delete('/student-delete/{student_id}', [StudentController::class, 'deleteStudent']);
