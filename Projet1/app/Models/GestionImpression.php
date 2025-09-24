<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GestionImpression extends Model
{
    use HasFactory;

    protected $table = 'gestion_impressions';

    protected $fillable = [
        'imprimerie_id',
        'demande_id',
        'produit_id',
        'nom_produit',
        'quantite_demandee',
        'quantite_imprimee',
        'type_impression',
        'statut',
        'date_impression',
        'date_demande',
        'valide_par',
        'operateur',
        'agent_commercial',
        'service',
        'objet',
    ];

    protected $casts = [
        'date_impression' => 'date',
        'date_demande' => 'date',
    ];

    // ================= RELATIONS =================

    /**
     * Lien avec l’imprimerie
     */
    public function imprimerie(): BelongsTo
    {
        return $this->belongsTo(Imprimerie::class, 'imprimerie_id');
    }

    /**
     * Lien avec la demande d’impression
     */
    public function demande(): BelongsTo
    {
        return $this->belongsTo(DemandeImpression::class, 'demande_id');
    }

    /**
     * Lien avec le produit
     */
    public function produit(): BelongsTo
    {
        return $this->belongsTo(Produit::class, 'produit_id');
    }


protected static function booted()
    {
        static::creating(function ($gestion) {
            if ($gestion->imprimerie_id) {
                $imprimerie = Imprimerie::find($gestion->imprimerie_id);

                if ($imprimerie) {
                    // Copier automatiquement les champs depuis Imprimerie
                    $gestion->demande_id = $imprimerie->demande_id;
                    $gestion->produit_id = $imprimerie->produit_id;
                    $gestion->nom_produit = $imprimerie->nom_produit;
                    $gestion->quantite_demandee = $imprimerie->quantite_demandee;
                    $gestion->quantite_imprimee = $imprimerie->quantite_imprimee;
                    $gestion->type_impression = $imprimerie->type_impression;
                    $gestion->statut = $imprimerie->statut;
                    $gestion->valide_par = $imprimerie->valide_par;
                 
                    $gestion->agent_commercial = $imprimerie->agent_commercial;
                    $gestion->service = $imprimerie->service;
                    $gestion->objet = $imprimerie->objet;
                    $gestion->date_impression = $imprimerie->date_impression;
                }
            }
        });
    }


    
}
