<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_paiement';

    protected $fillable = [
        'methode',
        'statut_paiement',
        'reference_transaction',
        'id_commande',
    ];

    /**
     * Un paiement appartient à une seule commande.
     */
    public function commande()
    {
        return $this->belongsTo(Commande::class, 'id_commande', 'id_commande');
    }
}