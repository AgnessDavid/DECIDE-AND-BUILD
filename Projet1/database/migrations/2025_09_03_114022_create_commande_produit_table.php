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
        Schema::create('commande_produit', function (Blueprint $table) {
            $table->id();

            // Clés étrangères
            $table->foreignId('commande_id')
                ->constrained('commandes')
                ->cascadeOnDelete();
            $table->foreignId('produit_id')
                ->constrained('produits')
                ->cascadeOnDelete();

            // Quantité et prix unitaire
            $table->integer('quantite')->unsigned()->default(1);
            $table->decimal('prix_unitaire_ht', 10, 2);

            // Montant HT calculé automatiquement
            $table->decimal('montant_ht', 10, 2)
                  ->storedAs('quantite * prix_unitaire_ht');

            // Montant TTC calculé automatiquement (TVA 18%)
            $table->decimal('montant_ttc', 10, 2)
                  ->storedAs('montant_ht * 1.18');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commande_produit');
    }
};
