<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HeaderController;
use App\Http\Controllers\Admin\SubjectController;

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
        return view('Admin.Dashboard');
    })->name('dashboard');
});

Route::get('/Header',[HeaderController::class, 'index'])->name('HeaderShow');



Route::resource('Subject', SubjectController::class);
Route::Post('/edit-subject',[SubjectController::class, 'update'])->name('editSubject');
Route::Post('/delete-subject',[SubjectController::class, 'destroy'])->name('deleteSubject');

