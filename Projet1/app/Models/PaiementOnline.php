<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaiementOnline extends Model
{
    use HasFactory;

    protected $table = 'paiement_online';

    protected $fillable = ['caisse_online_id', 'montant', 'mode_paiement', 'statut', 'reference_transaction'];

    public function caisse()
    {
        return $this->belongsTo(CaisseOnline::class);
    }
}
