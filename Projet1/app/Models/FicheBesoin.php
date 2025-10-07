<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FicheBesoin extends Model
{
    use HasFactory;
    protected $table = 'fiches_besoin';

    protected $fillable = [
        // Infos générales
        'client_id', 
        'produit_id',
        'nom_fiche_besoin',
        'produit_souhaite',
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
        'titre',
        'echelle', 
        'orientation', 
        'auteur',
        'symbole', 
        'type_element', 
        'latitude', 
        'longitude',
        'nom_zone', 
        'type_zone',
        'quantite_demandee',
    ];

    // ================= RELATIONS =================
    public function produit(): BelongsTo
    {
        return $this->belongsTo(Produit::class, 'produit_id');
    }

   public function DemandeExpressionBesoin()
   {

    return $this->hasMany(DemandeExpressionBesoin::class,'fiche_besoin_id');

   }

   public function livraisons(){

   return $this->hasMany(Livraison::class,'fiche_besoin_id');

   }

    public function validationsFiche(): HasMany
    {
        return $this->hasMany(ValidationFicheExpressionBesoin::class, 'fiche_besoin_id');
    }

    public function demandesImpression(): HasMany
    {
        return $this->hasMany(DemandeImpression::class, 'fiche_besoin_id');
    }

    public function toutesValidations(): \Illuminate\Support\Collection
    {
        $directes = $this->validationsFiche;
        $viaDemandes = $this->demandesImpression->flatMap(fn($demande) => $demande->validations);
        return $directes->merge($viaDemandes);
    }

    // ================= HOOK DE CRÉATION =================
protected static function booted()
{
    static::created(function ($fiche) {
        $userId = auth()->id() ?? User::first()?->id;

        if (!$userId) {
            throw new \Exception("Aucun utilisateur trouvé pour la validation !");
        }

        \App\Models\ValidationFicheExpressionBesoin::create([
            'fiche_besoin_id' => $fiche->id,
            'user_id' => $userId,          // ← corrige ici
            'valide' => false,
            'produit_souhaite' => $fiche->produit_souhaite,
            'nom_structure' => $fiche->nom_structure,
            'type_structure' => $fiche->type_structure,
            'nom_interlocuteur' => $fiche->nom_interlocuteur,
            'fonction' => $fiche->fonction,
            'nom_agent_bnetd' => $fiche->nom_agent_bnetd,
            'date_entretien' => $fiche->date_entretien,
            'objectifs_vises' => $fiche->objectifs_vises,
            'type_carte' => $fiche->type_carte,
            'echelle' => $fiche->echelle,
            'orientation' => $fiche->orientation,
            'auteur' => $fiche->auteur,
            'symbole' => $fiche->symbole,
            'type_element' => $fiche->type_element,
            'latitude' => $fiche->latitude,
            'longitude' => $fiche->longitude,
            'nom_zone' => $fiche->nom_zone,
            'type_zone' => $fiche->type_zone,
            'quantite_demandee' => $fiche->quantite_demandee,
        ]);
    });


        static::creating(function ($fiche) {
            if (!$fiche->nom_fiche_besoin) {
                $lastId = static::latest('id')->first()?->id ?? 0;
                $fiche->nom_fiche_besoin = 'FBC-' . date('Y') . '-' . str_pad($lastId + 1, 4, '0', STR_PAD_LEFT);
            }
        });


}

}
