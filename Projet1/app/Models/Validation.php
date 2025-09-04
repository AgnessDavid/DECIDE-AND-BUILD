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
        'user_id',
        'statut',
        'notes',
    ];

    // ================== RELATIONS ==================

    /**
     * La fiche de besoin associée à cette validation
     */
    public function ficheBesoin(): BelongsTo
    {
        return $this->belongsTo(FicheBesoin::class);
    }

    /**
     * L'utilisateur qui a validé la fiche (optionnel)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * La demande d'impression associée
     */
    public function demandeImpression()
    {
        return $this->hasOne(DemandeImpression::class, 'demande_id');
    }

    // ================== ACCESSEURS ==================

    public function getEstValideeAttribute(): bool
    {
        return $this->statut === 'validée'; // attention à la valeur exacte
    }

    public function getEstRefuseeAttribute(): bool
    {
        return $this->statut === 'refusee';
    }

    // ================== EVENTS ==================

    protected static function booted()
    {
        static::updated(function ($validation) {
            if ($validation->statut === 'validée') {
                $fiche = $validation->ficheBesoin;

                // Vérifie si une demande d'impression n'existe pas déjà pour cette fiche
                if (!\App\Models\DemandeImpression::where('demande_id', $fiche->id)->exists()) {
                    \App\Models\DemandeImpression::create([
                        'demande_id' => $fiche->id,
                        'numero_ordre' => 'ORD-' . $fiche->id,
                        'designation' => 'Fiche de besoin de ' . $fiche->nom_structure,
                        'quantite_demandee' => 1,
                        'date_demande' => now(),
                        'agent_commercial' => $fiche->nom_agent_bnetd,
                        'service' => 'Service concerné',
                        'objet' => 'Impression de la fiche validée',
                    ]);
                }
            }
        });
    }
}
