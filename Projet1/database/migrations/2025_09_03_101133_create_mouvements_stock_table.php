<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();

            // Nom de la structure ou du particulier
            $table->string('nom');

            // Type de client
            $table->enum('type', ['societe', 'organisme', 'particulier'])->default('societe');

            // Personne de contact principale
            $table->string('nom_interlocuteur')->nullable();
            $table->string('fonction')->nullable();

            // Coordonnées
            $table->string('telephone')->nullable();
            $table->string('cellulaire')->nullable();
            $table->string('fax')->nullable();
            $table->string('email')->nullable();

            // --- Nouveaux champs ajoutés ---
            $table->string('ville')->nullable();
            $table->string('quartier_de_residence')->nullable();
            $table->enum('usage', ['personnel', 'professionnel'])->nullable();
            $table->string('domaine_activite')->nullable(); // Ajout du domaine d'activité
            // --------------------------------

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};

