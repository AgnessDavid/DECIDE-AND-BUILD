<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Validation extends Model
{
    use HasFactory;

    protected $table = 'validations';

    protected $fillable = [
        'fiche_besoin_id',
        'demande_id',
        'user_id',
        'statut',
        'date_visa_chef_service',
        'nom_visa_chef_service',
        'date_autorisation',
        'est_autorise_chef_informatique',
        'nom_visa_autorisateur',
        'date_impression',
        'notes',
    ];

    // =============== RELATIONS ===============
    public function ficheBesoin(): BelongsTo
    {
        return $this->belongsTo(FicheBesoin::class);
    }

    public function demandeImpression(): BelongsTo
    {
        return $this->belongsTo(DemandeImpression::class, 'demande_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // =============== ACCESSORS ===============
    public function getEstValideeAttribute(): bool
    {
        return $this->statut === 'validée';
    }

    public function getEstEnAttenteAttribute(): bool
    {
        return $this->statut === 'en_attente';
    }

    // =============== EVENTS ===============

}
