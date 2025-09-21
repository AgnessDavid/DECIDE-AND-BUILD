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
            // Colonnes existantes
            $table->string('reference_produit', 100)->unique()->after('id');
            $table->string('nom_produit', 255)->after('reference_produit');
            $table->text('description')->nullable()->after('nom_produit');
            $table->integer('stock_minimum')->nullable()->after('description');
            $table->integer('stock_maximum')->nullable()->after('stock_minimum');
            $table->integer('stock_actuel')->default(0)->after('stock_maximum');
            $table->decimal('prix_unitaire_ht', 10, 2)->default(0)->after('stock_actuel');
            $table->string('photo')->nullable()->after('prix_unitaire_ht');

            // Nouvelles colonnes pour carte géographique
            $table->string('titre', 255)->nullable();            // Titre de la carte
                      // Type (ville, région, pays, continent)
            $table->string('echelle', 50)->nullable();            // Échelle (ex. 1:50000)
            $table->string('orientation', 50);     // Orientation (ex. Nord)
            $table->date('date_creation')->nullable();     // Date de création
            $table->string('auteur', 255)->nullable();  // Auteur / source
            $table->string('symbole', 100)->nullable();         // Nom du symbole (rivière, montagne...)
            $table->string('type_element', 50)->nullable();    // Type d’élément (relief, hydrographie, route, ville...)
            $table->decimal('latitude', 10, 7); // Latitude
            $table->decimal('longitude', 10, 7);  // Longitude
            $table->string('nom_zone', 255)->nullable();  // Nom de la zone (région, pays...)
            $table->string('type_zone', 50)->nullable();    // Type de zone (région, pays, département)
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
                'titre',
                'type',
                'echelle',
                'orientation',
                'date_creation',
                'auteur',
                'symbole',
                'type_element',
                'latitude',
                'longitude',
                'nom_zone',
                'type_zone',
            ]);
        });
    }
};
