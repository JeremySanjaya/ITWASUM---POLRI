<?php

use App\Http\Controllers\PresensiController;
use Illuminate\Support\Facades\Route;

// USER (ALUR 3 HALAMAN)
Route::get('/', [PresensiController::class, 'index'])->name('presensi.index');
Route::post('/signature', [PresensiController::class, 'signature'])->name('presensi.signature');
Route::post('/store', [PresensiController::class, 'store'])->name('presensi.store');
Route::get('/success', [PresensiController::class, 'success'])->name('presensi.success');

//  ADMIN (LANGSUNG AKSES)
Route::get('/dashboard_admin', [PresensiController::class, 'dashboard'])->name('admin.dashboard');