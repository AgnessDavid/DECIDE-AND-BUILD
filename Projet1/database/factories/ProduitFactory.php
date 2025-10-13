<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Produit;

class ProduitFactory extends Factory
{
    protected $model = Produit::class;

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
            'Carte Géologique Nationale',
            'Carte des Forêts Tropicales',
            'Plan d’Aménagement de Yamoussoukro',
            'Carte Hydrographique de la Comoé',
            'Carte Routière d’Abengourou',
            'Carte Administrative du Bas-Sassandra',
            'Plan Urbain de San Pedro',
            'Carte Agricole de la Marahoué',
            'Carte Minéralogique de la Bafing',
            'Carte Touristique de Korhogo',
            'Carte des Ressources Minières',
            'Carte des Parcs Naturels',
            'Carte Historique de Bouaké',
            'Carte des Infrastructures Portuaires',
            'Plan de Développement Industriel',
            'Carte Géologique de la Cavally',
            'Carte Topographique du Gôh',
            'Plan de la ville de Daloa',
            'Carte Hydrographique de la Bandama',
            'Carte Routière de San Pedro',
            'Carte Administrative de la Nawa',
            'Plan Urbain de Man',
            'Carte Agricole de l’Indénié',
            'Carte Minéralogique du Tonkpi',
            'Carte Touristique de Grand-Bassam',
            'Carte des Ressources Hydriques',
            'Carte des Parcs Forestiers',
            'Carte Historique de San Pedro',
            'Carte des Infrastructures Ferroviaires',
            'Plan de Développement Rural',
            'Carte Géologique de la Sassandra',
            'Carte Topographique de Korhogo',
            'Plan de la ville de Bouaké',
            'Carte Hydrographique du Cavally',
            'Carte Routière de Yamoussoukro',
            'Carte Administrative du Gôh',
            'Plan Urbain d’Abengourou',
            'Carte Agricole du Tonkpi'
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
            'Carte Géologique',
            'Carte des Forêts',
            'Plan Aménagement',
            'Carte des Rivières',
            'Carte Routière Locale',
            'Carte Administrative Régionale',
            'Plan Urbain Local',
            'Carte Agricole Spéciale',
            'Carte Minéralogique Locale',
            'Carte Touristique Régionale',
            'Carte des Ressources Minières',
            'Carte des Parcs Naturels',
            'Carte Historique Locale',
            'Carte des Infrastructures Portuaires',
            'Plan Développement Industriel',
            'Carte Géologique Spéciale',
            'Carte Topographique Régionale',
            'Plan Ville Daloa',
            'Carte Hydrographique Locale',
            'Carte Routière Urbaine',
            'Carte Administrative Locale',
            'Plan Urbain de Man',
            'Carte Agricole Locale',
            'Carte Minéralogique Régionale',
            'Carte Touristique Locale',
            'Carte des Ressources Naturelles',
            'Carte des Parcs Forestiers',
            'Carte Historique Régionale',
            'Carte Infrastructures Ferroviaires',
            'Plan Développement Rural',
            'Carte Géologique Régionale',
            'Carte Topographique Locale',
            'Plan Ville Bouaké',
            'Carte Hydrographique Spéciale',
            'Carte Routière Régionale',
            'Carte Administrative Locale',
            'Plan Urbain Spécial',
            'Carte Agricole Régionale'
        ];


        $prixHT = $this->faker->numberBetween(20000, 1000000);
        $tva = $this->faker->randomElement([0, 10, 12, 18]);
        $estPromo = $this->faker->boolean(30);

        return [
            // --- Informations de base ---
            'reference_produit' => strtoupper($this->faker->unique()->bothify('REF-###??')),

            'nom_produit' => $this->faker->randomElement($nomsProduits) . ' #' . $this->faker->unique()->numberBetween(1, 1000),


            'description' => $this->faker->sentence(15),
            'photo' => $this->faker->imageUrl(640, 480, 'products', true, 'Produit'),

            // --- Stock ---
            'stock_minimum' => $this->faker->numberBetween(5, 50),
            'stock_maximum' => $this->faker->numberBetween(100, 500),
            'stock_actuel' => $this->faker->numberBetween(10, 200),

            // --- Carte géographique ---
            'titre' => $this->faker->randomElement($titres),
            'type_carte' => $this->faker->randomElement(['carte', 'plan']), // pas "autre"


            'echelle' => '1:' . $this->faker->numberBetween(1000, 50000),
            'orientation' => $this->faker->randomElement(['Nord', 'Sud', 'Est', 'Ouest']),
            'date_creation' => $this->faker->date(),
            'auteur' => $this->faker->name(),
            'symbole' => $this->faker->randomElement(['Montagne', 'Rivière', 'Route', 'Ville']),
            'type_element' => $this->faker->randomElement(['Relief', 'Hydrographie', 'Transport', 'Urbain']),
            'latitude' => $this->faker->latitude(4, 10),
            'longitude' => $this->faker->longitude(-8, -2),
            'nom_zone' => $this->faker->city(),
            'type_zone' => $this->faker->randomElement(['Région', 'Pays', 'Département']),

            // --- E-commerce ---
            'categorie' => $this->faker->randomElement(['Topographique', 'Historique', 'Touristique', 'Routière']),
            'marque' => $this->faker->company(),
            'disponible' => $this->faker->boolean(90),
            'produit_non_disponible' => !$this->faker->boolean(80),
            'prix_unitaire_ht' => $prixHT,
            'taux_tva' => $tva,
            'prix_unitaire_ttc' => $prixHT * (1 + $tva / 100),
            'est_en_promotion' => $estPromo,
            'prix_promotion' => $estPromo ? $prixHT * $this->faker->randomFloat(2, 0.5, 0.9) : null,
            'est_actif' => true,
            'nombre_vues' => $this->faker->numberBetween(0, 500),
            'nombre_ventes' => $this->faker->numberBetween(0, 200),
            'largeur_cm' => $this->faker->randomFloat(2, 10, 100),
            'hauteur_cm' => $this->faker->randomFloat(2, 10, 100),
            'format' => $this->faker->randomElement(['A4', 'A3', 'A2', 'A1']),
            'etat_conservation' => $this->faker->randomElement(['neuf', 'excellent', 'bon', 'moyen', 'usage', 'restaure']),
            'tva' => $tva,
            'prix_ttc' => $prixHT * (1 + $tva / 100),
            'slug' => Str::slug($this->faker->unique()->word() . '-' . time()),
            'tags' => implode(',', $this->faker->randomElements(['historique', 'touristique', 'routière', 'administrative', 'agricole'], $this->faker->numberBetween(1, 3))),
        ];
    }
}
