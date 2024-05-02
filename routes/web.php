<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\StudentsController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\TestController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\User\ExamController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Website\ClassController;
use App\Http\Controllers\Website\SliderController;
use App\Http\Controllers\Website\WebsiteController;
use Illuminate\Support\Facades\Route;

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
////////////// Admin login Route /////////////////
Route::middleware('admin:admin')->group(function () {
    Route::get('admin/login', [AdminController::class, 'loginForm']);
    Route::POST('admin/login', [AdminController::class, 'store'])->name('admin.login');
});

////////////// Admin dashboard Route /////////////////

Route::middleware(['auth:sanctum,admin', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/admin/Dashboard', [AdminController::class, 'index'])->name('dashboard')->middleware('auth:admin');

    ////////////// Admin  subject Route /////////////////
    Route::resource('Subject', SubjectController::class)->middleware('auth:admin');
    Route::Post('/edit-subject', [SubjectController::class, 'update'])->name('editSubject')->middleware('auth:admin');
    Route::Post('/delete-subject', [SubjectController::class, 'destroy'])->name('deleteSubject')->middleware('auth:admin');
    ////////////// Admin  test Route /////////////////
    Route::resource('Test', TestController::class)->middleware('auth:admin');
    Route::get('/marks', [TestController::class, 'marks'])->name('marks')->middleware('auth:admin');
    Route::POST('/update/marks', [TestController::class, 'marksUpdate'])->name('updateMarks')->middleware('auth:admin');
    Route::get('/admin/review-test', [TestController::class, 'reviewTest'])->name('reviewTest')->middleware('auth:admin');
    Route::get('/admin/reviewQnA', [TestController::class, 'reviewQNA'])->name('reviewQNA')->middleware('auth:admin');
    Route::POST('/admin/approved', [TestController::class, 'approvedTest'])->name('approvedTest')->middleware('auth:admin');

    ////////////// Admin question Route /////////////////
    Route::resource('Question', QuestionController::class)->middleware('auth:admin');
    Route::get('/delete-ans', [QuestionController::class, 'removeAns'])->name('removeAns')->middleware('auth:admin');
    Route::POST('/import-qna', [QuestionController::class, 'importQna'])->name('import')->middleware('auth:admin');
    Route::get('/get-questions', [QuestionController::class, 'getQuestion'])->name('getQuestion')->middleware('auth:admin');
    Route::POST('/add-qna', [QuestionController::class, 'addQuestion'])->name('addQuestion')->middleware('auth:admin');
    Route::get('/show-questions', [QuestionController::class, 'showQuestion'])->name('showQuestion')->middleware('auth:admin');

    Route::get('/show-students', [StudentsController::class, 'index'])->name('Students')->middleware('auth:admin');
    Route::get('/export-students', [StudentsController::class, 'ExportStudent'])->name('ExportStudent')->middleware('auth:admin');

});
/////////////////// User Route ///////////////////////////
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/paid-exam', [UserController::class, 'paidExam'])->name('paidExam');
    Route::get('/dashboard/free-exam', [UserController::class, 'freeExam'])->name('freeExam');
    Route::get('/exam/{id}', [ExamController::class, 'index'])->name('loadExam');
    Route::POST('/exam-submit', [ExamController::class, 'examSubmit'])->name('examSubmit');
    Route::get('/getSingleRecord/{ExamID}', [ExamController::class, 'getSingleRecord']);
    Route::get('/Result', [ExamController::class, 'result'])->name('result');
    Route::get('/user/review-test', [ExamController::class, 'StudentreviewTest'])->name('testreview');
});
/////////////////// User registration Route ///////////////////////////
Route::get('/user/registration', [UserController::class, 'userRegister'])->name('userRegister');
Route::post('/user/submit',[UserController::class,'userSubmit'])->name('userSubmit');

/////////////////// User payement Route ///////////////////////////
Route::controller(StripePaymentController::class)->group(function () {
    Route::get('stripe', 'stripe')->name('payement');
    Route::post('stripe', 'stripePost')->name('stripe.post');
});

Route::get('/otp-verification', [UserController::class, 'Verification'])->name('Verification');
Route::get('user/register', [UserController::class, 'create'])->name('user.regiter');

///////////////////// Website Route ////////////////////
Route::get('/menu', [WebsiteController::class, 'menu'])->name('menu')->middleware('auth:admin');
Route::resource('image', SliderController::class)->middleware('auth:admin');
Route::resource('classes', ClassController::class)->middleware('auth:admin');
Route::get('contact', [WebsiteController::class, 'contact'])->name('contact');
Route::get('contact/{id}', [WebsiteController::class, 'contactEdit'])->name('contactedit');
Route::post('contact/update/{id}', [WebsiteController::class, 'contactUpdate'])->name('contactupdate');

