<?php

namespace App\Http\Controllers;

use App\Models\CommandeOnline;
use App\Models\CommandeProduitOnline;
use App\Models\PanierOnline;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PanierController extends Controller
{
    /**
     * Afficher le panier de l'utilisateur connecté
     */
    public function index()
    {
        $userId = Auth::id();

        $paniers = PanierOnline::with('produit')
            ->where('online_id', $userId)
            ->where('statut', 'actif')
            ->get();

        $total_ht = $paniers->sum(fn($item) => $item->quantite * $item->prix_unitaire_ht);
        $total_ttc = $total_ht * 1.18;

        return view('panier', compact('paniers', 'total_ht', 'total_ttc'));
    }

    /**
     * Ajouter un produit au panier
     */
    public function ajouter(Request $request)
    {
        $request->validate([
            'produit_id' => 'required|exists:produits,id',
            'quantite' => 'required|integer|min:1',
        ]);

        $userId = Auth::id();
        $produit = Produit::findOrFail($request->produit_id);

        $panier = PanierOnline::where('online_id', $userId)
            ->where('produit_id', $produit->id)
            ->where('statut', 'actif')
            ->first();

        if ($panier) {
            $panier->update([
                'quantite' => $panier->quantite + $request->quantite,
            ]);
        } else {
            PanierOnline::create([
                'online_id' => $userId,
                'produit_id' => $produit->id,
                'quantite' => $request->quantite,
                'prix_unitaire_ht' => $produit->prix,
                'statut' => 'actif'
            ]);
        }

        return redirect()->route('panier')->with('success', 'Produit ajouté au panier.');
    }

    /**
     * Supprimer un produit du panier
     */
    public function supprimer($id)
    {
        $userId = Auth::id();

        $panier = PanierOnline::where('id', $id)
            ->where('online_id', $userId)
            ->where('statut', 'actif')
            ->first();

        if ($panier) {
            $panier->delete();
        }

        return back()->with('success', 'Produit supprimé du panier.');
    }

    /**
     * Valider le panier → créer la commande_online
     */
    public function valider()
    {
        $userId = Auth::id();
        $paniers = PanierOnline::where('online_id', $userId)
            ->where('statut', 'actif')
            ->get();

        if ($paniers->isEmpty()) {
            return back()->with('error', 'Votre panier est vide.');
        }

        // Calcul des montants
        $total_ht = $paniers->sum(fn($item) => $item->quantite * $item->prix_unitaire_ht);
        $total_ttc = $total_ht * 1.18;

        // Créer la commande principale
        $commande = CommandeOnline::create([
            'online_id' => $userId,
            'numero_commande' => 'CMD-' . time(),
            'total_ht' => $total_ht,
            'total_ttc' => $total_ttc,
            'etat' => 'en_cours',
        ]);

        // Créer les lignes de commande
        foreach ($paniers as $item) {
            CommandeProduitOnline::create([
                'commande_online_id' => $commande->id,
                'produit_id' => $item->produit_id,
                'quantite' => $item->quantite,
                'prix_unitaire_ht' => $item->prix_unitaire_ht,
                'montant_ht' => $item->quantite * $item->prix_unitaire_ht,
                'montant_ttc' => $item->quantite * $item->prix_unitaire_ht * 1.18,
            ]);

            $item->update(['statut' => 'converti']);
        }

        return redirect()->route('panier')->with('success', 'Commande validée avec succès !');



    }


}
