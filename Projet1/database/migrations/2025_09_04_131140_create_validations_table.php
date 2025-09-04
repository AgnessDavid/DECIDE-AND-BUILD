<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('validations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('fiche_besoin_id')
                ->constrained('fiches_besoin')
                ->cascadeOnDelete()
                ->comment('Fiche de besoin validée');

            $table->foreignId('user_id')
                ->nullable() // permet de ne pas fournir de valeur immédiatement
                ->constrained('users')
                ->nullOnDelete(); // si l’utilisateur est supprimé, la colonne devient NULL


            $table->enum('statut', ['en_attente', 'validée'])
                ->default('en_attente')
                ->comment('Statut de la validation');

            $table->text('notes')->nullable()->comment('Notes éventuelles');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('validations');
    }
};
