<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart; // Pour gérer le panier
use App\Models\Commande;
use App\Models\LigneCommande;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        // 1️⃣ Créer une commande pour le client connecté
        $commande = Commande::create([
            'id_client' => auth()->id(),       // ID du client
            'montant_total' => Cart::total(),  // Total du panier
        ]);

        // 2️⃣ Ajouter chaque produit du panier dans la table lignes_commande
        foreach (Cart::content() as $item) {
            LigneCommande::create([
                'id_commande' => $commande->id_commande,
                'id_carte'    => $item->id,
                'quantite'    => $item->qty,
                'prix_unitaire'=> $item->price,
            ]);
        }

        // 3️⃣ Vider le panier après validation
        Cart::destroy();

        // 4️⃣ Rediriger avec un message de succès
        return redirect()->route('home')->with('success', 'Commande validée !');
    }
}
