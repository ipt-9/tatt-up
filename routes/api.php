<?php

use App\Http\Controllers\AuthController;
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

Route::post('/signup', [UserController::class, 'store']);

Route::get('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('auth', [AuthController::class, 'checkAuth'])->middleware('auth:sanctum');

Route::post('login', [AuthController::class, 'login']);

Route::get('/posts/search', [PostController::class, 'search']);

Route::post('posts/store', [PostController::class, 'store']);
