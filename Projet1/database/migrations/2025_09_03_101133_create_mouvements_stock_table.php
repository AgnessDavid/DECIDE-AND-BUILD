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
       Schema::create('mouvements_stock', function (Blueprint $table) {
    $table->id();

    $table->foreignId('demande_impression_id')
        ->constrained('demandes_impression')
        ->onDelete('cascade');


    $table->string('designation');
    $table->integer('quantite_entree')->nullable();
    $table->integer('quantite_sortie')->nullable();
    $table->date('date_mouvement');
    $table->string('type_mouvement'); // entrée ou sortie
    $table->text('details')->nullable();

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mouvements_stock');
    }
};

