<?php

namespace App\Filament\Resources\Commandes\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class CommandeInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('user.name'),
                TextEntry::make('client.id'),
                TextEntry::make('ficheBesoin.id'),
                TextEntry::make('numero_commande'),
                TextEntry::make('date_commande')
                    ->date(),
                TextEntry::make('montant_ht')
                    ->numeric(),
                TextEntry::make('tva')
                    ->numeric(),
                TextEntry::make('montant_ttc')
                    ->numeric(),
                TextEntry::make('moyen_de_paiement'),
                TextEntry::make('statut'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
