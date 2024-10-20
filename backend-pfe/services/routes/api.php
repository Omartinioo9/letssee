<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\NotificationController;

// Utilisateur routes
Route::apiResource('utilisateur', UtilisateurController::class);
Route::get('/utilisateur/{id}', [UtilisateurController::class,'FindUtilisateur'])->middleware('auth:sanctum');;

// Auth routes
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Offer routes
Route::post('/offers', [OfferController::class, 'store']);
Route::post('/offers/{id}/start', [OfferController::class, 'startOffer'])->middleware('auth:sanctum');
Route::get('/offers', [OfferController::class, 'index']);
Route::get('/offers/{id}', [OfferController::class, 'show']);

// Utilisateur update routes
Route::put('/user/update', [UtilisateurController::class, 'update'])->middleware('auth:sanctum');
Route::post('/user/update/avatar', [UtilisateurController::class, 'updateAvatar'])->middleware('auth:sanctum');

// Review routes
Route::get('/utilisateur/{id}/reviews', [ReviewController::class, 'getUserReviews']);

// Notification routes
Route::get('/notifications', [NotificationController::class, 'index'])->middleware('auth:sanctum');
Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->middleware('auth:sanctum');

