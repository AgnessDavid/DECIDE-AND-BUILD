<?php

namespace App\Http\Controllers;

use App\Models\CommandeOnline;
use App\Models\PanierOnline;
use Illuminate\Http\Request;
use App\Models\Produit;
use Illuminate\Support\Facades\Auth;

class PanierController extends Controller
{
    /**
     * Afficher le panier en cours pour l'utilisateur connecté
     */
    public function index(Request $request)
    {
        $userId = Auth::id(); // id du client online connecté

        // Récupérer le panier en cours
        $paniers = PanierOnline::with('produit')
            ->where('online_id', $userId)
            ->where('statut', 'actif')
            ->get();

        // Calculer le total HT et TTC
        $total_ht = $paniers->sum(function ($item) {
            return $item->quantite * $item->prix_unitaire_ht;
        });
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

        $panier = PanierOnline::updateOrCreate(
            [
                'online_id' => $userId,
                'produit_id' => $request->produit_id,
                'statut' => 'actif'
            ],
            [
                'quantite' => $request->quantite,
                'prix_unitaire_ht' => Produit::find($request->produit_id)->prix
            ]
        );

        return back()->with('success', 'Produit ajouté au panier');
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

        return back()->with('success', 'Produit supprimé du panier');
    }

    /**
     * Valider le panier → créer une commande_online
     */
    public function valider(Request $request)
    {
        $userId = Auth::id();
        $paniers = PanierOnline::where('online_id', $userId)
            ->where('statut', 'actif')
            ->get();

        if ($paniers->isEmpty()) {
            return back()->with('error', 'Votre panier est vide');
        }

        // Créer la commande
        $total_ht = $paniers->sum(fn($item) => $item->quantite * $item->prix_unitaire_ht);
        $total_ttc = $total_ht * 1.18;

        $commande = CommandeOnline::create([
            'online_id' => $userId,
            'numero_commande' => 'CMD-ONLINE-' . time(),
            'total_ht' => $total_ht,
            'total_ttc' => $total_ttc,
            'etat' => 'en_cours'
        ]);

        // Créer les lignes de commande
        foreach ($paniers as $item) {
            $commande->produits()->attach($item->produit_id, [
                'quantite' => $item->quantite,
                'prix_unitaire_ht' => $item->prix_unitaire_ht,
                'montant_ht' => $item->quantite * $item->prix_unitaire_ht,
                'montant_ttc' => $item->quantite * $item->prix_unitaire_ht * 1.18
            ]);

            // Marquer le panier comme converti
            $item->statut = 'converti';
            $item->save();
        }

        // Créer la caisse associée
        $commande->caisse()->create([
            'online_id' => $userId,
            'montant_ht' => $total_ht,
            'tva' => $total_ttc - $total_ht,
            'montant_ttc' => $total_ttc,
            'entree' => 0,
            'sortie' => 0,
            'statut_paiement' => 'impayé'
        ]);

        return redirect()->route('panier')->with('success', 'Commande créée avec succès');
    }
}
