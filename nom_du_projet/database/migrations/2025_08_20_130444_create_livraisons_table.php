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
    Schema::create('livraisons', function (Blueprint $table) {
        $table->id('id_livraison'); // Utilisation de id_livraison comme PK
        $table->timestamp('date_expedition')->nullable();
        $table->integer('delai_estime')->nullable(); // En jours par exemple
        $table->string('statut_livraison')->default('en attente');
        $table->foreignId('id_commande')->constrained('commandes', 'id_commande')->onDelete('cascade');
        $table->timestamps();
    });
}
// ...

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livraisons');
    }
};
