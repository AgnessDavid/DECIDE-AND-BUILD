<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Validation extends Model
{
    protected $fillable = [
        'document_id',               // L'id du document (fiche_besoin ou demande_impression)
        'type',                      // Le type de document : 'fiche_besoin' ou 'demande_impression'
        'user_id',                   // L'utilisateur qui valide
        'statut',                    // 'en_attente' ou 'validée'
        'date_visa_chef_service',
        'nom_visa_chef_service',
        'date_autorisation',
        'est_autorise_chef_informatique',
        'nom_visa_autorisateur',
        'date_impression',
        'notes',
    ];

    protected $casts = [
        'date_visa_chef_service' => 'date',
        'date_autorisation' => 'date',
        'date_impression' => 'date',
        'est_autorise_chef_informatique' => 'boolean',
    ];

    // Relation polymorphe avec le document validé
    public function document(): MorphTo
    {
        return $this->morphTo(null, 'type', 'document_id');
    }

    public function imprimeries()
{
    return $this->hasMany(Imprimerie::class, 'validation_id');
}

    // Relation avec l'utilisateur qui valide
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relation directe avec la fiche de besoin (pratique pour filtrer)
    public function ficheBesoin(): BelongsTo
    {
        return $this->belongsTo(FicheBesoin::class, 'document_id')
                    ->where('type', 'fiche_besoin');
    }

    // Relation directe avec la demande d'impression (pratique pour filtrer)
    public function demandeImpression(): BelongsTo
    {
        return $this->belongsTo(DemandeImpression::class, 'document_id')
                    ->where('type', 'demande_impression');
    }
}
