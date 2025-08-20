<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livraison extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_livraison';

    protected $fillable = [
        'date_expedition',
        'delai_estime',
        'statut_livraison',
        'id_commande',
    ];

    /**
     * Une livraison appartient à une seule commande.
     */
    public function commande()
    {
        return $this->belongsTo(Commande::class, 'id_commande', 'id_commande');
    }
}