<?php

namespace App\Filament\Resources\MouvementStocks\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class MouvementStockInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('produit.id'),
                TextEntry::make('date_mouvement')
                    ->date(),
                TextEntry::make('numero_bon'),
                TextEntry::make('type_mouvement'),
                TextEntry::make('quantite')
                    ->numeric(),
                TextEntry::make('stock_resultant')
                    ->numeric(),
                TextEntry::make('en_commande')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
