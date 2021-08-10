<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
    Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);
    Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);
    Route::post('/refresh', [\App\Http\Controllers\AuthController::class, 'refresh']);
    Route::get('/user-profile', [\App\Http\Controllers\AuthController::class, 'userProfile']);
});

Route::group(['prefix' => 'book'], function () {
    Route::apiResource('author', \App\Http\Controllers\Book\AuthorController::class)->only(['index', 'show']);
    Route::apiResource('publishing-house', \App\Http\Controllers\Book\PublishingHouseController::class)->only([
        'index',
        'show'
    ]);
    Route::apiResource('books', \App\Http\Controllers\Book\BookController::class);

    Route::post('import-json','\App\Http\Controllers\Book\ImporterController@importJson')->name('import.json');
});
Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');

    return '👌';
});

Route::fallback(function () {
    return 'Why are you here?';
});
