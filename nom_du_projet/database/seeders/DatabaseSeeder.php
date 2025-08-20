<?php

namespace Database\Seeders;

use Database\Seeders\CategorieSeeder;
use Database\Seeders\CarteSeeder;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        $this->call(CategorieSeeder::class);
        $this->call(CarteSeeder::class);
    }
}