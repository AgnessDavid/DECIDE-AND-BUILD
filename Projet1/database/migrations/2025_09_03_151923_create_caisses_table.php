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
        Schema::create('caisse', function (Blueprint $table) {
            $table->id();

            // Clés étrangères
            $table->foreignId('user_id')->comment('Agent responsable du mouvement')->constrained('users');
            $table->foreignId('paiement_id')->nullable()->comment('Lien vers le paiement si applicable')->constrained('paiements')->nullOnDelete();

            // Informations sur le mouvement
            $table->enum('type', ['entree', 'sortie']);
            $table->decimal('montant', 10, 2);
            $table->text('motif'); // Ex: "Paiement facture F2025-001", "Retrait pour achat fournitures"
            $table->dateTime('date_mouvement');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('caisse');
    }
};

