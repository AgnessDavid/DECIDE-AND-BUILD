<?php

namespace Database\Seeders;

use App\Models\Categorie;
use Illuminate\Database\Seeder;

class CategorieSeeder extends Seeder
{
    public function run(): void
    {
        Categorie::create(['nom_categorie' => 'Régions de France']);
        Categorie::create(['nom_categorie' => 'Capitales du Monde']);
        Categorie::create(['nom_categorie' => 'Paysages Naturels']);
    }
}