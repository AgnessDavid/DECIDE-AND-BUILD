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

            // ================= PRODUIT =================
            $table->unsignedBigInteger('produit_id')->nullable();
            $table->string('produit_souhaite');


            $table->string('nom_fiche_besoin')->nullable();
            // ================= STRUCTURE =================
            $table->string('nom_structure');
            $table->enum('type_structure', ['societe', 'organisme', 'particulier']);
            $table->string('nom_interlocuteur');
            $table->string('fonction')->nullable();
            $table->integer('quantite_demandee')->default(0);
            // ================= CONTACTS =================
            $table->string('telephone')->nullable();
            $table->string('cellulaire')->nullable();
            $table->string('fax')->nullable();
            $table->string('email')->nullable();

            // ================= ENTRETIEN =================
            $table->string('nom_agent_bnetd');
            $table->date('date_entretien');
            $table->text('objectifs_vises')->nullable();

            // ================= OPTIONS =================
            $table->boolean('commande_ferme')->default(false);
            $table->boolean('demande_facture_proforma')->default(false);

            // ================= LIVRAISON =================
            $table->date('delai_souhaite')->nullable();
            $table->date('date_livraison_prevue')->nullable();
            $table->date('date_livraison_reelle')->nullable();

            // ================= SIGNATURES =================
            $table->string('signature_client')->nullable();
            $table->string('signature_agent_bnetd')->nullable();

            // ================= INFORMATIONS CARTE =================
            $table->string('type_carte', 100)->nullable();    // Ville, Région, Pays, Continent
            $table->string('echelle', 50)->nullable();        // ex. 1:50000
            $table->string('orientation', 50)->nullable();    // ex. Nord
            $table->string('auteur', 255)->nullable();        // Auteur / Source
            $table->string('symbole', 100)->nullable();       // Nom du symbole
            $table->string('type_element', 50)->nullable();   // ex. Relief, Hydrographie...
            $table->decimal('latitude', 10, 6)->nullable();
            $table->decimal('longitude', 10, 6)->nullable();
            $table->string('nom_zone', 255)->nullable();      // Nom de la zone
            $table->string('type_zone', 50)->nullable();      // Type de zone

            // ================= TIMESTAMPS =================
            $table->timestamps();

            // ================= FOREIGN KEYS =================
            $table->foreign('produit_id')
                  ->references('id')
                  ->on('produits')
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
