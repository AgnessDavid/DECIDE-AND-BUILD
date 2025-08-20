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
    Schema::create('cartes', function (Blueprint $table) {
        $table->id('id_carte'); // Utilisation de id_carte comme PK
        $table->string('titre');
        $table->text('description')->nullable();
        $table->string('image')->nullable();
        $table->decimal('prix', 8, 2);
        $table->integer('stock')->default(0);
        $table->foreignId('id_categorie')->constrained('categories', 'id_categorie')->onDelete('cascade');
        $table->timestamps();
    });
}
// ...
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cartes');
    }
};
