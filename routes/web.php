<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\AlpaController;
use Illuminate\Support\Facades\Route;

/*
|-------------------------------------------------------------------------- 
| Web Routes
|-------------------------------------------------------------------------- 
| 
| Here is where you can register web routes for your application. These 
| routes are loaded by the RouteServiceProvider and all of them will 
| be assigned to the "web" middleware group. Make something great!
| 
*/

Route::pattern('id', '[0-9]+');

// Rute untuk halaman depan (landing page)
Route::get('/', [WelcomeController::class, 'login']);

// Rute registrasi dan login
// routes/web.php

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postlogin']);
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');
Route::get('register', [AuthController::class, 'register']);
Route::post('register', [AuthController::class, 'postRegister']);


Route::middleware(['auth'])->group(function(){
    Route::get('/', [WelcomeController::class,'index']);

// Proteksi rute berdasarkan role
Route::middleware(['auth'])->group(function () {
    
    // Rute untuk Mahasiswa
    Route::middleware(['role:mahasiswa'])->group(function () {
        // Rute khusus mahasiswa
        Route::get('/tugas', [TugasController::class, 'index']);
        Route::get('/alpa', [AlpaController::class, 'index']);
    });
    
    // Rute untuk Dosen dan Tendik
    Route::middleware(['role:dosen', 'role:tendik'])->group(function () {
        Route::get('/penugasanku', [PenugasanController::class, 'index']);
        Route::get('/info-mahasiswa', [InfoMahasiswaController::class, 'index']);
    });

    // Rute untuk Admin
    Route::middleware(['role:admin'])->group(function () {
        // Rute manajemen pengguna
        Route::get('/user', [UserController::class, 'index']);
        Route::post('/user/list', [UserController::class, 'list']);
        Route::post('/ajax', [UserController::class, 'store_ajax']);
        Route::get('/{id}/show_ajax', [UserController::class, 'show_ajax']);
        Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']);
        Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']);
        Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']);
        Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']);
        Route::delete('/{id}', [UserController::class, 'destroy']);
        Route::get('/import', [UserController::class, 'import']);
    });
});
});
