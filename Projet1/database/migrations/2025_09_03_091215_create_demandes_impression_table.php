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
        Schema::create('demandes_impression', function (Blueprint $table) {
        $table->id();
        $table->foreignId('fiche_besoin_id')->constrained('fiches_besoins')->onDelete('cascade');
        $table->foreignId('produit_id')->nullable()->constrained('produits')->onDelete('set null');

        $table->enum('type_impression', ['simple', 'specifique'])->default('simple');

    // Impression simple → produit existant

    // Impression spécifique → produit libre
        $table->string('produit_souhaite')->nullable();

        $table->string('produit_souhaite')->nullable;

        $table->string('numero_ordre')->nullable();
        $table->string('designation')->nullable();
        $table->integer('quantite_demandee')->default(0);
        $table->integer('quantite_imprimee')->default(0);
        $table->date('date_demande')->nullable();

        $table->string('agent_commercial')->nullable();
        $table->string('service')->nullable();
        $table->string('objet')->nullable();

        $table->date('date_visa_chef_service')->nullable();
        $table->string('nom_visa_chef_service')->nullable();
        $table->date('date_autorisation')->nullable();
        $table->boolean('est_autorise_chef_informatique')->default(false);
        $table->string('nom_visa_autorisateur')->nullable();
        $table->date('date_impression')->nullable();
        $table->integer('quantite_totale_imprimee')->default(0);
        $table->string('nom_visa_agent_impression')->nullable();
        $table->date('date_reception_stock')->nullable();
        $table->integer('quantite_totale_receptionnee')->default(0);
        $table->text('details_reception')->nullable();
        $table->text('observations')->nullable();
        $table->enum('statut', ['en_attente', 'en_production', 'terminer'])->default('en_attente');
        $table->string('nom_signature_final')->nullable();

        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demandes_impression');
    }
};