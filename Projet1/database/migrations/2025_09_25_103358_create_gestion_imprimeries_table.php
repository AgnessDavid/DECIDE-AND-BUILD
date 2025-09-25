<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gestion_imprimeries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produit_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('imprimeries_expression_besoin_id')
            ->nullable()
            ->constrained('imprimeries_expression_besoin')
            ->onDelete('set null');
            $table->string('designation')->nullable();
            $table->integer('quantite_entree')->nullable();
            $table->integer('quantite_sortie')->nullable();
            $table->integer('quantite_demandee')->nullable();
            $table->integer('quantite_imprimee')->nullable();
            $table->date('date_mouvement');
            $table->string('numero_bon')->nullable();
            $table->string('type_mouvement'); // entrée / sortie
            $table->integer('stock_resultant')->default(0);
            $table->integer('stock_minimum')->nullable();
            $table->integer('stock_maximum')->nullable();
            $table->integer('stock_actuel')->nullable();
            $table->text('details')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gestion_imprimeries');
    }
};
