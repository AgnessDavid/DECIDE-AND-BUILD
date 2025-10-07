<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Produit;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FicheBesoin>
 */
class FicheBesoinFactory extends Factory
{
    protected $model = \App\Models\FicheBesoin::class;

    public function definition(): array
    {
        // Liste de noms de produits/cartes réalistes
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

        // Récupère un produit aléatoire
        $produit = Produit::inRandomOrder()->first();

        return [
            'produit_id' => $produit?->id,
            'produit_souhaite' => $produit?->nom_produit ?? $this->faker->randomElement($nomsProduits),

            'nom_structure' => $this->faker->company(),
            'type_structure' => $this->faker->randomElement(['societe', 'organisme', 'particulier']),
            'nom_interlocuteur' => $this->faker->name(),
            'fonction' => $this->faker->jobTitle(),

            'telephone' => $this->faker->phoneNumber(),
            'cellulaire' => $this->faker->phoneNumber(),
            'fax' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),

            'nom_agent_bnetd' => User::inRandomOrder()->first()?->name ?? $this->faker->name(),
            'date_entretien' => $this->faker->date(),
            'objectifs_vises' => $this->faker->sentence(),

            'commande_ferme' => $this->faker->boolean(),
            'demande_facture_proforma' => $this->faker->boolean(),

            'delai_souhaite' => $this->faker->date('Y-m-d', 'now'),  // date au format YYYY-MM-DD
            'date_livraison_prevue' => $this->faker->date('Y-m-d', 'now'),
            'date_livraison_reelle' => $this->faker->optional()->date('Y-m-d', 'now'),


            'signature_client' => null,
            'signature_agent_bnetd' => null,

            // Champs de carte géographique réalistes
            'type_carte' => $this->faker->randomElement(['Topographique', 'Routière', 'Hydrographique', 'Urbain', 'Touristique']),
            'echelle' => '1:' . $this->faker->numberBetween(1000, 50000),
            'orientation' => $this->faker->randomElement(['Nord', 'Sud', 'Est', 'Ouest']),
            'auteur' => $this->faker->name(),
            'symbole' => $this->faker->randomElement(['Montagne', 'Rivière', 'Route', 'Ville', 'Parc']),
            'type_element' => $this->faker->randomElement(['Relief', 'Hydrographie', 'Transport', 'Urbain', 'Touristique']),
            'latitude' => $this->faker->latitude(4.0, 10.0),   // coordonnées Côte d’Ivoire réalistes
            'longitude' => $this->faker->longitude(-8.0, -2.0),
            'nom_zone' => $this->faker->randomElement(['Abidjan', 'Bouaké', 'San Pedro', 'Korhogo', 'Yamoussoukro']),
            'type_zone' => $this->faker->randomElement(['Région', 'Département', 'Ville']),
        ];
    }
}
