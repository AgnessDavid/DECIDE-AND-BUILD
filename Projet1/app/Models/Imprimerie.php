<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Imprimerie extends Model
{
    protected $fillable = [
        'validation_id',
        'demande_id',
        'produit_id',
        'nom_produit',
        'quantite_demandee',
        'quantite_imprimee',
        'valide_par',
        'operateur',
        'date_impression',
    ];

    // ================== RELATIONS ==================

    /**
     * L'imprimerie appartient à une validation
     */
    public function validation(): BelongsTo
    {
        return $this->belongsTo(Validation::class, 'validation_id');
    }

    /**
     * L'imprimerie appartient à une demande d'impression
     */
    public function demandeImpression(): BelongsTo
    {
        return $this->belongsTo(DemandeImpression::class, 'demande_id');
    }

    /**
     * L'imprimerie est liée à un produit
     */
    public function produit(): BelongsTo
    {
        return $this->belongsTo(Produit::class, 'produit_id');
    }

    // ================== HOOK DE CRÉATION ==================
    protected static function booted()
    {
        static::creating(function ($imprimerie) {
            if ($imprimerie->demande_id) {
                $demande = \App\Models\DemandeImpression::find($imprimerie->demande_id);
                if ($demande) {
                    $imprimerie->produit_id = $demande->produit_id;
                    $imprimerie->nom_produit = $demande->designation;
                    $imprimerie->quantite_demandee = $demande->quantite_demandee;
                    $imprimerie->quantite_imprimee = $demande->quantite_imprimee;
                    $imprimerie->valide_par = $demande->agent_commercial;
                    $imprimerie->operateur = $demande->service;
                    $imprimerie->date_impression = now();
                }
            }
        });
    }
}