Route::get('link', [WebsiteController::class, 'Link'])->name('link');
Route::post('link/save', [WebsiteController::class, 'LinkStore'])->name('linkstore');
Route::get('link/{id}', [WebsiteController::class, 'LinkEdit'])->name('linkedit');
Route::post('link/update/{id}', [WebsiteController::class, 'LinkUpdate'])->name('linkupdate');

Route::GET('image/publish/{id}', [SliderController::class, 'publish'])->name('publish');
Route::GET('image/unpublish/{id}', [SliderController::class, 'unpublish'])->name('unpublish');

Route::GET('/annauncement', [WebsiteController::class, 'annauncementIndex'])->name('annauncement');
Route::post('annauncement-save', [WebsiteController::class, 'annauncementSave'])->name('annauncementSave');
Route::get('annauncement/{id}', [WebsiteController::class, 'annauncementEdit'])->name('annauncementEdit');
Route::post('annauncement/update/{id}', [WebsiteController::class, 'annauncementUpdate'])->name('annauncementUpdate');

Route::GET('/newsletter', [WebsiteController::class, 'newsletterIndex'])->name('newsletter');
Route::post('newsletter-save', [WebsiteController::class, 'newsletterSave'])->name('newsletterSave');
Route::get('newsletter/{id}', [WebsiteController::class, 'newsletterEdit'])->name('newsletterEdit');
Route::post('newsletter/update/{id}', [WebsiteController::class, 'newsletterUpdate'])->name('newsletterUpdate');

Route::GET('/testimonial', [WebsiteController::class, 'testimonialIndex'])->name('testimonial');
Route::post('testimonial-save', [WebsiteController::class, 'testimonialSave'])->name('testimonialSave');
Route::get('testimonial/{id}', [WebsiteController::class, 'testimonialEdit'])->name('testimonialEdit');
Route::post('testimonial/update/{id}', [WebsiteController::class, 'testimonialUpdate'])->name('testimonialUpdate');

Route::GET('/post', [WebsiteController::class, 'postIndex'])->name('postIndex');
Route::post('post-save', [WebsiteController::class, 'postSave'])->name('postSave');
Route::get('post/{id}', [WebsiteController::class, 'postEdit'])->name('postEdit');
Route::post('post/update/{id}', [WebsiteController::class, 'postUpdate'])->name('postUpdate');

Route::GET('/category', [WebsiteController::class, 'categoryIndex'])->name('categoryIndex');
Route::post('category-save', [WebsiteController::class, 'categorySave'])->name('categorySave');
Route::get('category/{id}', [WebsiteController::class, 'categoryEdit'])->name('categoryEdit');
Route::post('category/update/{id}', [WebsiteController::class, 'categoryUpdate'])->name('categoryUpdate');

Route::GET('/tag', [WebsiteController::class, 'tagIndex'])->name('tagIndex');
Route::post('tag-save', [WebsiteController::class, 'tagSave'])->name('tagSave');
Route::get('tag/{id}', [WebsiteController::class, 'tagEdit'])->name('tagEdit');
Route::post('tag/update/{id}', [WebsiteController::class, 'tagUpdate'])->name('tagUpdate');

Route::GET('/pages', [WebsiteController::class, 'pagesIndex'])->name('pages');
Route::post('pages-save', [WebsiteController::class, 'pagesSave'])->name('pagesSave');
Route::get('pages/{id}', [WebsiteController::class, 'pagesEdit'])->name('pagesEdit');
Route::post('pages/update/{id}', [WebsiteController::class, 'pagesUpdate'])->name('pagesUpdate');

Route::GET('/galleries', [WebsiteController::class, 'galleriesIndex'])->name('galleries');
Route::post('galleries-save', [WebsiteController::class, 'galleriesSave'])->name('galleriesSave');
Route::get('galleries/{id}', [WebsiteController::class, 'galleriesEdit'])->name('galleriesEdit');
Route::post('galleries/update/{id}', [WebsiteController::class, 'galleriesUpdate'])->name('galleriesUpdate');

Route::GET('/faq', [WebsiteController::class, 'faqIndex'])->name('faq');
Route::post('faq-save', [WebsiteController::class, 'faqSave'])->name('faqSave');
Route::get('faq/{id}', [WebsiteController::class, 'faqEdit'])->name('faqEdit');
Route::post('faq/update/{id}', [WebsiteController::class, 'faqUpdate'])->name('faqUpdate');
