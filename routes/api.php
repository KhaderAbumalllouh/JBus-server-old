<?php

use App\Http\Controllers\Api\Auth\SocialiteController;
use App\Http\Controllers\Api\Auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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


Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('/login', [LoginController::class, 'login']);
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
        
        Route::prefix('{provider}')->group(function () {
            Route::get('/', [SocialiteController::class, 'oAuthRedirect']);
            Route::get('/callback', [SocialiteController::class, 'oAuthCallback']);
        })->whereIn('provider', ['facebook', 'google']);


    });
});

Route::get('/login1', function () {
    return view('login', ['errors' => session('errors')]);
});
