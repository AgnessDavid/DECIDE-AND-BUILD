<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gestion_impressions', function (Blueprint $table) {
            $table->id();

            // Relations
            $table->foreignId('imprimerie_id')->nullable()->constrained('imprimeries')->nullOnDelete();
            $table->foreignId('demande_id')->nullable()->constrained('demandes_impression')->nullOnDelete();
            $table->foreignId('produit_id')->constrained('produits')->cascadeOnDelete();

            // Infos produit et impression
            $table->string('nom_produit')->nullable();
            $table->integer('quantite_demandee')->default(0);
            $table->integer('quantite_imprimee')->default(0);

            // Suivi de l’impression
            $table->enum('type_impression', ['simple', 'specifique'])->nullable();
            $table->enum('statut', ['en_cours', 'terminee'])->default('en_cours');
            $table->date('date_impression')->nullable();
            $table->date('date_demande')->nullable();

            // Responsables
            $table->string('valide_par')->nullable();
            $table->string('operateur')->nullable();
            $table->string('agent_commercial')->nullable();
            $table->string('service')->nullable();
            $table->string('objet')->nullable();

            // Timestamps
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gestion_impressions');
    }
};
