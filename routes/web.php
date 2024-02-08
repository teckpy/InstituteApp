<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HeaderController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\TestController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\AdminController;

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
    })->name('dashboard');


    Route::get('/Header',[HeaderController::class, 'index'])->name('HeaderShow');
    Route::resource('Subject', SubjectController::class);
    Route::Post('/edit-subject',[SubjectController::class, 'update'])->name('editSubject');
    Route::Post('/delete-subject',[SubjectController::class, 'destroy'])->name('deleteSubject');
    //test
    Route::resource('Test', TestController::class);
    Route::resource('Question', QuestionController::class);
    Route::get('/delete-ans',[QuestionController::class,'removeAns'])->name('removeAns');
    Route::POST('/import-qna',[QuestionController::class,'import'])->name('import');

    Route::get('/get-questions',[QuestionController::class,'getQuestion'])->name('getQuestion');
    Route::POST('/add-qna',[QuestionController::class,'addQuestion'])->name('addQuestion');
    Route::get('/show-questions',[QuestionController::class,'showQuestion'])->name('showQuestion');

});



