<?php

namespace App\Filament\Resources\Ventes\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class VenteInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
             TextEntry::make('client.nom')->label('Client'),
TextEntry::make('commande.numero_commande')->label('Commande'),
TextEntry::make('montant_total')->numeric(),
TextEntry::make('mode_paiement'),
TextEntry::make('statut'),
TextEntry::make('date_vente')->dateTime(),
TextEntry::make('created_at')->dateTime(),
TextEntry::make('updated_at')->dateTime(),

            ]);
    }
}
