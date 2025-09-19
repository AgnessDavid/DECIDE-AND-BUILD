<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('caisse', function (Blueprint $table) {
            $table->id();
            
            // Référence à la commande
            $table->foreignId('commande_id')
                  ->constrained('commandes')
                  ->onDelete('cascade');

            // Référence au client
            $table->foreignId('client_id')
                  ->constrained('clients')
                  ->onDelete('cascade');

            
            $table->decimal('montant_ht', 15, 2);
            $table->decimal('tva', 5, 2)->default(18.00);
            $table->decimal('montant_ttc', 15, 2);

            // Montant payé par le client et monnaie rendue
            $table->decimal('entree', 15, 2);
            $table->decimal('sortie', 15, 2);

            // Statut de la commande dans la caisse (payé / impayé)
            $table->enum('statut', ['payé', 'impayé'])->default('impayé');

            // Optionnel : agent de caisse
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('caisse');
    }
};
