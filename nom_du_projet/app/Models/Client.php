<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable; // Optionnel: Si ce modèle gère l'authentification des utilisateurs

class Client extends Authenticatable // Changez en 'Model' si vous ne l'utilisez PAS pour l'authentification
{
    use HasFactory;

    // Indique que la clé primaire de cette table est 'id_client'
    protected $primaryKey = 'id_client';

    // Définit les champs qui peuvent être remplis en masse via les méthodes create() ou update()
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'telephone',
        'adresse',
        'password', // À inclure si ce modèle est utilisé pour l'authentification
    ];

    // Champs qui devraient être cachés lors de la conversion du modèle en tableau ou JSON
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Définit la relation : un Client peut avoir plusieurs Commandes
    public function commandes()
    {
        // 'Commande::class' est le modèle enfant
        // 'id_client' est la clé étrangère dans la table 'commandes'
        // 'id_client' est la clé locale (primaire) dans la table 'clients'
        return $this->hasMany(Commande::class, 'id_client', 'id_client');
    }
}