<?php

use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\DocumentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
Route::get('/', function () {
    return view('adminlte');
})->middleware('auth');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
// web.php
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');


Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    // Other profile routes
});

// Participant Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/first', [ParticipantController::class, 'index'])->name('participants.index');
    Route::get('/first/create', [ParticipantController::class, 'create'])->name('participants.create');
    Route::post('/first', [ParticipantController::class, 'store'])->name('participants.store');
    Route::get('/first/{participant}/edit', [ParticipantController::class, 'edit'])->name('participants.edit');
    Route::put('/first/{participant}', [ParticipantController::class, 'update'])->name('participants.update');
    Route::delete('/first/{participant}', [ParticipantController::class, 'destroy'])->name('participants.destroy');

    Route::get('/document', [DocumentController::class, 'index'])->name('document.index');
    Route::get('/document/dcreate', [DocumentController::class, 'create'])->name('document.create');
    Route::post('/document', [DocumentController::class, 'store'])->name('document.store');
    Route::get('/document/{documentType}/edit', [DocumentController::class, 'edit'])->name('document.edit');
    Route::put('/document/{documentType}', [DocumentController::class, 'update'])->name('document.update');
    Route::delete('/document/{documentType}', [DocumentController::class, 'destroy'])->name('document.destroy');
});

require __DIR__.'/auth.php';

