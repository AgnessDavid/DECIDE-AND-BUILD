<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carte extends Model
{
    use HasFactory;
protected $table = 'cartes';
    protected $primaryKey = 'id_carte';

    protected $fillable = [
        'titre',
        'description',
        'image',
        'prix',
        'stock',
        'id_categorie',
    ];

    /**
     * Une carte appartient à une seule catégorie.
     */
    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'id_categorie', 'id_categorie');
    }

    /**
     * Une carte peut avoir plusieurs lignes de commande (pour le panier).
     */
    public function lignesCommande()
    {
        return $this->hasMany(LigneCommande::class, 'id_carte', 'id_carte');
    }
}