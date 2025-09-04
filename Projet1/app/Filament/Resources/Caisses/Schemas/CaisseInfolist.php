<?php

namespace App\Filament\Resources\Caisses\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class CaisseInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('user_id')
                    ->numeric(),
                TextEntry::make('paiement_id')
                    ->numeric(),
                TextEntry::make('type'),
                TextEntry::make('montant')
                    ->numeric(),
                TextEntry::make('date_mouvement')
                    ->dateTime(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
