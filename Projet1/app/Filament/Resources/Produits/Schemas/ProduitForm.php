<?php

namespace App\Filament\Resources\Produits\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ProduitForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('reference_produit')
                    ->required(),
                TextInput::make('nom_produit')
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
                TextInput::make('stock_minimum')
                    ->numeric(),
                TextInput::make('stock_maximum')
                    ->numeric(),
                TextInput::make('stock_actuel')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('photo'),
            ]);
    }
}
