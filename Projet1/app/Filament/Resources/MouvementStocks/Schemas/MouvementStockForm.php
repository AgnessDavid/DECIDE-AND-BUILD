<?php

namespace App\Filament\Resources\MouvementStocks\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use App\Models\Produit;

class MouvementStockForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Produit sélectionné
                Select::make('produit_id')
                    ->relationship('produit', 'nom_produit')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn ($state, callable $set) => 
                        $set('stock_actuel', Produit::find($state)?->stock_actuel ?? 0)
                    ),

                DatePicker::make('date_mouvement')
                    ->required(),

              TextInput::make('numero_bon')
               ->disabled() // désactivé car généré automatiquement
               ->default(fn () => \App\Models\MouvementStock::genererNumero())
               ->required(),


                Select::make('type_mouvement')
                    ->options([
                        'entree' => 'Entrée',
                        'sortie' => 'Sortie'
                    ])
                    ->required()
                    ->reactive(),

                // Quantités séparées selon type
                TextInput::make('quantite_entree')
                    ->label('Quantité entrée')
                    ->numeric()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set, callable $get) {
                        if ($get('type_mouvement') === 'entree') {
                            $stockActuel = Produit::find($get('produit_id'))?->stock_actuel ?? 0;
                            $set('stock_resultant', $stockActuel + (int) $state);
                        }
                    }),

                TextInput::make('quantite_sortie')
                    ->label('Quantité sortie')
                    ->numeric()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set, callable $get) {
                        if ($get('type_mouvement') === 'sortie') {
                            $stockActuel = Produit::find($get('produit_id'))?->stock_actuel ?? 0;
                            $set('stock_resultant', $stockActuel - (int) $state);
                        }
                    }),

                // Stock actuel (lecture seule)
                TextInput::make('stock_actuel')
                    ->numeric()
                    ->disabled()
                    ->dehydrated(false),

                // Stock résultant après mouvement
                TextInput::make('stock_resultant')
                    ->numeric()
                    ->disabled(),
            ]);
    }
}
