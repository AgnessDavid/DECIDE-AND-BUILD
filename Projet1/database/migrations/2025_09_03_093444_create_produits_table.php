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
        Schema::table('produits', function (Blueprint $table) {
            $table->string('reference_produit', 100)->unique()->after('id');
            $table->string('nom_produit', 255)->after('reference_produit');
            $table->text('description')->nullable()->after('nom_produit');
            $table->integer('stock_minimum')->nullable()->after('description');
            $table->integer('stock_maximum')->nullable()->after('stock_minimum');
            $table->integer('stock_actuel')->default(0)->after('stock_maximum');
            $table->decimal('prix_unitaire_ht', 10, 2)->default(0)->after('stock_actuel');
            $table->string('photo')->nullable()->after('prix_unitaire_ht');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produits', function (Blueprint $table) {
            $table->dropColumn([
                'reference_produit',
                'nom_produit',
                'description',
                'stock_minimum',
                'stock_maximum',
                'stock_actuel',
                'prix_unitaire_ht',
                'photo',
            ]);
        });
    }
};
