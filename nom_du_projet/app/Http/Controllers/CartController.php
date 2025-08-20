<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carte; // N'oubliez pas d'importer votre modèle Carte

class CartController extends Controller
{
    /**
     * Ajoute un article au panier.
     */
    public function add(Request $request, Carte $carte)
    {
        $panier = session()->get('panier', []); // Récupère le panier de la session, ou un tableau vide

        $quantite = $request->input('quantite', 1);

        // Vérifie si la carte existe déjà dans le panier
        if (isset($panier[$carte->id_carte])) {
            $panier[$carte->id_carte]['quantite'] += $quantite;
        } else {
            $panier[$carte->id_carte] = [
                "id" => $carte->id_carte,
                "titre" => $carte->titre,
                "quantite" => $quantite,
                "prix" => $carte->prix,
                "image" => $carte->image
            ];
        }

        session()->put('panier', $panier); // Sauvegarde le panier dans la session

        return redirect()->route('cart.index')->with('success_message', 'Carte ajoutée au panier !');
    }

    /**
     * Affiche le contenu du panier.
     */
    public function index()
    {
        // Récupère le panier de la session
        $panier = session()->get('panier', []);
        return view('frontend.cart.index', compact('panier'));
    }

    /**
     * Met à jour la quantité d'un article dans le panier.
     */
    public function update(Request $request)
    {
        $panier = session()->get('panier');

        if (isset($panier[$request->id]) && $request->quantite > 0) {
            $panier[$request->id]['quantite'] = $request->quantite;
            session()->put('panier', $panier);
            return response()->json(['success_message' => 'Quantité mise à jour !']);
        }

        return response()->json(['error_message' => 'Erreur lors de la mise à jour !'], 400);
    }

    /**
     * Supprime un article du panier.
     */
    public function remove(Request $request)
    {
        $panier = session()->get('panier');
        if (isset($panier[$request->id])) {
            unset($panier[$request->id]);
            session()->put('panier', $panier);
            return response()->json(['success_message' => 'Article retiré du panier !']);
        }

        return response()->json(['error_message' => 'Erreur lors de la suppression !'], 400);
    }

    /**
     * Vide le panier.
     */
    public function destroy()
    {
        session()->forget('panier');
        return redirect()->route('cart.index')->with('success_message', 'Panier vidé !');
    }
}