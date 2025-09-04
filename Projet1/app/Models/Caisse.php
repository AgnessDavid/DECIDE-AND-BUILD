<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Caisse extends Model
{
    use HasFactory;

    protected $table = 'caisse';

    protected $fillable = [
        'user_id',
        'paiement_id',
        'type',
        'montant',
        'motif',
        'date_mouvement',
    ];

    protected $casts = [
        'montant' => 'decimal:2',
        'date_mouvement' => 'datetime',
    ];

    /**
     * L'utilisateur (agent) responsable.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Le paiement associé (facultatif).
     */
    public function paiement(): BelongsTo
    {
        return $this->belongsTo(Paiement::class);
    }
}
