<?php

namespace App\Filament\Resources\Imprimeries\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\DateEntry;
use Filament\Schemas\Schema;

class ImprimerieInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextEntry::make('nom_produit')
                ->label('Nom du produit'),

            TextEntry::make('quantite_a_imprimer')
                ->label('Quantité à imprimer'),

            TextEntry::make('valide_par')
                ->label('Validé par'),

            TextEntry::make('operateur')
                ->label('Opérateur'),

          TextEntry::make('date_impression')
    ->label('Date d\'impression')
    ->formatStateUsing(fn($state) => $state ? date('d/m/Y', strtotime($state)) : null),

        ]);
    }
}
