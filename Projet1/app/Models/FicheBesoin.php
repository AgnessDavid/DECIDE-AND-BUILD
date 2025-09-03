<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FicheBesoin extends Model
{
    protected $table = 'fiches_besoin';

    protected $fillable = [
        'nom_structure',
        'type_structure',
        'nom_interlocuteur',
        'fonction',
        'telephone',
        'cellulaire',
        'fax',
        'email',
        'nom_agent_bnetd',
        'date_entretien',
        'objectifs_vises',
        'commande_ferme',
        'demande_facture_proforma',
        'delai_souhaite',
        'date_livraison_prevue',
        'date_livraison_reelle',
        'signature_client',
        'signature_agent_bnetd',
    ];

    protected $casts = [
        'type_structure' => 'string', // Pour gérer l'enum
        'commande_ferme' => 'boolean',
        'demande_facture_proforma' => 'boolean',
        'date_entretien' => 'date',
        'date_livraison_prevue' => 'date',
        'date_livraison_reelle' => 'date',
    ];
}