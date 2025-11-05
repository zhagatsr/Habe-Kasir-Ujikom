<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

Route::get('/', fn()=>redirect('/login'));

Route::get('/login', [AuthController::class,'loginPage'])->name('login');
Route::post('/login', [AuthController::class,'login']);
Route::post('/logout', [AuthController::class,'logout'])->middleware('auth.kasir');

Route::middleware('auth.kasir')->group(function () {
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
});
