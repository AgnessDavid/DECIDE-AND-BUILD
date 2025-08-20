<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CarteController;
use App\Http\Controllers\ProfileController;

// Page d'accueil avec les cartes
Route::get('/', [TemplateController::class, 'index']);

// Tableau de bord (Breeze)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Routes profil (Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Ajouter un produit au panier
Route::get('/add-to-cart/{id}', [CarteController::class, 'addToCart'])->name('add.to.cart');

// Afficher le panier
Route::get('/panier', [CarteController::class, 'showCart'])->name('cart');

// Valider la commande (checkout)
Route::post('/checkout', [CheckoutController::class, 'checkout'])
     ->name('checkout')
     ->middleware('auth'); // le client doit être connecté

require __DIR__.'/auth.php';
