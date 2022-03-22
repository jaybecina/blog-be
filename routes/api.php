<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\PostController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// User
Route::prefix('/users')->as('users.')->group( function() {
    Route::controller(LoginController::class)->group(function() {
        Route::post('/login', 'login');
    });
    Route::controller(RegisterController::class)->group(function() {
        Route::post('/register', 'register');
    });
});

Route::middleware('auth:api')->group( function () {
    Route::controller(PostController::class)->group(function () {
        Route::get('/posts', 'index');
        Route::get('/post/{id}', 'show');
        Route::post('/posts', 'store');
        Route::put('/post/{id}', 'update');
        Route::delete('/post/{id}', 'destroy');
    });
});

