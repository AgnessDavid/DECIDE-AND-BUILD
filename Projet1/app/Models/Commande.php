<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    public function facture()
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
        static::created(function ($commande) {
            // Création automatique de la facture lors de la création de la commande
            Facture::create([
                'commande_id' => $commande->id,
                'client_id' => $commande->client_id,
                'user_id' => $commande->user_id,
                'date_facturation' => now(),
                //'produit_non_satisfait' => $commande->produit_non_satisfait,
                'moyen_de_paiement' => $commande->moyen_de_paiement,
                'statut_paiement' => $commande->statut_paiement ?? 'non_paye',
                'montant_ht' => $commande->montant_ht,
                'tva' => 18.00,
                'montant_ttc' => $commande->montant_ttc,
                'produits' => $commande->produits->map(function ($ligne) {
                    return [
                        'nom' => $ligne->produit->nom_produit,
                        'quantite' => $ligne->quantite,
                        'prix_unitaire_ht' => $ligne->prix_unitaire_ht,
                        'montant_ht' => $ligne->quantite * $ligne->prix_unitaire_ht,
                        'montant_ttc' => $ligne->quantite * $ligne->prix_unitaire_ht * 1.18,
                    ];
                }),
                'notes' => $commande->notes_internes,
            ]);
        });

static::creating(function ($commande) {
        if (empty($commande->numero_commande)) {
            // Préfixe fixe CMD-BNET-
            $prefix = 'CMD-BNET-';

            // Compter le nombre de commandes déjà créées pour incrémenter
            $count = static::count() + 1;

            // Formater avec 2 chiffres par exemple
            $commande->numero_commande = $prefix . str_pad($count, 2, '0', STR_PAD_LEFT);
        }
    });


    }



}
