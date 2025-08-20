<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
// ...
public function up(): void
{
    Schema::create('lignes_commande', function (Blueprint $table) {
        $table->foreignId('id_commande')->constrained('commandes', 'id_commande')->onDelete('cascade');
        $table->foreignId('id_carte')->constrained('cartes', 'id_carte')->onDelete('cascade');
        $table->integer('quantite');
        $table->decimal('prix_unitaire', 8, 2);
        $table->primary(['id_commande', 'id_carte']); // Clé primaire composée
        // Pas de timestamps pour une table pivot simple
    });
}
// ...

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lignes_commande');
    }
};
