<?php

use App\Http\Controllers\westController;
use App\Http\Controllers\DatabaseController;
use App\Http\Controllers\loginController;
use App\Http\Middleware\RegisteredMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    
    return view('welcome');
});

Route::get('/hello',function() {
    return 'hello world';
});

Route::get('/html',function () {
    return '<h1> Hello from Html</h1>';
});

Route::get('/new',function () {

    return view ('new');
});

// Route::get('/testnew', function(){

//     return view ('testNew');
    
// });
Route::get('/testnew', [westController::class, 'index']);
Route::get('/error',function() {
    return view ('error');
});

Route::get('/dashboard',function() {
    return 'This is protected route';
})->middleware('ProtectedMiddleware');

Route::controller(loginController::class)->group(function(){
    Route::get('/login','LoginView');
    Route::post('/login','LoginClick');
});


Route::get('/testDatabase', [DatabaseController::class, 'index']);
