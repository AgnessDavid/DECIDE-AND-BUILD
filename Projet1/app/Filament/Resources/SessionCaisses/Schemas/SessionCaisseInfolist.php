<?php

namespace App\Filament\Resources\SessionCaisses\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SessionCaisseInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('user.name'),
                TextEntry::make('solde_initial')
                    ->numeric(),
                TextEntry::make('entrees')
                    ->numeric(),
                TextEntry::make('sorties')
                    ->numeric(),
                TextEntry::make('solde_final')
                    ->numeric(),
                TextEntry::make('statut'),
                TextEntry::make('ouvert_le')
                    ->dateTime(),
                TextEntry::make('ferme_le')
                    ->dateTime(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
