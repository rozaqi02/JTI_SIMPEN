<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SidebarController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\RegistrationController;

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

Route::get('/sidebar', [SidebarController::class, 'getSidebar'])->name('sidebar');

// Route untuk mengambil tugas
Route::post('/tugas/{tugas_id}/ambil', [TugasController::class, 'ambilTugas'])->name('tugas.ambil');

//    Route::get('/dashboard', [WelcomeController::class, 'index']);

        Route::get('/user', [UserController::class, 'index']);                          //menampilkan laman awal user
        Route::post('/user/list', [UserController::class, 'list']);                      //menampilkan data user dalam bentuk json untuk datatable
        Route::post('/ajax', [UserController::class, 'store_ajax']);                //menyimpan data user baru AJAX                //menyimpan perubahan data user
        Route::get('/{id}/show_ajax', [UserController::class, 'show_ajax']);        //menampilkan form detil data user AJAX
        Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']);        //menampilkan laman form edit user AJAX
        Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']);    //menyimpan perubahan data user AJAX
        Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']);   //menampilkan form confirm hapus data user AJAX
        Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']); //menghapus data user AJAX
        Route::delete('/{id}', [UserController::class, 'destroy']);                 //menghapus data user
        Route::get('/import', [UserController::class, 'import']);                   //menampilkan form impor data user

});