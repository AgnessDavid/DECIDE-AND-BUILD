<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('commande_produit_online', function (Blueprint $table) {
            $table->id();
            $table->foreignId('commande_online_id')->constrained('commande_online')->onDelete('cascade');
            $table->foreignId('produit_id')->constrained('produits')->onDelete('cascade');
            $table->integer('quantite')->default(1);
            $table->decimal('prix_unitaire_ht', 10, 2);
            $table->decimal('montant_ht', 15, 2)->default(0)->change();  // calculé au moment de la validation
            $table->decimal('montant_tcc', 15, 2)->default(0)->change();  // montant_ht * 1.18
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('commande_produit_online');
    }
};
