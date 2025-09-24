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

    // Produit lié
$table->foreignId('produit_id')
->nullable()
->constrained('produits')
->cascadeOnDelete();

    $table->foreignId('imprimerie_id')
     ->nullable()
    ->constrained('imprimeries')
    ->cascadeOnDelete();

    // Optionnel : lien avec demande d'impression
    $table->foreignId('demande_impression_id')
        ->nullable()
        ->constrained('demandes_impression')
        ->cascadeOnDelete();

    $table->string('designation')->nullable();
    
    $table->integer('quantite_entree')->nullable();
    $table->integer('quantite_sortie')->nullable();
    
    $table->date('date_mouvement');
    $table->string('type_mouvement'); // 'entree' ou 'sortie'
 
    $table->integer('stock_resultant')->nullable(); // stock après mouvement

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

