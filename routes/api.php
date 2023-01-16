<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\IndexController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\SubCategoryController;
use App\Http\Controllers\API\NotesController;
use App\Http\Controllers\API\QuizController;
use App\Http\Controllers\API\QuoteController;
use App\Http\Controllers\API\MediaController;
use App\Http\Controllers\API\SiteBGController;
use App\Http\Controllers\API\TrainerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function(Request $request) {
    return $request->user();
});

Route::controller(AuthController::class)->group(function() {
    Route::post('/login', 'login');
    Route::post('/register', 'register');
    Route::post('/edit-profile', 'editProfile');
});

Route::middleware('auth:api')->group(function(){
    Route::controller(IndexController::class)->group(function() {
        Route::get('/explore-topic', 'exploreTopic');
    });

    Route::controller(CategoryController::class)->group(function() {
        Route::get('/get-category', 'getCategory');
    });

    Route::controller(SubCategoryController::class)->group(function() {
        Route::get('/get-sub-category', 'getSubCategory');
    });

    Route::controller(NotesController::class)->group(function() {
        Route::post('/add-notes', 'addNotes');
        Route::get('/get-notes', 'getNotes');
        Route::delete('/delete-notes', 'deleteNotes');
        Route::put('/update-notes', 'updateNotes');
    });

    Route::controller(QuizController::class)->group(function() {
        Route::get('/get-question', 'getQuestions');
    });

    Route::controller(QuoteController::class)->group(function() {
        Route::post('/add-quote', 'addQuote');
        Route::get('/get-quotes', 'getQuotes');
        Route::delete('/delete-quote', 'deleteQuote');
        Route::put('/update-quote', 'updateQuote');
    });

    Route::controller(MediaController::class)->group(function() {
        Route::get('/get-video-list', 'index');
        Route::get('/get-audio-list', 'getAudioList');
        Route::post('/media-like-unlike', 'likeUnlikeMedia');
        Route::post('/media-review', 'addMediaReview');
        Route::post('/media-favourite', 'storeMediaFavourite');
        Route::get('/get-favourite-media', 'getMediaFavouriteList');
        Route::post('/media-view-count', 'mediaViewCount');
        Route::get('/recent-view-media', 'recentViewMedia');
        Route::get('/recommendation-media', 'recommendationMedia');
    });

    Route::controller(SiteBGController::class)->group(function() {
        Route::get('/get-sitebg', 'getSiteBG');
    });

    Route::controller(TrainerController::class)->group(function() {
        Route::get('/get-trainer', 'getTrainer');
        Route::post('/trainer-review', 'trainerReview');
    });
});