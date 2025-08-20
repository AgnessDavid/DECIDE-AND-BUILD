<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\TemplateController;


 
Route::get('/',[TemplateController::class,'index']);


use App\Http\Controllers\CartController; // Assurez-vous d'importer le contrôleur

// Route pour la page du panier
Route::get('/panier', [CartController::class, 'index'])->name('cart.index');

// Route pour ajouter un article au panier
// La variable {carte} correspondra à l'ID de la carte que vous passez dans la route
Route::post('/panier/ajouter/{carte}', [CartController::class, 'add'])->name('cart.add');

// Route pour mettre à jour un article (peut être une requête AJAX)
Route::patch('/panier/mettre-a-jour', [CartController::class, 'update'])->name('cart.update');

// Route pour supprimer un article (peut être une requête AJAX)
Route::delete('/panier/supprimer', [CartController::class, 'remove'])->name('cart.remove');

// Route pour vider le panier
Route::post('/panier/vider', [CartController::class, 'destroy'])->name('cart.destroy');