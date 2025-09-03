<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Builder;

class Commande extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'client_id',
        'fiche_besoin_id',
        'numero_commande',
        'date_commande',
        'montant_ht',
        'tva',
        'montant_ttc',
        'moyen_de_paiement',
        'statut',
        'notes_internes',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'date_commande' => 'date',
        'montant_ht' => 'decimal:2',
        'tva' => 'decimal:2',
        'montant_ttc' => 'decimal:2',
    ];

    /**
     * Statuts disponibles pour les commandes
     */
    public const STATUTS = [
        'brouillon' => 'Brouillon',
        'validee' => 'Validée',
        'partiellement_facturee' => 'Partiellement facturée',
        'facturee' => 'Facturée',
        'annulee' => 'Annulée',
    ];

    /**
     * Moyens de paiement disponibles
     */
    public const MOYENS_PAIEMENT = [
        'en_ligne' => 'En ligne',
        'especes' => 'Espèces',
        'cheque' => 'Chèque',
        'virement_bancaire' => 'Virement bancaire',
    ];

    /**
     * Relation avec l'utilisateur qui a créé la commande
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation avec le client
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Relation avec la fiche de besoin
     */
    public function ficheBesoin(): BelongsTo
    {
        return $this->belongsTo(FicheBesoin::class);
    }

    /**
     * Relation avec les lignes de commande
     */
    public function lignesCommande(): HasMany
    {
        return $this->hasMany(LigneCommande::class);
    }

    /**
     * Relation avec les factures
     */
    public function factures(): HasMany
    {
        return $this->hasMany(Facture::class);
    }

    /**
     * Relation many-to-many avec les produits
     */
    public function produits(): BelongsToMany
    {
        return $this->belongsToMany(Produit::class, 'commande_produit')
                    ->withPivot(['quantite', 'prix_unitaire_ht'])
                    ->withTimestamps()
                    ->using(CommandeProduit::class);
    }

    /**
     * Relation avec les lignes de produits (pivot)
     */
    public function lignesProduits(): HasMany
    {
        return $this->hasMany(CommandeProduit::class);
    }

    /**
     * Recalculer automatiquement les totaux de la commande
     */
    public function recalculerTotaux(): void
    {
        $totalHt = $this->lignesProduits()->get()->sum(function ($ligne) {
            return $ligne->quantite * $ligne->prix_unitaire_ht;
        });

        $totalTtc = $totalHt * (1 + $this->tva / 100);

        $this->updateQuietly([
            'montant_ht' => $totalHt,
            'montant_ttc' => $totalTtc,
        ]);
    }

    // ================== SCOPES ==================

    public function scopeStatut($query, $statut)
    {
        return $query->where('statut', $statut);
    }

    public function scopeBrouillon($query)
    {
        return $query->where('statut', 'brouillon');
    }

    public function scopeValidees($query)
    {
        return $query->where('statut', 'validee');
    }

    public function scopeFacturees($query)
    {
        return $query->where('statut', 'facturee');
    }

    public function scopeAnnulees($query)
    {
        return $query->where('statut', 'annulee');
    }

    public function scopePourClient($query, $clientId)
    {
        return $query->where('client_id', $clientId);
    }

    public function scopeParAgent($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopePeriode($query, $dateDebut, $dateFin)
    {
        return $query->whereBetween('date_commande', [$dateDebut, $dateFin]);
    }

    // ================== ACCESSORS ==================

    public function getStatutLabelAttribute(): string
    {
        return self::STATUTS[$this->statut] ?? $this->statut;
    }

    public function getMoyenPaiementLabelAttribute(): ?string
    {
        return $this->moyen_de_paiement
            ? (self::MOYENS_PAIEMENT[$this->moyen_de_paiement] ?? $this->moyen_de_paiement)
            : null;
    }

    public function getNumeroFormatteAttribute(): string
    {
        return 'CMD-' . str_pad($this->id, 6, '0', STR_PAD_LEFT);
    }

    public function getMontantTvaAttribute(): float
    {
        return $this->montant_ttc - $this->montant_ht;
    }

    public function getResumeAttribute(): string
    {
        return "Commande {$this->numero_commande} - {$this->client->nom} - " .
               number_format($this->montant_ttc, 2) . " FCFA - {$this->statut_label}";
    }

    // ================== MUTATEURS ==================

    public function setMontantHtAttribute($value)
    {
        $this->attributes['montant_ht'] = $value;
        $this->calculerMontantTtc();
    }

    public function setTvaAttribute($value)
    {
        $this->attributes['tva'] = $value;
        $this->calculerMontantTtc();
    }

    private function calculerMontantTtc()
    {
        if (isset($this->attributes['montant_ht']) && isset($this->attributes['tva'])) {
            $montantHt = (float) $this->attributes['montant_ht'];
            $tva = (float) $this->attributes['tva'];
            $this->attributes['montant_ttc'] = $montantHt * (1 + $tva / 100);
        }
    }

    // ================== MÉTHODES ==================

    public function isBrouillon(): bool
    {
        return $this->statut === 'brouillon';
    }

    public function isValidee(): bool
    {
        return $this->statut === 'validee';
    }

    public function isFacturee(): bool
    {
        return $this->statut === 'facturee';
    }

    public function isAnnulee(): bool
    {
        return $this->statut === 'annulee';
    }

    public function peutEtreModifiee(): bool
    {
        return in_array($this->statut, ['brouillon', 'validee']);
    }

    public function peutEtreFacturee(): bool
    {
        return in_array($this->statut, ['validee', 'partiellement_facturee']);
    }

    public function valider(): bool
    {
        if ($this->isBrouillon()) {
            return $this->update(['statut' => 'validee']);
        }
        return false;
    }

    public function annuler(): bool
    {
        if ($this->peutEtreModifiee()) {
            return $this->update(['statut' => 'annulee']);
        }
        return false;
    }

    public static function genererNumeroCommande(): string
    {
        $annee = date('Y');
        $mois = date('m');

        $count = self::whereYear('date_commande', $annee)
                    ->whereMonth('date_commande', $mois)
                    ->count() + 1;

        return $annee . $mois . str_pad($count, 4, '0', STR_PAD_LEFT);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($commande) {
            if (empty($commande->numero_commande)) {
                $commande->numero_commande = self::genererNumeroCommande();
            }

            if (empty($commande->date_commande)) {
                $commande->date_commande = now();
            }
        });

        static::saving(function ($commande) {
            if ($commande->isDirty(['montant_ht', 'tva'])) {
                $commande->calculerMontantTtc();
            }
        });
    }
}
