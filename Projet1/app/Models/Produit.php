<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Produit extends Model
{
    use HasFactory;

    protected $table = 'produits';

    protected $fillable = [
        'reference_produit',
        'nom_produit',
        'description',
        'stock_minimum',
        'stock_maximum',
        'stock_actuel',
        'prix_unitaire_ht',
        'photo',
        // Colonnes liées à la carte géographique
  
        'type',
        'echelle',
        'orientation',
        'date_creation',
        'auteur',
        'symbole',
        'type_element',
        'latitude',
        'longitude',
        'nom_zone',
        'type_zone',
    ];

    protected $casts = [
        'stock_minimum' => 'integer',
        'stock_maximum' => 'integer',
        'stock_actuel' => 'integer',
        'prix_unitaire_ht' => 'decimal:2',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
        'date_creation' => 'date',
    ];

    // ================== RELATIONS ==================

    /** Commandes liées via pivot */
    public function commandes(): BelongsToMany
    {
        return $this->belongsToMany(Commande::class, 'commande_produit')
                    ->withPivot(['quantite', 'prix_unitaire_ht'])
                    ->withTimestamps()
                    ->using(CommandeProduit::class);
    }

    public function demandeExpressionBesoin()
    {

        return $this->hasMany(DemandeExpressionBesoin::class,'produit_id');

    }


    public function imprimerieExpressionBesoin()
    {

    return $this->hasMany(ImprimerieExpressionBesoin::class);

    }



    public function mouvements(): HasMany
    {
        return $this->hasMany(MouvementStock::class, 'produit_id');
    }


public function gestionImpression(){
    return $this->hasMany(GestionImpression::class);
}

    /** Lignes de commande pivot */
    public function lignesCommande(): HasMany
    {
        return $this->hasMany(CommandeProduit::class, 'produit_id');
    }

    // ================== ACCESSEURS ==================

    /**
     * URL publique de la photo ou fichier
     */
    public function getPhotoUrlAttribute(): ?string
    {
        return $this->photo ? Storage::url($this->photo) : null;
    }

    /**
     * Quantité totale commandée pour ce produit
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
     * Stock disponible après commandes
     */
    public function getStockDisponibleAttribute(): int
    {
        return max(0, $this->stock_actuel - $this->quantite_totale_commandee);
    }

    // ================== MÉTHODES ==================

    /**
     * Ajouter du stock
     */
    public function ajusterStock(int $quantite): void
    {
        $this->increment('stock_actuel', $quantite);
    }

    /**
     * Retirer du stock
     */
    public function retirerStock(int $quantite): void
    {
        $this->decrement('stock_actuel', $quantite);
    }

    /**
     * Vérifie si le produit est en rupture
     */
    public function isEnRuptureStock(): bool
    {
        return $this->stock_actuel <= ($this->stock_minimum ?? 0);
    }

    // ================== ACCESSEURS CARTOGRAPHIQUES ==================

    public function getCoordonneesAttribute(): ?string
    {
        if ($this->latitude && $this->longitude) {
            return "{$this->latitude}, {$this->longitude}";
        }
        return null;
    }

    public function getCarteCompleteAttribute(): string
    {
        return implode(' | ', array_filter([
            $this->titre,
            $this->type,
            $this->echelle,
            $this->orientation,
            $this->nom_zone,
            $this->type_zone,
            $this->symbole,
            $this->type_element,
        ]));
    }



// ================== ALERTES DE STOCK ==================






}
