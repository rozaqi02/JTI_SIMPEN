<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\Api\LevelController;
use App\Http\Controllers\Api\DetailTugasController;
// Middleware untuk mengautentikasi dengan Sanctum jika diperlukan
Route::post('/register', App\Http\Controllers\Api\RegisterController::class)->name('register');
Route::post('/login', App\Http\Controllers\Api\LoginController::class)->name('login');
Route::get('/user/{id_user}', [App\Http\Controllers\Api\LoginController::class, 'getUser'])->name('getUser');
Route::middleware('auth:api')->get('/user/{id_user}', [LoginController::class, 'getUser']);

Route::middleware('auth:api')->get('/user', function (Request $request){
    return $request->user();
});
Route::post('/logout', App\Http\Controllers\Api\LogoutController::class)->name('logout');

Route::get('levels', [LevelController::class, 'index']);
Route::post('levels', [LevelController::class, 'store']);
Route::get('levels/{level}', [LevelController::class, 'show']);
Route::put('levels/{level}', [LevelController::class, 'update']);
Route::delete('levels/{level}', [LevelController::class, 'destroy']);

Route::get('details', [DetailTugasController::class, 'index']);
Route::post('details', [DetailTugasController::class, 'store']);
Route::get('details/{detail}', [DetailTugasController::class, 'show']);
Route::put('details/{detail}', [DetailTugasController::class, 'update']);
Route::delete('details/{detail}', [DetailTugasController::class, 'destroy']);
