<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Commande extends Model
{
    use HasFactory;

    protected $table = 'commandes';

    protected $fillable = [
        'user_id',
        'client_id',
        'numero_commande',
        'date_commande',
        'produit_non_satisfait',
        'moyen_de_paiement',
        'statut_paiement',
        'notes_internes',
    ];

    protected $casts = [
        'date_commande' => 'date',
    ];

    // ================== RELATIONS ==================
    public function ventes(): HasMany
    {
        return $this->hasMany(Vente::class);
    }

    public function caisse(): HasOne
    {
        return $this->hasOne(Caisse::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function produits(): HasMany
    {
        return $this->hasMany(CommandeProduit::class);
    }

    public function facture(): HasOne
    {
        return $this->hasOne(Facture::class);
    }

    // ================== ACCESSORS ==================
    public function getMontantHtAttribute(): float
    {
        return $this->produits->sum(fn($ligne) => $ligne->quantite * $ligne->prix_unitaire_ht);
    }

    public function getMontantTtcAttribute(): float
    {
        return round($this->montant_ht * 1.18, 2); // TVA 18%
    }

    public function getNomProduitsAttribute(): string
    {
        return $this->produits->pluck('produit.nom_produit')->implode(', ');
    }

    // ================== EVENTS ==================
    protected static function booted()
    {
        // Générer automatiquement le numéro de commande
        static::creating(function ($commande) {
            if (empty($commande->numero_commande)) {
                $prefix = 'CMD-BNET-';
                $last = static::latest('id')->first();
                $count = $last ? $last->id + 1 : 1;
                $commande->numero_commande = $prefix . str_pad($count, 2, '0', STR_PAD_LEFT);
            }
        });


    }
}
