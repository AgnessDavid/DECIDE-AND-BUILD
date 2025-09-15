<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FicheBesoin extends Model
{
    protected $table = 'fiches_besoin';

    protected $fillable = [
        'client_id',
        'produit_souhaite',      // ✅ Ajout de la quantité demandée
        'nom_structure',
        'type_structure',
        'nom_interlocuteur',
        'fonction',
        'telephone',
        'cellulaire',
        'fax',
        'email',
        'nom_agent_bnetd',
        'date_entretien',
        'objectifs_vises',
        'commande_ferme',
        'demande_facture_proforma',
        'delai_souhaite',
        'date_livraison_prevue',
        'date_livraison_reelle',
        'signature_client',
        'signature_agent_bnetd',
    ];

    // ================= RELATIONS =================

    /** Relation avec Produit */
    public function produit(): BelongsTo
    {
        return $this->belongsTo(Produit::class, 'produit_id');
    }




    /** Relation avec les validations */
    public function validations(): HasMany
    {
        return $this->hasMany(Validation::class, 'fiche_besoin_id');
    }

    /** Relation avec les demandes d'impression */
    public function demandesImpression(): HasMany
    {
        return $this->hasMany(DemandeImpression::class, 'fiche_besoin_id');
    }

    /** Récupérer toutes les validations (directes + via demandes) */
    public function toutesValidations(): \Illuminate\Support\Collection
    {
        $directes = $this->validations;
        $viaDemandes = $this->demandesImpression->flatMap(fn($demande) => $demande->validations);
        return $directes->merge($viaDemandes);
    }

    // ================= HOOK DE CRÉATION =================
    protected static function booted()
    {
        static::created(function ($fiche) {
            \App\Models\Validation::create([
                'document_id' => $fiche->id,
                'type' => 'fiche_besoin',
                'statut' => 'en_attente',
            ]);
        });
    }
}
