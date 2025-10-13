<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LivraisonOnline extends Model
{
    use HasFactory;

    protected $table = 'livraison_online';

    protected $fillable = ['online_id', 'type', 'adresse', 'ville', 'code_postal', 'pays'];

    public function online()
    {
        return $this->belongsTo(Online::class);
    }

    public function commandes()
    {
        return $this->hasMany(CommandeOnline::class, 'adresse_livraison_id');
    }
}
