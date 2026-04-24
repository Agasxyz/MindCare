<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ArtikelController;
use App\Http\Controllers\Api\KomunitasController;
use App\Http\Controllers\Api\KomentarController;
use App\Http\Controllers\Api\MoodTrackerController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'me']);

    // Artikel
    Route::get('/articles', [ArtikelController::class, 'index']);
    Route::get('/articles/{id}', [ArtikelController::class, 'show']);

    // Komunitas
    Route::get('/community', [KomunitasController::class, 'index']);
    Route::post('/community', [KomunitasController::class, 'store']);
    Route::get('/community/{id}', [KomunitasController::class, 'show']);
    Route::post('/community/comment', [KomentarController::class, 'store']);

    // Mood Tracker
    Route::get('/moods', [MoodTrackerController::class, 'index']);
    Route::post('/moods', [MoodTrackerController::class, 'store']);
});
