<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot; // Utiliser Pivot si c'est une table pivot personnalisée

class LigneCommande extends Pivot // extends Model si pas une table pivot avec attributs supplémentaires
{
    use HasFactory;

    protected $table = 'lignes_commande'; // Nom de la table pivot
    public $incrementing = false; // Pas d'auto-incrément pour une PK composée
    protected $primaryKey = ['id_commande', 'id_carte']; // PK composée
    protected $fillable = [
        'id_commande',
        'id_carte',
        'quantite',
        'prix_unitaire',
    ];

    public function commande()
    {
        return $this->belongsTo(Commande::class, 'id_commande', 'id_commande');
    }

    public function carte()
    {
        return $this->belongsTo(Carte::class, 'id_carte', 'id_carte');
    }
}