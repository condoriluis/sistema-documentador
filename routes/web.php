<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DocumentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');
    Route::get('/documents/create', [DocumentController::class, 'create'])->name('documents.create');
    Route::post('/documents', [DocumentController::class, 'store'])->name('documents.store');
    Route::get('/documents/{filename}', [DocumentController::class, 'show'])->name('documents.show');
    Route::get('/documents/download/{filename}', [DocumentController::class, 'download'])->name('documents.download');
    Route::get('/documents/{filename}/edit', [DocumentController::class, 'edit'])->name('documents.edit');
    Route::put('/documents/{filename}', [DocumentController::class, 'update'])->name('documents.update');
    Route::delete('/documents/{filename}', [DocumentController::class, 'destroy'])->name('documents.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
