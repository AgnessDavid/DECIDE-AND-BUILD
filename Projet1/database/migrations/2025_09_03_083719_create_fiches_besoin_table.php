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
        Schema::create('fiches_besoin', function (Blueprint $table) {
            $table->id();

            // Lien produit
            $table->string('produit_souhaite');
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
            $table->text('objectifs_vises')->nullable();

            // Options
            $table->boolean('commande_ferme')->default(false);
            $table->boolean('demande_facture_proforma')->default(false);

            // Livraison
            $table->date('delai_souhaite')->nullable();
            $table->date('date_livraison_prevue')->nullable();
            $table->date('date_livraison_reelle')->nullable();

            // Signatures
            $table->string('signature_client')->nullable();
            $table->string('signature_agent_bnetd')->nullable();

            $table->timestamps();

            // Contrainte de clé étrangère
            $table->foreign('produit_id')
                  ->references('id')->on('produits')
                  ->onDelete('set null');
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
