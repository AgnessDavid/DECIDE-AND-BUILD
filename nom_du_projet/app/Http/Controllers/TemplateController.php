<?php

namespace App\Http\Controllers;

use App\Models\Carte;
use Illuminate\Http\Request;
use App\Models\Card; // Assurez-vous d'importer le modèle Carte !

class TemplateController extends Controller
{
    public function index(){
        // Récupère toutes les cartes de la base de données
        $cartes = Carte::all();

        // Passe les cartes à la vue avec le nom correct
        return view('frontend.home', compact('cartes'));
    }
}