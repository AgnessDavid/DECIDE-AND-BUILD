<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DemandeImpression extends Model
{
    protected $table = 'demandes_impression';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'demande_id',
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
        'nom_signature_final',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'demande_id' => 'integer',
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
}