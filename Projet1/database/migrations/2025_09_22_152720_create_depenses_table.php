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
        Schema::create('depenses', function (Blueprint $table) {
            $table->id();
            $table->string('designation');       // Nom de la dépense
            $table->decimal('montant', 10, 2);   // Montant de la dépense
            $table->decimal('montant_total', 10, 2)->default(0); // Montant total cumulé
            $table->date('date_depense');        // Date de la dépense
            $table->string('categorie')->nullable(); // Catégorie de dépense
            $table->text('details')->nullable(); // Détails supplémentaires
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('depenses');
    }
};
