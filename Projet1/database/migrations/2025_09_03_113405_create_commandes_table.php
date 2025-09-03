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
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();

            // Clés étrangères
            $table->foreignId('user_id')->comment('Agent qui a créé la commande')->constrained('users')->cascadeOnDelete();
            $table->foreignId('client_id')->constrained('clients')->cascadeOnDelete();
            $table->foreignId('fiche_besoin_id')->constrained('fiches_besoin')->cascadeOnDelete();

            // Informations sur la commande
            $table->string('numero_commande')->unique();
            $table->date('date_commande');
            
            // Montants
            $table->decimal('montant_ht', 10, 2)->default(0);
            $table->decimal('tva', 5, 2)->default(18.00);
            $table->decimal('montant_ttc', 10, 2)->default(0);

            // --- CHAMP AJOUTÉ ---
            $table->enum('moyen_de_paiement', ['en_ligne', 'especes', 'cheque', 'virement_bancaire'])->nullable()->comment('Moyen de paiement prévu');

            // Le statut de la commande indique si elle a été facturée
            $table->enum('statut', ['brouillon', 'validee', 'partiellement_facturee', 'facturee', 'annulee'])->default('brouillon');
            
            $table->text('notes_internes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};

