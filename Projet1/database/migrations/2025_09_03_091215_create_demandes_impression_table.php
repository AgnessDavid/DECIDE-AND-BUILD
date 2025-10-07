<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('demandes_impression', function (Blueprint $table) {
            $table->id();

            //  Relation avec la fiche de besoin (si applicable)
            $table->foreignId('fiche_besoin_id')
                ->nullable()
                ->constrained('fiches_besoin')
                ->nullOnDelete();

            //  Relation avec le produit
            $table->foreignId('produit_id')
                ->nullable()
                ->constrained('produits')
                ->nullOnDelete();

            //  Type d'impression
            $table->enum('type_impression', ['simple', 'specifique'])->default('simple');

            //  Informations de la demande
            $table->string('numero_ordre')->nullable();
            $table->string('designation')->nullable();
            $table->integer('quantite_demandee')->default(0);
            $table->integer('quantite_imprimee')->default(0);
            $table->date('date_demande')->nullable();

            //  Informations sur le demandeur
            $table->string('agent_commercial')->nullable();
            $table->string('service')->nullable();
            $table->string('objet')->nullable();

            //  Validation du chef de service
            $table->date('date_visa_chef_service')->nullable();
            $table->string('nom_visa_chef_service')->nullable();

            //  Autorisation du chef informatique
            $table->date('date_autorisation')->nullable();
            $table->boolean('est_autorise_chef_informatique')->default(false);
            $table->string('nom_visa_autorisateur')->nullable();

            //  Date d'impression effective
            $table->date('date_impression')->nullable();

            //  Horodatage
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('demandes_impression');
    }
};
