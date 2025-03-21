<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsulanController;
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

Route::post('login', [AuthController::class, 'loginApi']);
Route::post('logout', [AuthController::class, 'logoutApi'])->middleware('auth:api');

Route::prefix('/')->middleware('auth:api')->group(function () {
    Route::post('/usulan', [UsulanController::class, 'list']);
    Route::prefix('approvement')->group(function () {
        Route::put('/approve_usulan/{uid}', [UsulanController::class, 'approvement_disduk']);
        Route::put('/reject_usulan/{uid}', [UsulanController::class, 'rejectment_disduk']);
    });
});
