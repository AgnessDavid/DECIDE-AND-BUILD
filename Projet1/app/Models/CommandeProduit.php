<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommandeProduit extends Model
{
    use HasFactory;

    protected $table = 'commande_produit';

    protected $fillable = [
        'commande_id',
        'produit_id',
        'quantite',
        'prix_unitaire_ht',
    ];

    public function commande(): BelongsTo
    {
        return $this->belongsTo(Commande::class);
    }


    // relation avec factu
    public function produit(): BelongsTo
    {
        return $this->belongsTo(Produit::class);
    }


protected static function booted()
{
    // Quand une ligne de commande est créée
    static::created(function ($ligne) {
        $produit = $ligne->produit;
        $quantite = (int) ($ligne->quantite ?? 0); // force int et évite null

        if ($produit && $quantite > 0) {
            // Retirer la quantité commandée du stock actuel
            $produit->retirerStock($quantite);

            // Optionnel : créer un mouvement de stock pour historiser
            $produit->mouvements()->create([
                'date_mouvement' => now(),
                'type_mouvement' => 'sortie',
                'quantite' => $quantite,
                'stock_resultant' => $produit->stock_actuel,
                'details' => "Commande n°{$ligne->commande_id}",
            ]);
        }
    });

    // Si une ligne est supprimée, restaurer le stock
    static::deleted(function ($ligne) {
        $produit = $ligne->produit;
        if ($produit) {
            $produit->ajusterStock($ligne->quantite);

            $produit->mouvements()->create([
                'date_mouvement' => now(),
                'type_mouvement' => 'entree',
                'quantite' => $ligne->quantite,
                'stock_resultant' => $produit->stock_actuel,
                'details' => "Annulation commande n°{$ligne->commande_id}",
            ]);
        }
    });
}

}
