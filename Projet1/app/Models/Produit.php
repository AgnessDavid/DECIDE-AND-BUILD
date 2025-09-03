<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Produit extends Model
{
    protected $table = 'produits';

    protected $fillable = [
        'reference_produit',
        'nom_produit',
        'description',
        'stock_minimum',
        'stock_maximum',
        'stock_actuel',
        'photo',
    ];

    protected $casts = [
        'stock_minimum' => 'integer',
        'stock_maximum' => 'integer',
        'stock_actuel' => 'integer',
    ];

    /**
     * Accesseur pour obtenir l'URL complète de la photo.
     */
    public function getPhotoUrlAttribute(): ?string
    {
        return $this->photo ? Storage::url($this->photo) : null;
    }

    /**
     * Relation many-to-many avec les commandes
     */
    public function commandes(): BelongsToMany
    {
        return $this->belongsToMany(Commande::class, 'commande_produit')
                    ->withPivot(['quantite', 'prix_unitaire_ht'])
                    ->withTimestamps()
                    ->using(CommandeProduit::class);
    }

    /**
     * Relation avec les lignes de commande (pivot)
     */
    public function lignesCommande(): HasMany
    {
        return $this->hasMany(CommandeProduit::class, 'produit_id');
    }

    /**
     * Quantité totale commandée (pour commandes validées ou partiellement facturées)
     */
    public function getQuantiteTotaleCommandeeAttribute(): int
    {
        return (int) $this->lignesCommande()
                    ->whereHas('commande', function ($query) {
                        $query->whereIn('statut', ['validee', 'partiellement_facturee']);
                    })
                    ->sum('quantite');
    }

    /**
     * Vérifie si le produit est en rupture de stock
     */
    public function isEnRuptureStock(): bool
    {
        return $this->stock_actuel <= ($this->stock_minimum ?? 0);
    }

    /**
     * Stock disponible = stock actuel - quantité commandée
     */
    public function getStockDisponibleAttribute(): int
    {
        return max(0, $this->stock_actuel - $this->quantite_totale_commandee);
    }
}
