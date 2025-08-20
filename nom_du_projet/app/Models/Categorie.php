<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_categorie';

    protected $fillable = [
        'nom_categorie',
    ];

    /**
     * Une catégorie peut avoir plusieurs cartes.
     */
    public function cartes()
    {
        return $this->hasMany(Carte::class, 'id_categorie', 'id_categorie');
    }
}