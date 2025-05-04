<?php
use App\Http\Controllers\WisataController;
use Illuminate\Support\Facades\Route;

Route::get('/wisata', [WisataController::class, 'index'])->name('wisata.index');
Route::get('/wisata/create', [WisataController::class, 'create'])->name('wisata.create');
Route::post('/wisata', [WisataController::class, 'store'])->name('wisata.store');
Route::get('/wisata/search', [WisataController::class, 'search'])->name('wisata.search');
Route::get('/wisata', [WisataController::class, 'index'])->name('wisata.index');
Route::get('/wisata/{id}/galeri', [WisataController::class, 'galeri'])->name('wisata.galeri');
Route::get('/wisata/{id}/edit', [WisataController::class, 'edit'])->name('wisata.edit');
Route::put('/wisata/{id}', [WisataController::class, 'update'])->name('wisata.update');
Route::delete('/wisata/{id}', [WisataController::class, 'destroy'])->name('wisata.destroy');

