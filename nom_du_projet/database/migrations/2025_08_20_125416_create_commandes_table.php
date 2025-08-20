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
    Schema::create('commandes', function (Blueprint $table) {
        $table->id('id_commande'); // Utilisation de id_commande comme PK
        $table->timestamp('date_commande')->useCurrent();
        $table->string('statut')->default('en preparation');
        $table->decimal('montant_total', 8, 2);
        $table->foreignId('id_client')->constrained('clients', 'id_client')->onDelete('cascade');
        $table->timestamps();
    });
}
// ...
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
