<?php

use App\Http\Controllers\{
    BarangController, ContactController, CustumerController, DataPeminjamanController, HistoryController,
    Home, LoginController, PeminjamanController, ProfilController, RegistrasiController,
    SaranaDanPrasaranaController, AdminController
};
use Illuminate\Support\Facades\Route;


Route::get('/', [Home::class, 'index'])->middleware('auth');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/registrasi', [RegistrasiController::class, 'index'])->middleware('guest');
Route::post('/registrasi', [RegistrasiController::class, 'registrasi']);

Route::get('/dashboard', function() {
    return view('dashboard.index', ['title' => 'Dashboard Admin']);
})->middleware('admin');

Route::get('/profil/{user:id}', [ProfilController::class, 'index'])->middleware('auth');

Route::get('/sarana dan prasarana', [SaranaDanPrasaranaController::class, 'index'])->middleware('auth');
Route::resource('/sarana-prasarana', BarangController::class)->middleware('admin');

Route::get('/contact', [ContactController::class, 'index'])->middleware('auth');

Route::get('/peminjaman/{barang:id}', [PeminjamanController::class, 'index'])->middleware('auth');
Route::post('/peminjaman/{barang:id}', [PeminjamanController::class, 'peminjaman'])->middleware('auth');

Route::get('/history/{user:id}', [HistoryController::class, 'index'])->middleware('auth');

Route::get('/kembalikan/{id}', [PeminjamanController::class, 'kembalikan'])->middleware('auth');
Route::get('/detail-peminjaman/{id}', [PeminjamanController::class, 'detailPeminjaman'])->middleware('auth');

Route::get('/category/{id}', [SaranaDanPrasaranaController::class, 'category'])->middleware('auth');

Route::get('/custumer', [CustumerController::class, 'index'])->middleware('admin');
Route::get('/custumer/{user:id}', [CustumerController::class, 'detail'])->middleware('admin');

Route::get('/data-peminjaman', [DataPeminjamanController::class, 'index'])->middleware('admin');
Route::get('/data-peminjaman/{id}', [DataPeminjamanController::class, 'detail'])->middleware('admin');

Route::get('/contact', [ContactController::class, 'index'])->middleware('auth');
