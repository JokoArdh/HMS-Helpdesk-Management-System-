<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegistrasiController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\Dashboard\AdminDashboardController;
use App\Http\Controllers\Dashboard\ItDashboardController;
use App\Http\Controllers\Dashboard\ManagerDashboardController;
use App\Http\Controllers\Dashboard\UserDashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KeluhanController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TicketingController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\TransaksiOutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserKeluhanController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');

Route::get('/register', [RegistrasiController::class, 'index'])->name('registrasi');
Route::post('/register', [RegistrasiController::class, 'store'])->name('registrasi.store');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/barang-export/pdf', [BarangController::class, 'export'])->name('barang.export.pdf');
    Route::get('/setting/about', [SettingController::class, 'about'])->name('setting.about');
    Route::get('/transaksi-masuk/export-pdf', [TransaksiController::class, 'exportPdf'])->name('transaksi-masuk.export.pdf');

    Route::resource('/kategori', KategoriController::class);
    Route::resource('/logtrobel', LogController::class);
    Route::resource('/user', UserController::class);
    Route::resource('/barang', BarangController::class);
    Route::resource('/keluhan', KeluhanController::class);
    Route::resource('/transaksi-masuk', TransaksiController::class);
    Route::resource('/transaksi-out', TransaksiOutController::class);
    Route::resource('/ticket', TicketingController::class);
    Route::resource('/setting', SettingController::class);

});

Route::middleware(['auth', 'role:it'])->prefix('it')->name('it.')->group(function () {
    Route::get('/dashboard', [ItDashboardController::class, 'index'])->name('dashboard');
    Route::get('/barang-export/pdf', [BarangController::class, 'export'])->name('barang.export.pdf');
    Route::get('/setting/about', [SettingController::class, 'about'])->name('setting.about');
    Route::get('/transaksi-masuk/export-pdf', [TransaksiController::class, 'exportPdf'])->name('transaksi-masuk.export.pdf');

    Route::resource('/kategori', KategoriController::class);
    Route::resource('/logtrobel', LogController::class);
    Route::resource('/barang', BarangController::class);
    Route::resource('/transaksi-masuk', TransaksiController::class);
    Route::resource('/transaksi-out', TransaksiOutController::class);
    Route::resource('/ticket', TicketingController::class);
    Route::resource('/setting', SettingController::class);

});

Route::middleware(['auth', 'role:manager'])->prefix('manager')->name('manager.')->group(function () {
    Route::get('/dashboard', [ManagerDashboardController::class, 'index'])->name('dashboard');

    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
    Route::get('/transaksi-masuk', [TransaksiController::class, 'index'])->name('transaksi-masuk.index');
    Route::get('/setting/about', [SettingController::class, 'about'])->name('setting.about');
    // Route::get('/setting/password-update', [SettingController::class, 'updatePass'])->name('setting.update-pass.update');
    Route::get('/barang-export/pdf', [BarangController::class, 'export'])->name('barang.export.pdf');
    Route::get('/transaksi-masuk/export-pdf', [TransaksiController::class, 'exportPdf'])->name('transaksi-masuk.export.pdf');

    Route::resource('/transaksi-out', TransaksiOutController::class);
    Route::resource('/ticket', TicketingController::class);
    Route::resource('/setting', SettingController::class);

    
});

Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

    Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
    //ini route u get ajax nama barang
    Route::get('/riwayat-permintaan/by-nama/{nama}', [TransaksiOutController::class, 'byNama']);

    //route select option barang 
    Route::get('/barang/auto', [TransaksiOutController::class, 'auto'])->name('barang.auto');

    //route untuk riwayat permintaan saya
    Route::get('/riawayat-permintaan', [TransaksiOutController::class, 'permintaan'])->name('permintaan.index');
    Route::get('/datakeluhan', [UserKeluhanController::class, 'datakeluhan'])->name('datakeluhan.index');
    Route::get('/setting/about', [SettingController::class, 'about'])->name('setting.about');
    Route::post('/setting/password-update', [SettingController::class, 'updatePass'])->name('setting.update-pass.update');
    Route::put('/setting/profile-update/{id}', [SettingController::class, 'update'])->name('setting.update');

    Route::resource('/keluhan', KeluhanController::class);
    Route::resource('/transaksi-out', TransaksiOutController::class);
    Route::resource('/ticketing', UserKeluhanController::class);
    Route::resource('/setting', SettingController::class)->except(['update']);


});