<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ParController;



Route::get('/participants', [ParController::class, 'index']);
Route::post('/participants', [ParController::class, 'store']);
Route::get('/participants/{participant}', [ParController::class, 'show']);
Route::put('/participants/{participant}', [ParController::class, 'update']);
Route::delete('/participants/{participant}', [ParController::class, 'destroy']);


