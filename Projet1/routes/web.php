<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OnlineAuthController;

// ------------------------
// BACK (Admin / Filament)
// ------------------------
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php'; // routes Filament / admin

// ------------------------
// FRONT (Client / Online)
// ------------------------

// Page d'accueil
Route::get('/', function () {
    return view('index');
})->name('accueil');

// Boutique
Route::get('/boutique', function () {
    return view('boutique');
})->name('boutique');

// Panier
Route::get('/panier', function () {
    return view('panier');
})->name('panier');

// Contact
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// ------------------------
// Auth Front (Online)
// ------------------------

// Affichage formulaire inscription / connexion
Route::get('/inscription', [OnlineAuthController::class, 'showRegisterForm'])->name('online.register');
Route::post('/inscription', [OnlineAuthController::class, 'register']);

Route::get('/connexion', [OnlineAuthController::class, 'showLoginForm'])->name('online.login');
Route::post('/connexion', [OnlineAuthController::class, 'login']);

// Déconnexion front
Route::post('/deconnexion', [OnlineAuthController::class, 'logout'])->name('online.logout');

// Dashboard client (protégé par le guard "online")
Route::middleware('auth:online')->group(function () {
    Route::get('/dashboard-front', function () {
        return view('front.dashboard');
    })->name('online.dashboard');
});
