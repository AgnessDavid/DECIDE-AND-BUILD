<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DemandeExpressionBesoin extends Model
{
    use HasFactory;

    protected $table = 'demandes_expression_besoin';

    protected $fillable = [
        'produit_id',
        'type_impression',
        'numero_ordre',
        'designation',
        'quantite_demandee',
        'quantite_imprimee',
        'date_demande',
        'agent_commercial',
        'service',
        'objet',
    ];

    /** Relation vers le produit */
    public function produit(): BelongsTo
    {
        return $this->belongsTo(Produit::class, 'produit_id');
    }

/** Une demande peut avoir plusieurs impressions */
    public function imprimeriesExpressionBesoin()
    {
    return $this->hasMany(ImprimerieExpressionBesoin::class, 'demande_expression_besoin_id');
    }


    /** Si tu veux lier chaque demande à une fiche (optionnel) */
    public function ficheBesoin(): BelongsTo
    {
        return $this->belongsTo(FicheBesoin::class, 'fiche_besoin_id');
    }
}
