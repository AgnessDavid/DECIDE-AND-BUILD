<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produit;

class ProduitSeeder extends Seeder
{
    public function run(): void
    {
        // Génère 10 produits aléatoires via la factory
        Produit::factory()->count(15)->create();
    }
}
