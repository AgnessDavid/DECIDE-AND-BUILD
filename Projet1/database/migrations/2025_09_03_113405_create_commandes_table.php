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
            $table->foreignId('user_id')
                ->comment('Agent qui a créé la commande')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('client_id')
                ->constrained('clients')
                ->cascadeOnDelete();


            // Fiche de besoin optionnelle
        

            // Informations sur la commande
            $table->string('numero_commande')->unique();
            $table->date('date_commande');

            // Montants globaux pour la commande
            $table->decimal('montant_ht', 10, 2)->default(0);
            $table->decimal('tva', 5, 2)->default(18.00);
            $table->decimal('montant_ttc', 10, 2)->default(0);

            // Moyen de paiement
            $table->enum('moyen_de_paiement', ['en_ligne', 'especes', 'cheque', 'virement_bancaire'])
                ->nullable()
                ->comment('Moyen de paiement prévu');

            // Statut de la commandeChatGPT can make mistakes. Check important info.
            $table->enum('statut', ['payé', 'impayé'])->default('impayé');

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
