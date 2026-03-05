<?php

use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\API\BookController;
use App\Http\Controllers\API\RegisterAPIController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DummyAPIController;
use App\Http\Controllers\API\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Events\TestMessage;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// WebSocket test endpoints for React frontend
Route::post('/broadcast-test', function (Request $request) {
    $message = $request->input('message', 'Test message from React at ' . now());
    
    broadcast(new TestMessage($message));
    
    return response()->json([
        'success' => true,
        'message' => 'Event broadcasted',
        'data' => ['message' => $message],
        'timestamp' => now()
    ]);
});

Route::get('/websocket-config', function () {
    return response()->json([
        'broadcaster' => 'reverb',
        'key' => env('REVERB_APP_KEY', 'local'),
        'wsHost' => env('REVERB_HOST', '127.0.0.1'),
        'wsPort' => env('REVERB_PORT', 8080),
        'forceTLS' => false,
        'disableStats' => true,
    ]);
});

Route::get("data", [DummyAPIController::class, 'getData']);

Route::post("createMovie", [DummyAPIController::class, 'postData']);

Route::get('/get-movie/{id}', [DummyAPIController::class, 'getMovie']);


Route::post('/login', [AuthController::class, 'login']);
Route::get('/users', [AuthController::class, 'getUser']);
Route::delete('/users/{id}', [AuthController::class, 'deleteUser']);
Route::get('/restore/{id}',  [AuthController::class, 'restore']);

Route::post('/user-register', [RegisterAPIController::class, 'store']);


// student related routes
Route::post('/student-register', [StudentController::class, 'registerStudent']);
Route::post('/student-login', [StudentController::class, 'loginStudent']);

// proctected route accessible by admin token and student token
Route::middleware(['auth:sanctum', 'checkAbilities:student-access,admin-access'])->group(function () {

    Route::get('/student-book-list/{student_id}', [StudentController::class, 'getStudentBooks']);
    Route::get('/student-book/{student_id}', [StudentController::class, 'getRentBooks']);
    Route::post('/student-book/{student_id}', [StudentController::class, 'rentBook']);
    Route::get('/students-show/{student_id}', [AdminController::class, 'showStudent']);
    Route::put('/student-update/{student_id}', [AdminController::class, 'updateStudent']);
});

// admin related routes

Route::post('/admin-register', [AdminController::class, 'registerAdmin']);
Route::post('/admin-login', [AdminController::class, 'adminLogin']);

// protected only by admin token
Route::middleware(['auth:sanctum', 'ability:admin-access'])->group(function () {
    Route::get('/students-list', [AdminController::class, 'getStudents']);
    Route::delete('/student-delete/{student_id}', [AdminController::class, 'deleteStudent']);
    Route::get('/books-list', [BookController::class, 'getBooks']);
    Route::post('/book-create', [BookController::class, 'createBook']);
    Route::get('/book-show/{id}', [BookController::class, 'showBook']);
    Route::put('/book-update/{id}', [BookController::class, 'updateBook']);
    Route::delete('/book-delete/{id}', [BookController::class, 'deleteBook']);
});
