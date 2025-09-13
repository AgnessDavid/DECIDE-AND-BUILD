<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('validations', function (Blueprint $table) {
            $table->id();

            // Fiche de besoin optionnelle
            $table->foreignId('fiche_besoin_id')
                ->nullable()
                ->constrained('fiches_besoins')
                ->nullOnDelete();

            // Demande d'impression optionnelle
            $table->foreignId('demande_id')
                ->nullable()
                ->constrained('demandes_impression')
                ->nullOnDelete();

            // Utilisateur validateur
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Statut de la validation
            $table->enum('statut', ['en_attente', 'validée'])
                ->default('en_attente');

            // Champs d'autorisation / visa
            $table->date('date_visa_chef_service')->nullable();
            $table->string('nom_visa_chef_service')->nullable();
            $table->date('date_autorisation')->nullable();
            $table->boolean('est_autorise_chef_informatique')->default(false);
            $table->string('nom_visa_autorisateur')->nullable();
            $table->date('date_impression')->nullable();

            // Notes facultatives
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('validations');
    }
};
