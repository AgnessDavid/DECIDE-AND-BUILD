<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DemandeImpression extends Model
{
    use HasFactory;

    protected $table = 'demandes_impression';

    protected $fillable = [
        'fiche_besoin_id',
        'produit_id',
        'type_impression',
        'numero_ordre',
        'designation',
        'quantite_demandee',
        'quantite_imprimee',
        'date_demande',
        'agent_commercial',
        'service',
        'objet',
    ];



protected static function booted()
    {
        static::created(function ($demande) {
            // Création automatique d'une validation associée
            \App\Models\Validation::create([
                'demande_id' => $demande->id,
                'fiche_besoin_id' => $demande->fiche_besoin_id,
                'statut' => 'en_attente',
                // 'user_id' peut rester null jusqu'à ce que quelqu'un valide
            ]);
        });
    }



    // =============== RELATIONS ===============

    public function ficheBesoin(): BelongsTo
    {
        return $this->belongsTo(FicheBesoin::class);
    }

    public function produit(): BelongsTo
    {
        return $this->belongsTo(Produit::class);
    }

    public function validations(): HasMany
    {
        return $this->hasMany(Validation::class, 'demande_id');
    }
}
