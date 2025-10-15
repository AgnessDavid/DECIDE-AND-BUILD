<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('paiement_online', function (Blueprint $table) {
            $table->id();
            $table->foreignId('caisse_online_id')->constrained('caisse_online')->onDelete('cascade');
            $table->decimal('montant', 10, 2);
            $table->enum('mode_paiement', [
                'carte',
                'paypal',
                'mobile_money',
                'especes',
                'wave',
                'moov_money',
                'mtn_money',
                'orange_money',
                'bitcoin',
                'ethereum'
            ])->change();

            // Modifier la colonne categorie pour accepter "crypto"
            $table->enum('categorie', [
                'espèces',
                'mobile_money',
                'en_ligne',
                'crypto'
            ])->nullable()->change();

            $table->enum('statut', ['en_attente', 'réussi', 'échoué'])->default('en_attente');
            $table->string('reference_transaction')->nullable(); // ajouté pour suivi transaction
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('paiement_online');
    }
};
