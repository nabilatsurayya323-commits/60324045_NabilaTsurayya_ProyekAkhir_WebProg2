<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\KategoriController; // TAMBAHKAN CONTROLLER KATEGORI
use Illuminate\Support\Facades\Route;

// Public routes (tanpa auth)
Route::get('/', function () {
    return redirect()->route('login');
});

// Protected routes (dengan auth middleware)
Route::middleware(['auth'])->group(function () {
    
    // ==========================================
    // RUTE EXPORT (Wajib Paling Atas)
    // ==========================================
    Route::get('/anggota/export', [AnggotaController::class, 'exportExcel'])->name('anggota.export');
    Route::get('/buku/export', [BukuController::class, 'export'])->name('buku.export');
    Route::get('/transaksi/export-pdf', [TransaksiController::class, 'exportPdf'])->name('transaksi.export-pdf');
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Kategori - CRUD Routes (TAMBAHKAN INI)
    Route::resource('kategori', KategoriController::class);

    // Buku - Custom Routes
    Route::get('/buku/search', [BukuController::class, 'search'])->name('buku.search');
    // MODIFIKASI: Ubah nama parameter {kategori} menjadi {kategoriId} agar sinkron dengan BukuController Anda
    Route::get('/buku/kategori/{kategoriId}', [BukuController::class, 'filterKategori'])->name('buku.kategori');
    Route::post('/buku/bulk-delete', [BukuController::class, 'bulkDelete'])->name('buku.bulk-delete');
    Route::resource('buku', BukuController::class);

    // Anggota - Custom Routes
    Route::get('/anggota/search', [AnggotaController::class, 'search'])->name('anggota.search');
    Route::resource('anggota', AnggotaController::class);

    // Transaksi - Custom & Laporan Routes
    Route::get('/transaksi/laporan', [TransaksiController::class, 'laporan'])->name('transaksi.laporan');
    Route::put('/transaksi/{id}/kembalikan', [TransaksiController::class, 'kembalikan'])->name('transaksi.kembalikan');
    Route::resource('transaksi', TransaksiController::class);

    // Global Search
    Route::get('/search', [SearchController::class, 'index'])->name('search');
});

require __DIR__.'/auth.php';