<?php

namespace App\Filament\Resources\Produits\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProduitForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                // ================== Informations générales ==================
                Section::make('Informations générales')
                    ->schema([
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
                            ->numeric()
                            ->columnSpan(1),

                        TextInput::make('stock_maximum')
                            ->label('Stock maximum')
                            ->numeric()
                            ->columnSpan(1),

                        TextInput::make('stock_actuel')
                            ->label('Stock actuel')
                            ->required()
                            ->numeric()
                            ->default(0)
                            ->columnSpan(1),

                        TextInput::make('prix_unitaire_ht')
                            ->label('Prix unitaire HT')
                            ->required()
                            ->numeric()
                            ->default(0)
                            ->columnSpan(2),

                        FileUpload::make('photo')
                            ->directory('produits')
                            ->maxSize(102400)
                            ->image()
                            ->columnSpanFull(),
                    ])->columns(4), // définit 4 colonnes pour cette section

                // ================== Informations de la carte ==================
                Section::make('Informations de la carte')
                    ->schema([
                        TextInput::make('type')
                            ->label('Type de carte')
                            ->placeholder('ex: Ville, Région, Pays, Continent')
                            ->columnSpan(2),

                        TextInput::make('echelle')
                            ->label('Échelle')
                            ->placeholder('ex: 1:50000')
                            ->columnSpan(1),

                        TextInput::make('orientation')
                            ->label('Orientation')
                            ->placeholder('ex: Nord')
                            ->columnSpan(1),

                        TextInput::make('auteur')
                            ->label('Auteur / Source')
                            ->columnSpan(2),

                        TextInput::make('symbole')
                            ->label('Symbole')
                            ->columnSpan(2),

                        TextInput::make('type_element')
                            ->label('Type d’élément')
                            ->placeholder('ex: Relief, Hydrographie, Route, Ville, Fleuve, Montagne')
                            ->columnSpan(2),

                        TextInput::make('latitude')
                            ->label('Latitude')
                            ->numeric()
                            ->step(0.0000001)
                            ->columnSpan(1),

                        TextInput::make('longitude')
                            ->label('Longitude')
                            ->numeric()
                            ->step(0.0000001)
                            ->columnSpan(1),

                        TextInput::make('nom_zone')
                            ->label('Nom de la zone')
                            ->columnSpan(2),

                        TextInput::make('type_zone')
                            ->label('Type de zone')
                            ->placeholder('ex: Région, Département, Pays')
                            ->columnSpan(2),

                        TextInput::make('date_creation')
                            ->label('Date de création')
                            ->type('date')
                            ->columnSpan(2),
                    ])->columns(4), // définit 4 colonnes pour cette section

            ]);
    }
}
