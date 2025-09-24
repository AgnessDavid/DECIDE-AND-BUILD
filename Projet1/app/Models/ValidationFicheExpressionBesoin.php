<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValidationFicheExpressionBesoin extends Model
{
    use HasFactory;

    // Nom de la table
    protected $table = 'validation_fiches_expression_besoin';

    // Colonnes autorisées à la création / mise à jour
    protected $fillable = [
        'fiche_besoin_id',
        'user_id',
        'nom_structure',
        'type_structure',
        'produit_souhaite',
        'nom_interlocuteur',
        'fonction',
        'nom_agent_bnetd',
        'date_entretien',
        'objectifs_vises',
        'valide',
        'commentaire',
        'type_carte',
        'echelle',
        'orientation',
        'auteur',
        'symbole',
        'type_element',
        'latitude',
        'longitude',
        'nom_zone',
        'type_zone',
    ];

    // Relation avec la fiche d'expression de besoin
    public function fiche()
    {
        return $this->belongsTo(FicheBesoin::class, 'fiche_besoin_id');
    }

    // Relation avec l'utilisateur qui valide
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
