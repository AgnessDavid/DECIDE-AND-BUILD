<?php

namespace App\Filament\Resources\GestionImpressions\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class GestionImpressionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('imprimerie.id'),
                TextEntry::make('demande.id'),
                TextEntry::make('produit.id'),
                TextEntry::make('nom_produit'),
                TextEntry::make('quantite_demandee')
                    ->numeric(),
                TextEntry::make('quantite_imprimee')
                    ->numeric(),
                TextEntry::make('type_impression'),
                TextEntry::make('statut'),
                TextEntry::make('date_impression')
                    ->date(),
                TextEntry::make('date_demande')
                    ->date(),
                TextEntry::make('valide_par'),
                TextEntry::make('operateur'),
                TextEntry::make('agent_commercial'),
                TextEntry::make('service'),
                TextEntry::make('objet'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
