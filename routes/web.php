<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HeaderController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\TestController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\ExamController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('Website.index');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('User.Dashboard');
    })->name('dashboard');

});

Route::middleware('admin:admin')->group(function(){
    Route::get('admin/login',[AdminController::class,'loginForm']);
    Route::POST('admin/login',[AdminController::class,'store'])->name('admin.login');
});


Route::middleware(['auth:sanctum,admin',config('jetstream.auth_session'),'verified',])->group(function () {
    Route::get('/admin/Dashboard', function () {
        return view('Admin.Dashboard');
    })->name('dashboard')->middleware('auth:admin');


    Route::get('/Header',[HeaderController::class, 'index'])->name('HeaderShow')->middleware('auth:admin');
    Route::resource('Subject', SubjectController::class)->middleware('auth:admin');
    Route::Post('/edit-subject',[SubjectController::class, 'update'])->name('editSubject')->middleware('auth:admin');
    Route::Post('/delete-subject',[SubjectController::class, 'destroy'])->name('deleteSubject')->middleware('auth:admin');
    //test
    Route::resource('Test', TestController::class)->middleware('auth:admin');
    Route::resource('Question', QuestionController::class)->middleware('auth:admin');
    Route::get('/delete-ans',[QuestionController::class,'removeAns'])->name('removeAns')->middleware('auth:admin');
    Route::POST('/import-qna',[QuestionController::class,'import'])->name('import')->middleware('auth:admin');

    Route::get('/get-questions',[QuestionController::class,'getQuestion'])->name('getQuestion')->middleware('auth:admin');
    Route::POST('/add-qna',[QuestionController::class,'addQuestion'])->name('addQuestion')->middleware('auth:admin');
    Route::get('/show-questions',[QuestionController::class,'showQuestion'])->name('showQuestion')->middleware('auth:admin');

});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::get('/exam/{id}', [ExamController::class, 'index'])->name('loadExam');
});

Route::get('/register/students', [UserController::class, 'create'])->name('students.register');
Route::get('/signup/students', [UserController::class, 'signUp'])->name('students.signup');

