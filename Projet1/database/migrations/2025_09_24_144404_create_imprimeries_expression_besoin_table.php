<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('imprimeries_expression_besoin', function (Blueprint $table) {
            $table->id();

            // Clé étrangère vers la demande
            $table->foreignId('demande_expression_besoin_id')
                  ->constrained('demandes_expression_besoin')
                  ->onDelete('cascade');

            // Produit lié
            $table->foreignId('produit_id')
                  ->nullable()
                  ->constrained('produits')
                  ->nullOnDelete();

            $table->string('nom_produit')->nullable();
            $table->integer('quantite_demandee')->default(0);
            $table->integer('quantite_imprimee')->default(0);
            $table->string('valide_par')->nullable();
            $table->string('operateur')->nullable();
            $table->date('date_impression')->nullable();
            $table->enum('type_impression', ['simple', 'specifique']);
            $table->enum('statut', ['en_cours', 'terminee'])->default('en_cours');
            $table->string('agent_commercial')->nullable();
            $table->string('service')->nullable();
            $table->string('objet')->nullable();
            $table->date('date_demande')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('imprimeries_expression_besoin');
    }
};
