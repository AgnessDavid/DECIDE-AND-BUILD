<?php

namespace Database\Seeders;

use App\Models\Carte;
use App\Models\Categorie;
use Illuminate\Database\Seeder;

class CarteSeeder extends Seeder
{
    public function run(): void
    {
        // Créer les cartes
        Carte::factory(20)->create();
    }
}