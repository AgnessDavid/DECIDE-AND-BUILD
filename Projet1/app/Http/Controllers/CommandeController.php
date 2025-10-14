<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\CommandeOnline;
use App\Models\PanierOnline;
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
        $clientId = auth()->id();

        // Récupérer ou créer le panier en cours
        $panier = PanierOnline::firstOrCreate(
            ['online_id' => $clientId, 'produit_id' => $produit->id, 'statut' => 'actif'],
            ['quantite' => 0, 'prix_unitaire_ht' => $produit->prix_unitaire_ht]
        );

        // Incrémenter la quantité
        $panier->quantite += 1;
        $panier->save();

        // Créer ou récupérer la ligne de commande correspondante
        $ligne = CommandeProduitOnline::firstOrCreate(
            [
                'commande_online_id' => CommandeOnline::firstOrCreate(
                    ['online_id' => $clientId, 'etat' => 'en_cours']
                )->id,
                'produit_id' => $produit->id,
            ],
            [
                'quantite' => 0,
                'prix_unitaire_ht' => $produit->prix_unitaire_ht,
                'montant_ht' => 0,
                'montant_ttc' => 0,
                'panier_id' => $panier->id, // ⚡ lie la ligne au panier
            ]
        );

        // Mettre à jour les montants
        $ligne->quantite += 1;
        $ligne->montant_ht = $ligne->quantite * $ligne->prix_unitaire_ht;
        $ligne->montant_ttc = $ligne->montant_ht * 1.18; // TVA 18%
        $ligne->save();

        return back()->with('success', "Quantité ajoutée pour {$produit->nom_produit}");
    }


    /**
     * Réduire la quantité d’un produit
     */
    public function reduireQuantite(Request $request, Produit $produit)
    {
        // Récupère la commande en cours pour l'utilisateur
        $commande = CommandeOnline::where('online_id', auth()->id())
            ->where('etat', 'en_cours')
            ->first();

        if (!$commande) {
            return back()->with('error', 'Aucune commande en cours.');
        }

        // Récupère la ligne de commande correspondante
        $ligne = CommandeProduitOnline::where('commande_online_id', $commande->id)
            ->where('produit_id', $produit->id)
            ->first();

        if ($ligne) {
            // Quantité à réduire (par défaut 1)
            $quantite = (int) $request->input('quantite', 1);
            $ligne->quantite -= $quantite;

            if ($ligne->quantite <= 0) {
                // Supprime la ligne si quantité <= 0
                $ligne->delete();
            } else {
                // Recalcul automatique des montants
                $ligne->montant_ht = $ligne->quantite * $ligne->prix_unitaire_ht;
                $ligne->montant_ttc = $ligne->montant_ht * (1 + ($produit->taux_tva ?? 0) / 100);
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


    public function validerCommande(Request $request)
    {
        // Vérifie si l'utilisateur est connecté
        if (!auth()->check()) {
            return redirect()->route('online.login')->with('error', 'Veuillez vous connecter pour valider votre commande.');
        }

        // Récupère la commande en cours du client
        $commande = CommandeOnline::where('online_id', auth()->id())
            ->where('etat', 'en_cours')
            ->first();

        if (!$commande) {
            return redirect()->route('panier')->with('error', 'Aucune commande en cours.');
        }

        // Vérifie s’il y a au moins un produit
        if ($commande->produits()->count() === 0) {
            return redirect()->route('panier')->with('error', 'Votre panier est vide.');
        }

        // Calcule le montant total
        $montantTotalHT = $commande->produits->sum(function ($produit) {
            return $produit->pivot->quantite * $produit->pivot->prix_unitaire_ht;
        });

        $montantTotalTTC = $montantTotalHT * 1.2; // exemple avec TVA 20%

        // Met à jour la commande
        $commande->update([
            'etat' => 'validee',
            'montant_ht' => $montantTotalHT,
            'montant_ttc' => $montantTotalTTC,
            'date_validation' => now(),
            'numero_commande' => 'CMD-' . strtoupper(uniqid()),
        ]);

        // (Optionnel) — Tu peux aussi vider le panier ici
        // CommandeProduitOnline::where('commande_online_id', $commande->id)->delete();

        return redirect()->route('accueil')->with('success', 'Votre commande a été validée avec succès !');
    }


}
