<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OnlineAuthController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\PanierController;
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

// ------------------------
// Boutique / Produits
// ------------------------
Route::get('/boutique', [ProduitController::class, 'index'])->name('boutique');
Route::get('/boutique/{slug}', [ProduitController::class, 'show'])->name('produit.show');

// Routes protégées pour gérer les produits (admin)
Route::middleware('auth')->group(function () {
    Route::get('/boutique/create', [ProduitController::class, 'create'])->name('produit.create');
    Route::post('/boutique', [ProduitController::class, 'store'])->name('produit.store');
    Route::get('/boutique/{produit}/edit', [ProduitController::class, 'edit'])->name('produit.edit');
    Route::put('/boutique/{produit}', [ProduitController::class, 'update'])->name('produit.update');
    Route::delete('/boutique/{produit}', [ProduitController::class, 'destroy'])->name('produit.destroy');
});

// Filtrage / Promotions / Type / Zone
Route::prefix('boutique')->group(function () {
    Route::get('/promotions', [ProduitController::class, 'promotions'])->name('produit.promotions');
    Route::get('/type/{type}', [ProduitController::class, 'parType'])->name('produit.parType');
    Route::get('/zone/{zone}', [ProduitController::class, 'parZone'])->name('produit.parZone');
});

// ------------------------
// Panier et commandes (client online)
// ------------------------
Route::middleware('auth:online')->group(function () {
    // Afficher le panier
    Route::get('/panier', [CommandeController::class, 'afficherPanier'])->name('panier');

    // Ajouter, réduire ou supprimer un produit du panier
    Route::post('/panier/ajouter/{produit}', [CommandeController::class, 'ajouterQuantite'])->name('panier.ajouter');
    Route::post('/panier/reduire/{produit}', [CommandeController::class, 'reduireQuantite'])->name('panier.reduire');
    Route::delete('/panier/supprimer/{produit}', [CommandeController::class, 'supprimerProduit'])->name('panier.supprimer');
    Route::delete('/panier/vider', [CommandeController::class, 'viderPanier'])->name('panier.vider');
    
    Route::post('/panier/valider', [CommandeController::class, 'validerCommande'])->name('panier.valider');


    // Dashboard client
    Route::get('/dashboard-front', function () {
        return view('front.dashboard');
    })->name('online.dashboard');
});

// ------------------------
// Auth Front (Online)
// ------------------------
Route::get('/inscription', [OnlineAuthController::class, 'showRegisterForm'])->name('online.register');
Route::post('/inscription', [OnlineAuthController::class, 'register']);

Route::get('/connexion', [OnlineAuthController::class, 'showLoginForm'])->name('online.login');
Route::post('/connexion', [OnlineAuthController::class, 'login']);

Route::post('/deconnexion', [OnlineAuthController::class, 'logout'])->name('online.logout');

// ------------------------
// Contact
// ------------------------
Route::get('/contact', function () {
    return view('contact');
})->name('contact');



Route::get('/resume/{id}', [CommandeController::class, 'resume'])->name('resume');

