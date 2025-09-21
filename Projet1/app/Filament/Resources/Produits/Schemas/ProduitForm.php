<?php

namespace App\Filament\Resources\Produits\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;

class ProduitForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // ================== Informations produit ==================
                TextInput::make('reference_produit')
                    ->label('Référence')
                    ->required()
                    ->columnSpan(2),

                TextInput::make('nom_produit')
                    ->label('Nom du produit')
                    ->required()
                    ->columnSpan(2),

                Textarea::make('description')
                    ->label('Description')
                    ->columnSpanFull(),

                TextInput::make('stock_minimum')
                    ->label('Stock minimum')
                    ->numeric(),

                TextInput::make('stock_maximum')
                    ->label('Stock maximum')
                    ->numeric(),

                TextInput::make('stock_actuel')
                    ->label('Stock actuel')
                    ->required()
                    ->numeric()
                    ->default(0),

                TextInput::make('prix_unitaire_ht')
                    ->label('Prix unitaire HT')
                    ->required()
                    ->numeric()
                    ->default(0),
FileUpload::make('photo')
    ->directory('produits')
    ->maxSize(102400) // 100 Mo
    ->image(),


                // ================== Éléments de la carte ==================
      

                TextInput::make('type')
                    ->label('Type de carte')
                    ->placeholder('ex: Ville, Région, Pays, Continent')
                    ->required(),

                TextInput::make('echelle')
                    ->label('Échelle')
                    ->placeholder('ex: 1:50000'),

                TextInput::make('orientation')
                    ->label('Orientation')
                    ->placeholder('ex: Nord'),

                TextInput::make('auteur')
                    ->label('Auteur / Source'),

                TextInput::make('symbole')
                    ->label('Symbole'),

                TextInput::make('type_element')
                    ->label('Type d’élément')
                    ->placeholder('ex: Relief, Hydrographie, Route, Ville, Fleuve, Montagne'),

                TextInput::make('latitude')
                    ->label('Latitude')
                    ->numeric()
                    ->step(0.0000001),

                TextInput::make('longitude')
                    ->label('Longitude')
                    ->numeric()
                    ->step(0.0000001),

                TextInput::make('nom_zone')
                    ->label('Nom de la zone'),

                TextInput::make('type_zone')
                    ->label('Type de zone')
                    ->placeholder('ex: Région, Département, Pays'),

                TextInput::make('date_creation')
                    ->label('Date de création')
                    ->type('date'),
            ]);
    }
}
