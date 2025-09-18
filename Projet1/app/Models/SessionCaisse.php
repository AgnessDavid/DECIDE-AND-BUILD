<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SessionCaisse extends Model
{
    protected $table = 'session_caisses';

    protected $fillable = [
        'user_id',
        'solde_initial',
        'solde_final',
        'statut',
        'ouvert_le',
        'ferme_le',
    ];

    protected $casts = [
        'ouvert_le' => 'datetime',
        'ferme_le' => 'datetime',
        'solde_initial' => 'float',
        'solde_final' => 'float',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function caisses(): HasMany
    {
        return $this->hasMany(Caisse::class, 'session_caisse_id');
    }

    // ================== Totaux automatiques ==================
    
    public function getTotalEntreesAttribute(): float
    {
        return $this->caisses()->sum('entree'); // somme de toutes les entrées
    }

    public function getTotalSortiesAttribute(): float
    {
        return $this->caisses()->sum('sortie'); // somme de toutes les sorties
    }

    public function getSoldeAttribute(): float
    {
        return $this->solde_initial + $this->total_entrees - $this->total_sorties;
    }

    public function getEntreesCaissesAttribute(): array
    {
        // récupère automatiquement l'entrée et la sortie de chaque caisse
        return $this->caisses->map(function ($caisse) {
            return [
                'id' => $caisse->id,
                'montant_ht' => $caisse->montant_ht,
                'entree' => $caisse->entree,
                'sortie' => $caisse->sortie,
                'statut' => $caisse->statut,
            ];
        })->toArray();
    }
}
