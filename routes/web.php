<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\TransaksiController;

// --------------------
// Redirect root ke login
// --------------------
Route::get('/', fn() => redirect('/login'));

// --------------------
// AUTH
// --------------------
Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth.kasir');

// --------------------
// DASHBOARD (hanya bisa diakses setelah login)
// --------------------
Route::middleware('auth.kasir')->group(function () {

    // --------------------
    // DASHBOARD
    // --------------------
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // --------------------
    // BARANG
    // --------------------
    Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
    Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
    Route::put('/barang/{id}', [BarangController::class, 'update'])->name('barang.update');
    Route::delete('/barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');
    Route::get('/barang/search', [BarangController::class, 'search'])->name('barang.search');

    // --------------------
    // TRANSAKSI
    // --------------------
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');

    // === Semua aksi keranjang ===
    Route::post('/transaksi/cart/add',    [TransaksiController::class, 'cartAdd'])->name('transaksi.cart.add');
    Route::post('/transaksi/cart/inc',    [TransaksiController::class, 'cartInc'])->name('transaksi.cart.inc');
    Route::post('/transaksi/cart/dec',    [TransaksiController::class, 'cartDec'])->name('transaksi.cart.dec');
    Route::post('/transaksi/cart/remove', [TransaksiController::class, 'cartRemove'])->name('transaksi.cart.remove');
    Route::post('/transaksi/cart/clear',  [TransaksiController::class, 'cartClear'])->name('transaksi.cart.clear');
    Route::post('/transaksi/checkout',    [TransaksiController::class, 'checkout'])->name('transaksi.checkout');
    Route::post('/transaksi/cart/set', [TransaksiController::class, 'cartSetQty'])->name('transaksi.cart.set');
    Route::post('/transaksi/cart/update-qty', [TransaksiController::class, 'cartUpdateQty'])->name('transaksi.cart.updateQty');

     // --------------------
    // LAPORAN
    // --------------------
    Route::get('/laporan', [\App\Http\Controllers\LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/detail/{id}', [\App\Http\Controllers\LaporanController::class, 'detail'])->name('laporan.detail');
    Route::get('/laporan/cetak', [\App\Http\Controllers\LaporanController::class, 'cetak'])->name('laporan.cetak');


});
