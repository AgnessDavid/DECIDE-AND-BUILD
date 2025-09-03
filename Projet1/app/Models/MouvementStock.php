<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MouvementStock extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'mouvements_stock';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'produit_id',
        'date_mouvement',
        'numero_bon',
        'type_mouvement',
        'quantite',
        'stock_resultant',
        'en_commande',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'date_mouvement' => 'date',
        'quantite' => 'integer',
        'stock_resultant' => 'integer',
        'en_commande' => 'integer',
    ];

    /**
     * Relation avec le produit
     */
    public function produit(): BelongsTo
    {
        return $this->belongsTo(Produit::class);
    }

    /**
     * Scope pour filtrer les entrées
     */
    public function scopeEntrees($query)
    {
        return $query->where('type_mouvement', 'entree');
    }

    /**
     * Scope pour filtrer les sorties
     */
    public function scopeSorties($query)
    {
        return $query->where('type_mouvement', 'sortie');
    }

    /**
     * Scope pour filtrer par produit
     */
    public function scopePourProduit($query, $produitId)
    {
        return $query->where('produit_id', $produitId);
    }

    /**
     * Accessor pour afficher le type de mouvement de façon lisible
     */
    public function getTypeMouvementLabelAttribute(): string
    {
        return match($this->type_mouvement) {
            'entree' => 'Entrée',
            'sortie' => 'Sortie',
            default => $this->type_mouvement,
        };
    }

    /**
     * Mutateur pour s'assurer que la quantité est positive
     */
    public function setQuantiteAttribute($value)
    {
        $this->attributes['quantite'] = abs($value);
    }
}