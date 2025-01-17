<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\westController;
use App\Http\Controllers\DatabaseController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\RegisterController;
use App\Http\Middleware\RegisteredMiddleware;
use App\Models\Student;
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

    return view ('/day2Blade.new');
});

// Route::get('/testnew', function(){

//     return view ('testNew');
    
// });
Route::get('/testnew', [westController::class, 'index']);
Route::get('/error',function() {
    return view ('/day2Blade.error');
});

Route::get('/dashboard',function() {
    return 'This is protected route';
})->middleware('ProtectedMiddleware');

Route::controller(loginController::class)->group(function(){
    Route::get('/login','LoginView');
    Route::post('/login','LoginClick');
});


Route::get('/testDatabase', [DatabaseController::class, 'index']);

Route::resource('/blogs', BlogController::class);

Route::get('/contact',[LayoutController::class, 'ContactLayout']);

Route::get('/contact2', function () {
    return view ('contact2');
});


Route::get('/card',function () {

    return view ('render.CardRender');

});

Route::get('/register',[RegisterController::class, 'ViewForm']);

Route::post('/register',[RegisterController::class, 'ClickSubmit']);

Route::get('/students', function(){

    $students= Student::all();
    echo"<pre>";
    print_r($students->toArray());
});


