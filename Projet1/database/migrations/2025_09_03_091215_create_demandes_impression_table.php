<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('demandes_impression', function (Blueprint $table) {
            $table->id();

            // Relations
            $table->foreignId('fiche_besoin_id')
                ->nullable()
                ->constrained('fiches_besoins')
                ->nullOnDelete();

            $table->foreignId('produit_id')
                ->nullable()
                ->constrained('produits')
                ->nullOnDelete();

            // Type d'impression
            $table->enum('type_impression', ['simple', 'specifique'])
                ->default('simple');

            // Infos demande
            $table->string('numero_ordre')->nullable();
            $table->string('designation')->nullable();
            $table->integer('quantite_demandee')->default(0);
            $table->integer('quantite_imprimee')->default(0);
            $table->date('date_demande')->nullable();

            // Infos supplémentaires
            $table->string('agent_commercial')->nullable();
            $table->string('service')->nullable();
            $table->string('objet')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('demandes_impression');
    }
};
