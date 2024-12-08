<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BidkomController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SidebarController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\TugasMahasiswaController;
use App\Http\Controllers\JenisKompenController;
use App\Http\Controllers\RiwayatPenugasanMahasiswaController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProgressTugasController;
use App\Http\Controllers\AlpakuController;
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

Route::get('/', [WelcomeController::class, 'landing']);

Route::get('register', [RegistrationController::class, 'registration'])->name('signup');
Route::post('register', [RegistrationController::class, 'store']);

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postlogin']);
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');

Route::middleware(['auth'])->group(function () {
});

Route::get('/dashboard', [WelcomeController::class, 'index']);

Route::group(['prefix' => 'jenis-kompen'], function () {
    Route::get('/', [JenisKompenController::class, 'index']);
});


Route::group(['prefix' => 'daftar-tugas'], function () {
    Route::get('/', [TugasMahasiswaController::class, 'index']);
});

Route::group(['prefix' => 'riwayat-tugas'], function () {
    Route::get('/', [RiwayatPenugasanMahasiswaController::class, 'index']);
});

Route::group(['prefix' => 'info-mahasiswa'], function () {
    Route::get('/', [MahasiswaController::class, 'index']);
});

Route::group(['prefix' => 'progress-tugas'], function () {
    Route::get('/', [ProgressTugasController::class, 'index']);
});

Route::group(['prefix' => 'alpaku'], function () {
    Route::get('/', [AlpakuController::class, 'index']);
});


Route::group(['prefix' => 'user'], function () {
Route::get('/', [UserController::class, 'index']);                          //menampilkan laman awal user
Route::post('/list', [UserController::class, 'list']);                      //menampilkan data user dalam bentuk json untuk datatable
Route::get('/create', [UserController::class, 'create']);                //menyimpan data user baru AJAX
Route::post('/', [UserController::class, 'store']);
Route::post('/ajax', [UserController::class, 'store_ajax']);                //menyimpan data user baru AJAX   
Route::get('/{id}', [UserController::class, 'show']);
Route::get('/{id}/edit', [UserController::class, 'edit']);
Route::put('/{id}', [UserController::class, 'update']);
Route::get('/{id}/show_ajax', [UserController::class, 'show_ajax']);        //menampilkan form detil data user AJAX
Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']);        //menampilkan laman form edit user AJAX
Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']);    //menyimpan perubahan data user AJAX
Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']);   //menampilkan form confirm hapus data user AJAX
Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']); //menghapus data user AJAX
Route::delete('/{id}', [UserController::class, 'destroy']);                 //menghapus data user
Route::get('/import', [UserController::class, 'import']);                   //menampilkan form impor data user
});


Route::group(['prefix' => 'bidkom'], function () {
    Route::get('/', [BidkomController::class, 'index']);                            // Menampilkan laman awal Bidkom
    Route::post('/list', [BidkomController::class, 'list']);                        // Menampilkan data Bidkom dalam bentuk JSON untuk DataTable

});

Route::middleware(['authorize:ADM,MHS,TDK,DSN'])->group(function(){
    Route::get('/profile', [ProfileController::class, 'index']);
    Route::get('/profile/{id}/edit_ajax', [ProfileController::class, 'edit_ajax']);
    Route::put('/profile/{id}/update_ajax', [ProfileController::class, 'update_ajax']);
    Route::get('/profile/{id}/edit_foto', [ProfileController::class, 'edit_foto']);
    Route::put('/profile/{id}/update_foto', [ProfileController::class, 'update_foto']);
});