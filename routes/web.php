<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BidkomController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RiwayatPenugasankuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SidebarController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\ProgressPenugasankuController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\NgambilTugasController;
use App\Http\Controllers\PenugasankuController;
use App\Http\Controllers\TugasPendidikController;
use App\Http\Controllers\TugasMahasiswaController;
use App\Http\Controllers\JenisKompenController;
use App\Http\Controllers\RiwayatPenugasanMahasiswaController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProgressTugasController;
use App\Http\Controllers\AlpakuController;
use Illuminate\Support\Facades\Route;

use function Laravel\Prompts\confirm;

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

Route::get('register', [RegistrationController::class, 'registration'])->name('register');
Route::post('register', [RegistrationController::class, 'store']);

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postlogin']);
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');

Route::middleware(['auth'])->group(function () {
});


route::group(['middleware'=> 'authorize:ADM,DSN,TDK,MHS'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
});

Route::group(['prefix' => 'user', 'middleware'=> 'authorize:ADM'], function () {
    Route::get('/', [UserController::class, 'index'])->name('user.index');
    Route::post('/list', [UserController::class, 'list'])->name('user.list');
    Route::get('/create_ajax', [UserController::class, 'create_ajax']);
    Route::post('/store_ajax', [UserController::class, 'store_ajax'])->name('user.store');
    Route::get('/import', [UserController::class, 'import'])->name('user.import');
    Route::post('/import_ajax', [UserController::class, 'import_ajax'])->name('user.import_ajax');
    Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax'])->name('user.edit');
    Route::put('/update_ajax/{id}', [UserController::class, 'update_ajax'])->name('user.update');
    Route::get('/{id}/show_ajax', [UserController::class, 'show_ajax'])->name('user.show_ajax');
    Route::get('/{id}/confirm_ajax', [UserController::class, 'confirm_ajax'])->name('user.confirm_ajax');
    Route::delete('/user/{id}/delete_ajax', [UserController::class, 'delete_ajax'])->name('user.delete_ajax');

});


// Route::get('/dashboard', [DashboardController::class, 'index']);

Route::group(['prefix' => 'jenis-kompen'], function () {
    Route::get('/', [JenisKompenController::class, 'index']);
    Route::post('/list', [JenisKompenController::class, 'list']);
});


 Route::group(['prefix' => 'daftar-tugas', 'middleware'=> 'authorize:ADM,DSN,TDK'], function () {
     Route::get('/', [TugasPendidikController::class, 'index']);
 });

 Route::group(['prefix' => 'riwayat-tugas'], function () {
    Route::get('/', [RiwayatPenugasanMahasiswaController::class, 'index'])->name('riwayat-tugas.index');
    Route::post('/list', [RiwayatPenugasanMahasiswaController::class, 'list'])->name('riwayat-tugas.list');
});


Route::group(['prefix' => 'info-mahasiswa'], function () {
    Route::get('/', [MahasiswaController::class, 'index']);
});

Route::group(['prefix' => 'mahasiswa/alpa'], function () {
    Route::get('/', [AlpakuController::class, 'index']); // Halaman data alpa mahasiswa
    Route::post('/list', [AlpakuController::class, 'list']); // DataTables untuk alpa
});

// Group routes for tugas-pendidik
Route::group(['prefix' => 'tugas-pendidik'], function () {
    Route::get('/', [TugasPendidikController::class, 'index']); // Menampilkan halaman daftar tugas pendidik
    Route::post('/list', [TugasPendidikController::class, 'list']); // Menampilkan data tugas pendidik dalam bentuk JSON untuk DataTable
    Route::get('/create_ajax', [TugasPendidikController::class, 'create_ajax']); // Menampilkan form tambah data
    Route::post('/store_ajax', [TugasPendidikController::class, 'store_ajax']); // Menyimpan data baru
    Route::get('/{id_detail_tugas}/edit_ajax', [TugasPendidikController::class, 'edit_ajax'])->name('edit_ajax'); // Menampilkan form edit data
    Route::put('/update_ajax/{id}', [TugasPendidikController::class, 'update_ajax'])->name('update_ajax'); // Menyimpan perubahan data

    // Route untuk Konfirmasi Hapus Tugas Pendidik
    Route::get('/{id_detail_tugas}/confirm_ajax', [TugasPendidikController::class, 'confirm_ajax']); // Menampilkan konfirmasi hapus
    Route::delete('/{id_detail_tugas}/delete_ajax', [TugasPendidikController::class, 'delete_ajax']); // Menghapus tugas pendidik

    // Menambahkan route untuk show_ajax (menampilkan detail tugas pendidik)
    Route::get('/{id_detail_tugas}/show_ajax', [TugasPendidikController::class, 'show_ajax'])->name('show_ajax'); // Menampilkan detail data tugas pendidik
});

