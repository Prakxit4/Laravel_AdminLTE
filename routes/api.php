<?php 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ParController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/participants', [ParController::class, 'index']);
    Route::post('/participants', [ParController::class, 'store']);
    Route::get('/participants/{participant}', [ParController::class, 'show']);
    Route::put('/participants/{participant}', [ParController::class, 'update']);
    Route::delete('/participants/{participant}', [ParController::class, 'destroy']);
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);
Route::middleware('auth:sanctum')->delete('/logout', [AuthController::class, 'logout']);
