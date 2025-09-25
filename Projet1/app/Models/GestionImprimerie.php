<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produit;

class GestionImprimerie extends Model
{
    use HasFactory;

    protected $table = 'gestion_imprimeries';

    protected $fillable = [
        'produit_id',
        'designation',
        'quantite_entree',
        'quantite_sortie',
        'date_mouvement',
        'numero_bon',
        'type_mouvement',
        'stock_resultant',
        'details',
        'imprimeries_expression_besoin_id',
        'quantite_demandee',
        'quantite_imprimee',
        'stock_minimum',
        'stock_maximum',
        'stock_actuel',
    ];

    // ================== RELATIONS ==================

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }

    public function imprimerieExpressionBesoin()
    {
        return $this->belongsTo(ImprimerieExpressionBesoin::class, 'imprimeries_expression_besoin_id');
    }

    // ================== MISE À JOUR AUTOMATIQUE DU STOCK ==================

protected static function booted()
{
    static::saving(function ($gestion) {
        if ($gestion->produit) {
            // Sécuriser les valeurs null -> 0
            $stockActuel = $gestion->stock_actuel ?? $gestion->produit->stock_actuel ?? 0;
            $stockMin = $gestion->stock_minimum ?? $gestion->produit->stock_minimum ?? 0;
            $stockMax = $gestion->stock_maximum ?? $gestion->produit->stock_maximum ?? 0;

            // Calcul du stock_resultant
            $gestion->stock_resultant = $stockActuel;

            // Mise à jour du produit
            $gestion->produit->update([
                'stock_actuel'  => $gestion->stock_resultant, // on enregistre le stock calculé
                'stock_minimum' => $stockMin,
                'stock_maximum' => $stockMax,
            ]);
        }
    });
}
}
