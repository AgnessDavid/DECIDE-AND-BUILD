<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    // Page d'accueil
    public function index() {
        return view('index'); // resources/views/index.blade.php
    }

    // Page welcome
    public function welcome() {
        return view('welcome'); // resources/views/welcome.blade.php
    }

    // Tu peux ajouter d'autres pages ici
    public function about() {
        return view('about'); // resources/views/about.blade.php
    }
}
