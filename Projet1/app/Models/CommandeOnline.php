<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommandeOnline extends Model
{
    use HasFactory;

    protected $table = 'commande_online';

    protected $fillable = [
        'online_id',
        'numero_commande',
        'total_ht',
        'total_ttc',
        'etat',
        'date_commande',
        'adresse_livraison_id'
    ];

    public function online()
    {
        return $this->belongsTo(Online::class);
    }

    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'commande_produit_online')
            ->withPivot(['quantite', 'prix_unitaire_ht', 'montant_ht', 'montant_ttc'])
            ->withTimestamps();
    }



    public function caisse()
    {
        return $this->hasOne(CaisseOnline::class, 'commande_online_id');
    }


    public function livraison()
    {
        return $this->hasOne(LivraisonOnline::class, 'online_id', 'online_id')
            ->where('type', 'livraison');
    }


    public function paiements()
    {
        return $this->hasMany(PaiementOnline::class, 'caisse_online_id', 'id');
        // ou si le lien se fait via la caisse
        // return $this->hasManyThrough(PaiementOnline::class, CaisseOnline::class, 'commande_online_id', 'caisse_online_id', 'id', 'id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($commande) {
            if (!$commande->numero_commande) {
                $commande->numero_commande = 'CMD-' . time() . '-' . rand(1000, 9999);
            }
        });
    }

}
