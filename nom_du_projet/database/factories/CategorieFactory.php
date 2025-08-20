<?php

namespace Database\Factories;

use App\Models\Categorie; // Le modèle de la factory
use Illuminate\Database\Eloquent\Factories\Factory;

class CategorieFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Categorie::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom_categorie' => $this->faker->unique()->word(),
        ];
    }
}