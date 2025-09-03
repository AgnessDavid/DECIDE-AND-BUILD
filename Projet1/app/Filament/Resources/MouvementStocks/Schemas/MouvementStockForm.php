<?php

namespace App\Filament\Resources\MouvementStocks\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MouvementStockForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('produit_id')
                    ->relationship('produit', 'id')
                    ->required(),
                DatePicker::make('date_mouvement')
                    ->required(),
                TextInput::make('numero_bon'),
                Select::make('type_mouvement')
                    ->options(['entree' => 'Entree', 'sortie' => 'Sortie'])
                    ->required(),
                TextInput::make('quantite')
                    ->required()
                    ->numeric(),
                TextInput::make('stock_resultant')
                    ->required()
                    ->numeric(),
                TextInput::make('en_commande')
                    ->numeric(),
            ]);
    }
}
