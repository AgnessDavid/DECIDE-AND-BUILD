<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MouvementStock extends Model
{
    use HasFactory;

    protected $table = 'mouvements_stock';

    protected $fillable = [
        'produit_id',
        'date_mouvement',
        'numero_bon',
        'type_mouvement',
        'quantite',
        'stock_resultant',
        'en_commande',
    ];

    protected $casts = [
        'date_mouvement' => 'date',
        'quantite' => 'integer',
        'stock_resultant' => 'integer',
        'en_commande' => 'integer',
    ];

    /**
     * Relation avec le produit.
     */
    public function produit(): BelongsTo
    {
        return $this->belongsTo(Produit::class);
    }

    /**
     * Relation avec l'employé qui a enregistré le mouvement.
     */
  

    /** Scopes personnalisés */
    public function scopeEntrees($query)
    {
        return $query->where('type_mouvement', 'entree');
    }

    public function scopeSorties($query)
    {
        return $query->where('type_mouvement', 'sortie');
    }

    public function scopePourProduit($query, $produitId)
    {
        return $query->where('produit_id', $produitId);
    }

    /** Accessor lisible */
    public function getTypeMouvementLabelAttribute(): string
    {
        return match($this->type_mouvement) {
            'entree' => 'Entrée',
            'sortie' => 'Sortie',
            default => $this->type_mouvement,
        };
    }

    /** Mutateur */
    public function setQuantiteAttribute($value)
    {
        $this->attributes['quantite'] = abs($value);
    }
}
