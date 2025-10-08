<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Important pour Auth
use Illuminate\Notifications\Notifiable;

class Online extends Authenticatable
{
    use HasFactory, Notifiable;

    // Nom de la table si différent de "onlines"
    protected $table = 'onlines';

    // Colonnes autorisées à la création/mise à jour
    protected $fillable = [
        'name',       // nom de l'utilisateur
        'email',      // email
        'password',   // mot de passe
    ];

    // Cacher certains champs lors de la sérialisation (ex: API)
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Type de données pour certains champs
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
