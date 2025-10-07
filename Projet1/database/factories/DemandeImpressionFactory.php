<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Produit;
use App\Models\FicheBesoin;

class DemandeImpressionFactory extends Factory
{
    protected $model = \App\Models\DemandeImpression::class;

    public function definition(): array
    {
        // Liste des produits et titres
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

        // Choix aléatoire d'un produit
        $index = $this->faker->numberBetween(0, count($nomsProduits) - 1);
        $nomProduit = $nomsProduits[$index];
        $titreProduit = $titres[$index];

        // On récupère un produit existant ou on le crée
        $produit = Produit::firstOrCreate(
            ['nom_produit' => $nomProduit],
            ['titre' => $titreProduit]
        );

        return [
            'fiche_besoin_id' => FicheBesoin::inRandomOrder()->first()?->id,
            'produit_id' => $produit->id,
            'type_impression' => $this->faker->randomElement(['simple', 'specifique']),
            'nom_demandes' => $titreProduit,
            'numero_ordre' => $this->faker->unique()->numerify('ORD-IMP-####'),
            'designation' => $nomProduit,
            'quantite_demandee' => $this->faker->numberBetween(10, 100),
            'quantite_imprimee' => $this->faker->numberBetween(0, 100),
            'date_demande' => $this->faker->date('Y-m-d'),
            'agent_commercial' => $this->faker->name(),
            'service' => $this->faker->word(),
            'objet' => $this->faker->sentence(),
            'date_visa_chef_service' => $this->faker->optional()->date('Y-m-d'),
            'nom_visa_chef_service' => $this->faker->optional()->name(),
            'date_autorisation' => $this->faker->optional()->date('Y-m-d'),
            'est_autorise_chef_informatique' => $this->faker->boolean(),
            'nom_visa_autorisateur' => $this->faker->optional()->name(),
            'date_impression' => $this->faker->optional()->date('Y-m-d'),
        ];
    }
}
