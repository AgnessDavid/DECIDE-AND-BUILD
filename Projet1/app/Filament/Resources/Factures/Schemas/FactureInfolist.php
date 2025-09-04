<?php

namespace App\Filament\Resources\Factures\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class FactureInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('commande.id'),
                TextEntry::make('client.id'),
                TextEntry::make('user.name'),
                TextEntry::make('numero_facture'),
                TextEntry::make('date_facturation')
                    ->date(),
                TextEntry::make('montant_ht')
                    ->numeric(),
                TextEntry::make('tva')
                    ->numeric(),
                TextEntry::make('montant_ttc')
                    ->numeric(),
                TextEntry::make('statut_paiement'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
