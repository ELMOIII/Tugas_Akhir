<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/laba-rugi', [TransaksiController::class, 'labaRugi']);

Route::get('/pemasukan', [PemasukanController::class, 'index']);
Route::get('/pemasukan/create', [PemasukanController::class, 'create']);
Route::post('/pemasukan', [PemasukanController::class, 'store']);
Route::delete('/pemasukan/{id}', [PemasukanController::class, 'destroy']);

Route::middleware(['auth'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/laporan', [TransaksiController::class, 'laporan']);
    Route::get('/laba-rugi', [LaporanController::class, 'labaRugi']);
    Route::get('/grafik', [LaporanController::class, 'grafik']);
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('barang', BarangController::class);
    Route::resource('transaksi', TransaksiController::class);
    Route::resource('pengeluaran', PengeluaranController::class);

});

require __DIR__.'/auth.php';