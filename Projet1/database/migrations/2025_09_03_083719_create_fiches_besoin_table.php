<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Ce fichier est basé sur votre code.
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fiches_besoin', function (Blueprint $table) {
            $table->id();

            // Infos structure
            $table->string('nom_structure');
            $table->enum('type_structure', ['societe', 'organisme', 'particulier']);
            $table->string('nom_interlocuteur');
            $table->string('fonction')->nullable();

            // Contacts
            $table->string('telephone')->nullable();
            $table->string('cellulaire')->nullable();
            $table->string('fax')->nullable();
            $table->string('email')->nullable();

            // Entretien
            $table->string('nom_agent_bnetd');
            $table->date('date_entretien');
            $table->text('objectifs_vises')->nullable(); // Ajouté depuis le formulaire

            // Options
            $table->boolean('commande_ferme')->default(false);
            $table->boolean('demande_facture_proforma')->default(false);

            // Livraison
            $table->string('delai_souhaite')->nullable();
            $table->date('date_livraison_prevue')->nullable();
            $table->date('date_livraison_reelle')->nullable();

            // Signatures (vos ajouts)
            $table->string('signature_client')->nullable();
            $table->string('signature_agent_bnetd')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fiches_besoin');
    }
};
