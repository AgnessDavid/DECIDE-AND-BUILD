<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\PanierOnline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProduitController extends Controller
{
    /**
     * Afficher tous les produits (boutique)
     */
    public function index(Request $request)
    {
        $query = Produit::query()->actif();

        // Filtrage recherche
        if ($request->filled('recherche')) {
            $recherche = $request->input('recherche');
            $query->where('nom_produit', 'LIKE', "%{$recherche}%")
                ->orWhere('tags', 'LIKE', "%{$recherche}%");
        }

        $produits = $query->orderBy('nom_produit')->paginate(20);

        return view('boutique.index', compact('produits'));
    }

    /**
     * Ajouter un produit au panier
     */
    public function ajouterAuPanier(Request $request, Produit $produit)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vous devez vous connecter.');
        }

        $quantite = (int) $request->input('quantite', 1);

        $panier = PanierOnline::updateOrCreate(
            [
                'online_id' => Auth::id(),
                'produit_id' => $produit->id,
                'statut' => 'actif',
            ],
            [
                'quantite' => $quantite,
                'prix_unitaire_ht' => $produit->prix_unitaire_ht,
            ]
        );

        return back()->with('success', "{$produit->nom_produit} ajouté au panier.");
    }
}
