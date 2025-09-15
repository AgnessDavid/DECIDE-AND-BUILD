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
        \App\Models\Validation::create([
            'document_id' => $demande->id,
            'type' => 'demande_impression',
            'statut' => 'en_attente',
        ]);
    });
}

    // ================== RELATIONS ==================

    /**
     * La demande appartient à une fiche de besoin
     */
    public function ficheBesoin(): BelongsTo
    {
        return $this->belongsTo(FicheBesoin::class);
    }


public function imprimeries()
{
    return $this->hasMany(Imprimerie::class, 'demande_id');
}


    /**
     * La demande est liée à un produit
     */
    public function produit(): BelongsTo
    {
        return $this->belongsTo(Produit::class);
    }

    /**
     * Toutes les validations liées à cette demande d'impression
     */
    public function validations(): HasMany
    {
        return $this->hasMany(Validation::class, 'document_id')
                    ->where('type', 'demande_impression');
    }
}
