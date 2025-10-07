<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Imprimerie extends Model
{
    protected $fillable = [
        'validation_id',      // pour relier à la validation
        'demande_id',         // référence à la demande
        'produit_id',
        'nom_fiche_besoin',
        'nom_produit',
        'type_impression',
        'quantite_demandee',
        'quantite_imprimee',
        'agent_commercial',
        'service',
        'objet',
        'date_demande',
        'date_impression',
        'statut',             // en_cours / terminée
        'valide_par',         // nom de l'utilisateur qui a validé
    ];

    // ================== RELATIONS ==================

    public function demande(): BelongsTo
    {
        return $this->belongsTo(DemandeImpression::class, 'demande_id');
    }

    public function produit(): BelongsTo
    {
        return $this->belongsTo(Produit::class, 'produit_id');
    }

    public function validation(): BelongsTo
    {
        return $this->belongsTo(Validation::class, 'validation_id');
    }

    // ================== HOOK DE CRÉATION ==================
protected static function booted()
{
    static::creating(function ($imprimerie) {
        if ($imprimerie->demande_id) {
            $demande = DemandeImpression::find($imprimerie->demande_id);
            if ($demande) {
                $imprimerie->produit_id = $demande->produit_id;
                $imprimerie->nom_produit = $demande->designation;
                $imprimerie->type_impression = $demande->type_impression;
                $imprimerie->quantite_demandee = $demande->quantite_demandee;
                $imprimerie->quantite_imprimee = $demande->quantite_imprimee ?? 0;
                $imprimerie->agent_commercial = $demande->agent_commercial;
                $imprimerie->service = $demande->service;
                $imprimerie->objet = $demande->objet;
                $imprimerie->date_demande = $demande->date_demande;
                $imprimerie->date_impression = now();
                $imprimerie->statut = 'en_cours';
                // valide_par doit être assigné **avant de créer l'imprimerie** depuis Validation
            }
        }
    });
}

}
