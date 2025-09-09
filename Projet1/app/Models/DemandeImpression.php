<?php

namespace App\Models;
use App\Models\MouvementStock;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class DemandeImpression extends Model
{
    protected $table = 'demandes_impression';

    protected $fillable = [


    'fiche_besoin_id',
    'type_impression',
    'produit_id',
    'produit_souhaite',

    'numero_ordre',
    'designation',
    'quantite_demandee',
    'quantite_imprimee',
    'date_demande',
    'agent_commercial',
    'service',
    'objet',
    'date_visa_chef_service',
    'nom_visa_chef_service',
    'date_autorisation',
    'est_autorise_chef_informatique',
    'nom_visa_autorisateur',
    'date_impression',
    'quantite_totale_imprimee',
    'nom_visa_agent_impression',
    'date_reception_stock',
    'quantite_totale_receptionnee',
    'details_reception',
    'observations',
    'statut',
    'nom_signature_final',
];

   

    protected $casts = [
        'fiche_besoin_id' => 'integer',
        'produit_id' => 'integer',
        'quantite_demandee' => 'integer',
        'quantite_imprimee' => 'integer',
        'quantite_totale_imprimee' => 'integer',
        'quantite_totale_receptionnee' => 'integer',
        'date_demande' => 'date',
        'date_visa_chef_service' => 'date',
        'date_autorisation' => 'date',
        'date_impression' => 'date',
        'date_reception_stock' => 'date',
        'est_autorise_chef_informatique' => 'boolean',
    ];

    /**
     * Relation avec la fiche de besoin
     */
    public function ficheBesoin(): BelongsTo
    {
        return $this->belongsTo(FicheBesoin::class);
    }

    /**
     * Relation avec le client via la fiche de besoin
     */
    public function client(): BelongsTo
    {
        return $this->ficheBesoin()->withDefault()->client();
    }

    /**
     * Relation avec le produit (si applicable)
     */
    public function produit(): BelongsTo
    {
        return $this->belongsTo(Produit::class);
    }

    public function validation()
{
    return $this->belongsTo(Validation::class, 'demande_id');
}

    public function mouvementStock()
{
    return $this->hasMany(MouvementStock::class, 'demande_impression_id');
}


public function getNomProduitAttribute(): string
{
    if ($this->type_impression === 'simple') {
        return $this->produit->nom_produit ?? 'Produit non défini';
    }

    return $this->produit_souhaite ?? 'Produit spécifique non précisé';
}


public function estEnAttente(): bool
{
    return $this->statut === 'en_attente';
}

public function estEnProduction(): bool
{
    return $this->statut === 'en_production';
}

public function estValidee(): bool
{
    return $this->statut === 'terminer';
}

protected static function booted()
{
    static::updated(function ($demande) {
        if ($demande->isDirty('statut') && $demande->statut === 'terminer') {
            MouvementStock::create([
                'demande_impression_id' => $demande->id,
                'designation' => $demande->designation ?? 'Sans désignation', // obligatoire
                'quantite_entree' => $demande->quantite_totale_receptionnee ?? 0,
                'quantite_sortie' => null,
                'date_mouvement' => $demande->date_reception_stock ?? now(),
                'type_mouvement' => 'entree', // obligatoire
                'details' => $demande->details_reception ?? 'Impression terminée et stockée',
            ]);
        }
    });
}


}
