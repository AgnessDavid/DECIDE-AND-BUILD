<?php

namespace App\Filament\Resources\Produits\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ProduitInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
                TextEntry::make('reference_produit'),
                TextEntry::make('nom_produit'),
                TextEntry::make('stock_minimum')
                    ->numeric(),
                TextEntry::make('stock_maximum')
                    ->numeric(),
                TextEntry::make('stock_actuel')
                    ->numeric(),
                TextEntry::make('photo'),
            ]);
    }
}