Route::group(['prefix' => 'list-tugas'], function () {
    Route::get('/', [NgambilTugasController::class, 'index']);
    Route::post('/mahasiswa/list', [NgambilTugasController::class, 'list']);
    Route::get('/{id}/apply_ajax', [NgambilTugasController::class, 'applyAjax']);
    Route::post('/{id}/submit', [NgambilTugasController::class, 'submitTugas']);
});


Route::prefix('riwayat-penugasanku')->group(function () {
    Route::get('/', [RiwayatPenugasankuController::class, 'index'])->name('riwayat.index');
    Route::post('/list', [RiwayatPenugasankuController::class, 'list'])->name('riwayat.list');
});


Route::group(['prefix' => 'progress-tugas'], function () {
    Route::get('/', [ProgressTugasController::class, 'index']);
});

Route::group(['prefix' => 'alpaku'], function () {
    Route::get('/', [AlpakuController::class, 'index']);
});

Route::prefix('progress-penugasanku')->group(function () {
    Route::get('/', [ProgressPenugasankuController::class, 'index'])->name('progress.index');
    Route::post('/list', [ProgressPenugasankuController::class, 'list'])->name('progress.list'); // Pastikan POST method
});


Route::group(['prefix' => 'user'], function () {
    Route::get('/', [UserController::class, 'index'])->name('user.index');
    Route::post('/list', [UserController::class, 'list'])->name('user.list');
    Route::get('/create_ajax', [UserController::class, 'create_ajax'])->name('user.create');
    Route::post('/store_ajax', [UserController::class, 'store_ajax'])->name('user.store');
    Route::get('/import', [UserController::class, 'import'])->name('user.import');
    Route::post('/import_ajax', [UserController::class, 'import_ajax'])->name('user.import_ajax');
    Route::get('/export_pdf', [UserController::class, 'export_pdf'])->name('user.export_pdf');
    Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax'])->name('user.edit');
    Route::put('/update_ajax/{id}', [UserController::class, 'update_ajax'])->name('user.update');
    Route::get('/{id}/show_ajax', [UserController::class, 'show_ajax'])->name('user.show_ajax');
    Route::get('/{id}/confirm_ajax', [UserController::class, 'confirm_ajax'])->name('user.confirm_ajax');
    Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax'])->name('user.delete_ajax');
});


Route::group(['prefix' => 'Pendidik'], function () {
    Route::get('/', [PenugasankuController::class, 'index'])->name('pendidik.index');
    Route::post('/list', [PenugasankuController::class, 'list'])->name('pendidik.list');
    Route::get('/create_ajax', [PenugasankuController::class, 'create_ajax'])->name('pendidik.create_ajax');
    Route::post('/store_ajax', [PenugasankuController::class, 'store_ajax'])->name('pendidik.store_ajax');
});






    Route::group(['prefix' => 'bidkom'], function () {
        Route::get('/', [BidkomController::class, 'index']); // Menampilkan laman awal Bidkom
        Route::post('/list', [BidkomController::class, 'list']); // Menampilkan data Bidkom dalam bentuk JSON untuk DataTable
        Route::get('/create_ajax', [BidkomController::class, 'create_ajax']); // Menampilkan form tambah data (gunakan GET, bukan POST)
        Route::post('/store_ajax', [BidkomController::class, 'store_ajax']); // Menyimpan data baru
        Route::get('/{id_bidkom}/edit_ajax', [BidkomController::class, 'edit_ajax'])->name('edit_ajax'); // Menampilkan form edit data
        Route::put('/update_ajax/{id}', [BidkomController::class, 'update_ajax'])->name('update_ajax'); // Menyimpan perubahan data

        // Route untuk Konfirmasi Hapus Bidkom
        Route::get('/{id_bidkom}/confirm_ajax', [BidkomController::class, 'confirm_ajax']); // Menampilkan konfirmasi hapus
        Route::delete('/{id_bidkom}/delete_ajax', [BidkomController::class, 'delete_ajax']);



        // Menambahkan route untuk show_ajax (menampilkan detail Bidkom)
        Route::get('/{id_bidkom}/show_ajax', [BidkomController::class, 'show_ajax'])->name('show_ajax'); // Menampilkan detail data Bidkom
    });





Route::middleware(['authorize:ADM,MHS,TDK,DSN'])->group(function(){
    Route::get('/profile', [ProfileController::class, 'index']);
    Route::get('/profile/{id}/edit_ajax', [ProfileController::class, 'edit_ajax']);
    Route::put('/profile/{id}/update_ajax', [ProfileController::class, 'update_ajax']);
    Route::get('/profile/{id}/edit_foto', [ProfileController::class, 'edit_foto']);
    Route::put('/profile/{id}/update_foto', [ProfileController::class, 'update_foto']);
});
