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
        Schema::create('imprimeries', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('validation_id')->nullable(); // Validation liée
            $table->unsignedBigInteger('demande_id')->nullable();   // Demande d'impression liée
            $table->unsignedBigInteger('produit_id')->nullable();   // Produit lié
            $table->string('nom_produit')->nullable();              // Nom / Désignation du produit
            $table->integer('quantite_demandee')->default(0);     // Quantité à imprimer
            $table->integer('quantite_imprimee')->default(0);       // Quantité imprimée
            $table->string('valide_par')->nullable();               // Nom de la personne qui a validé
            $table->string('operateur')->nullable();                // Personne qui fera l'impression
            $table->date('date_impression')->nullable();            // Date de l'impression
            $table->enum('type_impression', ['simple', 'specifique']);
             $table->enum('statut', ['en_cours', 'terminee'])->default('en_cours');
           
            $table->string('agent_commercial')->nullable();
            $table->string('service')->nullable();
            $table->string('objet')->nullable();
               $table->date('date_demande')->nullable();
             $table->timestamps();
            
            
            // Clés étrangères
            $table->foreign('validation_id')->references('id')->on('validations')->onDelete('cascade');
            $table->foreign('demande_id')->references('id')->on('demandes_impression')->onDelete('cascade');
            $table->foreign('produit_id')->references('id')->on('produits')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imprimeries');
    }
};
