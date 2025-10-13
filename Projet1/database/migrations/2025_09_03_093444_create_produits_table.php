<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produits', function (Blueprint $table) {

            $table->id();

            // Colonnes existantes avec uniques
            $table->string('reference_produit', 100)->unique()->after('id');
            $table->string('nom_produit', 255)->unique()->after('reference_produit');
            $table->text('description')->nullable()->after('nom_produit');
            $table->integer('stock_minimum')->nullable()->after('description');
            $table->integer('stock_maximum')->nullable()->after('stock_minimum');
            $table->integer('stock_actuel')->default(0)->after('stock_maximum')->index();
            $table->integer('prix_unitaire_ht')->default(0);
            $table->string('photo')->nullable()->after('prix_unitaire_ht');

            // Colonnes carte géographique
            $table->string('titre', 255)->nullable();
            $table->enum('type_carte', ['carte', 'plan'])->default('carte');
            $table->string('echelle', 50)->nullable();
            $table->string('orientation', 50);
            $table->date('date_creation')->nullable();
            $table->string('auteur', 255)->nullable();
            $table->string('symbole', 100)->nullable();
            $table->string('type_element', 50)->nullable()->index();
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->string('nom_zone', 255)->nullable()->index();
            $table->string('type_zone', 50)->nullable()->index();

            $table->timestamps(); // created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produits');
    }
};
