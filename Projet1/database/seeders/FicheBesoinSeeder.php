<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FicheBesoin;

class FicheBesoinSeeder extends Seeder
{
    public function run(): void
    {
        // Crée 15 fiches de besoin
        FicheBesoin::factory()->count(15)->create();
    }
}
