<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Imprimerie extends Model
{
    protected $fillable = [
        'validation_id',
        'demande_id',
        'nom_produit',
        'quantite_a_imprimer',
        'valide_par',
        'operateur',
        'date_impression',
    ];

    public static function createFromValidation($validation)
    {
        if ($validation->type === 'fiche_besoin') {
            foreach ($validation->document->produits ?? [] as $produit) {
                self::create([
                    'validation_id' => $validation->id,
                    'nom_produit' => $produit->nom_produit,
                    'quantite_a_imprimer' => $produit->quantite_demandee,
                    'valide_par' => $validation->user->name ?? null,
                ]);
            }
        }

        if ($validation->type === 'demande_impression') {
            $demande = $validation->document;
            self::create([
                'validation_id' => $validation->id,
                'demande_id' => $demande->id,
                'nom_produit' => $demande->designation,
                'quantite_a_imprimer' => $demande->quantite_demandee,
                'valide_par' => $validation->user->name ?? null,
            ]);
        }
    }
}

