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
        Schema::create('demandes_impression', function (Blueprint $table) {
            $table->id(); // INT PRIMARY KEY AUTO_INCREMENT
            $table->unsignedBigInteger('demande_id')->nullable(); // Clé étrangère ou identifiant interne (laissé nullable pour clarification)
            $table->string('numero_ordre', 50)->nullable(); // Numéro d'ordre de la ligne
            $table->text('designation'); // Description de l'article à imprimer
            $table->integer('quantite_demandee'); // Quantité souhaitée
            $table->integer('quantite_imprimee')->nullable(); // Quantité réellement imprimée

            // Informations générales
            $table->date('date_demande'); // Date de création de la demande
            $table->string('agent_commercial', 255)->nullable(); // Nom de l'agent commercial
            $table->string('service', 255)->nullable(); // Service demandeur
            $table->text('objet')->nullable(); // Objet de la demande

            // Section: Visa Chef Service Commercial
            $table->date('date_visa_chef_service')->nullable(); // Date du visa
            $table->string('nom_visa_chef_service', 255)->nullable(); // Nom du chef de service

            // Section: Autorisation des impressions
            $table->date('date_autorisation')->nullable(); // Date d'autorisation
            $table->boolean('est_autorise_chef_informatique')->default(false); // Case à cocher
            $table->string('nom_visa_autorisateur', 255)->nullable(); // Nom de l'autorisateur

            // Section: Impressions
            $table->date('date_impression')->nullable(); // Date d'impression
            $table->integer('quantite_totale_imprimee')->nullable(); // Quantité totale imprimée
            $table->string('nom_visa_agent_impression', 255)->nullable(); // Nom de l'agent impression

            // Section: Visa Gestionnaire de Stocks
            $table->date('date_reception_stock')->nullable(); // Date de réception
            $table->integer('quantite_totale_receptionnee')->nullable(); // Quantité totale reçue
            $table->text('details_reception')->nullable(); // Détails de réception

            // Champs additionnels
            $table->text('observations')->nullable(); // Observations générales
            $table->string('nom_signature_final', 255)->nullable(); // Nom et signature finale

            $table->timestamps(); // Champs created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demandes_impression');
    }
};