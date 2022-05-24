<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TagController;

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

Route::post('login', [Api\AuthController::class, 'login']);
Route::post('register', [Api\RegisterController::class, 'register']);
Route::post('forgot', [Api\ForgotController::class, 'forgot']);
Route::post('reset', [Api\ForgotController::class, 'reset']);
Route::get('email/resend/{user}', [Api\VerifyController::class, 'resend'])->name('verification.resend');
Route::get('email/verify/{id}', [Api\VerifyController::class, 'verify'])->name('verification.verify');; // Make sure to keep this as your route name
    
Route::group(['middleware' => ['auth:api']], function () {
    Route::get('user', [Api\AuthController::class, 'user']);
});





Route::get('posts', [PostController::class, 'index']);
Route::post('posts/store', [PostController::class, 'store']);
Route::get('posts/{post}', [PostController::class, 'show']);
Route::get('getAuthpost/{id}', [PostController::class, 'authPost']);
Route::post('posts/delete/{id}', [PostController::class, 'delete']);
Route::post('posts/update/{id}', [PostController::class, 'update']);
Route::get('getTag', [TagController::class, 'index']);
Route::post('tag/store', [TagController::class, 'store']);




Route::post('comments', [CommentController::class, 'store'])->name('comments.store');
