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
        Schema::create('factures', function (Blueprint $table) {
            $table->id();

            // Clés étrangères pour lier la facture à ses contextes
            $table->foreignId('commande_id')->comment('La commande originale')->constrained('commandes')->cascadeOnDelete();
            $table->foreignId('client_id')->constrained('clients')->cascadeOnDelete();
            $table->foreignId('user_id')->comment('Agent qui a créé la facture')->constrained('users')->cascadeOnDelete();

            // Informations spécifiques à la facture
            $table->string('numero_facture')->unique();
            $table->date('date_facturation');
            
            // Montants calculés
            $table->decimal('montant_ht', 10, 2)->default(0);
            $table->decimal('tva', 5, 2)->default(18.00);
            $table->decimal('montant_ttc', 10, 2)->default(0);

            // Statut du paiement de la facture
              $table->enum('statut', ['payé', 'impayé'])->default('impayé');
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factures');
    }
};

