<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CommandeProduit extends Pivot
{
    protected $table = 'commande_produit';

    protected $fillable = [
        'commande_id',
        'produit_id',
        'quantite',
        'prix_unitaire_ht',
    ];

    /**
     * Indique que ce pivot doit avoir des timestamps
     */
    public $timestamps = true;

    /**
     * Relation avec la commande
     */
    public function commande()
    {
        return $this->belongsTo(\App\Models\Commande::class, 'commande_id');
    }

    /**
     * Relation avec le produit
     */
    public function produit()
    {
        return $this->belongsTo(\App\Models\Produit::class, 'produit_id');
    }
}
