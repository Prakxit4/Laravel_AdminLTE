<?php

use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\DocumentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('adminlte');
});

// Participant Routes
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
