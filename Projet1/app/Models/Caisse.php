<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Caisse extends Model
{
    protected $table = 'caisse';

    protected $fillable = [
        'commande_id',
        'client_id',
        'user_id',
        'montant_ht',
        'tva',
        'montant_ttc',
        'entree',
        'sortie',
        'statut',
    ];

    // ================== RELATIONS ==================


     public function sessionCaisse(): BelongsTo
    {
        return $this->belongsTo(SessionCaisse::class, 'session_caisse_id');
    }

    public function commande(): BelongsTo
    {
        return $this->belongsTo(Commande::class, 'commande_id');
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // ================== ACCESSORS ==================
    public function getNumeroCommandeAttribute(): ?string
    {
        return $this->commande?->numero_commande;
    }

    public function getNomClientAttribute(): ?string
    {
        return $this->client?->nom ?? $this->client?->prenom;
    }

    public function getMontantHtCommandeAttribute(): ?float
    {
        return $this->commande?->montant_ht;
    }

    public function getMontantTtcCommandeAttribute(): ?float
    {
        return $this->commande?->montant_ttc;
    }




    public function getProduitsCommandeAttribute(): array
    {
        if ($this->commande) {
            return $this->commande->produits->map(function ($ligne) {
                return [
                    'nom' => $ligne->produit?->nom_produit,
                    'quantite' => $ligne->quantite,
                    'prix_unitaire_ht' => $ligne->prix_unitaire_ht,
                    'montant_ht' => $ligne->quantite * $ligne->prix_unitaire_ht,
                    'montant_ttc' => $ligne->quantite * $ligne->prix_unitaire_ht * 1.18,
                ];
            })->toArray();
        }

        return [];
    }

    // ================== HOOKS ==================
    protected static function booted()
    {
        static::creating(function ($caisse) {
            if ($caisse->commande_id) {
                $commande = Commande::with('client')->find($caisse->commande_id);
                if ($commande) {
                    $caisse->client_id = $commande->client_id;
                    $caisse->user_id   = $commande->user_id;
                    $caisse->montant_ht   = $commande->montant_ht;
                    $caisse->tva          = 18.00;
                    $caisse->montant_ttc  = $commande->montant_ttc;
                }
            }

 static::saving(function ($caisse) {
        if (!empty($caisse->entree) && !empty($caisse->montant_ttc)) {
            $caisse->sortie = $caisse->entree - $caisse->montant_ttc;
        }
    });

        });
    }
}
