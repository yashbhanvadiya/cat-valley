<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\QuoteController;
use App\Http\Controllers\Admin\SiteBGController;
use App\Http\Controllers\Admin\TrainerController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\CheckRole;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth::routes([
//     'register' => false, 'reset' => false, 'verify' => false
// ]);

Route::controller(MainController::class)->group(function() {
    Route::get('/', 'index');
});

Route::prefix('admin')->group(function () {
    Route::controller(IndexController::class)->group(function() {
        Route::get('/', 'login');
        Route::get('/login', 'login')->name('login');
        Route::post('/login', 'loginData')->name('login-data');
    });

    Route::middleware([Authenticate::class])->group(function() {
        Route::controller(IndexController::class)->group(function() {
            Route::get('/dashboard', 'index')->name('/dashboard');
            Route::get('/logout', 'logout')->name('logout');
        });

        Route::controller(UsersController::class)->group(function() {
            Route::get('/users', 'index')->name('users');
            Route::post('/users/add-users', 'addUsers')->name('add-users');
            Route::delete('users/delete-users/{id}', 'deleteUsers')->name('delete-users');
            Route::get('/users/show-users/{id}', 'showUsers')->name('show-users');
        });

        Route::controller(CategoryController::class)->group(function () {
            Route::get('/category', 'index')->name('category');
            Route::post('/category/add-category', 'addCategory')->name('add-category');
            Route::delete('/category/delete-category/{id}', 'deleteCategory')->name('delete-category');
            Route::get('/category/{id}/edit-category', 'editCategory')->name('edit-category');
        });

        Route::controller(SubCategoryController::class)->group(function () {
            Route::get('/sub-category', 'index')->name('sub-category');
            Route::post('/sub-category/add-sub-category', 'addSubCategory')->name('add-sub-category');
            Route::delete('/sub-category/delete-sub-category/{id}', 'deleteSubCategory')->name('delete-sub-category');
            Route::get('/sub-category/{id}/edit-sub-category', 'editSubCategory')->name('edit-sub-category');
        });

        Route::controller(MediaController::class)->group(function () {
            Route::get('/media', 'index')->name('media');
            Route::post('/media/get-subcategory', 'getSubCategory')->name('get-subcategory');
            Route::post('/media/add-media', 'addMedia')->name('add-media');
            Route::delete('/media/delete-media/{id}', 'deleteMedia')->name('delete-media');
            Route::get('/media/{id}/edit-media', 'editMedia')->name('edit-media');
            Route::post('/media/get-subcategory-data', 'getSubCategoryData')->name('get-subcategory-data');
        });
        
        Route::controller(QuizController::class)->group(function () {
            Route::get('/quiz', 'index')->name('quiz');
            Route::post('quiz/add-question', 'addQuestion')->name('add-question');
            Route::delete('/quiz/delete-question/{id}', 'deleteQuestion')->name('delete-question');
            Route::get('/quiz/{id}/edit-question', 'editQuestion')->name('edit-question');
        });

        Route::controller(QuoteController::class)->group(function () {
            Route::get('/quote', 'index')->name('quote');
            Route::post('/quote/add-quote', 'addQuote')->name('add-quote');
            Route::delete('/quote/delete-quote/{id}', 'deleteQuote')->name('delete-quote');
            Route::get('/quote/{id}/edit-quote', 'editQuote')->name('edit-quote');
        });

        Route::middleware(['checkRole'])->group(function (){
            Route::controller(SiteBGController::class)->group(function () {
                Route::get('/site-bg', 'index')->name('site-bg');
                Route::post('/site-bg/add-sitebg', 'addSiteBG')->name('add-sitebg');
                Route::delete('/site-bg/delete-sitebg/{id}', 'deleteSiteBG')->name('delete-sitebg');
                Route::get('/site-bg/{id}/edit-sitebg', 'editSiteBG')->name('edit-sitebg');
            });
        });

        Route::controller(TrainerController::class)->group(function () {
            Route::get('/trainer', 'index')->name('trainer');
            Route::post('/trainer/add-trainer', 'addTrainer')->name('add-trainer');
            Route::delete('/trainer/delete-trainer/{id}', 'deleteTrainer')->name('delete-trainer');
            Route::get('/trainer/{id}/edit-trainer', 'editTrainer')->name('edit-trainer');
        });
        
    });
});