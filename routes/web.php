<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HeaderController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\TestController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\RazorpayController;
use App\Http\Controllers\Admin\StudentsController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\ExamController;
use App\Http\Controllers\Website\SliderController;
use App\Http\Controllers\Website\ClassController;
use App\Http\Controllers\Website\WebsiteController;


Route::get('/', [WebsiteController::class, 'index']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('User.Dashboard');
    })->name('dashboard');
});
////////////// Admin Route /////////////////
Route::middleware('admin:admin')->group(function () {
    Route::get('admin/login', [AdminController::class, 'loginForm']);
    Route::POST('admin/login', [AdminController::class, 'store'])->name('admin.login');
});


Route::middleware(['auth:sanctum,admin', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/admin/Dashboard', function () {
        return view('Admin.Dashboard');
    })->name('dashboard')->middleware('auth:admin');


    Route::get('/Header', [HeaderController::class, 'index'])->name('HeaderShow')->middleware('auth:admin');
    Route::resource('Subject', SubjectController::class)->middleware('auth:admin');
    Route::Post('/edit-subject', [SubjectController::class, 'update'])->name('editSubject')->middleware('auth:admin');
    Route::Post('/delete-subject', [SubjectController::class, 'destroy'])->name('deleteSubject')->middleware('auth:admin');
    //test
    Route::resource('Test', TestController::class)->middleware('auth:admin');
    Route::resource('Question', QuestionController::class)->middleware('auth:admin');
    Route::get('/delete-ans', [QuestionController::class, 'removeAns'])->name('removeAns')->middleware('auth:admin');
    Route::POST('/import-qna', [QuestionController::class, 'import'])->name('import')->middleware('auth:admin');

    Route::get('/get-questions', [QuestionController::class, 'getQuestion'])->name('getQuestion')->middleware('auth:admin');
    Route::POST('/add-qna', [QuestionController::class, 'addQuestion'])->name('addQuestion')->middleware('auth:admin');
    Route::get('/show-questions', [QuestionController::class, 'showQuestion'])->name('showQuestion')->middleware('auth:admin');
    Route::get('/show-students', [StudentsController::class, 'index'])->name('Students')->middleware('auth:admin');
});
/////////////////// User Route ///////////////////////////
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::get('/exam/{id}', [ExamController::class, 'index'])->name('loadExam');
    Route::POST('/exam-submit', [ExamController::class, 'examSubmit'])->name('examSubmit');
});

Route::get('/examregistration/{id}', [TestController::class, 'examregistrationshow'])->name('examregistration');
Route::POST('/registration/{id}',[TestController::class,'examregistrationstore'])->name('test.register');

Route::name('razorpay.')
    ->controller(RazorpayController::class)
    ->prefix('razorpay')
    ->group(function () {
        Route::view('payment', 'razorpay.index')->name('create.payment');
        Route::post('handle-payment', 'handlePayment')->name('make.payment');
    });

Route::get('/otp-verification', [UserController::class, 'Verification'])->name('Verification');

Route::get('user/register',[UserController::class,'create'])->name('user.regiter');

///////////////////// Website Route ////////////////////

Route::resource('image', SliderController::class)->middleware('auth:admin');
Route::resource('classes', ClassController::class)->middleware('auth:admin');
Route::get('contact',[WebsiteController::class,'contact'])->name('contact');
Route::get('contact/{id}',[WebsiteController::class,'contactEdit'])->name('contactedit');
Route::post('contact/update/{id}',[WebsiteController::class,'contactUpdate'])->name('contactupdate');

Route::get('link',[WebsiteController::class,'Link'])->name('link');
Route::post('link/save',[WebsiteController::class,'LinkStore'])->name('linkstore');
Route::get('link/{id}',[WebsiteController::class,'LinkEdit'])->name('linkedit');
Route::post('link/update/{id}',[WebsiteController::class,'LinkUpdate'])->name('linkupdate');

Route::GET('image/publish/{id}', [SliderController::class, 'publish'])->name('publish');
Route::GET('image/unpublish/{id}', [SliderController::class, 'unpublish'])->name('unpublish');
