<?php

use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FakultasController;
use App\Http\Controllers\JanjiTemuController;
use App\Http\Controllers\LaporanKonsulController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\RiwayatKonsulController;
use App\Http\Controllers\PerguruanTinggiController;
use App\Http\Controllers\PsikologController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CekRole;
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

Route::get('/', function () {
    return view('landing');
});

Route::middleware('guest')->group(function(){
    Route::get('/login', ([AuthController::class,'showLoginPage']))
    ->name('loginPage');

    Route::post('/proses-login', ([AuthController::class, 'loginProcess']))
    ->name('loginProcess');

    Route::get('/forgot-password', [ForgotPasswordController::class,'showForm'])->name('password.request');

    Route::post('/forgot-password', [ForgotPasswordController::class,'sendEmail'])->name('password.email');

    Route::get('/reset-password/{token}', [ForgotPasswordController::class,'showResetForm'])->name('password.reset');

    Route::post('/reset-password', [ForgotPasswordController::class,'reset'])->name('password.update');
});

Route::get('/logout', ([AuthController::class, 'logout']))
->name('logout')->middleware('auth');

Route::get('/layanan', ([LayananController::class,'showLayananPage']))
->name('layananPage');

Route::middleware(CekRole::class . ':mahasiswa')->group(function(){
    Route::post('/layanan/ajukan-janji', ([JanjiTemuController::class,'ajukanJanjiProcess']))
    ->name('ajukanJanjiProcess');

    Route::get('/riwayat-konsultasi', ([RiwayatKonsulController::class,'showRiwayatKonsulPage']))
    ->name('riwayatKonsulPage');

    Route::get('/hasil-konsultasi', ([LaporanKonsulController::class,'showHasilKonsultasiMahasiswaPage']))
    ->name('hasilKonsultasiPage');

    Route::get('/profile-mahasiswa', ([MahasiswaController::class,'showProfilePage']))
    ->name('showProfileMahasiswaPage');

    Route::put('/profile-mahasiswa/profile/{id_user}', ([MahasiswaController::class,'updateProfile']))
    ->name('updateProfileMahasiswa');

    Route::put('/profile-mahasiswa/kata-sandi/{id_user}', ([UserController::class,'updateKataSandi']))
    ->name('updateKataSandiMahasiswa');

});

Route::middleware(CekRole::class . ':psikolog')->group(function(){
    Route::get('/profile-psikolog', ([PsikologController::class,'showProfilePage']))
    ->name('showProfilePsikologPage');

    Route::put('/profile-psikolog/profile/{id_user}', ([PsikologController::class,'updateProfile']))
    ->name('updateProfilePsikolog');

    Route::put('/profile-psikolog/kata-sandi/{id_user}', ([UserController::class,'updateKataSandi']))
    ->name('updateKataSandiPsikolog');

    Route::get('/pasien', ([PasienController::class,'showPasienPage']))
    ->name('pasienPage');

    Route::put('/pasien/terima/{id_janji_temu}', ([JanjiTemuController::class,'terimaJanjiTemu']))
    ->name('terimaPasienProcess');

    Route::put('/pasien/reschedule/{id_janji_temu}', ([JanjiTemuController::class,'rescheduleJanjiTemu']))
    ->name('rescheduleProcess');

    Route::put('/pasien/selesai/{id_janji_temu}', ([JanjiTemuController::class,'updateStatusSelesai']))
    ->name('pasienUpdateSelesai');

    Route::get('/laporan-konsultasi', ([LaporanKonsulController::class,'showLaporanPsikologPage']))
    ->name('laporanPsikologPage');

    Route::post('/laporan-konsultasi/tambah', ([LaporanKonsulController::class,'tambahLaporan']))
    ->name('tambahLaporan');

    Route::put('/laporan-konsultasi/edit/{id_laporan_konsultasi}', ([LaporanKonsulController::class,'editLaporan']))
    ->name('editLaporan');

    Route::get('/update-status/{jenis_status}', ([PsikologController::class,'updateStatus']))
    ->name('updateStatusPsikolog');
});

Route::middleware(CekRole::class . ':perguruan tinggi')->group(function(){
    Route::get('/profile-perguruan-tinggi', ([PerguruanTinggiController::class,'showProfilePage']))
    ->name('showProfilePerguruanPage');

    Route::put('/profile-perguruan-tinggi/profile/{id_user}', ([PerguruanTinggiController::class,'updateProfile']))
    ->name('updateProfilePerguruan');

    Route::put('/profile-perguruan-tinggi/kata-sandi/{id_user}', ([UserController::class,'updateKataSandi']))
    ->name('updateKataSandiPerguruan');

    Route::get('/hasil-laporan-psikolog', ([LaporanKonsulController::class,'showHasilLaporanPsikologPage']))
    ->name('hasilLaporanPsikologPage');

    Route::post('/hasil-laporan-psikolog/chart', ([LaporanKonsulController::class,'showStatistik']))
    ->name('showChart');

    Route::get('/kelola-mahasiswa', ([MahasiswaController::class,'showKelolaPage']))
    ->name('kelolaMahasiswaPage');

    Route::post('/kelola-mahasiswa/tambah', ([MahasiswaController::class,'tambahMahasiswa']))
    ->name('tambahMahasiswa');

    Route::put('/kelola-mahasiswa/edit/{id_user}', ([MahasiswaController::class,'editMahasiswa']))
    ->name('editMahasiswa');

    Route::delete('/kelola-mahasiswa/hapus/{id_user}', ([MahasiswaController::class,'hapusMahasiswa']))
    ->name('hapusMahasiswa');

    Route::get('/kelola-psikolog', ([PsikologController::class,'showKelolaPage']))
    ->name('kelolaPsikologPage');

    Route::post('/kelola-psikolog/tambah', ([PsikologController::class,'tambahPsikolog']))
    ->name('tambahPsikolog');

    Route::put('/kelola-psikolog/edit/{id_user}', ([PsikologController::class,'editPsikolog']))
    ->name('editPsikolog');

    Route::delete('/kelola-psikolog/hapus/{id_user}', ([PsikologController::class,'hapusPsikolog']))
    ->name('hapusPsikolog');

    Route::get('/kelola-fakultas', ([FakultasController::class,'showKelolaPage']))
    ->name('kelolaFakultasPage');

    Route::post('/kelola-fakultas/tambah', ([FakultasController::class,'tambahFakultas']))
    ->name('tambahFakultas');

    Route::put('/kelola-fakultas/edit/{id_fakultas}', ([FakultasController::class,'editFakultas']))
    ->name('editFakultas');

    Route::delete('/kelola-fakultas/hapus/{id_fakultas}', ([FakultasController::class,'hapusFakultas']))
    ->name('hapusFakultas');

});

Route::middleware(CekRole::class . ':superadmin')->group(function(){
    Route::get('/kelola-perguruan-tinggi', ([PerguruanTinggiController::class,'showKelolaPage']))
    ->name('kelolaPerguruanPage');

    Route::post('/kelola-perguruan-tinggi/tambah', ([PerguruanTinggiController::class,'tambahPerguruan']))
    ->name('tambahPerguruanTinggi');

    Route::put('/kelola-perguruan-tinggi/edit/{id_user}', ([PerguruanTinggiController::class,'editPerguruan']))
    ->name('editPerguruanTinggi');

    Route::delete('/kelola-perguruan-tinggi/hapus/{id_user}', ([PerguruanTinggiController::class,'hapusPerguruan']))
    ->name('hapusPerguruanTinggi');
});

