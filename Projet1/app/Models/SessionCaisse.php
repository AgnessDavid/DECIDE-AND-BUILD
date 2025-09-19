<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SessionCaisse extends Model
{
    protected $table = 'session_caisses';

    protected $fillable = [
        'user_id',
        'solde_initial',
        'solde_final',
        'statut',
        'ouvert_le',
        'ferme_le',
        'entrees',
        'sorties',
    ];

    protected $casts = [
        'ouvert_le' => 'datetime',
        'ferme_le' => 'datetime',
        'solde_initial' => 'float',
        'solde_final' => 'float',
        'entrees' => 'float',
        'sorties' => 'float',
    ];

    // Relation avec l'utilisateur
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Hook pour calculer automatiquement le solde final
 protected static function booted()
{
    static::saving(function ($session) {
        $session->solde_final = ($session->entrees ?? 0) - ($session->sorties ?? 0);
    });
}

}
