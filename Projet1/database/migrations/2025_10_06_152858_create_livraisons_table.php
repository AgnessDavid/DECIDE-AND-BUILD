<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('livraisons', function (Blueprint $table) {
            $table->id();

            // ================= RELATIONS =================
            $table->foreignId('fiche_besoin_id')
                ->constrained('fiches_besoin')
                ->onDelete('cascade');

            $table->foreignId('produit_id')
                ->nullable()
                ->constrained('produits')
                ->onDelete('set null');

            // ================= QUANTITÉS =================
            $table->integer('quantite_demandee')->default(0);
            $table->integer('quantite_delivree')->default(0);

            // ================= INFOS LIVRAISON =================
            $table->string('livreur')->nullable();              // Nom du livreur
            $table->date('date_livraison')->nullable();         // Date de la livraison
            $table->enum('statut', ['en_attente', 'en_cours', 'livree', 'incomplete'])
                ->default('en_attente');

            $table->text('observation')->nullable();            // Notes ou remarques

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('livraisons');
    }
};
