<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\CommandeOnline;
use App\Models\Online;
use App\Models\CommandeProduitOnline;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    /**
     * Afficher le panier de l'utilisateur connecté
     */
    public function afficherPanier()
    {
        if (!auth()->check()) {
            return redirect()->route('online.login')->with('error', 'Veuillez vous connecter pour voir votre panier.');
        }

        $client = auth()->user();

        $commande = $client->commandeEnCoursOnline()->first();

        if (!$commande) {
            $commande = CommandeOnline::create([
                'online_id' => $client->id,
                'etat' => 'en_cours',
            ]);
        }

        return view('panier', compact('commande'));
    }

    /**
     * Ajouter un produit au panier
     */
    public function ajouterQuantite(Request $request, Produit $produit)
    {
        $commande = CommandeOnline::firstOrCreate(
            ['online_id' => auth()->id(), 'etat' => 'en_cours']
        );

        $quantite = (int) $request->input('quantite', 1);
        $ligne = CommandeProduitOnline::firstOrCreate(
            [
                'commande_online_id' => $commande->id,
                'produit_id' => $produit->id,
            ],
            [
                'quantite' => 0,
                'prix_unitaire_ht' => $produit->prix_unitaire_ht,
                'montant_ht' => 0,
                'montant_ttc' => 0, // ⚠️ ajouter ici
            ]



        );

        $ligne->quantite += 1; // incrémente
        // Si tu veux calculer automatiquement :
        $ligne->montant_ht = $ligne->quantite * $ligne->prix_unitaire_ht;
        $ligne->montant_ttc = $ligne->montant_ht * (1 + ($produit->taux_tva ?? 0) / 100);
        $ligne->save();
        // Si tu veux mettre le montant automatiquement :
        $ligne->montant_ht = $ligne->quantite * $ligne->prix_unitaire_ht;
        $ligne->save();
        return back()->with('success', "Quantité ajoutée pour {$produit->nom_produit}");
    }

    /**
     * Réduire la quantité d’un produit
     */
    public function reduireQuantite(Request $request, Produit $produit)
    {
        $commande = CommandeOnline::where('online_id', auth()->id())
            ->where('etat', 'en_cours')
            ->first();

        if (!$commande)
            return back();

        $ligne = CommandeProduitOnline::where('commande_online_id', $commande->id)
            ->where('produit_id', $produit->id)
            ->first();

        if ($ligne) {
            $ligne->quantite -= (int) $request->input('quantite', 1);
            if ($ligne->quantite <= 0) {
                $ligne->delete();
            } else {
                $ligne->save();
            }
        }




        return back()->with('success', "Quantité réduite pour {$produit->nom_produit}");
    }

    /**
     * Supprimer complètement un produit
     */
    public function supprimerProduit(Produit $produit)
    {
        $commande = CommandeOnline::where('online_id', auth()->id())
            ->where('etat', 'en_cours')
            ->first();

        if (!$commande)
            return back();

        $ligne = CommandeProduitOnline::where('commande_online_id', $commande->id)
            ->where('produit_id', $produit->id)
            ->first();

        if ($ligne)
            $ligne->delete();

        return back()->with('success', "{$produit->nom_produit} supprimé du panier");
    }

    /**
     * Vider tout le panier
     */
    public function viderPanier()
    {
        $commande = CommandeOnline::where('online_id', auth()->id())
            ->where('etat', 'en_cours')
            ->first();

        if ($commande) {
            $commande->produits()->detach(); // relation Many-to-Many
        }

        return back()->with('success', 'Panier vidé avec succès');
    }
}
