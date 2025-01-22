<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\DatabaseController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\StudentController;
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


Route::controller(loginController::class)->group(function(){
    Route::get('/login','LoginView');
    Route::post('/login','LoginClick');
});

Route::controller(RegisterController::class)->group(function(){
    Route::get('/register','ViewForm');
    Route::post('/register','ClickSubmit');

});


Route::get('/student-register', [StudentController::class,'ViewStudentForm']);

Route::post('/student-register',[StudentController::class,'registerStudent'])->name('registerStudent');

Route::get('/student-list',[StudentController::class,'viewStudents']);

Route::get('/edit_student/{student_id}',[StudentController::class,'edit_student']);

Route::post('/update_data/{student_id}',[StudentController::class,'update_data']);

Route::get('/delete_student/{student_id}',[StudentController::class,'delete_student']);

Route::get('/student/{student_id}/profile', function ($student_id) {
    $student = Student::findOrFail($student_id); 
    $profile = $student->profile; 

    dd($profile);
});