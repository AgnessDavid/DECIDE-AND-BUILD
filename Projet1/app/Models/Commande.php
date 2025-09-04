<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Commande extends Model
{
    use HasFactory;

    protected $table = 'commandes';

    protected $fillable = [
        'user_id',
        'client_id',
        'fiche_besoin_id',
        'numero_commande',
        'date_commande',
        'moyen_de_paiement',
        'statut',
        'notes_internes',
    ];

    protected $casts = [
        'date_commande' => 'date',
    ];

    // ================== RELATIONS ==================

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function ficheBesoin(): BelongsTo
    {
        return $this->belongsTo(FicheBesoin::class);
    }

    public function produits(): HasMany
    {
        return $this->hasMany(CommandeProduit::class);
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
}
