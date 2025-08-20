<?php

namespace Database\Factories;

use App\Models\Carte; // <-- Assurez-vous que c'est bien le modèle Carte ici
use App\Models\Categorie; // <-- N'oubliez pas d'importer le modèle Categorie aussi
use Illuminate\Database\Eloquent\Factories\Factory;

class CarteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Carte::class; // <-- Doit pointer vers le modèle Carte

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // On récupère une catégorie existante. Si aucune n'existe, on en crée une.
        $categorie = Categorie::inRandomOrder()->first() ?? Categorie::factory()->create();

        return [
            'titre' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(2),
            'image' => $this->faker->imageUrl(640, 480, 'cartes', true), // URL d'image factice
            'prix' => $this->faker->randomFloat(2, 5, 50),
            'stock' => $this->faker->numberBetween(0, 100),
            'id_categorie' => $categorie->id_categorie, // Clé étrangère vers la catégorie
        ];
    }
}