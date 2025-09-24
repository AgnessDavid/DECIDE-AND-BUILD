<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ImprimerieExpressionBesoin extends Model
{
    use HasFactory;

    protected $table = 'imprimeries_expression_besoin';

    protected $fillable = [
        'demande_expression_besoin_id',
        'produit_id',
        'nom_produit',
        'quantite_demandee',
        'quantite_imprimee',
        'valide_par',
        'operateur',
        'date_impression',
        'type_impression',
        'statut',
        'agent_commercial',
        'service',
        'objet',
        'date_demande',
    ];

    // ================== RELATIONS ==================

    /**
     * La demande d'expression de besoin associée
     */
    public function demandeExpressionBesoin(): BelongsTo
    {
        return $this->belongsTo(DemandeExpressionBesoin::class, 'demande_expression_besoin_id');
    }

    /**
     * Le produit associé (optionnel)
     */
    public function produit(): BelongsTo
    {
        return $this->belongsTo(Produit::class, 'produit_id');
    }
}
