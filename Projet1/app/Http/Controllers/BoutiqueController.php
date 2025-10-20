<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;

class BoutiqueController extends Controller
{
    public function index(Request $request)
    {
        // Récupérer toutes les catégories distinctes
        $categories = Produit::select('categorie')->distinct()->get();

        // Construire la requête
        $query = Produit::query();

        // Filtrer par catégorie si sélectionnée
        if ($request->categorie) {
            $query->where('categorie', $request->categorie);
        }

        // Tri par prix si demandé
        if ($request->tri) {
            if ($request->tri === 'prix_croissant') {
                $query->orderByRaw('COALESCE(prix_promotion, prix_unitaire_ttc) ASC');
            } elseif ($request->tri === 'prix_decroissant') {
                $query->orderByRaw('COALESCE(prix_promotion, prix_unitaire_ttc) DESC');
            }
        }

        // Pagination
        $produits = $query->paginate(12)->withQueryString();

        return view('boutique.index', compact('produits', 'categories'));
    }



    public function rechercher(Request $request)
    {
        $query = $request->input('q');

        // Rechercher les produits correspondants
        $resultats = \App\Models\Produit::where('nom_produit', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->orWhere('categorie', 'like', "%{$query}%")
            ->take(10) // Limite à 10 résultats pour la suggestion
            ->get(['id', 'nom_produit', 'photo']);

        // Si c’est une requête AJAX, renvoyer les résultats en JSON
        if ($request->ajax()) {
            return response()->json($resultats);
        }

        // Sinon, afficher la page de résultats complète
       // return view('boutique.index', compact('resultats', 'query'));
    }
}
