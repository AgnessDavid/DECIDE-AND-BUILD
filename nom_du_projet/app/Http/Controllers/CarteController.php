<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carte;
use Gloudemans\Shoppingcart\Facades\Cart;

class CarteController extends Controller
{
    // Ajouter un produit au panier
    public function addToCart($id)
    {
        $carte = Carte::findOrFail($id);

        Cart::add($carte->id_carte, $carte->titre, 1, $carte->prix);

        return redirect()->back()->with('success', 'Produit ajouté au panier !');
    }

    // Afficher le panier
    public function showCart()
    {
        return view('frontend.cart'); // Assurez-vous que resources/views/frontend/cart.blade.php existe
    }
}
