<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\Api\LevelController;
use App\Http\Controllers\Api\DetailTugasMahasiswaController;
use App\Http\Controllers\Api\DetailTugasAdtController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\TendikController;
use App\Http\Controllers\Api\MahasiswaController;
use App\Http\Controllers\Api\DosenController;
use App\Http\Controllers\Api\AlpaController;
use App\Http\Controllers\Api\TugasMahasiswaController;
use App\Http\Controllers\Api\TugasAdtController;
use App\Http\Controllers\Api\RiwayatMahasiswaController;
use App\Http\Controllers\Api\RiwayatAdtController;

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
Route::get('levels/{level}', [LevelController::class, 'show']);

Route::get('detailm', [DetailTugasMahasiswaController::class, 'index']);
Route::get('detailm/{detail}', [DetailTugasMahasiswaController::class, 'show']);

Route::get('detailadt', [DetailTugasAdtController::class, 'index']);
Route::get('detailadt/{detail}', [DetailTugasAdtController::class, 'show']);

Route::get('admins', [AdminController::class, 'index']);
Route::get('admins/{admin}', [AdminController::class, 'show']);

Route::get('tendiks', [TendikController::class, 'index']);
Route::get('tendiks/{tendik}', [TendikController::class, 'show']);

Route::get('dosens', [DosenController::class, 'index']);
Route::get('dosens/{dosen}', [DosenController::class, 'show']);

Route::get('mahasiswas', [MahasiswaController::class, 'index']);
Route::get('mahasiwas/{mahasiswa}', [MahasiswaController::class, 'show']);

Route::get('alpas', [AlpaController::class, 'index']);
Route::get('alpas/{alpa}', [AlpaController::class, 'show']);

Route::get('tugasm', [TugasMahasiswaController::class, 'index']);
Route::get('tugasm/{tugas}', [TugasMahasiswaController::class, 'show']);

Route::get('tugasadt', [TugasAdtController::class, 'index']);
Route::get('tugasadt/{tugas}', [TugasAdtController::class, 'show']);

Route::get('riwayatm', [RiwayatMahasiswaController::class, 'index']);
Route::get('riwayatm/{riwayat}', [RiwayatMahasiswaController::class, 'show']);

Route::get('riwayatadt', [RiwayatAdtController::class, 'index']);
Route::get('riwayatadt/{riwayat}', [RiwayatAdtController::class, 'show']);
