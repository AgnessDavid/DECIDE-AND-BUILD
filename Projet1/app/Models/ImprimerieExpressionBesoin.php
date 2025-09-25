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
    public function demandeExpressionBesoin(): BelongsTo
    {
        return $this->belongsTo(DemandeExpressionBesoin::class, 'demande_expression_besoin_id');
    }

    public function gestionImprimeries()
    {
        return $this->hasMany(GestionImprimerie::class, 'imprimeries_expression_besoin_id');
    }

    public function produit(): BelongsTo
    {
        return $this->belongsTo(Produit::class, 'produit_id');
    }

    // ================== AUTOMATISATION ==================
    protected static function booted()
    {
        static::created(function ($imprimerie) {
            // On crée une ligne dans GestionImprimerie automatiquement
            $imprimerie->gestionImprimeries()->create([
                'produit_id' => $imprimerie->produit_id,
                'quantite_imprimee' => $imprimerie->quantite_imprimee,
                'operateur' => $imprimerie->operateur,
                'statut' => $imprimerie->statut,
                'date_impression' => $imprimerie->date_impression,
                'service' => $imprimerie->service,
                'objet' => $imprimerie->objet,
                // ajoute d’autres champs si nécessaire
            ]);
        });
    }
}
