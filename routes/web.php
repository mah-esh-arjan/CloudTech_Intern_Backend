<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\DatabaseController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RoleLoginController;
use App\Http\Controllers\StudentController;
use App\Http\Middleware\RegisteredMiddleware;
use App\Http\Middleware\RoleMiddleware;
use App\Models\Student;
use App\Models\Movie;
use App\Models\Category;
use App\Models\Image;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    return view('welcome');
});

Route::get('/hello', function () {
    return 'hello world';
});

Route::get('/html', function () {
    return '<h1> Hello from Html</h1>';
});

Route::get('/new', function () {

    return view('/day2Blade.new');
});

Route::get('/error', function () {
    return view('/day2Blade.error');
});

Route::get('/dashboard', function () {
    return 'This is protected route';
})->middleware('ProtectedMiddleware');

Route::controller(loginController::class)->group(function () {
    Route::get('/login', 'LoginView');
    Route::post('/login', 'LoginClick');
});

Route::get('/testDatabase', [DatabaseController::class, 'index']);

Route::resource('/blogs', BlogController::class);

Route::get('/contact', [LayoutController::class, 'ContactLayout']);

Route::get('/contact2', function () {
    return view('contact2');
});


Route::get('/card', function () {

    return view('render.CardRender');
});


Route::controller(loginController::class)->group(function () {
    Route::get('/login', 'LoginView');
    Route::post('/login', 'LoginClick');
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'ViewForm');
    Route::post('/register', 'ClickSubmit');
});


Route::controller(StudentController::class)->group(function (){
    Route::get('/student-register', 'ViewStudentForm');
    Route::post('/student-register', 'registerStudent')->name('registerStudent');
    Route::get('/student-list', 'viewStudents');
    Route::get('/edit_student/{student_id}', 'edit_student');
    Route::post('/update_data/{student_id}', 'update_data');
    Route::get('/delete_student/{student_id}', 'delete_student');

});


Route::get('/student/{student_id}/profile', function ($student_id) {
    $student = Student::findOrFail($student_id);
    $profile = $student->profile;

    dd($profile);
});

Route::get('/test-movie', function () {
    $movie = Movie::find(1);

    $movie->categories()->attach([1, 2]);

    return dd($movie->load('categories'));
});

Route::get('/test-image', function () {

    $student = Student::find(1); 


    $image = new Image([
        'url' => 'https://fastly.picsum.photos/id/237/200/300.jpg?hmac=TmmQSbShHz9CdQm0NkEjx1Dyh_Y984R9LpNrpvH2D_U',
        'imageable_id' => 1,
        'imageable_type' => Student::class,
    ]);


    $image->save();

    $student->image()->save($image);

    dd($student->image);
});

Route::get('/role-login', [RoleLoginController::class, 'showRoleLoginForm']);

Route::post('/role-login', [RoleLoginController::class, 'roleLogin']);


Route::get('/admin-dashboard', [RoleLoginController::class, 'viewAdmin'])->middleware('can:isAdmin');

Route::get('/client-dashboard', [RoleLoginController::class, 'viewClient'])->middleware('can:isClient');

Route::get('/reader-dashboard', [RoleLoginController::class, 'viewReader'])->middleware('can:isReader');


