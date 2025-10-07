<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('validation_fiches_expression_besoin', function (Blueprint $table) {
            $table->id();

            // 🔹 Lien avec la fiche d'expression de besoin
            $table->foreignId('fiche_besoin_id')
                  ->constrained('fiches_besoin')
                  ->onDelete('cascade');

            // 🔹 Utilisateur qui valide
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            // 🔹 Informations sur la structure
            $table->string('nom_structure');
            $table->enum('type_structure', ['societe', 'organisme', 'particulier']);
            $table->string('nom_interlocuteur');
            $table->string('fonction')->nullable();

            // 🔹 Entretien
            $table->string('nom_agent_bnetd');
            $table->date('date_entretien');
            $table->text('objectifs_vises')->nullable();

            // 🔹 Statut de validation
            $table->boolean('valide')->default(false);

            // 🔹 Commentaire éventuel
            $table->text('commentaire')->nullable();

            // 🔹 Informations produit / carte
            $table->string('type_carte', 100)->nullable();     // Ville, Région, Pays, Continent
            $table->string('echelle', 50)->nullable();         // ex. 1:50000
            $table->string('orientation', 50)->nullable();     // ex. Nord
            $table->string('auteur', 255)->nullable();         // Auteur / Source
            $table->string('symbole', 100)->nullable();        // Nom du symbole
            $table->string('type_element', 50)->nullable();    // ex. Relief, Hydrographie...
            $table->decimal('latitude', 10, 6)->nullable();
            $table->decimal('longitude', 10, 6)->nullable();
            $table->integer('quantite_demandee')->default(0);   // Quantité demandée
            
            $table->string('nom_zone', 255)->nullable();       // Nom de la zone
            $table->string('type_zone', 50)->nullable();       // Type de zone

            // 🔹 Dates
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('validation_fiche_expression_besoin');
    }
};
