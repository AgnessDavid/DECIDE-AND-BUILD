<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProduitFactory extends Factory
{
    protected $model = \App\Models\Produit::class;

    public function definition(): array
    {
        $nomsProduits = [
            'Carte Topographique Côte d’Ivoire',
            'Plan de la ville d’Abidjan',
            'Carte Hydrographique du Bandama',
            'Carte Routière Nationale',
            'Carte Administrative des Régions',
            'Plan Urbain de Bouaké',
            'Carte Agricole du Cavally',
            'Carte Minéralogique de l’Indénié',
            'Carte Touristique du Bas-Sassandra',
            'Carte des Ressources Naturelles',
            'Carte des Parcs Nationaux',
            'Carte Historique de la Côte d’Ivoire',
            'Carte des Infrastructures Routières',
            'Plan de Développement Urbain',
            'Carte Géologique Nationale'
        ];

        $titres = [
            'Carte Topographique',
            'Plan Urbain',
            'Carte Hydrographique',
            'Carte Routière',
            'Carte Administrative',
            'Plan de Ville',
            'Carte Agricole',
            'Carte Minéralogique',
            'Carte Touristique',
            'Carte des Ressources',
            'Carte des Parcs',
            'Carte Historique',
            'Carte des Infrastructures',
            'Plan Développement',
            'Carte Géologique'
        ];

        return [
            'reference_produit' => strtoupper($this->faker->unique()->bothify('REF-###??')),
            'nom_produit' => $this->faker->randomElement($nomsProduits),
            'description' => $this->faker->sentence(10),
            'stock_minimum' => $this->faker->numberBetween(5, 50),
            'stock_maximum' => $this->faker->numberBetween(100, 500),
            'stock_actuel' => $this->faker->numberBetween(10, 200),
            'prix_unitaire_ht' => $this->faker->randomFloat(2, 50, 500),
            'photo' => $this->faker->imageUrl(640, 480, 'products', true, 'Produit'),

            // Champs de carte géographique
            'titre' => $this->faker->randomElement($titres),
            'echelle' => '1:' . $this->faker->numberBetween(1000, 50000),
            'orientation' => $this->faker->randomElement(['Nord', 'Sud', 'Est', 'Ouest']),
            'date_creation' => $this->faker->date(),
            'auteur' => $this->faker->name(),
            'symbole' => $this->faker->randomElement(['Montagne', 'Rivière', 'Route', 'Ville']),
            'type_element' => $this->faker->randomElement(['Relief', 'Hydrographie', 'Transport', 'Urbain']),
            'latitude' => $this->faker->latitude(-10, 10),  // proche de la Côte d’Ivoire
            'longitude' => $this->faker->longitude(-10, 10),
            'nom_zone' => $this->faker->city(),
            'type_zone' => $this->faker->randomElement(['Région', 'Pays', 'Département']),
        ];
    }
}
