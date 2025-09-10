<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Facture extends Model
{
    use HasFactory;

    protected $fillable = [
        'commande_id',
        'client_id',
        'user_id',
        'numero_facture',
        'date_facturation',
        'montant_ht',
        'tva',
        'montant_ttc',
        'statut_paiement',
        'notes',
    ];

    protected $casts = [
        'date_facturation' => 'date',
        'montant_ht' => 'decimal:2',
        'tva' => 'decimal:2',
        'montant_ttc' => 'decimal:2',
    ];

    // Relations
    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }

    // Accesseurs
    public function getFormattedMontantHtAttribute(): string
    {
        return number_format($this->montant_ht, 2, ',', ' ') . ' FCFA';
    }

    public function getFormattedMontantTtcAttribute(): string
    {
        return number_format($this->montant_ttc, 2, ',', ' ') . ' FCFA';
    }

    public function getStatutPaiementLabelAttribute(): string
    {
        return match($this->statut_paiement) {
            'non_paye' => 'Non payé',
            'partiellement_paye' => 'Partiellement payé',
            'paye' => 'Payé',
            default => 'Inconnu'
        };
    }

public function calculerMontantTtc(): void
{
    $this->montant_ttc = $this->montant_ht + ($this->montant_ht * $this->tva / 100);
}



    // Mutateurs
    public function setNumeroFactureAttribute($value): void
    {
        $this->attributes['numero_facture'] = strtoupper($value);
    }

    // Méthodes utilitaires


    public function estPayee(): bool
    {
        return $this->statut_paiement === 'paye';
    }


    // Scopes
    public function scopePayees($query)
    {
        return $query->where('statut_paiement', 'paye');
    }

    public function scopeNonPayees($query)
    {
        return $query->where('statut_paiement', 'non_paye');
    }

    public function scopeParClient($query, $clientId)
    {
        return $query->where('client_id', $clientId);
    }

    public function scopeParPeriode($query, $dateDebut, $dateFin)
    {
        return $query->whereBetween('date_facturation', [$dateDebut, $dateFin]);
    }


public static function genererNumeroFacture(): string
{
    return 'FAC-' . now()->year . '-' . str_pad(
        static::whereYear('created_at', now()->year)->count() + 1,
        4,
        '0',
        STR_PAD_LEFT
    );
}



    // Événements du modèle
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($facture) {
            // Générer automatiquement le numéro de facture si non fourni
            if (empty($facture->numero_facture)) {
                $facture->numero_facture = 'FAC-' . date('Y') . '-' . str_pad(
                    static::whereYear('created_at', date('Y'))->count() + 1,
                    4,
                    '0',
                    STR_PAD_LEFT
                );
            }
        });



        
        static::saving(function ($facture) {
            // Recalculer automatiquement le montant TTC
            if ($facture->isDirty(['montant_ht', 'tva'])) {
                $facture->calculerMontantTtc();
            }
        });
    }
}