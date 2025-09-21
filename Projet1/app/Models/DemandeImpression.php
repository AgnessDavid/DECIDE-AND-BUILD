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


static::creating(function ($demande) {
        // 1️⃣ Génération automatique du numéro d'ordre
        // Préfixe fixe + incrémentation simple
        $prefix = 'ORD-IMP-';
        $count = static::count() + 1;
        $demande->numero_ordre = $prefix . str_pad($count, 4, '0', STR_PAD_LEFT);

        // 2️⃣ Assignation automatique du service à partir de l'agent commercial
        if (empty($demande->service) && !empty($demande->agent_commercial)) {
            $demande->service = $demande->agent_commercial;
        }
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


      // Une demande peut générer plusieurs enregistrements d'imprimerie

    /**
     * Toutes les validations liées à cette demande d'impression
     */
    public function validations(): HasMany
    {
        return $this->hasMany(Validation::class, 'document_id')
                    ->where('type', 'demande_impression');
    }







    
}
