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
                TextInput::make('reference_produit')
                    ->label('Référence')
                    ->required(),
                
                TextInput::make('nom_produit')
                    ->label('Nom du produit')
                    ->required(),
                
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
                    ->label('Photo du produit')
                    ->directory('produits')   // répertoire dans storage/app/public
                    ->maxSize(102400)          // taille max 100 Mo (102400 Ko)
                    ->image(),                 // valide uniquement les images
            ]);
    }
}
