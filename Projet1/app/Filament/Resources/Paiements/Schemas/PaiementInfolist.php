<?php

namespace App\Filament\Resources\Paiements\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PaiementInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('facture.id'),
                TextEntry::make('user.name'),
                TextEntry::make('numero_recu'),
                TextEntry::make('date_paiement')
                    ->date(),
                TextEntry::make('montant_paye')
                    ->numeric(),
                TextEntry::make('moyen_de_paiement'),
                TextEntry::make('reference_paiement'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
