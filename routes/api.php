<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [UserController::class, 'register']);

Route::get('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('auth', [AuthController::class, 'checkAuth'])->middleware('auth:sanctum');

Route::post('login', [AuthController::class, 'login']);

Route::get('posts/search', [PostController::class, 'search']);

Route::post('posts/store', [PostController::class, 'store']);

Route::get('checkUsernameExists/{username}', [UserController::class, 'checkUsernameExists']);

Route::get('checkEmailExists', [UserController::class, 'checkEmailExists'])->middleware('throttle:10,1');

Route::post('imageUpload', [ImageController::class, 'imageUpload']);

Route::get('users', [UserController::class, 'index']);

Route::middleware(['auth'])->group(function () {
    Route::post('/events', [EventController::class, 'store']);
});

Route::get('events', [EventController::class, 'index']);


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/messages/{username}', [MessageController::class, 'getMessages']);
    Route::post('/messages', [MessageController::class, 'sendMessage']);
});

Route::middleware('auth:sanctum')->get('/conversations', [MessageController::class, 'getConversations']);
