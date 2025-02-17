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
Route::get('/users', [AuthController::class, 'getUser']);
Route::delete('/users/{id}', [AuthController::class, 'deleteUser']);
Route::get('/restore/{id}',  [AuthController::class, 'restore']);

Route::post('/user-register', [RegisterAPIController::class, 'store']);

Route::post('/student-register', [StudentController::class, 'registerStudent']);
Route::post('/student-login', [StudentController::class, 'loginStudent']);
Route::middleware(['auth:sanctum', 'token'])->controller(StudentController::class)->group(function () {
    Route::get('/students-list', 'getStudents');
    Route::get('/students-show/{student_id}', 'showStudent');
    Route::put('/student-update/{student_id}', 'updateStudent');
    Route::delete('/student-delete/{student_id}', 'deleteStudent');
});

