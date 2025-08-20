<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_commande';

    protected $fillable = [
        'date_commande',
        'statut',
        'montant_total',
        'id_client',
    ];

    /**
     * Une commande appartient à un seul client.
     */
    public function client()
    {
        return $this->belongsTo(Client::class, 'id_client', 'id_client');
    }

    /**
     * Une commande a plusieurs lignes de commande.
     */
    public function lignesCommande()
    {
        return $this->hasMany(LigneCommande::class, 'id_commande', 'id_commande');
    }

    /**
     * Une commande a un seul paiement.
     */
    public function paiement()
    {
        return $this->hasOne(Paiement::class, 'id_commande', 'id_commande');
    }

    /**
     * Une commande a une seule livraison.
     */
    public function livraison()
    {
        return $this->hasOne(Livraison::class, 'id_commande', 'id_commande');
    }
}