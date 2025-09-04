<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FicheBesoin extends Model
{
    protected $table = 'fiches_besoin';

    protected $fillable = [
        'client_id',
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
        'type_structure' => 'string',
        'commande_ferme' => 'boolean',
        'demande_facture_proforma' => 'boolean',
        'date_entretien' => 'date',
        'date_livraison_prevue' => 'date',
        'date_livraison_reelle' => 'date',
    ];

    /**
     * Une fiche de besoin appartient à un client.
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

protected static function booted()
{
    static::created(function ($ficheBesoin) {
        \App\Models\Validation::create([
            'fiche_besoin_id' => $ficheBesoin->id,
            'user_id' => $ficheBesoin->user_id,
// ou $ficheBesoin->user_id si tu stockes l’agent
            'statut' => 'en_attente',
        ]);
    });
}


}
