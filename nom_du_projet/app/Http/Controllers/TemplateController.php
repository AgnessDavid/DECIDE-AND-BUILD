<?php

namespace App\Http\Controllers;

use App\Models\Carte;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    public function index()
    {
        $cartes = Carte::all(); // récupère toutes les cartes
        return view('frontend.home', compact('cartes'));
    }
}
