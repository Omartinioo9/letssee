<?php

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\AuthMiddleware;
// use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ReviewController;


// Route::get('/session-data', [UtilisateurController::class, 'showPr']);


Route::apiResource("utilisateur", UtilisateurController::class);

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::middleware(['auth', 'role:client'])->group(function () {
    // Route::get('/offers/create', [OfferController::class, 'create'])->name('offers.create');
    Route::post('/offers', [OfferController::class, 'store']);
// });
// Route::middleware(['auth', 'role:developer'])->group(function () {
    Route::get('/offers', [OfferController::class, 'index']);
    Route::get('offers/{id}', [OfferController::class, 'show']);
    // });
Route::put('/user/update', [UtilisateurController::class, 'update'])->middleware('auth:sanctum');
Route::post('user/update/avatar', [UtilisateurController::class, 'updateAvatar'])->middleware('auth:sanctum');


Route::get('/utilisateur/{id}/reviews', [ReviewController::class, 'getUserReviews']);
