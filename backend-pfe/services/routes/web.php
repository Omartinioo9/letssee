<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UtilisateurController;

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/utilisateurs', [UtilisateurController::class, 'index'])->name('utilisateurs.index');
